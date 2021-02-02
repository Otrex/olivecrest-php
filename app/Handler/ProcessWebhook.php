<?php
namespace App\Handler;

use App\Models\User;
use App\Events\PaymentConfirmation;
use \Spatie\WebhookClient\ProcessWebhookJob;
//The class extends "ProcessWebhookJob" class as that is the class 
//that will handle the job of processing our webhook before we have //access to it.
class ProcessWebhook extends ProcessWebhookJob
{
	public function handle(){
	       $data = json_decode($this->webhookCall, true);
	       // $this->check_type($data);
	       logger($data);
	       http_response_code(200); //Acknowledge you received the response
	}

	public function check_type($data) {
		$type = $data['payload']['event']['type'];
		switch ($type) {
			case "charge:created":
		    	$this->charge_created($data['event']);
		    break;
			case "charge:failed":
		    	$this->charge_failed($data['event']);
		    break;
			case "charge:pending":
		    	$this->charge_pending($data['event']);
		    break;
		    case "charge:confirmed":
		    	$this->charge_confirmed($data['event']);
		    break;
			case "charge:delayed":
		    	$this->charge_delayed($data['event']);
		    break;
			case "charge:resolved":
		    	$this->charge_resolved($data['event']);
		    break;
		  default:
		    logger("::WebHook-Coinbase:: Charge type does not exist " );
		}
	}

	public function charge_confirmed($data) {
		if (empty($data)) return;
		$meta = $data['metadata'];

		if (empty($meta)) {
			$meta['email'] = 'obisiket@gmail.com';
			// return;
		}
		$payment = $data['payments'][0];

		$payment_details = (object) [
			'type' => 'credit',
			'message' => 'RESOLVED',
			'status' => $payments['status'],
			'detected_at' => $payments['detected_at'],
			'currency' => $payments['crypto']['currency'],
			'amount' => $payments['crypto']['amount'],
			'transaction_id' =>$payments['transaction_id'] ,
			'confirmed_at' => $data['data']['timeline'][3]['time']
		];

		if (in_array('email', $meta)) {
			User::with_email($meta['email'])
			->create_trx_notification($payment_details);

			event(new PaymentConfirmed($payment_details));
		}	
	}

	public function charge_created($data) {
	}

	public function charge_delayed($data) {
	}

	public function charge_failed($data) {
		// Failed trasaction would be stored in the junkTransaction
	}

	public function charge_pending($data) {
	}

	public function charge_resolved($data) {
		$this->charge_confirmed($data);
	}
}