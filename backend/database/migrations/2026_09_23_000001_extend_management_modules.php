<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::table('quotations', function(Blueprint $t){$t->date('issued_at')->nullable();$t->string('currency',3)->default('AED');$t->decimal('discount',12,2)->default(0);$t->decimal('tax',12,2)->default(0)->change();$t->text('internal_notes')->nullable();$t->text('customer_notes')->nullable();$t->foreignId('accepted_by')->nullable()->constrained('users')->nullOnDelete();});
  Schema::table('quotation_items', function(Blueprint $t){$t->decimal('discount',12,2)->default(0);});
  Schema::table('invoices', function(Blueprint $t){$t->foreignId('quotation_id')->nullable()->constrained()->nullOnDelete();$t->date('issued_at')->nullable();$t->date('due_at')->nullable();$t->string('currency',3)->default('AED');$t->decimal('discount',12,2)->default(0);$t->decimal('amount_paid',12,2)->default(0);$t->text('notes')->nullable();$t->text('terms')->nullable();$t->string('status')->default('draft')->change();});
  Schema::table('invoice_items', function(Blueprint $t){$t->decimal('discount',12,2)->default(0);});
  Schema::table('payments', function(Blueprint $t){$t->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();$t->string('reference')->nullable()->unique();$t->string('currency',3)->default('AED');$t->string('method')->default('manual');$t->string('receipt_number')->nullable()->unique();$t->text('proof_path')->nullable();$t->text('staff_notes')->nullable();$t->timestamp('refunded_at')->nullable();});
  Schema::table('faqs', function(Blueprint $t){$t->foreignId('service_id')->nullable()->constrained()->nullOnDelete();$t->string('category')->nullable();$t->boolean('featured')->default(false);});
  Schema::table('team_members', function(Blueprint $t){$t->string('email')->nullable();$t->string('phone',30)->nullable();$t->boolean('featured')->default(false);});
  Schema::table('pages', function(Blueprint $t){$t->string('slug_ar')->nullable()->unique();$t->dateTime('published_at')->nullable();$t->string('page_type')->default('standard');$t->string('og_image_path')->nullable();$t->boolean('show_in_navigation')->default(false);$t->unsignedInteger('sort_order')->default(0);});
  Schema::table('settings', function(Blueprint $t){$t->text('encrypted_value')->nullable();});
  Schema::table('request_documents', function(Blueprint $t){$t->string('document_type')->nullable();$t->string('verification_status')->default('pending');$t->text('rejection_reason')->nullable();$t->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();$t->timestamp('verified_at')->nullable();});
  Schema::table('request_messages', function(Blueprint $t){$t->foreignId('recipient_id')->nullable()->constrained('users')->nullOnDelete();$t->string('audience')->default('customer');$t->string('attachment_path')->nullable();});
  Schema::table('contact_enquiries', function(Blueprint $t){$t->foreignId('service_id')->nullable()->constrained()->nullOnDelete();$t->string('preferred_language',5)->default('en');$t->string('source_page')->nullable();$t->json('utm_parameters')->nullable();$t->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();$t->text('internal_notes')->nullable();$t->timestamp('contacted_at')->nullable();$t->string('status')->default('new')->change();});
 }
 public function down(): void {}
};
