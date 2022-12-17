@extends('base/template')

@section("konten")
<a class="nav-link btn" style="color:white;" href="/inputBuku">Input Buku </a>
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
        <td>
            <a class="btn btn-warning btn-sm" href="">Pinjam</a>        
        </td>
    </tr>
    @endforeach
</tbody>
@endsection