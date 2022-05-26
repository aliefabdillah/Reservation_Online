<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Testing Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <h1>TESTING SEAT</h1>
    @if(\Session::get('login') == TRUE)
        <a href="{{ route('customerLogout') }}"><button type="button" class="btn btn-danger float-end">Logout</button></a>
    @endif
    <form class="form" action="{{ route('submit.tempatDuduk') }}" method="post">
        <div class="mb-3">
            <label>Waktu Kedatangan :</label>
            <input name="waktu">
        </div>
        <div class="mb-3">
            <label>Tempat:</label>
            <input name="waktu">
        </div>
        @if(\Session::get('login') == TRUE)
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        @else
            <label>Untuk Memilih Tempat Duduk Anda Perlu Login? <a href="{{ route('signIn') }}">Login Sekarang!</a></label>
        @endif
    </form>
</body>
</html>