<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
	protected $fillable = [
        'desc','name', 'percent_returns','btn_link', 'feat'
    ];
    use HasFactory;
}
