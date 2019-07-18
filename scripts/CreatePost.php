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
//if (!isset($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['unit'])) {
//   die ('Improper Form');
//}

$OwnerID = $_SESSION['id'];
$OutAFSC = $_POST['OutAFSC'];
$OutRank = $_POST['OutRank'];
$OutSEI = $_POST['OutSEI'];
$OutSkillLevel = $_POST['OutSkillLevel'];
$InAFSC = $_POST['InAFSC'];
$InRank = $_POST['InRank'];
$InSEI = $_POST['InSEI'];
$InSkillLevel = $_POST['InSkillLevel'];
$PositionNumber = $_POST['PositionNumber'];
$Description = $_POST['Description'];
//$DatePosted = ;  This will be set with MySQL NOW() Function
$Views = 0;
$Clicks = 0;
$Status = 1;

//Prepare our sql statement, nullify SQL Injection
if ($stmt = $con->prepare("INSERT INTO BilletEntry(OwnerID, OutAFSC, OutRank, OutSEI, OutSkillLevel, InAFSC, InRank, InSEI, InSkillLevel, PositionNumber, Description, Views, Clicks, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('isssisssissiii', $OwnerID, htmlspecialchars($OutAFSC, ENT_NOQUOTES), htmlspecialchars($OutRank, ENT_NOQUOTES), htmlspecialchars($OutSEI, ENT_NOQUOTES), $OutSkillLevel, htmlspecialchars($InAFSC, ENT_NOQUOTES), htmlspecialchars($InRank, ENT_NOQUOTES), htmlspecialchars($InSEI, ENT_NOQUOTES), $InSkillLevel, htmlspecialchars($PositionNumber, ENT_NOQUOTES), htmlspecialchars($Description, ENT_NOQUOTES), $Views, $Clicks, $Status);
    if ($stmt->execute()){
        $_SESSION['errorMessage'] = 'Post Created!';
        header('Location: ../home.php');
    }
    else {
        $_SESSION['errorMessage'] = 'Post Creation Failed!';
        header('Location: ../home.php');
    }
    $stmt->close();
    
}
else{
    $_SESSION['errorMessage'] = 'Post Creation Failed!';
    header('Location: ../home.php');
}