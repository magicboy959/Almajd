<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ServiceRequirement extends Model { protected $fillable=['service_id','name_en','name_ar','required','allowed_mimes','max_kb','sort_order']; protected $casts=['required'=>'boolean']; public function service(){return $this->belongsTo(Service::class);} }
