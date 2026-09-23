<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
class Setting extends Model { protected $fillable=['key','value','encrypted_value','type']; protected $hidden=['encrypted_value']; public function setValueAttribute($value){$this->attributes['value']=$this->type==='secret'?null:$value;$this->attributes['encrypted_value']=$this->type==='secret'?Crypt::encryptString((string)$value):null;} public function getResolvedValueAttribute(){return $this->type==='secret'&&$this->encrypted_value?Crypt::decryptString($this->encrypted_value):$this->value;} }
