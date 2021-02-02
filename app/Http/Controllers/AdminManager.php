<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\InvestmentPlan;

class AdminManager extends Controller {
// Index
    public function __construct() {
        // $this->middleware(['auth', 'App\Http\Middleware\VerifiedAccess']);
    }
     public function respond($msg, $errmsg='User Details not found..'){
      if (!$msg){
        return response(json_encode(['err'=> $errmsg]), 400);
      }
        // var_dump($msg);
      return response(json_encode(['msg' => $msg ]), 200);
    }

    public function index(){
    	//if(isset(Auth::user()->email)){
            return view("admin-dashboard");//->with("title", Auth::user()->username);
       // } else {
       //     return redirect("admin.login")->with("error", "Please Login in first");
       // }
    }

    public function users(){
      $users = User::paginate();
      return  $this->respond($users);
    }

    public function addplan(Request $req) {
      try {
        $plan = InvestmentPlan::create([
          'name' => $req->name,
          'percent_returns' => $req->percentageReturns,
          'btn_link' => '',
          'desc' => $req->description,
          'feat' => $req->feat
        ]);
        return $this->respond($plan);
      } catch (Exception $err) {
        return $this->respond([], 'Something Went Wrong(DB)..');
      }
    }
}
