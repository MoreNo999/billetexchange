<?php
require_once(dirname(__FILE__)."/../config.php");

class SQLConnectionManager{
    public $mDbName;
    public $mDbUser;
    public $mDbPass;
    public $mDbHost;
    private $con;

    public function __construct() {
        global $config;
        $this->mDbName = $config["db"]["db1"]["dbname"];
        $this->mDbUser = $config["db"]["db1"]["username"];
        $this->mDbPass = $config["db"]["db1"]["password"];
        $this->mDbHost = $config["db"]["db1"]["host"];
    }
    
    public function StartConnection(){
        $this->con = mysqli_connect($this->mDbHost, $this->mDbUser, $this->mDbPass, $this->mDbName);
        if ( mysqli_connect_errno() ) {
            //There was a connection error....Die....
            die ('Failed to connect to MySQL' . mysqli_connect_error());
        }
        else{
            return $this->con;
        }
    }

    public function GetConnection(){
        return $this->con;
    }

}


function GetBilletPosts($con, $userid, $number = 5, $first = 0, $status = 1){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE OwnerID = ? AND Status = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('ii', $userid, $status);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0 and $stmt->num_rows > $first ) {
            $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status);
            $returnData = array();
            $iterator = 0;
            while ($stmt->fetch() and $iterator < $number + $first){
                if ($iterator >= $first){
                    array_push($returnData, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status));
                }
                ++$iterator;
            }
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            return $returnData;
        } 
        else {
            return FALSE;
        }
    }
    $stmt->close();
}

function GetMatches(){
    return null;
}

function GetSessionUserProfileData(){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    if (!isset($_SESSION['id'])){
        die ('USER NOT LOGGED IN');
    }
    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM Accounts WHERE UserID = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            $stmt->bind_result(	$UserID, $UserName, $Passwd, $FirstName, $LastName, $Rank, $Unit, $Email, $PhoneNumber, $PASCode);
            $returnData = array();
            
            $stmt->fetch();
            array_push($returnData, array( 'UserID'=>$UserID, 'UserName'=>$UserName, 'Passwd'=>$Passwd, 'FirstName'=>$FirstName, 'LastName'=>$LastName, 'Rank'=>$Rank, 'Unit'=>$Unit, 'Email'=>$Email, 'PhoneNumber'=>$PhoneNumber, 'PASCode'=>$PASCode));
            
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            return $returnData;
        } 
        else {
            return FALSE;
        }
    }
    $stmt->close();

}

function SetSessionUserProfileData(){

}

?>