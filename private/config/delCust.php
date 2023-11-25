<?php
require 'function.php';
$idc = $_GET["cust"];

if (delCust($idc)) {
  echo '<script>
  alert("Data terhapus");
  document.location = "../../public/customer";
  </script>';
} else {
  echo '<script>
  alert("Data gagal dihapus");
  document.location = "../../public/customer";
  </script>';
}
