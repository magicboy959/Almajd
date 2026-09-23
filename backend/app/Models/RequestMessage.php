<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RequestMessage extends Model { protected $fillable=['service_request_id','author_id','recipient_id','body','customer_visible','audience','attachment_path','read_at']; protected $casts=['customer_visible'=>'boolean','read_at'=>'datetime']; public function request(){return $this->belongsTo(ServiceRequest::class,'service_request_id');} public function author(){return $this->belongsTo(User::class,'author_id');} public function recipient(){return $this->belongsTo(User::class,'recipient_id');} }
