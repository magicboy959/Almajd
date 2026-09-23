<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function(){
 Route::post('auth/register',[AuthController::class,'register']); Route::post('auth/login',[AuthController::class,'login']); Route::post('auth/forgot-password',[AuthController::class,'forgotPassword']); Route::post('auth/reset-password',[AuthController::class,'resetPassword']);
 Route::get('services',[ServiceController::class,'index']); Route::get('services/{slug}',[ServiceController::class,'show']); Route::get('faqs',[PublicContentController::class,'faqs']); Route::get('team',[PublicContentController::class,'team']); Route::get('pages/{slug}',[PublicContentController::class,'page']); Route::post('contact-enquiries',[PublicContentController::class,'enquiry'])->middleware('throttle:10,1'); Route::post('service-requests/track/{reference}',[ServiceRequestController::class,'track']); Route::post('service-requests',[ServiceRequestController::class,'store'])->middleware('throttle:10,1');
 Route::middleware('auth:sanctum')->group(function(){Route::post('auth/logout',[AuthController::class,'logout']); Route::get('auth/profile',[AuthController::class,'profile']); Route::patch('auth/profile',[AuthController::class,'updateProfile']); Route::get('auth/email/verify',[VerificationController::class,'verify'])->middleware('signed'); Route::post('auth/email/verification-notification',[VerificationController::class,'resend']); Route::get('service-requests',[ServiceRequestController::class,'mine']); Route::get('service-requests/{serviceRequest}',[ServiceRequestController::class,'show']); Route::post('service-requests/{serviceRequest}/documents',[DocumentController::class,'store']); Route::get('documents/{document}/download',[DocumentController::class,'download']); Route::patch('admin/service-requests/{serviceRequest}/status',[ServiceRequestController::class,'updateStatus']);});
});
