<?php 
session_start();
require_once("functions.php");
require_once("../config.php");

$conMan = new SQLConnectionManager();
$con = $conMan->StartConnection();

//We are connected now, so lets check for post data
if (!isset($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['unit'])) {
    die ('Improper Form');
}
//Prepare our sql statement, nullify SQL Injection
if ($stmt = $con->prepare("INSERT INTO Accounts(Username, Passwd, Email, Unit, PhoneNumber) VALUES (?, ?, ?, ?, ?)")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    if (isset($_POST['phone'])){
        $_SESSION['errorMessage'] = 'P=Y';
        $stmt->bind_param('sssss', htmlspecialchars($_POST['user'], ENT_NOQUOTES), $password, htmlspecialchars($_POST['email'],ENT_NOQUOTES), htmlspecialchars($_POST['unit'], ENT_NOQUOTES), htmlspecialchars($_POST['phone'], ENT_NOQUOTES));
    }
    else {
        $stmt->bind_param('sssss', htmlspecialchars($_POST['user'], ENT_NOQUOTES), $password, htmlspecialchars($_POST['email'],ENT_NOQUOTES), htmlspecialchars($_POST['unit'], ENT_NOQUOTES), "empty");
    }
    $stmt->execute();
    $_SESSION['errorMessage'] = 'Account Created!';
    header('Location: ../index.php');
    $stmt->close();
}
else{
    $_SESSION['errorMessage'] = 'Account Creation Failed!';
}