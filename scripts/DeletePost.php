<?php 
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