<?php
$conn = mysqli_connect("localhost", "root", "", "laundry-app");

function query($query)
{
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// FUNCTION PRODUK
function addProduk($data)
{
  global $conn;

  $id_outlet = $data['outlet'];
  $jenis = ucwords(htmlspecialchars($data['jenis']));
  $nama = ucwords(htmlspecialchars($data['nmPaket']));
  $harga = htmlspecialchars($data['harga']);

  $query = "INSERT INTO paket VALUES('','$id_outlet','$jenis','$nama','$harga')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function delProduk($keyProduk)
{
  global $conn;

  $query = "DELETE FROM paket WHERE id_paket = $keyProduk";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function updateProduk($data)
{
  global $conn;

  $id = $data['idPaket'];
  $id_outlet = $data['outlet'];
  $jenis = ucwords(htmlspecialchars($data['jenis']));
  $nama = ucwords(htmlspecialchars($data['nmPaket']));
  $harga = htmlspecialchars($data['harga']);

  $query = "UPDATE paket SET id_outlet = $id_outlet, jenis = '$jenis', nama_paket = '$nama', harga = '$harga' WHERE id_paket = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
// END

// FUNCTION MEMBER
function addMember($data)
{
  global $conn;

  $nama = ucwords(htmlspecialchars($data['nama']));
  $alamat = ucwords(htmlspecialchars($data['alamat']));
  $kelamin = $data['kelamin'];
  $telp = htmlspecialchars($data['telp']);

  $query = "INSERT INTO member VALUES(NULL,'$nama','$alamat','$kelamin','$telp')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function delCust($idc)
{
  global $conn;

  $query = "DELETE FROM member WHERE id_member = $idc";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function updateMember($data)
{
  global $conn;

  $id = $data['idcust'];
  $nama = ucwords(htmlspecialchars($data['nama']));
  $alamat = ucwords(htmlspecialchars($data['alamat']));
  $kelamin = $data['kelamin'];
  $tlp = htmlspecialchars($data['telp']);

  $query = "UPDATE member SET nama = '$nama', alamat = '$alamat', kelamin = '$kelamin', tlp = '$tlp' WHERE id_member = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
// END

// FUNCTION USER
function addUser($data)
{
  global $conn;

  $nm = ucwords(htmlspecialchars($data['nama']));
  $username = strtolower(htmlspecialchars($data['username']));
  $password = mysqli_real_escape_string($conn, htmlspecialchars($data['password']));
  $outlet = $data['outlet'];
  $role = $data['role'];
  $hashed = password_hash($password, PASSWORD_DEFAULT);

  $validasiNama = mysqli_query($conn, "SELECT nama FROM user WHERE nama = '$nm'");
  if (mysqli_fetch_assoc($validasiNama)) {
    echo '<script> alert("Nama sudah dipakai"); document.location = "user"; </script>';
    return false;
  }

  $query = "INSERT INTO user VALUES(NULL,'$nm','$username','$hashed','$outlet','$role')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function delUser($idu)
{
  global $conn;

  $query = "DELETE FROM user WHERE id_user = $idu";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function updateUser($data)
{
  global $conn;

  $nama = ucwords(htmlspecialchars($data['nama']));
  $uname = strtolower(htmlspecialchars($data['username']));
  $pw = mysqli_real_escape_string($conn, $data['password']);
  $outlet = $data['outlet'];
  $role = $data['role'];
  $hashed = password_hash($pw, PASSWORD_DEFAULT);

  $query = "UPDATE user SET nama = '$nama', username = '$uname', password = '$hashed', id_outlet = $outlet, role = '$role'";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
// END

// FUNCTION OUTLET
function addOutlet($data)
{
  global $conn;

  $nama = ucwords(htmlspecialchars($data['nama']));
  $alamat = ucwords(htmlspecialchars($data['alamat']));
  $tlp = htmlspecialchars($data['telp']);

  $query = "INSERT INTO outlet VALUES(NULL,'$nama','$alamat','$tlp')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function delOutlet($ido)
{
  global $conn;

  $query = "DELETE FROM outlet WHERE id_outlet = $ido ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function updateOutlet($data)
{
  global $conn;

  $id = $data['idOutlet'];
  $nama = ucwords(htmlspecialchars($data['nama']));
  $alamat = ucwords(htmlspecialchars($data['alamat']));
  $telp = htmlspecialchars($data['telp']);

  $query = "UPDATE outlet SET nama = '$nama', alamat = '$alamat', tlp = '$telp' WHERE id_outlet = $id";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
// END

// TRANSAKSI
function addTransaksi($data)
{
  global $conn;

  $query = mysqli_query($conn, "SELECT harga FROM paket");
  $harga = mysqli_fetch_assoc($query);
  $outlet = $data['outlet'];
  $member = $data['member'];
  $paket = $data['paket'];
  $qty = $data['quantity'];
  $diskon = $data['diskon'];
  $user = $data['user'];

  $query = "INSERT INTO transaksi VALUES(NULL,$outlet,'2023','/INV/',LPAD(FLOOR(RAND() * 999),10,'0'),$member,now(),$paket,'','$qty',$diskon,5000,'diproses',$user)";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function bayar($idt)
{
  global $conn;

  $query = "UPDATE transaksi SET tgl_bayar = now(), status = 'dibayar' WHERE id_transaksi = $idt";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function delTransaksi($idt)
{
  global $conn;

  $query = "DELETE FROM transaksi WHERE id_transaksi = $idt";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
