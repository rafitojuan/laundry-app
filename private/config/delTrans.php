<?php
require 'function.php';
$idt = $_GET["t"];

if (delTransaksi($idt)) {
  echo '<script> alert("Dihapus"); document.location = "../../public/transaksi"; </script>';
} else {
  echo '<script> alert("Gagal dihapus!"); document.location = "../../public/transaksi"; </script>';
}
