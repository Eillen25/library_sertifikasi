@extends('base/template')

@section("header", "Input Buku")

@section("konten")

<form action="/inputBuku/add" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nama">Nama Buku: </label>
        <input type="text" class="form-control" name="nama" placeholder="Nama Buku" required="required">
    </div>
    <div class="form-group">
        <label for="desc">Deskripsi Buku: </label>
        <textarea type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Buku"
            required="required"></textarea>
    </div>
    <div>
        <label for="pic">Gambar Buku: </label>
        <input type="file" name="file_gambar" required="required">
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Simpan</button>
        </div>
    </div>
</form>
@endsection