@extends('base/template')

@section("header", "List Pinjaman Buku")

@section("konten")

<thead>
    <tr>
        <th>Nama Buku</th>
        <th>Gambar</th>
        <th>Tanggal Pinjam</th>
        <th>Tenggat Kembali</th>
        <th>Status Pengembalian</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($checkListPinjaman as $b)

    <tr>
        <td>{{ $b->nama_buku }}</td>
        <td><img src="/assets/image/{{ $b->gambar_buku }}" style="width:60px; height:70px;"
                alt="Gambar {{ $b->gambar_buku }}"></td>
        <td>{{ $b->tanggal_pinjam }}</td>
        <td>{{ $b->tenggat_kembali }}</td>
        <td>{{ $b->status_pengembalian }}</td>

        @if(($b->status_pengembalian) == "Sudah Dikembalikan")
        <td>
            Done
        </td>
        @else
        <td>
            <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
            <a class="btn btn-warning btn-sm" href="/kembalikanBuku/{{ $b->id_peminjaman }}">Kembalikan</a>
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
@endsection