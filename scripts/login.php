<?php 
require_once("scripts/functions.php");
require_once("config.php");
$lDbName = $db["db1"]["dbname"];
$lDbUser = $db["db1"]["dbname"];
$lDbPass = $db["db1"]["dbname"];
$lDbHost = $db["db1"]["dbname"];

$con = mysqli_connect($lDbHost, $lDbUser, $lDbPass, $lDbName);
if ( mysqli_connect_errno() ) {
    //There was a connection error....Die....
    die ('Failed to conenct to MySQL' . mysqli_connect_error());
}

//We are connected now, so lets check for post data
if (!isset($_POST['user'], $_POST['pass'], $_POST['formkey'])) {
    die ('Login improper');
}

//Prepare our sql statement, nullify SQL Injection
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['user']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['pass'], $password)) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo 'Welcome ' . $_SESSION['name'] . '!';
        } else {
            echo 'Incorrect username/password!';
        }
    } else {
        echo 'Incorrect username/password!';
    }
    $stmt->close();
}