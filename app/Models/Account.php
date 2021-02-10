<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// P = Principal or Initial Capital
// r = Annual Rate of Interest
// n = Number of times compounded
// t = Time Interval of investment
function compoundInterest ($P, $r, $n) {
    $r = $r/100;
    return $P * pow((1 + ($r)), ($n));
}
 

// Note: use DateTime Now for invested at
class Account extends Model
{
    protected $fillable = [
        'user_id','invested_at'
    ];
    use HasFactory;

    public function nxcompounded (){
        $d1 = new DateTime($this->invested_at ?? 'NOW');
        $d2 = new DateTime("NOW");
        $interval = $d1->diff($d2);
        $dd = $interval->d; 
        $mm  = $interval->m; //4
        $yyyy  = $interval->y; //1
        $result = ($yyyy * 365) + ($mm * 29) + $dd;
        return $result;
    }

    public function setTotalEarningsAttribute($value)
    {
        $compounded = compoundInterest(
            $this->invested_balance, $this->plan->percent_returns, $this->nxcompounded()
        );
        $this->attributes['total_earnings'] = compoundInterest(
            $this->invested_balance, $this->plan->percent_returns, $this->nxcompounded()
        );
        $this->total_earnings = $compounded;
        $this->save();
    }
    public function user(){
        return $this->belongsTo("App\Models\User", 'foreign_key');
    }
    public function plan(){
    	return $this->belongsTo("App\Models\InvestmentPlan", 'foreign_key');
    }
    public static function with_($user, $type){
    	$field = $type;
    	if ($field == 'id') {
    		$field = 'user_id';
    	}
    	return self::where($field, $user[$type])->first();
    }

    public static function updateInfo($user, $data){
    	$p = self::with_($user, 'id');
    	if (!$p){
    		return false;
    	}
    	foreach($data as $key => $value){
    		$p[$key] = $value;
    	}
    	$p->save();
    	return true;
    }

    public static function forID($userId) {
        return self::where('user_id', $userId)->first();
    }
}
