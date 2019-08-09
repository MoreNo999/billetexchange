<?php
//Expects a POST of postid= and the post that is being changed, and the rest of the data as post. 
session_start();
require_once("functions.php");
require_once("../config.php");

$conMan = new SQLConnectionManager();
$con = $conMan->StartConnection();

//We are connected now, so lets check for post data
//if (!isset($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['unit'])) {
//   die ('Improper Form');
//}
$PostID = $_POST['postid'];
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
$Majcom = $_POST['Majcom'];

//Prepare our sql statement, nullify SQL Injection
if ($stmt = $con->prepare("UPDATE BilletEntry SET OutAFSC=?, OutRank=?, OutSEI=?, OutSkillLevel=?, InAFSC=?, InRank=?, InSEI=?, InSkillLevel=?, PositionNumber=?, Description=?, Views=?, Clicks=?, Status=? WHERE ID=? and OwnerID=?")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('sssisssissiiisii', htmlspecialchars(strtoupper($OutAFSC), ENT_NOQUOTES), htmlspecialchars($OutRank, ENT_NOQUOTES), htmlspecialchars(strtoupper($OutSEI), ENT_NOQUOTES), $OutSkillLevel, htmlspecialchars(strtoupper($InAFSC), ENT_NOQUOTES), htmlspecialchars($InRank, ENT_NOQUOTES), htmlspecialchars(strtoupper($InSEI), ENT_NOQUOTES), $InSkillLevel, htmlspecialchars($PositionNumber, ENT_NOQUOTES), htmlspecialchars($Description, ENT_NOQUOTES), $Views, $Clicks, $Status, htmlspecialchars($Majcom, ENT_NOQUOTES), $PostID, $OwnerID);
    if ($stmt->execute()){
        $_SESSION['errorMessage'] = 'Post Updated!';
        header('Location: ../home.php');
    }
    else {
        $_SESSION['errorMessage'] = 'Post Update Failed!';
        header('Location: ../home.php');
    }
    $stmt->close();
    
}
else{
    $_SESSION['errorMessage'] = 'Post Update Failed!';
    header('Location: ../home.php');
}