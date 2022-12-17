@extends('base/template')

@section("header", "Edit Buku")

@section("konten")

    @foreach($getEdited as $b)
    <form action="/buku/update" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="nama">Nama Buku: </label>
            <input type="text" class="form-control" name="nama" required="required" value="{{ $b->nama_buku }}">
        </div>
        <div class="form-group">
            <label for="desc">Deskripsi Buku: </label>
            <textarea type="text" class="form-control" name="deskripsi" required="required">{{ $b->deskripsi_buku }}</textarea>
        </div>
            <input type="hidden" class="form-control" name="gambar" value="{{ $b->gambar_buku }}" required="required">
   
        <div>
            <label for="pic">Gambar Buku: </label>
            <input type="file" name="file_gambar" value="{{ $b->gambar_buku }}">
        </div>
        <input type="hidden" name="id" value="{{ $b->id_buku }}">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Simpan</button>
            </div>
        </div>
    </form>
    @endforeach
@endsection