<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'type', 
    ];

    public function user(){
    	return $this->belongsTo("App\Models\User", 'foreign_key');
    }
}
