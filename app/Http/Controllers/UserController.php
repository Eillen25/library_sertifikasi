<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    public function pinjamBuku($id) {
        $getBookData = DB::table("buku")->where("id_buku", $id)->get();
        $todayDate = Carbon::now()->toDateString();
        $dueDate = Carbon::today()->addDays(7)->toDateString();

        return view("pinjamBuku", ["getBookData" => $getBookData, "todayDate" => $todayDate, "dueDate" => $dueDate]);
    }
    
    public function inputPeminjaman(Request $req) {
        $username = Session::get("username");
        
        $todayDate = Carbon::now()->toDateString();
        $dueDate = Carbon::today()->addDays(7)->toDateString();

        DB::table("peminjaman")->insert([
            "username" => $username,
            "id_buku" => $req->id,
            "tanggal_pinjam" => $todayDate,
            "tenggat_kembali" => $dueDate
        ]);

        DB::table('buku')->where('id_buku',$req->id)->update([
            'status_ketersediaan' => 0
        ]);

        return redirect("listPinjaman");

    }

    public function listPinjaman() {
        // Menampilkan seluruh transaksi pinjam
        $username = Session::get("username");
        // pass ke database harus array
        $data = [
            'username' => $username
        ];
        $peminjaman = new Peminjaman();
        $checkListPinjaman = $peminjaman->checkListPinjaman($data);

        return view("listPinjaman", compact('checkListPinjaman'));
    }

    public function kembalikanBuku(Request $req) {
        // Update status pengembalian user
        $todayDate = Carbon::now()->toDateString();
        DB::table('peminjaman')->where('id_peminjaman',$req->id)->update([
            "status_pengembalian" => 1,
            "tanggal_kembali" => $todayDate
        ]);
        
        // Update status ketersediaan di tabel buku
        $getReqData = DB::table("peminjaman")->where("id_peminjaman", $req->id)->get();
        $id_buku = $getReqData[0]->id_buku;
        DB::table('buku')->where('id_buku',$id_buku)->update([
            'status_ketersediaan' => 1
        ]);

        return redirect("listPinjaman");
    }
}
