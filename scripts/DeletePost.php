<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("functions.php");
require_once("../config.php");

$conMan = new SQLConnectionManager();
$con = $conMan->StartConnection();

//We are connected now, so lets check for post data
if (!isset($_GET['PostID'])) {
    die ('Delete improper');
}

if (DeletePost($_GET['PostID'])){
    header('Location: ../home.php');
}
else{
    echo "FAIL DELETE";
}
?>