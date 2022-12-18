<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <title>Register</title>
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

        <h4 style="color:white;">Data Perpustakaan</h4>
    </nav>
    <!-- </div> -->
    <div class="container">
        <div class="card" style="margin-top:20px;">
            <div class="card-header text-center" style="background:white;padding-top:30px;">
                <h3>Register</h3>
            </div>
            <form action="/authRegist" method="post">
                @csrf
                <div class="card-body" style="background:white;">


                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label for="username">Username: </label>
                                    <input class="form-control" placeholder="Username" name="username" type="text"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <label for="username">Nama: </label>
                                    <input class="form-control" placeholder="Nama" name="nama" type="text"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <label for="username">Password: </label>
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                        required="required">
                                </div>
                                
                                <button type='submit' class='btn btn-primary'>
                                    <i class='fa fa-sign-in'></i> Masuk
                                </button>
                                <div>
                                    <a href="/">Sudah punya akun? Login disini</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
