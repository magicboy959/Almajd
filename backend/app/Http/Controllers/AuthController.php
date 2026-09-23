<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
class AuthController extends Controller {
 public function register(Request $request){$data=$request->validate(['name'=>'required|string|max:120','email'=>'required|email|unique:users,email','mobile'=>'required|string|max:30|unique:users,mobile','password'=>['required','confirmed',PasswordRule::defaults()],'preferred_language'=>'nullable|in:en,ar']); $user=User::create($data); $user->customer()->create(['preferred_language'=>$data['preferred_language']??'en']); $token=$user->createToken('customer')->plainTextToken; return response()->json(['user'=>$user->load('customer'),'token'=>$token],201);}
 public function login(Request $request){$data=$request->validate(['email'=>'required|email','password'=>'required']); $user=User::where('email',$data['email'])->first(); abort_unless($user && Hash::check($data['password'],$user->password),422,'Invalid credentials.'); return ['user'=>$user->load('customer'),'token'=>$user->createToken('customer')->plainTextToken];}
 public function logout(Request $request){$request->user()->currentAccessToken()?->delete(); return response()->noContent();}
 public function profile(Request $request){return $request->user()->load('customer');}
 public function updateProfile(Request $request){$user=$request->user(); $data=$request->validate(['name'=>'sometimes|string|max:120','mobile'=>'sometimes|string|max:30|unique:users,mobile,'.$user->id,'nationality'=>'nullable|string|max:80','emirates_id'=>'nullable|string|max:40','preferred_language'=>'nullable|in:en,ar','preferred_communication'=>'nullable|in:whatsapp,phone,email']); $user->update(collect($data)->only(['name','mobile'])->all()); $user->customer()->updateOrCreate([],collect($data)->only(['nationality','emirates_id','preferred_language','preferred_communication'])->all()); return $user->fresh()->load('customer');}
 public function forgotPassword(Request $request){$request->validate(['email'=>'required|email']); return response()->json(['status'=>Password::sendResetLink($request->only('email'))]);}
 public function resetPassword(Request $request){$data=$request->validate(['token'=>'required','email'=>'required|email','password'=>['required','confirmed',PasswordRule::defaults()]]); $status=Password::reset($data,function(User $user,string $password){$user->forceFill(['password'=>$password,'remember_token'=>null])->save(); $user->tokens()->delete();}); return response()->json(['status'=>$status],$status===Password::PASSWORD_RESET?200:422);}
}
