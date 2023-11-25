<?php
$page = "edit";
require 'function.php';
session_start();

$id = $_GET["u"];
$user = mysqli_query($conn, "SELECT *, user.nama AS usernama FROM user JOIN outlet USING (id_outlet) WHERE id_user = $id");


if (isset($_POST['uptUser'])) {
  if (updateUser($_POST) > 0) {
    echo "
    <script>
    alert('Berhasil');
    document.location = '../../public/user';
    </script>";
  } else {
    echo "
    <script>
    alert('Data tidak diubah');
    document.location = '../../public/user';
    </script>";
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Produk</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
  <link rel="icon" href="../assets/img/logo.png">

</head>

<body>
  <!-- <div class="side">
    <?php require '../components/sidebar.php' ?>
  </div> -->

  <div class="container" style="margin-top: 100px;">
    <div class="row">
      <div class="col-md-4">
        <div class="carda card">
          <div class="card-header">
            Edit User
          </div>
          <div class="card-body">
            <form action="" method="post">
              <?php foreach ($user as $items) : ?>
                <input type="hidden" name="iduser" id="" value="<?= $items['id_user'] ?>">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama :</label>
                  <input type="text" name="nama" id="nama" class="form-control" value="<?= $items['usernama'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Username :</label>
                  <input type="text" name="username" id="username" class="form-control" value="<?= $items['username'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password :</label>
                  <input type="password" name="password" id="password" class="form-control" value="<?= $items['password'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="outlet" class="form-label">Outlet :</label>
                  <!-- <input type="file" class="form-control" name="kelamin" id=""> -->
                  <select name="outlet" id="outlet" class="form-select" required>
                    <option disabled>== Pilih Outlet ==</option>
                    <option selected hidden value="<?= $items['id_outlet'] ?>"><?= $items['nama'] ?></option>
                    <option value="<?= $items['id_outlet'] ?>"><?= $items['nama'] ?></option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="role" class="form-label">Role :</label>
                  <select name="role" id="role" class="form-select">
                    <option disabled>== Pilih Role ==</option>
                    <option selected hidden value="<?= $items['role'] ?>"><?= $items['role'] ?></option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                  </select>
                </div>
              <?php endforeach; ?>
          </div>
          <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success float-end" name="uptUser">Kirim</button>
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
                <?php $no = 1;
                foreach ($user as $items) : ?>
                  <td scope="row"><?= $no++ ?>.</td>
                  <td><?= $items['usernama'] ?></td>
                  <td><?= $items['username'] ?></td>
                  <td><?= $items['nama'] ?></td>
                  <td><?= $items['role'] ?></td>
                  <td class="text-center">
                    <a href="editUser?u=<?= $items['id_user'] ?>" class="badge btn text-dark"><i class="ri-edit-line"></i></a>
                    <a href="delUser?u=<?= $items['id_user'] ?>" onclick="return confirm('Yakin untuk hapus?')" class="badge btn text-dark"><i class="ri-delete-bin-line"></i></a>
                  </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>



</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>