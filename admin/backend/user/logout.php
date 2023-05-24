<?php

session_start();
unset($_SESSION["admin_email"]);
unset($_SESSION["admin_id"]);
header("location: ../../login.php")
?>
