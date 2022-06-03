<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Reservasi Online</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,400&family=Secular+One&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }

        .stamp {
            width: 35%;
        }

        .head1 {
            width: 15%;
        }
    </style>
</head>

<body>
    <div class="container-responsive">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-beetwen">
                <span class="navbar-brand mb-0 h1">PILIH TEMPAT DUDUK</span>
                @if(\Session::get('login') == TRUE)
                <a href="{{ route('customerLogout') }}"><button type="button" class="btn btn-light float-end">Logout</button></a>
                @endif
            </div>
        </nav>

        <div class="container">
            <div class="stamp container-sm border border-dark m-4 p-2">
                <p>Waktu Kedatangan : {{$waktu}}</p>
                <p>Nomor Kursi : {{$nama_tempatDuduk}}</p>
            </div>

            <div class="menu container-sm rounded bg-secondary p-2 d-flex flex-column" style="max-width: 1200px;">
                <form class="d-flex flex-wrap" action="{{ route('check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="seat_id" value="{{$tempatDuduk}}">
                    <input type="hidden" name="waktu" value="{{$waktu}}">
                    <div class="container d-flex flex-column p-1 mt-3 align-items-center">
                        <div class="head1 rounded d-flex flex-row bg-white p-1 justify-content-center">
                            <p class="my-auto mx-3">Makanan</p>
                        </div>
                    </div>
                        <div class="container d-flex justify-content-center flex-wrap">
                            @php($i = 0)
                            @foreach ($makanan as $m)
                            <div class="d-flex  col-12 col-md-3 flex-column bg-white rounded p-1 m-2" style="max-width: 200px;">
                                <p class="my-auto mx-3"> {{ $m->nama }}</p>
                                <p class="my-auto mx-3"> {{ $m->harga }}</p>
                                <div class="d-flex flex-row align-items-center">
                                    <p class="my-auto mx-3"> pesan </p>
                                    <input type="checkbox" name="menu[{{$i++}}]" value="{{$m->id}}" onchange="checkbox(this)"><br>
                                </div>
                                <input class="text-center w-25 my-auto mx-3" type="number" name="qty[]" value="0" onkeyup="noMinus(this)" readonly><br>
                            </div>
                            @endforeach
                        </div>
                        <div class="container d-flex flex-column mt-3 p-1  align-items-center">
                            <div class="head1 rounded d-flex flex-row bg-white p-1 justify-content-center">
                                <p class="my-auto mx-3">Minuman</p>
                            </div>
                        </div>
                        <div class="container d-flex justify-content-center  flex-wrap">
                            @foreach ($minuman as $m)
                            <div class="d-flex flex-column bg-white rounded p-1 m-2">
                                <p class="my-auto mx-3"> {{ $m->nama }}</p>
                                <p class="my-auto mx-3"> {{ $m->harga }}</p>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <p class="my-auto mx-3"> pesan </p>
                                    <input class="m-0" type="checkbox" name="menu[{{$i++}}]" value="{{$m->id}}" onchange="checkbox(this)"><br>
                                </div>
                                <input class="my-auto mx-3 w-25" type="number" name="qty[]" value="0" onkeyup="noMinus(this)" readonly ><br>
                            </div>
                            @endforeach
                        </div>
                        <div class="container d-flex flex-column p-1  align-items-center">
                            <input class="btn-primary w-25" type="submit" value="Checkout" id="submit" disabled>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function checkbox(element) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
            if (checkedOne) document.getElementById("submit").disabled = false
            else document.getElementById("submit").disabled = true
            el = element.parentElement.nextSibling.nextSibling;
            console.log(el);
            if (element.checked) {
                el.readOnly = false;
                el.value = 1
            } else {
                el.readOnly = true;
                el.value = 0
            }
        }

        function noMinus(element) {
            if (element.value < 1) {
                element.value = 1
            }
        }
    </script>

</body>

</html>
