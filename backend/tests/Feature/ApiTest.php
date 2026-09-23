<?php
namespace Tests\Feature;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ApiTest extends TestCase {
 use RefreshDatabase;
 protected function setUp(): void { parent::setUp(); $this->seed(); }
 public function test_services_are_public(): void { $this->getJson('/api/v1/services')->assertOk()->assertJsonStructure(['data']); }
 public function test_customer_can_register_and_submit_request(): void { $registration=$this->postJson('/api/v1/auth/register',['name'=>'Customer','email'=>'customer@example.com','mobile'=>'0501234567','password'=>'StrongPassword123!','password_confirmation'=>'StrongPassword123!'])->assertCreated(); $token=$registration->json('token'); $service=Service::first(); $this->withHeader('Authorization','Bearer '.$token)->postJson('/api/v1/service-requests',['service_id'=>$service->id,'full_name'=>'Customer','mobile'=>'0501234567','email'=>'customer@example.com','details'=>'Need help','consent_at'=>true])->assertCreated()->assertJsonPath('status','new')->assertJsonPath('reference','QM-'.now()->year.'-000001'); }
 public function test_request_tracking_requires_matching_contact(): void { $service=Service::first(); $request=$this->postJson('/api/v1/service-requests',['service_id'=>$service->id,'full_name'=>'Customer','mobile'=>'0501234567','email'=>'customer@example.com','details'=>'Need help','consent_at'=>true])->assertCreated(); $this->postJson('/api/v1/service-requests/track/'.$request->json('reference'),['contact'=>'wrong@example.com'])->assertNotFound(); $this->postJson('/api/v1/service-requests/track/'.$request->json('reference'),['contact'=>'customer@example.com'])->assertOk(); }
 public function test_status_history_is_created_and_staff_can_update(): void { $service=Service::first(); $request=$this->postJson('/api/v1/service-requests',['service_id'=>$service->id,'full_name'=>'Customer','mobile'=>'0501234567','email'=>'customer@example.com','details'=>'Need help','consent_at'=>true])->json(); $admin=User::where('email','admin@qemmat-almajd.ae')->first(); $response=$this->actingAs($admin)->patchJson('/api/v1/admin/service-requests/'.$request['id'].'/status',['status'=>'in_progress','customer_note'=>'Started']); $response->assertOk()->assertJsonPath('status','in_progress'); $this->assertDatabaseHas('request_status_histories',['new_status'=>'in_progress','customer_note'=>'Started']); }
}
