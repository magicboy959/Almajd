<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Page extends Model { protected $fillable=['slug','slug_ar','title_en','title_ar','body_en','body_ar','seo_title_en','seo_title_ar','seo_description_en','seo_description_ar','published','published_at','page_type','og_image_path','show_in_navigation','sort_order']; protected $casts=['published'=>'boolean','published_at'=>'datetime','show_in_navigation'=>'boolean']; }
