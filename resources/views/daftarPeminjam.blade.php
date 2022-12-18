@extends('base/template')

@section("header", "Daftar Peminjam Buku")

@section("konten")
<div class="col-md-2">
    <a class="nav-link btn" style="color:white;" href="/updateStatus">Peringati</a>
</div>
<br>

<thead>
    <tr>
        <th>Tenggat Waktu</th>
        <th>Tanggal Kembali</th>
        <th>Gambar</th>
        <th>Nama Buku</th>
        <th>Peminjam</th>
        <th>Status Pengembalian</th>
    </tr>
</thead>
<tbody>
    @foreach($allData as $b)
    <tr>
        <td>{{ $b->tenggat_kembali }}</td>
        <td>{{ $b->tanggal_kembali }}</td>
        <td><img src="/assets/image/{{ $b->gambar_buku }}" style="width:60px; height:70px;"
                alt="Gambar {{ $b->gambar_buku }}"></td>
        <td>{{ $b->nama_buku }}</td>
        <td>{{ $b->username }}</td>
        <td>{{ $b->status_pengembalian }}</td>
    </tr>
    @endforeach
</tbody>
@endsection
@section('paginate')
    <br>
    <div class="d-flex justify-content">
        {{ $allData->links('pagination::bootstrap-4') }}
    </div>
    Halaman: {{$allData->currentpage()}} <br>
    Jumlah Data: {{$allData->total()}} <br>
@endsection