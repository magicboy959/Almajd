<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ServiceCategory extends Model { use SoftDeletes; protected $fillable = ['name_en','name_ar','slug','description_en','description_ar','sort_order','featured','published']; protected $casts=['featured'=>'boolean','published'=>'boolean']; public function services(){return $this->hasMany(Service::class);} }
