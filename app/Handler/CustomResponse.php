<?php 
namespace App\Handler;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\WebhookConfig;
use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookResponse\RespondsToWebhook;
use Spatie\WebhookClient\WebhookConfig;

class CustomResponse implements RespondsToWebhook {
	public function respondToValidWebhook(Request $request, WebhookConfig $config) {
		return response('working', 200)
	};
}