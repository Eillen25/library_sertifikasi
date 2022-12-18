<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

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
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    
    protected $table = "anggota";
    protected $primaryKey = 'username';

    public function checkLogin($data) {
        $cmd = "SELECT COUNT(*) `found` FROM anggota WHERE username =:username AND password =:password;";
        $userChecked = DB::select($cmd, $data);
        
        // dd($userChecked);

        if($userChecked[0]->found == 1){
            return true;
        }
        return false;

        // if(isset($userChecked) && count($userChecked) > 0){
        //     return $res;
        // }
        // return null;
    }
}
