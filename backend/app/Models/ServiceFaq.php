<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ServiceFaq extends Model { protected $fillable=['service_id','question_en','question_ar','answer_en','answer_ar','sort_order']; public function service(){return $this->belongsTo(Service::class);} }
