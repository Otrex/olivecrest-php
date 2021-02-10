<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\InvestmentPlan;
use utils\getRequestWithHeaders as getHReq;

class InfoManager extends Controller {
    
    public function plan(Request $req) {
        return $this->respond(InvestmentPlan::all());
    }

    public function getCoinData(Request $req){
    	$res = Http::withHeaders(['X-CoinAPI-Key' => env('COINAPI_KEY')])
    		->get('https://rest.coinapi.io/v1/assets?filter_asset_id=BTC;ETH;ltc;xrp');
    	$result = [];
    	if ($res->failed()) return $this->respond(null, 'Can"t access details now..');
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
		  return $this->respond($result);
		} catch (HttpException $ex) {
		  return $this->respond(null, 'Can"t access details now.. '.$ex.getMessage());
		}
    }
}
