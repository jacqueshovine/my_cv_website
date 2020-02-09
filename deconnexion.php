<?php
session_start();
unset($_SESSION);
session_destroy();
header("Location:http://jhovine.fr/login.php?action=logout");
?>