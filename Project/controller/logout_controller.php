<?php
session_start();
session_destroy();
header('Location: ../View/home_page.php');
exit();
?>