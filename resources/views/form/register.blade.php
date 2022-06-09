<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Register</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/x-icon" href="{{ url('storage/img/foodicon.png') }}">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,400&family=Secular+One&display=swap');
    *{
      font-family: 'Montserrat', sans-serif;
    }

    .container{
      position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
    }

    @media screen and (max-width: 400px) {
			.container{
        margin-top: 0;
        height: 100%;
      }
		}
  </style>
</head>
<body class="bg-light">
  <div class="container shadow pt-4 pb-5 px-5 rounded bg-white" style="max-width:500px">
    <h1 class="text-center mb-1">Register </h1>
    <h1 class="text-center mb-4">Data Pemesan </h1>
    <!-- cek status -->
    <!-- @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif -->
    <form action="{{ route('submit.register') }}" method="post">
      @csrf
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
        @error('nama')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="telepon" class="form-label">Nomor Telepon</label>
        <input type="text" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telepon') }}">
        @error('telp')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
        @error('alamat')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email </label>
        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
        @error('email')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password </label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <input type="checkbox" onclick="myFunction()"> Show Password
      </div>
      <input type="submit" name="submit" value="Register" class="w-100 btn btn-primary">
    </form>
  </div>
 
<script >
    // java script untuk menampilkan password
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type == "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>