<?php
$page = "tambus";
require '../private/config/function.php';
session_start();

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Login terlebih dahulu');
  document.location = '../auth/login';
  </script>";
}

$user = mysqli_query($conn, "SELECT *, user.nama AS namaUser FROM user JOIN outlet USING (id_outlet)");
$outlet = query("SELECT * FROM outlet");
$usr = mysqli_fetch_assoc($user);

if (isset($_POST['send'])) {
  if (addUser($_POST)) {
    echo "<script> alert('Berhasil!'); document.location = 'user'; </script>";
  } else {
    echo '<script> alert("Gagal"); document.location = "user"; </script>';
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>User Londry</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
  <link rel="icon" href="../private/assets/img/logo.png">
  <link rel="stylesheet" href="../private/assets/css/style.css">

</head>

<body>
  <div class="side">
    <?php require '../private/components/sidebar.php' ?>
  </div>

  <div class="container" style="margin-top: 100px;">
    <div class="row">
      <div class="col-md-4">
        <div class="carda card">
          <div class="card-header">
            Tambah User
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama :</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Username :</label>
                <input type="text" name="username" id="username" class="form-control">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input type="password" name="password" id="password" class="form-control">
              </div>
              <div class="mb-3">
                <label for="outlet" class="form-label">Outlet :</label>
                <!-- <input type="file" class="form-control" name="kelamin" id=""> -->
                <select name="outlet" id="outlet" class="form-select" required>
                  <option disabled>== Pilih Outlet ==</option>
                  <option selected hidden label=""></option>
                  <?php foreach ($outlet as $select) : ?>
                    <option value="<?= $select['id_outlet'] ?>"><?= $select['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">Role :</label>
                <select name="role" id="role" class="form-select">
                  <option hidden selected label=""></option>
                  <option disabled>== Pilih Role ==</option>
                  <option value="admin">admin</option>
                  <option value="kasir">kasir</option>
                </select>
              </div>
          </div>
          <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success float-end" name="send">Kirim</button>
          </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <div class="carda table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="text-white" style="background-color: #304362;">
              <tr>
                <th scope="col" style="width: 10px;">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Outlet</th>
                <th scope="col">Role</th>
                <th scope="col" class="text-center" style="width: 85px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="">
                <?php if ($usr == NULL) {
                  echo '<td colspan="6" class="text-center">data kosong</td>';
                } ?>
                <?php $no = 1;
                foreach ($user as $items) : ?>
                  <td scope="row"><?= $no++ ?>.</td>
                  <td><?= $items['namaUser'] ?></td>
                  <td><?= $items['username'] ?></td>
                  <td><?= $items['nama'] ?></td>
                  <td><?= $items['role'] ?></td>
                  <td class="text-center">
                    <a href="../private/config/editUser?u=<?= $items['id_user'] ?>" class="badge btn text-dark"><i class="ri-edit-line"></i></a>
                    <a href="../private/config/delUser?u=<?= $items['id_user'] ?>" onclick="return confirm('Yakin untuk hapus?')" class="badge btn text-dark"><i class="ri-delete-bin-line"></i></a>
                  </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <div class="container" style="margin-top: 100px;">

  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>