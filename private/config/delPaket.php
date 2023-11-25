<?php
require 'function.php';
$keyProduk = $_GET["iu"];

if (delProduk($keyProduk)) {
  echo '<script>
  alert("Data terhapus");
  document.location = "../../public/items";
  </script>';
} else {
  echo '<script>
  alert("Data gagal dihapus");
  document.location = "../../public/items";
  </script>';
}
