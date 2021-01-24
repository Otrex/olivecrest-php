<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use utils\getRequestWithHeaders as getHReq;

class InfoManager extends Controller
{
    //
    public function respond($msg, $errmsg='User Details not found..'){
    	if (!$msg){
    		return response(json_encode(['err'=> $errmsg]), 400);
    	}
        // var_dump($msg);
    	return response(json_encode($msg), 200);
    }
    
    public function plan(Request $req) {
        $account = InvestmentPlan::all();
        return $this->respond($account);
    }

    public function getCoinData(Request $req){
    	$res = Http::withHeaders(['X-CoinAPI-Key' => env('COINAPI_KEY')])
    		->get('https://rest.coinapi.io/v1/assets?filter_asset_id=BTC;ETH;ltc;xrp');
    	$result = [];
    	if ($res->failed()) return response(json_encode(['err' => 'Can"t access details now..']), 200);
		try {
			foreach($res->json() as $data){
				$coin = [ 
					'asset_id' => $data['asset_id'],
					'name' => $data['name'],
					"volume" => $data["volume_1day_usd"],
					"price_usd" => $data["price_usd"]
				];
				array_push($result, $coin);
			}
		  return response(json_encode($result), 200);
		} catch (HttpException $ex) {
		  return response(json_encode(['err' => 'Can"t access details now..']), 200);
		}
    }
}
