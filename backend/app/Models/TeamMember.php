<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model { protected $fillable=['name_en','name_ar','role_en','role_ar','bio_en','bio_ar','photo_path','email','phone','sort_order','published','featured']; protected $casts=['published'=>'boolean','featured'=>'boolean']; }
