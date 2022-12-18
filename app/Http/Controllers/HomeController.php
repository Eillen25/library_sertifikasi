<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use Illuminate\Support\Facades\File; 
use Carbon\Carbon;

class HomeController extends Controller
{
    // Fungsi untuk menampilkan keseluruhan data buku
    public function index() {
        $buku = Buku::all();

        return view("home", ["buku" => $buku]);
    }

    // Fungsi untuk menampilkan halaman untuk input data buku baru
    public function inputBuku() {
        return view("inputBuku");
    }

    // insert data ke table buku
    public function add(Request $req) {
        // menyimpan file gambar ke asset
        $file = $req->file('file_gambar');
        $uploadPath = 'assets\image';
        $file->move($uploadPath,$file->getClientOriginalName());

        // insert data ke database
        DB::table("buku")->insert([
            'nama_buku' => $req->nama,
            'deskripsi_buku' => $req->deskripsi,
            'gambar_buku' => $file->getClientOriginalName()
        ]);
	
	    return redirect('/daftarBuku');
    }

    // Hapus data buku
    public function hapusBuku($id) {
        // Hapus file dari storage
        $getReqData = DB::table("buku")->where("id_buku", $id)->get();
        $gambar = $getReqData[0]->gambar_buku;
		File::delete('assets\image/'.$gambar);

        // Hapus data di database
        DB::table("buku")->where('id_buku',$id)->delete();
        
        return redirect('/daftarBuku');
    }


    // Mengambil data buku sesuai ID, lalu dipassing ke view untuk edit
    public function editBuku($id) {
        $getEdited = DB::table("buku")->where('id_buku',$id)->get();

        return view('editBuku',['getEdited' => $getEdited]);
    }

    // Proses update data buku ke database 
    public function update(Request $req) {
        $file = $req->file('file_gambar');
        // Jika ada file gambar baru
        if($file != null) {
            $uploadPath = 'assets\image';
            $file->move($uploadPath,$file->getClientOriginalName());
            DB::table('buku')->where('id_buku',$req->id)->update([
                'nama_buku' => $req->nama,
                'deskripsi_buku' => $req->deskripsi,
                'gambar_buku' => $file->getClientOriginalName()
            ]);
        } else {
            // Jika tidak ada file gambar baru
            DB::table('buku')->where('id_buku',$req->id)->update([
                'nama_buku' => $req->nama,
                'deskripsi_buku' => $req->deskripsi,
                'gambar_buku' => $req->gambar
            ]);
        }

        return redirect('/daftarBuku');
    }


    // Fungsi untuk menampilkan halaman login
    public function login() {
        return view("login");
    }

    // Fungsi untuk memproses data login, akan dilempar ke model untuk pengecekan
    public function auth(Request $req) {
        $username = $req->input('username');
        $pass = $req->input('password');
        $data = [
            'username' => $username,
            'password' => $pass
        ];
        $userData = new User();
        $userChecked = $userData->checkLogin($data);

        // Jika data pengguna ditemukan, data username dan status keanggotaan akan disimpan
        if($userChecked) {
            Session::put('username', $username);
            Session::put('pass', $pass);

            $akses = User::find($username);
            Session::put('akses_id', $akses->status_keanggotaan);

            return redirect('/daftarBuku');
        } else {
            // Jika salah username/password
            Session::flash('error', 'Email dan Password tidak sesuai!');

            return redirect('/');
        }
    }

    // Fungsi untuk logout, menghapus session dan kembali ke halaman login
    public function logout() {
        Session::flush();
        Session::flash("logout", "Anda telah logout");

        return redirect("/");
    }

    // Fungsi untuk menampilkan seluruh data peminjaman
    public function dataPeminjaman() {
        $data = new Peminjaman;
        $allData = $data->dataPeminjaman();

        return view('daftarPeminjam', compact('allData'));
    }

    // Fungsi untuk melakukan update status pengembalian bila telah melewati batas tenggat kembali
    public function updateStatus() {
        $todayDate = Carbon::now()->toDateString();
        $peminjaman = new Peminjaman();
        $data = [
            'todayDate' => $todayDate
        ];
        $updateStatus = $peminjaman->updateStatusTerlambat($data);

        return redirect("/dataPeminjaman");
    }

    // Menampilkan halaman register
    public function register() {
        return view("register");
    }

    // Verifikasi akun baru, bila sesuai akan insert ke database
    public function authRegist(Request $req) {
        $this->validate($req,[
            'nama' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:15|unique:anggota'
         ]);

        DB::table("anggota")->insert([
            'username' => $req->username,
            'nama_anggota' => $req->nama,
            'password' => $req->password
        ]);

        return redirect("/");
    }

}
