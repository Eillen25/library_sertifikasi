<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <title>@yield('judul')</title>
</head>
<style>
    body {
        background-color: #f2dfda;
    }

    tr:nth-child(even) {
        background-color: #ffcdab;
    }

    tr:nth-child(odd) {
        background-color: white;
    }

    th {
        background-color: #ffa45c;
    }

    .btn {
        background-color: #493a36;
        color: white;
    }

    .btn:hover {
        background-color: #ffa45c;
        color: black;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg default navbar-light" style="background-color: #493a36;">
        <a class="navbar-brand" href="/"><img src="/assets/image/logo.png" height="50" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link btn" style="color:white;" href="/daftarBuku">Seluruh Buku </a>
                <a class="nav-link btn" style="color:white;" href="/inputBuku">Input Buku </a>
                <a class="nav-link btn" style="color:white;" href="/listPinjaman">List Pinjaman Buku </a>
                <a class="nav-link btn" style="color:white;" href="/dataPeminjaman">Daftar Peminjam Buku </a>
                <a class="nav-link active btn" style="color:white;" href="/logout">Logout </a>
            </div>
        </div>
        <h4 style="color:white;">Data Perpustakaan</h4>
    </nav>
    
    <div class="container">
        <div class="card" style="margin-top:20px;">
            <div class="card-header text-center" style="background:white;padding-top:30px;">
                <h3>@yield('header')</h3>
            </div>
            <div class="card-body" style="background:white;">
                <table class="table table-bordered table-hover">
                    @yield('konten')
                </table>
            </div>
        </div>
        @yield('paginate')
    </div>
</body>

</html>