<?php
require 'function.php';
$ido = $_GET["let"];

if (delOutlet($ido)) {
  echo '<script> alert("Berhasil"); document.location = "../../public/outlet.php"; </script>';
} else {
  echo '<script> alert("Gagal!"); document.location = "../../public/outlet.php"; </script>';
}
