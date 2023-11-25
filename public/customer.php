<?php
$page = "customer";
require '../private/config/function.php';
session_start();

if (!isset($_SESSION['login'])) {
  echo "
  <script>
  alert('Login terlebih dahulu');
  document.location = '../auth/login';
  </script>";
}

$member = mysqli_query($conn, "SELECT * FROM member");
$cust = mysqli_fetch_assoc($member);

if (isset($_POST['send'])) {
  if (addMember($_POST)) {
    echo "<script> alert('Berhasil!'); document.location = 'customer'; </script>";
  } else {
    echo '<script> alert("Gagal"); document.location = "customer"; </script>';
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Member</title>
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
            Tambah Member
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama :</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat :</label>
                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label for="kelamin" class="form-label">Kelamin :</label>
                <!-- <input type="file" class="form-control" name="kelamin" id=""> -->
                <select name="kelamin" id="kelamin" class="form-select" required>
                  <option disabled>== Pilih Jenis Kelamin ==</option>
                  <option selected hidden label=""></option>
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="telp" class="form-label">Telp :</label>
                <input type="number" name="telp" id="telp" class="form-control" min="0" max="999999999999" required oninvalid="this.setCustomValidity('Bukan nomor telepon!')" oninput="this.setCustomValidity('')">
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
                <th scope="col">Alamat</th>
                <th scope="col">Telp</th>
                <th scope="col" class="text-center" style="width: 85px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="">
                <?php if ($cust == NULL) {
                  echo '<td colspan="5" class="text-center">data kosong</td>';
                } ?>
                <?php $no = 1;
                foreach ($member as $items) : ?>
                  <td scope="row"><?= $no++ ?>.</td>
                  <td><?= $items['nama'] ?><img src="../private/assets/img/<?= $items['kelamin'] == 'L' ? 'men-line.png' : 'women-line.png' ?>" width="13px" alt="Gender Beliau"></td>
                  <td><?= $items['alamat'] ?></td>
                  <td><?= $items['tlp'] ?></td>
                  <td class="text-center">
                    <a href="../private/config/editCust?cust=<?= $items['id_member'] ?>" class="badge btn text-dark"><i class="ri-edit-line"></i></a>
                    <a href="../private/config/delCust?cust=<?= $items['id_member'] ?>" onclick="return confirm('Yakin untuk hapus?')" class="badge btn text-dark"><i class="ri-delete-bin-line"></i></a>
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