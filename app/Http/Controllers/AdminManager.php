<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminManager extends Controller {
// Index
    public function __construct() {
        // $this->middleware(['auth', 'App\Http\Middleware\VerifiedAccess']);
    }

    public function index(){
    	//if(isset(Auth::user()->email)){
            return view("admin-dashboard");//->with("title", Auth::user()->username);
       // } else {
       //     return redirect("admin.login")->with("error", "Please Login in first");
       // }
    }
}
