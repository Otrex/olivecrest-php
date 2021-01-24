<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'token', 'is_verified'
    ];

     public function user(){
    	return $this->belongsTo("App\Models\User", 'foreign_key');
    }
}
