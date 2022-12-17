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
    // Menampilkan keseluruhan data buku
    public function index() {
        $buku = Buku::all();

        return view("home", ["buku" => $buku]);
    }

    public function inputBuku() {

        return view("inputBuku");
    }

    // insert data ke table buku
    public function add(Request $req) {
        $file = $req->file('file_gambar');
        $uploadPath = 'assets\image';
        $file->move($uploadPath,$file->getClientOriginalName());

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

    public function update(Request $req) {
        $file = $req->file('file_gambar');
        if($file != null) {
            $uploadPath = 'assets\image';
            $file->move($uploadPath,$file->getClientOriginalName());
            DB::table('buku')->where('id_buku',$req->id)->update([
                'nama_buku' => $req->nama,
                'deskripsi_buku' => $req->deskripsi,
                'gambar_buku' => $file->getClientOriginalName()
            ]);
        } else {
            DB::table('buku')->where('id_buku',$req->id)->update([
                'nama_buku' => $req->nama,
                'deskripsi_buku' => $req->deskripsi,
                'gambar_buku' => $req->gambar
            ]);
        }

        return redirect('/daftarBuku');
    }


    // Login dan auntentikasi
    public function login() {
        return view("login");
    }

    public function auth(Request $req) {
        $username = $req->input('username');
        $pass = $req->input('password');

        $data = [
            'username' => $username,
            'password' => $pass
        ];

        $userData = new User();
        $userChecked = $userData->checkLogin($data);

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

    public function logout() {
        Session::flush();
        Session::flash("logout", "Anda telah logout");

        return redirect("/");
    }


    public function dataPeminjaman() {
        $data = new Peminjaman;
        $allData = $data->dataPeminjaman();
        return view('daftarPeminjam', compact('allData'));
    }


    public function updateStatus($id) {
        $todayDate = Carbon::now()->toDateString();
        $getData = DB::table("peminjaman")->get();
        
        $dueDate = $getData[0];
        // dd($dueDate);
        DB::table('peminjaman')
            ->where($todayDate, '>', 'tenggat_kembali')
            ->update([
                'status_pengembalian' => 2
            ]);
        
    }
}
