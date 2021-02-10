<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respond($msg, $errmsg='User Details not found..'){
    	if (!$msg)	return response(json_encode(['err'=> $errmsg]), 400);
    	return response(json_encode(['msg' => $msg]), 200);
    }
    public function validate_data($arr){
		return $arr;
	}
}
