<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Pagination\Paginator;

class Peminjaman extends Model
{
    use HasFactory;
    // Menyimpan tabel peminjaman ke class
    protected $table = "peminjaman";

    // Fungsi untuk mengambil selueuh buku pinjaman user tertentu
    public function checkListPinjaman($data) {
        $cmd = "SELECT b.id_buku, p.id_peminjaman, b.nama_buku, b.gambar_buku, tanggal_pinjam, tenggat_kembali, IF(status_pengembalian=0,'Belum Dikembalikan', IF(status_pengembalian=1,'Sudah Dikembalikan', 'Melebihi Tenggat Waktu')) `status_pengembalian` FROM `peminjaman` p, `buku` b WHERE username =:username AND p.id_buku = b.id_buku ORDER BY status_pengembalian, tenggat_kembali";
        $checkedList = DB::select($cmd, $data);
        // dd($checkedList);

        return $checkedList;
    }

    // Fungsi untuk seluruh data peminjaman
    public function dataPeminjaman() {
        $allData = DB::table(DB::raw('peminjaman AS p JOIN buku AS b ON p.id_buku = b.id_buku'))
        ->select(DB::raw("b.id_buku, p.id_peminjaman, username, b.nama_buku, b.gambar_buku, tanggal_pinjam, tenggat_kembali, tanggal_kembali, IF(status_pengembalian=0,'Belum Dikembalikan', IF(status_pengembalian=1,'Sudah Dikembalikan', 'Melebihi Tenggat Waktu')) `status_pengembalian`"))
        ->orderBy("status_pengembalian", "ASC", "tenggat_kembali", "ASC")
        ->paginate(10);
        
        return $allData;
    }

    // Fungsi untuk memperbaharui status pengembalian dari tabel peminjaman, jika telah melewati batas tenggat kembali
    public function updateStatusTerlambat($data) {
        $cmd = "UPDATE `peminjaman` SET `status_pengembalian`= 2 WHERE tenggat_kembali < :todayDate AND tanggal_kembali IS NULL;";
        $updateStatus = DB::update($cmd, $data);
        // dd($updateStatus);

        return $updateStatus;
    }
}
