<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Model
use App\Models\Token;
use App\Models\User;

class SendToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        // Get User
        $useremail = $request->header('email');
        if (!$useremail){
            $useremail = $request->get('email');
        }
        
        $user = User::where('email', $useremail)->first();
        if (!$user) {
            return response(json_encode(['err' => 'User not found..']), 200);
        }

        $request->user_id = $user->id;
        $request->user_is_admin = $user->is_admin;

        // Stop sending token for Admins
        if ($user->is_admin){
            $user->is_token_verified = true;
            $user->save();
            return $next($request);
        }
        // $request->token = rand(10000, 99999);
        $token = Token::updateOrCreate([
            'user_id'=> $user->id, 
            'token' => rand(10000, 99999),
        ]);

        $message = [
            'link' => $token->token,
            'reply_to' => env('EMAILJS_EMAIL'),
            'sender' => env('APP_NAME'),
            'username' => $user->name,
            'to' => $user->email
        ];
        
        $msgStatus = true;
        if (env('MODE') == 'PROD'){
            $msgStatus = \utils\sendMail($message, env('EMAILJS_TEMPLATE_ID'))['status'];
        }

        // // send token
        if ($msgStatus) {
            return $next($request);
        }
    }
}
