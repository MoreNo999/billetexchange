<?php 
session_start();
require_once("functions.php");
require_once("../config.php");
$lDbName = $config["db"]["db1"]["dbname"];
$lDbUser = $config["db"]["db1"]["username"];
$lDbPass = $config["db"]["db1"]["password"];
$lDbHost = $config["db"]["db1"]["host"];

$con = mysqli_connect($lDbHost, $lDbUser, $lDbPass, $lDbName);
if ( mysqli_connect_errno() ) {
    //There was a connection error....Die....
    die ('Failed to connect to MySQL' . mysqli_connect_error());
}

//We are connected now, so lets check for post data
if (!isset($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['unit'])) {
    die ('Improper Form');
}

//Prepare our sql statement, nullify SQL Injection
if ($stmt = $con->prepare("INSERT INTO MyGuests (Username, Password, Email, Unit, Phone Number) VALUES (?, ?, ?,)")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $password = password_hash($_POST['pass']);
    if (isset($_POST['phone'])){
        $stmt->bind_param('sssss', $_POST['user'], $password, $_POST['email'], $_POST['unit'], $_POST['phone']);
    }
    else {
        $stmt->bind_param('sssss', $_POST['user'], $password, $_POST['email'], $_POST['unit'], "empty");
    }
	$stmt->execute();
    $_SESSION['errorMessage'] = 'Account Created!';
    header('Location: ../index.php');
    $stmt->close();

}
else{
    echo "StatementBuildBorked";
}