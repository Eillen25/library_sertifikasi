@extends('base/template')

@section("header", "Peminjaman Buku")

@section("konten")


<form action="/inputPeminjaman" method="post">
    {{ csrf_field() }}
    @foreach($getBookData as $b)
    <input type="hidden" name="id" value="{{ $b->id_buku }}">
    <img src="/assets/image/{{ $b->gambar_buku }}" alt="{{ $b->gambar_buku }}" style="width: 200px; height: 250px;">
    <div class="form-group">
        <h3>{{ $b->nama_buku }}</h3>
        <p>{{ $b->deskripsi_buku }}</p>
    </div>
    @endforeach
    
    <div class="form-group">
        <p><b>Tanggal Pinjam</b></p>
        <label for="tanggalPinjam">{{ $todayDate }}</label>
        
    </div>
    
    <div class="form-group">
        <p><b>Tenggat Waktu</b></p>
        <label for="tenggatWaktu">{{ $dueDate }}</label>
        
    </div>
    

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Pinjam</button>
        </div>
    </div>
</form>

@endsection