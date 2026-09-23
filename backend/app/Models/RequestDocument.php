<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RequestDocument extends Model { protected $fillable=['service_request_id','service_requirement_id','uploaded_by','original_name','stored_name','disk','path','mime_type','size','status','document_type','verification_status','rejection_reason','verified_by','verified_at','expires_at']; protected $casts=['expires_at'=>'datetime','verified_at'=>'datetime']; public function request(){return $this->belongsTo(ServiceRequest::class,'service_request_id');} public function requirement(){return $this->belongsTo(ServiceRequirement::class,'service_requirement_id');} public function uploader(){return $this->belongsTo(User::class,'uploaded_by');} public function verifier(){return $this->belongsTo(User::class,'verified_by');} }
