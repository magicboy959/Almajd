<?php
namespace Tests\Feature;
use App\Filament\Resources\InvoiceResource;
use App\Models\ContactEnquiry;
use App\Models\Faq;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ManagementModulesTest extends TestCase {
 use RefreshDatabase;
 protected function setUp():void{parent::setUp();$this->seed();}
 private function request():ServiceRequest{return ServiceRequest::create(['service_id'=>Service::first()->id,'full_name'=>'Finance Customer','mobile'=>'0501111111','email'=>'finance@example.com','details'=>'Finance test','consent_at'=>true]);}
 public function test_quotation_calculates_server_side():void{$request=$this->request();$quotation=Quotation::create(['service_request_id'=>$request->id,'tax'=>10,'discount'=>5]);$quotation->items()->create(['description'=>'Service','quantity'=>2,'unit_price'=>100,'discount'=>3]);$quotation->load('items')->recalculate();$quotation->saveQuietly();$this->assertSame('202.00',(string)$quotation->fresh()->total);$this->assertStringStartsWith('QT-', $quotation->number);}
 public function test_invoice_balance_follows_completed_payments():void{$request=$this->request();$invoice=Invoice::create(['service_request_id'=>$request->id,'tax'=>0,'discount'=>0]);$invoice->items()->create(['description'=>'Work','quantity'=>1,'unit_price'=>100,'discount'=>0]);$invoice->load('items')->recalculate();$invoice->saveQuietly();$payment=Payment::create(['invoice_id'=>$invoice->id,'amount'=>40,'method'=>'manual','status'=>'completed']);$this->assertSame('40.00',(string)$invoice->fresh()->amount_paid);$this->assertSame('partially_paid',$invoice->fresh()->status);$this->assertSame('PAY-',substr($payment->reference,0,4));}
 public function test_only_published_faqs_are_public():void{$faq=Faq::create(['question_en'=>'Hidden','question_ar'=>'مخفي','answer_en'=>'Hidden','answer_ar'=>'مخفي','published'=>false]);$this->getJson('/api/v1/faqs')->assertOk()->assertJsonMissing(['question_en'=>'Hidden']);}
 public function test_internal_messages_are_not_exposed_to_customers():void{$request=$this->request();$user=User::factory()->create(['email'=>'customer2@example.com','mobile'=>'0502222222']);$customer=$user->customer()->create();$request->update(['customer_id'=>$customer->id]);$request->messages()->create(['body'=>'Internal only','customer_visible'=>false,'audience'=>'internal']);$request->messages()->create(['body'=>'Visible','customer_visible'=>true,'audience'=>'customer']);$token=$user->createToken('test')->plainTextToken;$this->withToken($token)->getJson('/api/v1/service-requests')->assertOk()->assertJsonFragment(['body'=>'Visible'])->assertJsonMissing(['body'=>'Internal only']);}
 public function test_settings_key_is_a_singleton():void{Setting::create(['key'=>'company_name','type'=>'string','value'=>'Qemmat']);$this->expectException(\Illuminate\Database\QueryException::class);Setting::create(['key'=>'company_name','type'=>'string','value'=>'Duplicate']);}
 public function test_accountant_can_view_finance_and_case_officer_cannot():void{$accountant=User::factory()->create();$accountant->assignRole('Accountant');$caseOfficer=User::factory()->create();$caseOfficer->assignRole('Case Officer');$this->actingAs($accountant);$this->assertTrue(InvoiceResource::canViewAny());$this->actingAs($caseOfficer);$this->assertFalse(InvoiceResource::canViewAny());}
 public function test_contact_enquiry_assignment_and_status_are_stored():void{$staff=User::where('email','admin@qemmat-almajd.ae')->first();$enquiry=ContactEnquiry::create(['name'=>'Lead','email'=>'lead@example.com','message'=>'Hello','status'=>'new']);$enquiry->update(['assigned_to'=>$staff->id,'status'=>'contacted','contacted_at'=>now()]);$this->assertDatabaseHas('contact_enquiries',['id'=>$enquiry->id,'status'=>'contacted','assigned_to'=>$staff->id]);}
}
