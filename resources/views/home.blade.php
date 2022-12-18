@extends('base/template')

@section("header", "Daftar Buku")

@section("konten")
@if(session('akses_id') == 1)
<div class="col-md-2">
    <a class="nav-link btn" style="color:white;" href="/inputBuku">Input Buku </a>
</div>
<br>
@endif
<thead>
    <tr>
        <th>ID Buku</th>
        <th>Nama Buku</th>
        <th>Deskripsi Buku</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($buku as $b)
    <tr>
        <td>{{ $b->id_buku }}</td>
        <td>{{ $b->nama_buku }}</td>
        <td>{{ $b->deskripsi_buku }}</td>
        <td><img src="/assets/image/{{ $b->gambar_buku }}" style="width:60px; height:70px;"
                alt="Gambar {{ $b->gambar_buku }}"></td>
        @if(session('akses_id') == 1)
        <td>
            <a class="btn btn-warning btn-sm" href="/buku/edit/{{ $b->id_buku }}">Edit</a>
            <a class="btn btn-danger btn-sm" href="/buku/hapus/{{ $b->id_buku }}">Hapus</a>
        </td>
        @endif
        @if(session('akses_id') == 2)
            @if(($b->status_ketersediaan) == 1)
        <td>
            <a class="btn btn-warning btn-sm" href="/pinjamBuku/{{ $b->id_buku }}">Pinjam</a>
        </td>
        @elseif(($b->status_ketersediaan) == 0)
        <td>
            Sedang Tidak Tersedia
        </td>
        @endif
        @endif

    </tr>
    @endforeach
</tbody>
@endsection