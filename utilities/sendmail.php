<?php

namespace utils;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;


/**
 * 
 */
class AppConfig
{
	private static $instance = null;
	private static function all(){
		if (self::$instance == null) self::$instance = Settings::find(1);
		return self::$instance;
	}
	public static function get($feature) {
		if ($feature='*') return self::all();
		try {
			return self::$instance->$feature;
		} catch (Exception $e){
			throw new Exception("$feature is not a feature of this settings", 1);
		}
	}
	public static function update($updates = null){
		self::all();
		if ($updates) self::$instance->update($updates);
		self::$instance = Settings::find(1);
	}
}

function Settings(){
	$GLOBALS['variable'] = something;
} 

function postRequest($url, $body){
	$res = Http::post($url, $body);
	return $res;
}

function getRequest($url){
	$res = Http::get($url);
	return $res;
}

function getRequestWithHeaders($url, $headers) {
	$res = Http::withHeaders($headers)->get($url);
	return $res;
}

function sendMail($data, $template){
	$data = [
		'service_id' => env('EMAILJS_SERVICE_ID'),
		'template_id' => $template,
		'user_id' => env('EMAILJS_USER_ID'),
		'template_params' => $data
	];
	$res = postRequest('https://api.emailjs.com/api/v1.0/email/send', $data);
	if ($res->successful()){
		return ['msg' => 'Sent successfully...', 'status'=>true ];
	} else {
		return ['err' => 'Failed', 'status'=>false ];
	}
}

function verifyEmail($email){
	$ve = new \hbattat\VerifyEmail($email, env('MAIL_FROM_ADDRESS'));
	return $ve->verify();
}

class RandomStringGenerator { 
	/** @var string */ 
	protected $alphabet; 
	/** @var int */ 
	protected $alphabetLength; 
	/** * @param string $alphabet */ 
	public function __construct($alphabet = '') { 
		if ('' !== $alphabet) { 
			$this->setAlphabet($alphabet); 
		} else { 
			$this->setAlphabet( implode(range('a', 'z')) . implode(range('A', 'Z')) . implode(range(0, 9)) ); 
		} 
	}

	/** * @param string $alphabet */ 
	public function setAlphabet($alphabet) { 
		$this->alphabet = $alphabet; 
		$this->alphabetLength = strlen($alphabet); 
	} 

	/** * @param int $length * @return string */ 
	public function generate($length) { 
		$token = ''; 
		for ($i = 0; $i < $length; $i++) { 
			$randomKey = $this->getRandomInteger(0, $this->alphabetLength); 
			$token .= $this->alphabet[$randomKey]; 
		} 
		return $token; 
	}
	/** * @param int $min * @param int $max * @return int */ 
	protected function getRandomInteger($min, $max) { 
		$range = ($max - $min); 
		if ($range < 0) { 
			// Not so random... 
			return $min; 
		} 
		$log = log($range, 2); 
		// Length in bytes. 
		$bytes = (int) ($log / 8) + 1; 
		// Length in bits. 
		$bits = (int) $log + 1; 
		// Set all lower bits to 1. 
		$filter = (int) (1 << $bits) - 1; 
		do { 
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes))); 
			// Discard irrelevant bits. 
			$rnd = $rnd & $filter; 
		} while ($rnd >= $range); 
		return ($min + $rnd); 
	}
}

function genV(){
	$c = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnop';
	$l = 30;
	$gen = new RandomStringGenerator($c);
	return $gen->generate($l);
}



