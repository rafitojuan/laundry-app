<?php
require 'function.php';
$idt = $_GET["t"];

if (bayar($idt)) {
  echo '<script> alert("Berhasil dibayar"); document.location = "../../public/transaksi"; </script>';
} else {
  echo '<script> alert("Gagal dibayar!"); document.location = "../../public/transaksi"; </script>';
}
