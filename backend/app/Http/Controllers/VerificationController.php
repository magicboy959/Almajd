<?php
namespace App\Http\Controllers;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
class VerificationController extends Controller { public function verify(Request $request){$user=$request->user(); abort_unless($request->hasValidSignature(),403); if(!$user->hasVerifiedEmail()){ $user->markEmailAsVerified(); event(new Verified($user)); } return response()->json(['verified'=>true]); } public function resend(Request $request){if($request->user()->hasVerifiedEmail()){return response()->json(['message'=>'Already verified.']);} $request->user()->sendEmailVerificationNotification(); return response()->json(['message'=>'Verification email sent.']);} }
