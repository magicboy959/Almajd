<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model { use SoftDeletes; protected $fillable = ['user_id','nationality','emirates_id','preferred_language','preferred_communication']; public function user(){return $this->belongsTo(User::class);} public function requests(){return $this->hasMany(ServiceRequest::class);} }
