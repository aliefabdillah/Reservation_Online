<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Register</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <?php
        // cek status
        // if (isset($_GET['status'])) {
        //     if ($_GET['status'] == 1) {
        //         echo "<div class=\"alert alert-success\">SIGN UP SUCCESS - <a href='login.php'> Kembali ke Halaman Login</div>";
        //     }
        //     else {``
        //         echo "<div class=\"alert alert-danger\">SIGN UP GAGAL</div>";
        //     }
        // }
    ?>
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control"
          value="<?php echo isset($nama) ? $nama : ""?>">
      </div>
      <div class="mb-3">
        <label for="telepon" class="form-label">Nomor Telepon</label>
        <input type="text" name="telepon" id="telepon" class="form-control">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email </label>
        <input type="text" name="email" id="email" class="form-control">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password </label>
        <input type="password" name="password" id="password" class="form-control">
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