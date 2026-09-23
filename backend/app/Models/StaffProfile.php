<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StaffProfile extends Model { protected $fillable=['user_id','job_title','employee_code','active']; protected $casts=['active'=>'boolean']; public function user(){return $this->belongsTo(User::class);} }
