<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model {

	use HasFactory;
    protected $fillable = [
        'user_id', 'token'
    ];

    public static function getLatest($user) {
    	return Token::where('user_id', $user)->latest()->first();
    }

    public static function deleteAll($user) {
       Token::where('user_id', $user)->delete();
    }

    public static function verify ($user, $tok) {
        $token = Token::getLatest($user);
        if ($token && $tok == $token->token){
            Token::deleteAll($user);
            $user = User::with_id($user);
            return $user;
        }
        return null;
    }
}
