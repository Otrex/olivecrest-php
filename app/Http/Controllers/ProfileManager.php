<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

// Model
use App\Models\Token;
use App\Models\User;
use App\Models\Profile;
use App\Models\InvestmentPlan;

class ProfileManager extends Controller {
// Index
    public function __construct() {
        // $this->middleware(['auth', 'App\Http\Middleware\VerifyAccess']);
    }

    public function index(){
    	// if(isset(Auth::user()->email)){
            return view("dashboard");//->with("title", Auth::user()->username);
        // } else {
        //    return redirect("login")->with("error", "Please Login in first");
        // }
    }

// Emb-Tools
    public function validate_data($arr){
		return $arr;
	}

    public function respond($msg, $errmsg='User Details not found..'){
    	if (!$msg){
    		return response(json_encode(['err'=> $errmsg]), 400);
    	}
        // var_dump($msg);
    	return response(json_encode($msg), 200);
    }

// Profile
    public function profile(){
    	$user = User::with_id(Auth::user()->id);
        $profile = $user->profile;
        $profile->user_id = null;
        $profile->created_at = null;
        $profile->updated_at = null;
        $profile->username = $user->username;
        $profile->email = $user->email;
    	return $this->respond($profile);
    }

    public function edit(Request $req){
    	$data = $this->validate_data($req->updates);
    	if (!Profile::updateInfo(Auth::user(), $data)){
    		return $this->respond([]);
    	}
    	return $this->respond(['msg'=>'Update Successful...']);
    }

// Account
    public function account(Request $req) {
    	$account = User::with_id(Auth::user()->id)->account;
    	return $this->respond($account);
    }
    public function plan(Request $req) {
        $account = InvestmentPlan::all();
        return $this->respond($account);
    }

    public function account_update(Request $req){
    	$data = $this->validate_data($req->updates);
    	if (!Account::updateInfo(Auth::user(), $data)){
    		return $this->respond([]);
    	}
    	return $this->respond(['msg'=>'Update Successful...']);
    }

// Transactions
    public function transactions(Request $req) {
    	$t = User::with_id(Auth::user()->id)->transactions()->paginate();
        // $t = ['money' => 50000];
    	return $this->respond($t);
    }

    public function add_transaction(Request $req){
    	$data = $this->validate_data($req->data);
    	if (!Transaction::create($data)){
    		return $this->respond([]);
    	}
    	return $this->respond(['msg'=>'Update Successful...']);
    }

// Referals
    public function referer(Request $req) {
    	$token = User::with_id(Auth::user()->id)->referer_code;
    	return $this->respond(['token'=> $token]);
    }

    public function refer(Request $req) {
    	$token = User::with_id(Auth::user()->id)->refer_code;
    	return $this->respond(['token'=> $token]);
    }

    public function get_referals(Request $req) {
    	$r = User::withid(Auth::user()->id)->referals->pagination();
    	return $this->respond($acc);
    }
}
