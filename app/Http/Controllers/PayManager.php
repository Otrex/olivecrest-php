<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use Auth;

use App\Models\User;
use App\Models\Account;
use App\Models\WalletRequest;

class PayManager extends Controller
{
    public function createCharge(Request $req) {
    	ApiClient::init(\utils\AppConfig::get('API_KEY'));
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
		   	return $this->respond($chargeObj->addresses);
		} catch (\Exception $exception) {
		    return $this->respond(null, $exception->getMessage());
		}
    }


    // WalletRequest
    public function getWalletRequests() {
        return $this->respond(auth()->user()->walletRequests());
    }

    public function makeWalletRequest(Request $req){
        $data = $this->validate_data($req->data);
        if (isset($data['amount'])){
            $account = auth()->user()->account;
            if ((double) $account->total_earnings < (double) $data['amount']) return $this->respond(null, 'request not made due to insufficient amount');
        }
        if ($data['type'] == 'withdrawal' && $account->nxcompounded() < 29) return $this->respond(null, 401);
        if (!WalletRequest::create($data)) return $this->respond(null, 'Request was not made Successfully');

        event (new \App\Events\WalletRequester( $data ));
        return $this->respond('Update Successful...');
    }

    public function invest(Request $req){
        $acc = auth()->user()->account();

        if ($req->amount > $acc->available_balance) return $this->respond(
            null, 'Amount specified is greater than available balance'
        );

        $acc->available_balance -= $req->amount;
        $acc->invested_balance += $req->amount;
        $acc->invested_at = new DateTime("NOW")->format('Y-m-d H:i:s');;

        $acc->save();

        event(new \App\Events\Transactions((object) [
            'type' => 'investment',
            'currency' => auth()->user()->settings()->currency,
            'status' => 'COMPLETED',
            'amount' => $req->amount
        ]));

        return $this->respond('Investment Successful...');
    }
}
