<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'country'
    ];

    public function user(){
    	return $this->belongsTo("App\Models\User", 'foreign_key');
    }
    public static function with_($user, $type){
    	$field = $type;
    	if ($field == 'id') {
    		$field = 'user_id';
    	}
    	return Profile::where($field, $user[$type])->first();
    }

    public static function updateInfo($user, $data){
    	$p = Profile::with_($user, 'id');
    	if (!$p){
    		return false;
    	}
    	foreach($data as $key => $value){
    		$p[$key] = $value;
    	}
    	$p->save();
    	return true;
    }
}
