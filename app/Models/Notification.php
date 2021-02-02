<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'message',
        'amount',
        'time_recieved' 
    ];
    public function user(){
        return $this->belongsTo("App\Models\User", 'foreign_key');
    }
}
