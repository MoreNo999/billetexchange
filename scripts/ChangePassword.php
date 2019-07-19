<?php 
session_start();
require_once("functions.php");

//We are connected now, so lets check for post data
if (!isset($_POST['oldPassword'], $_POST['newPassword'])) {
    die ('Improper Form');
}
//Call update function
if (ChangePassword($_POST)){
    //Handle Success
    $_SESSION['errorMessage'] = 'Account Updated!';
    //header('Location: ../index.php');
}
else{
    //Handle Failure
    $_SESSION['errorMessage'] = 'Account Update Failed!';
    //header('Location: ../index.php');
}
?>
