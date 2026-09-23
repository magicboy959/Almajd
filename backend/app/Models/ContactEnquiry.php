<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContactEnquiry extends Model { protected $fillable=['name','email','mobile','service_id','preferred_language','subject','message','source_page','utm_parameters','status','assigned_to','internal_notes','contacted_at']; protected $casts=['utm_parameters'=>'array','contacted_at'=>'datetime']; public function service(){return $this->belongsTo(Service::class);} public function assignee(){return $this->belongsTo(User::class,'assigned_to');} }
