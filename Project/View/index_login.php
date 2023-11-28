<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once '../model/dbConnect.php';
require_once '../model/UserModel.php';
require_once '../controller/UserController.php';

$usermodel = new UserModel($con);
$usercontroller = new UserController($con);

$usercontroller->handleRequest($_POST);
?>