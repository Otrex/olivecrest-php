<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hash;
use Auth;

// Model
use App\Models\Token;
use App\Models\User;
use App\Models\Verify;
use App\Models\Account;
use App\Models\Profile;

class AuthManager extends Controller {
// Landing
    public function index(){
    	return view("landing");
    }

// Tools
    public function page_response($cond, $view, $data, $failed='auth'){
        if ($cond) {
            return redirect($view)->with('data',$data);
        }
        return redirect('/admin/'.$failed)->with('data',$data);
    }

// Login
    public function login(Request $req){
        // echo $req->is_admin; die();
    	$this->validate($req, [
            'email' => "required|email",
            'password' => 'required|alphaNum|min:4'
        ]);

        $user = [
            'email' => $req->get('email'),
            'password' => $req->get('password')
        ];

        $userLoggin = Auth::attempt($user);
        // $user = (object) []; $user->is_admin = true;
        $user = User::with_email($user['email']);

        // Handles Admininstration Login
        try {
            if ($req->is_admin) {
                if (!$user) return page_response(false, 'Login Failed');
                if ($user->is_admin) return $this->page_response($user, '/admin/dashboard', []);
            }
        } catch (Exception $e) {}
        
        // Normal User Login
        if (!$user) return response(json_encode(['err' => 'Login Failed, User Not Found..']), 200);

                event(new \App\Events\Token($user));

        return response(json_encode(['msg' => 'Login successful..']), 200);
    }

// Sign-Up
    public function register(Request $request) {
    	// Validate Request
        $this->validate($request, [
        	'username' => 'required',
            'email' => "required|email",
            'password' => 'required|alphaNum|min:4',
        ]);


        // Prepare for saving
        $user = [
        	'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'remember_token' => Str::random(40)
        ];

        // Check If User Already Exists
        if (User::with_email($user['email'])) return response(json_encode(['err' => 'User already exists..']), 200);


        // More Validations
        if (env('MODE') == 'PROD' && env('CHECK_EMAIL') && !$request->is_admin){
            if (!\utils\verifyEmail($user['email'])){
            	return response(json_encode(['err'=>$user['email'].' Email Not valid..']), 200);
            }
        }

        // Save the user
        if (User::create($user)){
        	$user = User::with_email($user['email']);
            $user->token = \utils\genV();

            // Registering Admin
            try {
                $user->is_admin = $request->is_admin;
                // // $this->login($request);
                // return;
            } catch (Exception $e ) {}

            event( new \App\Events\Register($user, $request) );
	        
	        // Create and Send Mail
			// $message = [
			// 	'link' => env('APP_URL').'/auth/verify/'.$user->email.'/'.$token->token,
			// 	'reply_to' => env('EMAILJS_EMAIL'),
			// 	'sender' => env('APP_NAME'),
			// 	'username' => $user->name,
			// 	'to' => $user->email
			// ];

   //          $msgStatus = true;
   //          if (env('MODE') == 'PROD') {
   //               $msgStatus = \utils\sendMail($message, env('EMAILJS_TEMPLATE_ID'))['status'];
   //          }
           
			// if (!$msgStatus) {
			// 	return response(json_encode(['err'=>'Verification link failed to be sent Account']), 201);
			// }

        	return response(json_encode(['msg'=>"Account successfully created.."]), 200);
        } else {
        	return response(json_encode(['err'=>'Failed to create Account']), 400);
        }
    }

// Password Reset
    public function reset_password(Request $req) {
    	$this->validate($req, [
    		'token' => 'required|min:4',
            'password' => 'required|alphaNum|min:4',
            'rpassword' => 'required|alphaNum|min:4'
    	]);

    	if ($req->get('password') != $req->get('rpassword')){
    		return response(json_encode(['err'=> 'Password Does not match']), 400);
    	}

        $verified = Token::verify($req->user_id, $req->get('token'));
        if (!$verified) { return response(json_encode(['err'=>'Invalid Token']), 200);}
        $verified->password = Hash::make($request->get('password'));
        $verified->save();
        return response(json_encode(['msg'=>'Password Reset Successful']), 200);
    }

// Email-Verifications & Token-Verification
    public function email_verify(Request $req, $email, $vtoken){
        $result = User::verifyToken($email, $vtoken);
        return view('auth-verify', [
            'title' => $result ? "Verification Successful" : "Verification Failed",
            'message'=> $result ? "$email Successfully Verified Your Account." : " Verification Failed. Invalid Verification Token."
        ]);
    }

    public function send_token(Request $req) {
        return response(json_encode(['msg'=>'Token sent']));
    }

    public function check_access_token(Request $req){
        $user = Token::verify(Auth::user()->id, $req->get('token'));
        if ($user){
            $user->is_token_verified = true;
            $user->save();
            return Response(json_encode(['msg'=>'Token verification complete...']), 200);
        }
        return Response(json_encode(['err'=>'Token verification Failed...']), 200);
    }

// Logout
    public function logout(){
        if (is_object(Auth::user())){
            $user = User::with_id(Auth::user()->id);
            $user->is_token_verified = false;
            $user->save();
            Auth::logout();
        }
        return redirect("/");
    }

}

