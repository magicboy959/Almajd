<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RequestStatusHistory extends Model { public $timestamps=false; protected $fillable=['service_request_id','staff_id','previous_status','new_status','customer_note','internal_note','created_at']; protected $casts=['created_at'=>'datetime']; public function request(){return $this->belongsTo(ServiceRequest::class,'service_request_id');} public function staff(){return $this->belongsTo(User::class,'staff_id');} }
