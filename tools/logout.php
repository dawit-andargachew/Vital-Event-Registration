<?php
session_start();
// session_destroy();
unset($_SESSION['ssn']);
unset($_SESSION['email']);
unset($_SESSION['pass']);
unset($_SESSION['name']);

header("Location:../index.php")
?>
