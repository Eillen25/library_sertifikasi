@extends('base/template')

@section("header", "Daftar Peminjam Buku")

@section("konten")
<a class="btn btn-warning btn-sm" href="/updateStatus">Peringati</a>
<thead>
    <tr>
        <th>Tenggat Waktu</th>
        <th>Tanggal Kembali</th>
        <th>Gambar</th>
        <th>Nama Buku</th>
        <th>Peminjam</th>
        <th>Status Pengembalian</th>
        <th>Aksi</th>
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

        @if(($b->status_pengembalian) == "Sudah Dikembalikan")
        <td>
            Done
        </td>
        @else
        <td>
            <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
            <a class="btn btn-warning btn-sm" href="/updateStatus/{{ $b->id_peminjaman }}">Peringati</a>
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
@endsection