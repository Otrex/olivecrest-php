<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'amount',
        'type'
    ];
    public function user(){
        return $this->belongsTo("App\Models\User", 'foreign_key');
    }
}
