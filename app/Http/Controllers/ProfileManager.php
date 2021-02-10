<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;


// Model
use App\Models\User;
use App\Models\Profile;
use App\Models\UserSetting;

class ProfileManager extends Controller {
    public function filter($profile, $user){
        $profile->username = $user->username;
        $profile->email = $user->email;
        return $profile;
    }
    public function profile() {
    	$user = auth()->user();
        $profile = $user->profile;
    	return $this->respond($this->filter($profile, $user));
    }

    public function update(Request $req){
    	$data = $this->validate_data($req->all());
        try {
            auth()->user()->profile()->update($data);
            return $this->respond('Update Successful...');
        } catch (Exception $e) {
            logger($e)
            return $this->respond(null, 'Update Failed');
        }
    }

    public function settings () {
        return $this->respond(auth()->user()->setting());
    }

    public function updateSettings (Request $req) {
        $data = $this->validate_data($req->all());
        auth()->user()->setting()->update($data);
        return $this->respond('Ok');
    }
}
