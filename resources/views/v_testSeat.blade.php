<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-beetwen">
            <span class="navbar-brand mb-0 h1">PILIH TEMPAT DUDUK</span>
            @if(\Session::get('login') == TRUE)
                <a href="{{ route('customerLogout') }}"><button type="button" class="btn btn-danger float-end">Logout</button></a>
            @endif
        </div>
    </nav>

    @if(\Session::get('login') == TRUE)
    @endif
    <form class="form" action="{{ route('submit.tempatDuduk') }}" method="post">
        @csrf
        <div class="mb-3">
            <label>Waktu Kedatangan :</label>
            <input type="time" min="10:00" max="22:00" name="waktu"><br>
            <p>Waktu Operasional Restoran dari jam 10:00 - 22:00</p>
        </div>
        <div class="mb-3">
            <label>List Tempat Duduk</label>
            <ul>
                @foreach ($seat as $s)
                    <li>{{ $s->nama }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mb-3">
            <label>Tempat:</label>
            <input type="text" name="tempatDuduk">
        </div>
        @if(\Session::get('login') == TRUE)
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        @else
            <label>Untuk Memilih Tempat Duduk Anda Perlu Login? <a href="{{ route('signIn') }}">Login Sekarang!</a></label>
        @endif
    </form>
    @if(\Session::has('validate'))
        <div class="alert alert-danger">
            <div>{{Session::get('validate')}}</div>
        </div>
    @endif
</body>
</html>
