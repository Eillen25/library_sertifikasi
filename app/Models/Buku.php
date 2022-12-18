<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Buku extends Model
{
    use HasFactory;
    // Menyimpan tabel buku ke class
    protected $table = "buku";
}
