<?php
session_start();
session_destroy();
session_unset();
session_abort();

echo '<script> alert("Selamat Tinggal!"); document.location = "login"; </script>';
