<?php
session_start();
require '../private/config/function.php';

if (isset($_SESSION['login'])) {
  echo '<script> document.location = "../public/index"; </script>';
}

if (isset($_POST['login'])) {
  $uname = $_POST['nama'];
  $pw = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$uname' ");
  if (mysqli_num_rows($result)) {
    $rows = mysqli_fetch_assoc($result);
    if ($uname == $rows['nama'] and $pw == password_verify($pw, $rows['password'])) {
      $_SESSION['login'] = true;
      $_SESSION['username'] = ucfirst($rows['username']);
      $_SESSION['role'] = $rows['role'];
      $_SESSION['outlet'] = $rows['id_outlet'];

      echo '<script> document.location = "../public/index</script>';
    } else {
      echo '<script> alert("Username atau Password Salah") </script>';
    }
  } else {
    echo '<script> alert("Akun tidak terdaftar!") </script>';
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="../private/assets/dist/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../private/assets/css/style.css">

</head>

<body>
  <div class="container-fluid">
    <div class="row vh-100">
      <div class="col-xl-4 d-flex justify-content-center align-items-center">
        <div class="wrapper">
          <h3 class="text-center">Welcome Back!</h3>
          <p class="text-muted text-center mb-5">Hai selamat datang Loaners ayo login dahulu!</p>
          <form action="" method="post">
            <div class="nama mb-4">
              <input type="text" class="form-control border-input m-auto" name="nama" id="nama" placeholder="Nama" required>
            </div>
            <div class="password mb-4">
              <input type="password" class="form-control border-input m-auto" name="password" id="password" placeholder="Password" required>
            </div>

            <button type="submit" name="login" class="btn text-white bg-primary w-100 m-auto mb-2">Masuk</button>
            <center>
              <!-- <span class="ms-4">Beliau kasir? <a href="register" class="text-decoration-none text-semudah">Daftar Sekarang</a></span> -->
            </center>
          </form>

        </div>

      </div>
      <div class="col-xl-8 bg-login d-none d-md-block">
        <div class="bg-login"></div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="../private/assets/dist/bootstrap.bundle.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
<!-- <i class="toggle-password" onclick="togglePassword()">&#128065;</i> -->