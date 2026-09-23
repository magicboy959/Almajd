<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Faq extends Model { protected $fillable=['service_id','question_en','question_ar','answer_en','answer_ar','category','sort_order','published','featured']; protected $casts=['published'=>'boolean','featured'=>'boolean']; public function service(){return $this->belongsTo(Service::class);} }
