<?php
namespace App\Handler;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;


class CustomSignatureValidator implements SignatureValidator{
    public function isValid(Request $request, WebhookConfig $config): 
    bool{
    	// var_dump($config);
		// $signature = $request->header($config->signatureHeaderName);
		$signature = $request->header('X-Cc-Webhook-Signature');
		if (!$signature) {
			return false;
		}
		$signingSecret = '3637f2e9-32c7-43c4-8b3a-289ca4f9db1f';
		if (empty($signingSecret)) {
			throw WebhookFailed::signingSecretNotSet();
		}
		$computedSignature = hash_hmac('sha256', $request->getContent(), $signingSecret);
		return hash_equals($signature, $computedSignature);
	}
}