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
    	$this->validate($req, [
            'email' => "required|email",
            'password' => 'required|alphaNum|min:4'
        ]);

        $user = [
            'email' => $req->get('email'),
            'password' => $req->get('password')
        ];

        $user = Auth::attempt($user);
        if (!$user) return response(json_encode(['err' => 'Login Failed, User Not Found..']), 200);

        // Handles Admininstration Login
        if (isset($req->is_admin) && $req->is_admin) {
            if ($user->is_admin) return $this->page_response($user, '/admin/dashboard', []);
        }

        event(new \App\Events\Token(auth()->user()));

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

        // Check If User Already Exists For admin
        if ($request->is_admin) {
            $newAdmin = User::firstOrNew(['email' => $user['email']]);
            if (!$newAdmin) return response(json_encode(['err'=>'Failed to create Account']), 200);
            $newAdmin->is_admin = true;
            $newAdmin->password = $user['password'];
            $newAdmin->save();
            return $this->login($request);
        }

        // Check If User Already Exists
        if (User::with_email($user['email'])) return response(json_encode(['err' => 'User already exists..']), 200);


        // More Validations
        if (env('MODE') == 'PROD' && \utils\AppConfig::get('CHECK_EMAIL') && !$request->is_admin){
            if (!\utils\verifyEmail($user['email'])){
            	return response(json_encode(['err'=>$user['email'].' Email Not valid..']), 200);
            }
        }

        // Save the user
        if (User::create($user)){
        	$user = User::with_email($user['email']);
            $user->token = \utils\genV();
            event( new \App\Events\Register($user, $request) );
        	return response(json_encode(['msg'=>"Account successfully created.."]), 200);
        } else {
        	return response(json_encode(['err'=>'Failed to create Account']), 200);
        }
    }

// Password Reset
    public function send_token(Request $req, $email) {
        $user = auth()->user() ?? User::with_email($email);
        event (new \App\Events\Token($user));
        return response(json_encode(['msg'=>'Token sent']));
    }

    public function reset_password(Request $req, $email) {
    	$this->validate($req, [
    		'token' => 'required|min:4',
            'password' => 'required|alphaNum|min:4',
            'rpassword' => 'required|alphaNum|min:4'
    	]);

        $user = User::with_email($email);
        if (!$user) return $this->respond(null, 'This User can\'t be found..');

    	if ($req->get('password') != $req->get('rpassword')){
    		return response(json_encode(['err'=> 'Password Does not match']), 400);
    	}

        $verified = Token::verify($user->id, $req->get('token'));

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

