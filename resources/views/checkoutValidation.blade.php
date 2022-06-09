<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Reservasi Restoran</title>
	<link rel="icon" type="image/x-icon" href="{{ url('storage/img/foodicon.png') }}">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,400&family=Secular+One&display=swap');
		body, html{
			margin: 0;
			height: 100%;
		}

		.hero-text {
			text-align: center;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		h1{
			font-size: 60px;
			font-family: 'Montserrat', sans-serif;
			font-weight: 700;
		}

		.slogan{
			font-size: 28px;
			font-family: 'Montserrat', sans-serif;
			font-weight: 500;
		}

		button{
			font-family: 'Montserrat', sans-serif;
		}

		@media screen and (max-width: 800px) {
			h1{
				font-size: 45px;
			}

			.slogan{
				font-size: 20px;
			}

			.btn{
				font-size: 18px;
			}
		}

		@media screen and (max-width: 400px) {
			h1{
				font-size: 30px;
			}

			.slogan{
				font-size: 14px;
			}

			.btn{
				font-size: 12px;
			}
		}
	</style>
</head>
<body>
	@if($status == 2)
	<div class="hero-text">
		<h1>Pembayaran Berhasil</h1>
		<p class="slogan mt-2">Jika pesanan belum di konfirmasi di restoran 15 menit setelah waktu reservasi maka pesanan hangus dan uang tidak dapat kembali !!!!</p>
		<a href="{{ route('landing') }}"><button type="button" class="btn btn-primary btn-lg">Kembali</button></a>
	</div>
	@else
	<div class="hero-text">
		<h1>Pembayaran Gagal</h1>
		<p class="slogan mt-2">Terjadi Kesalahan dalam proses pembayaran. Silahkan ulangi proses pembayaran!</p>
	</div>
	@endif
</body>
</html>
