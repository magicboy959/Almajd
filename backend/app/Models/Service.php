<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Service extends Model { use SoftDeletes; protected $fillable = ['service_category_id','name_en','name_ar','slug','short_description_en','short_description_ar','description_en','description_ar','government_fee','service_fee','processing_days','eligibility_en','eligibility_ar','notes_en','notes_ar','featured','published']; protected $casts=['government_fee'=>'decimal:2','service_fee'=>'decimal:2','featured'=>'boolean','published'=>'boolean']; public function category(){return $this->belongsTo(ServiceCategory::class,'service_category_id');} public function requirements(){return $this->hasMany(ServiceRequirement::class);} public function faqs(){return $this->hasMany(ServiceFaq::class);} public function requests(){return $this->hasMany(ServiceRequest::class);} }
