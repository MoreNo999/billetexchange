<?php 
session_start();
require_once("functions.php");

//We are connected now, so lets check for post data
if (!isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['unit'])) {
    die ('Improper Form');
}
//Call update function
if (UpdateSessionUserProfileData($_POST)){
    //Handle Success
    $_SESSION['errorMessage'] = 'Account Updated!';
    header('Location: ../my_account.php');
}
else{
    //Handle Failure
    $_SESSION['errorMessage'] = 'Account Update Failed!';
    header('Location: ../edit_profile.php');
}
?>
