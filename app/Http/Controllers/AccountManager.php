<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountManager extends Controller
{
    // Account
    public function account(Request $req) {
    	return $this->respond(auth()->user()->account());
    }

    public function update(Request $req, $user){
    	$data = $this->validate_data($req->updates);
    	return !Account::updateInfo(Auth::user(), $data) ? 
    	$this->respond(null) : $this->respond('Update Successful...');
    }

// Transactions
    public function transactions(Request $req) {
    	return $this->respond(auh()->user()->transactions()->paginate());
    }

// Referals
    public function referer(Request $req) {
    	$token = auth()->user()->profile()->referer_code;
    	return $this->respond(['referrer_code'=> $token]);
    }

    public function refer(Request $req) {
    	$token = auth()->user()->profile()->refer_code;
    	return $this->respond(['token'=> $token]);
    }

    public function getReferals(Request $req) {
    	$r = Referal::where('referer_code', auth()->user()->profile()->refer_code)->pagination();
    	return $this->respond($r);
    }

}
