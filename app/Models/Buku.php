<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Buku extends Model
{
    use HasFactory;
    // protected $primaryKey = "id_buku";
    protected $table = "buku";
}
