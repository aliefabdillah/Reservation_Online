<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ url('storage/img/foodicon.png') }}">
    <style>
		@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,400&family=Secular+One&display=swap');
		body, html{
			margin: 0;
			height: 100%;
            font-family: 'Montserrat', sans-serif;
		}

		h1{
            margin: 20px;
			font-size: 30px;
		}

        .container {
            border: 1px solid #000000;
            border-radius: 5px;
            padding: 10px 30px 30px 30px;
        }

        .container-1 {
            display: flex;
            align-items : flex-start;
            justify-content: space-between;
            padding: 20px 50px;
        }

        .flex-container-1{
            background-color: #C4C4C4;
            width: 13%;
            text-align: center;
            line-height: 70px;
            font-size: 20px;
        }

        .container-2 {
            display: flex;
            align-items: flex-start;

            justify-content: space-between;
        }

        .flex-container-2{
            background-color: #C4C4C4;
            width: 17%;
            text-align: center;
            line-height: 100px;
            font-size: 20px;
        }

        .flex-container-3{
            background-color: #C4C4C4;
            width: 25%;
            text-align: center;
            line-height: 150px;
            font-size: 20px;
        }

        .mb-3 p{
            padding :0px;
            margin : 0;
            text-align: justify;
        }

        a {
            text-decoration: none;
        }

        .mb-3 label{
            margin: 0;
            color: #8A8A8A;
        }

        p {
            text-align: center;
        }

		@media screen and (max-width: 800px) {
			h1{
				font-size: 45px;
			}

			.btn{
				font-size: 18px;
			}
		}

		@media screen and (max-width: 400px) {
			h1{
				font-size: 30px;
			}

			.btn{
				font-size: 12px;
			}
		}
	</style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-beetwen">
            <span class="navbar-brand mb-0 h1">PILIH TEMPAT DUDUK</span>
            @if(\Session::get('login') == TRUE)
                <a href="{{ route('customerLogout') }}"><button type="button" class="btn btn-light float-end">Logout</button></a>
            @endif
        </div>
    </nav>

    <form class="form" action="{{ route('submit.tempatDuduk') }}" method="post">
        @csrf
        <div class="container mt-3">
            <div class="mb-3">
                <p> Keterangan Kode<br>
                    Contoh : 4B1<br>
                    4 = jumlah kursi<br>
                    B = Baris<br>
                    1 = Kolom<br>
                </p>
            </div>
            @if(\Session::has('validate'))
            <div class="alert alert-danger">
                <div>{{Session::get('validate')}}</div>
            </div>
            @endif
            <div class="mb-3">
                <span>Waktu Kedatangan :</span>
                <input type="time"  min="10:00" max="22:00" name="waktu">
                <p>Waktu Operasional Restoran dari jam 10:00 - 22:00</p>
            </div>
            <div class="mb-3">
                <div class="container">
                    <div class="container-1 align-items-center flex-wrap">
                        @foreach ($seat as $s)
                            @if(substr($s->nama, 0, 1) == "2")
                                @if($s->is_available == 1)
                                    <div class="flex-container-1 m-4 text-light bg-success">{{$s->nama}}</div>
                                @else
                                    <div class="flex-container-1 m-4 text-light bg-danger">{{$s->nama}}</div>
                                @endif
                            @elseif(substr($s->nama, 0, 1) == "4")
                                @if($s->is_available == 1)
                                    <div class="flex-container-2 m-3 text-light bg-success">{{$s->nama}}</div>
                                @else
                                    <div class="flex-container-2 m-3 text-light bg-danger">{{$s->nama}}</div>
                                @endif
                            @elseif(substr($s->nama, 0, 1) == "6")
                                @if($s->is_available == 1)
                                    <div class="flex-container-3 m-3 text-light bg-success">{{$s->nama}}</div>
                                @else
                                    <div class="flex-container-3 m-3 text-light bg-danger">{{$s->nama}}</div>
                                @endif
                            @endif
                        @endforeach
                        <!-- <div class="flex-container-1">2A2</div>
                        <div class="flex-container-1">2A3</div>
                        <div class="flex-container-1">2A4</div> -->
                    </div>

                    <!-- <div class="container-1">
                        <div class="flex-container-1">4D1</div>
                        <div class="flex-container-1">2D2</div>
                        <div class="flex-container-1">2D3</div>
                        <div class="flex-container-1">4D4</div>
                    </div> -->
                </div>
            </div>
            <div class="m-4 d-grid gap-2 col-3 mx-auto">
                <!-- <label class="">Tempat Yang Dipilih:</label> -->
                <input type="text" class="text-center form-control" name="tempatDuduk" placeholder="Tempat yang Dipilih...">
            </div>
        @if(\Session::get('login') == TRUE)
            <div class="d-grid gap-2 col-2 mx-auto">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
        @else
            <p>Untuk Memilih Tempat Duduk Anda Perlu Login? <a href="{{ route('signIn') }}">Login Sekarang!</a></p>
        @endif
        </div>
    </form>
</body>
</html>
