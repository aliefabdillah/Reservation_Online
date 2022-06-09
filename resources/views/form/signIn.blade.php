<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Login</title>
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
      
      .wrapper{
        margin-top: 40px;
      }
		}
  </style>
</head>
<body class="bg-light">
  <div class="container shadow pt-4 pb-5 px-5 rounded bg-white" style="max-width:500px">
    <div class="wrapper">
      <h1 class="text-center mb-4">Login</h1>
      @if(\Session::has('alert-success'))
        <div class="alert alert-success">
            <div>{{Session::get('alert-success')}}</div>
        </div>
      @elseif(\Session::has('alert'))
        <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
        </div>
      @endif
      <form action="{{ route('submit.signIn') }}" method="post">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Email</label>
          <input type="text" name="email" id="email" class="form-control"
            value="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="pass" class="form-control">
          <input type="checkbox" onclick="myFunction()"> Show Password
        </div>
        <div class="mb-3">
          <label>Belum Pernah Memesan sebelumnya? <a href="{{ route('register') }}">Register Now!</a></label>
        </div>
        <input type="submit" name="submit" value="Login" class="w-100 btn btn-primary">
      </form>
    </div>
  </div>
 
<script >
    // java script untuk menampilkan password
    function myFunction() {
        var x = document.getElementById("pass");
        if (x.type == "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>