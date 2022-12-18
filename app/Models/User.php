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

    // Variabel yang bisa diisi
    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
    protected $table = "anggota";
    protected $primaryKey = 'username';

    // Fungsi untuk melakukan pengecekan pengguna, bila sesuai akan mengembalikan boolean true
    public function checkLogin($data) {
        $cmd = "SELECT COUNT(*) `found` FROM anggota WHERE username =:username AND password =:password;";
        $userChecked = DB::select($cmd, $data);
        // dd($userChecked);

        if($userChecked[0]->found == 1){
            return true;
        }
        return false;
    }
}
