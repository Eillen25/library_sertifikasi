<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjaman";

    public function checkListPinjaman($data) {
        $cmd = "SELECT b.id_buku, p.id_peminjaman, b.nama_buku, b.gambar_buku, tanggal_pinjam, tenggat_kembali, IF(status_pengembalian=0,'Belum Dikembalikan', IF(status_pengembalian=1,'Sudah Dikembalikan', 'Melebihi Tenggat Waktu')) `status_pengembalian` FROM `peminjaman` p, `buku` b WHERE username =:username AND p.id_buku = b.id_buku";
        $checkedList = DB::select($cmd, $data);
        // dd($checkedList);

        return $checkedList;
    }

    public function dataPeminjaman() {
        $cmd = "SELECT b.id_buku, p.id_peminjaman, username, b.nama_buku, b.gambar_buku, tanggal_pinjam, tenggat_kembali, tanggal_kembali, IF(status_pengembalian=0,'Belum Dikembalikan', IF(status_pengembalian=1,'Sudah Dikembalikan', 'Melebihi Tenggat Waktu')) `status_pengembalian` FROM `peminjaman` p, `buku` b WHERE p.id_buku = b.id_buku";
        $allData = DB::select($cmd);

        return $allData;
    }
}
