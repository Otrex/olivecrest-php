<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function account(){
        return $this->hasOne('App\Models\Account');
    }

    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function verify() {
        return $this->hasOne('App\Models\Verify');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }

    public function referals() {
        return $this->hasMany('App\Models\Referal');
    }

    public static function with_id($user){
        return User::where('id', $user)->first();
    }

    public static function with_email($user){
        return User::where('email', $user)->first();
    }

    public static function verifytoken($email, $token) {
        $user = User::with_email($email);
        if ($user->verify->token == $token) {
            $user->is_verified = true;
            $user->verify()->delete();
            $user->save();
            return true;
        } 
        return false;
    }
}
