<?php
require 'function.php';

$idu = $_GET["u"];

if (delUser($idu)) {
  echo '<script> alert("Berhasil dihapus!"); document.location = "../../public/user" </script>';
} else {
  echo '<script> alert("Gagal Hapus") </script>';
}
