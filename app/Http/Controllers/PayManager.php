<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use Auth;

class PayManager extends Controller
{
    //
    public function __construct() {
        $this->middleware(['auth', 'App\Http\Middleware\VerifyAccess']);
    }

    public function index(){
    	if(isset(Auth::user()->email)){
            return view("dashboard")->with("title", Auth::user()->username);
        } else {
           return redirect("login")->with("error", "Please Login in first");
        }
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

    public function create_charge(Request $req) {
    	ApiClient::init(env('COINBASE_API_KEY'));
		$chargeObj = new Charge(
		    [
		        "description" => "Olive Crest Investment",
		        "metadata" => [
		            "customer_id" => Auth::user()->id ?? null,
		            "customer_email" => Auth::user()->email ?? null,
		        ],
		        "name" => "Olivecrest",
		        "payments" => [],
		        "pricing_type" => "no_price"
		    ]
		);

		try {
		    $chargeObj->save();
		    // echo sprintf("Successfully created new charge with id: %s \n", $chargeObj->id);
		   	return $this->respond(['msg' => $chargeObj->addresses]);
		} catch (\Exception $exception) {
		    // echo sprintf("Enable to create charge. Error: %s \n", $exception->getMessage());
		    return $this->respond(['err' => $exception->getMessage()]);
		}
    }
}
