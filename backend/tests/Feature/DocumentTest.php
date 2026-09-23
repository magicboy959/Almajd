<?php
namespace Tests\Feature;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
class DocumentTest extends TestCase { use RefreshDatabase; public function test_document_type_is_validated(): void { $this->seed(); $user=User::factory()->create(); $user->customer()->create(); $request=$this->actingAs($user)->postJson('/api/v1/service-requests',['service_id'=>Service::first()->id,'full_name'=>'Customer','mobile'=>$user->mobile,'email'=>$user->email,'details'=>'Need help','consent_at'=>true])->json(); $this->actingAs($user)->post('/api/v1/service-requests/'.$request['id'].'/documents',['document'=>UploadedFile::fake()->create('malware.exe',10,'application/octet-stream')])->assertStatus(422); } }
