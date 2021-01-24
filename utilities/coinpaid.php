<?php
// Request from laravel Request
use Illuminate\Support\Facades\Http;

class CoinPaid {
	private $apis = [
		'ping' => '/ping',
		'currencies' => '/currencies/list'
	];
	public function __construct($api) {
		$this->root_api = $api;
	}
	public function api($api){
		return $this->root_api . $this->apis[$api];
	}
	public function ping(){
		return $this->handle_response(Http::get($this->api('ping')))->status();
	}
	public function handle_response($req){
		if ($req->successful()){
			return $req;
		}
		throw new Exception("Request Failed: ". $req['error'] );
		return;
	}

	public function supported_currencies($visible=false){
		return $this->handle_response(Http::post(
			$this->api('currencies'), [
				'visible' => $visible
			]))->json();
	}
}
?>