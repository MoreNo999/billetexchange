<?php
require_once(dirname(__FILE__)."/../config.php");
session_start();

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

function GetBilletPosts($userid, $number = 5, $first = 0, $status = 1){
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

function GetAllBilletPosts($number = 5, $first = 0, $status = 1){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i',  $status);
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

function GetSingleBilletPost($id){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE ID = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i',  $id);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0 ) {
            $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status);
            $stmt->fetch();
            $returnData = array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status);
            // WE now have the post, lets return it.
            return $returnData;
        } 
        else {
            return FALSE;
        }
    }
    $stmt->close();
}



function GetMatches(){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    if (!isset($_SESSION['id'])){
        die ('USER NOT LOGGED IN');
    }

    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = 1 and OwnerID = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        // Store the results so we can process them.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status);
            $allUsersPosts = array();
            
            while ($stmt->fetch()){
                    array_push($allUsersPosts, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status));
            }
            //We now have the data, need to run over it and find matches.  This may be expensive :S
            //Currently only matching AFSC Rank SkillLevel
            $matchedPosts = array(); 
            $AllPostsMatches = array();

            foreach($allUsersPosts as $post){
                //We have a list of the posts made by this user.  Now we check for any that match what we want on the SQL Server.
                if ($searchStmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = 1 and OutAFSC = ? and InAFSC = ? and OutRank = ? and InRank = ? and OutSkillLevel = ? and InSkillLevel = ?')) {
                    // Bind parameters (s = string, i = int, b = blob, etc)
                    //The variables will line up as opposites of the where statement, as we are trying to find a possible match.  InAFSC - OutAFSC.
                    //echo $post['InAFSC'], $post['OutAFSC'], $post['InRank'], $post['OutRank'], $post['InSkillLevel'], $post['OutSkillLevel'];
                    $searchStmt->bind_param('ssiiii', $post['InAFSC'], $post['OutAFSC'], $post['InRank'], $post['OutRank'], $post['InSkillLevel'], $post['OutSkillLevel']);
                    if ($searchStmt->execute()){
                        // Store the results so we can process them.
                        $searchStmt->store_result();
                        if ($searchStmt->num_rows > 0) {
                            $searchStmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status);
                            $foundData = array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status);
                            while ($searchStmt->fetch()){
                                array_push($matchedPosts, $foundData);
                            }                        
                        //array_push($AllPostsMatches, array($post['ID'], $matchedPosts));
                        $AllPostsMatches[(string)$post['ID']] = $matchedPosts;
                        }
                    }
                }
                $searchStmt->close();
            }
            foreach($AllPostsMatches as $match){
                foreach($match[1] as $fmatch){
                    if ($matchStmt = $con->prepare("INSERT INTO Matches(PostAKey, PostBKey) VALUES (?, ?)")) {
                        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                        $matchStmt->bind_param('ii', $match[0], $fmatch);
                        if ($matchStmt->execute()){
                        }
                    }
                    
                    $matchStmt->close();
                }
            }
        } 
        else {
            return FALSE;
        }
        return $AllPostsMatches;
    }
    $stmt->close();
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
            $returnData = array( 'UserID'=>$UserID, 'UserName'=>$UserName, 'Passwd'=>$Passwd, 'FirstName'=>$FirstName, 'LastName'=>$LastName, 'Rank'=>$Rank, 'Unit'=>$Unit, 'Email'=>$Email, 'PhoneNumber'=>$PhoneNumber, 'PASCode'=>$PASCode);
            
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

//Expects postdata to be sent by parameter for use.  Doesnt Update Password or Username.
function UpdateSessionUserProfileData($pPostData){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();

    if (!isset($_SESSION['id'])){
        die ('USER NOT LOGGED IN');
    }

    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare("UPDATE Accounts SET Email=?, Unit=?, PhoneNumber=?, FirstName=?, LastName=?, Rank=?, PASCode=? WHERE UserID=?")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

        $stmt->bind_param('ssssssii', htmlspecialchars($pPostData['email'], ENT_NOQUOTES), htmlspecialchars($pPostData['unit'], ENT_NOQUOTES), htmlspecialchars($pPostData['phone'], ENT_NOQUOTES), htmlspecialchars($pPostData['firstName'], ENT_NOQUOTES), htmlspecialchars($pPostData['lastName'], ENT_NOQUOTES), $pPostData['rank'], htmlspecialchars($pPostData['PASCode'], ENT_NOQUOTES), $_SESSION['id']);

        if ($stmt->execute()){
            return True;
        }
        else{
            return False;            
        }
        return False;
        $stmt->close();
    }
    else{
        return False;
    }
}

function CardifyPost($data, $columns =3){
    $currentRow = 0;
    $currentColumn = 0;
    $cardCount = 0;
    echo '<div>';
        for ($item = 0; $item < count($data); $item++){
            echo '  <div>';
            for($cc = 0; $cc < count($data);$cc+=$columns){   //for($cc = $it; $cc < count($data);$cc+=$columns){
                echo '      <div class="cardrow">';
                for ($it = 0; $it < $columns; $it++){
                    $outputVar = "<h2 style='text-align: center;'> <a href='./view_post.php?Card=" . $data[$cardCount]["ID"] . "'>View Post</a></h2></br>";
                    $outputVar .= "<table cellspacing='20px' style='text-align: left;'>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th style='text-align: left;'>Position #: " . $data[$cardCount]["PositionNumber"] . "</th>";
                    $outputVar .= "<th style='text-align: left;'>Timestamp: " . $data[$cardCount]["DatePosted"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th style='text-align: left;'>Out AFSC: " . $data[$cardCount]["OutAFSC"] . "</th>";
                    $outputVar .= "<th style='text-align: left;'>In AFSC: " . $data[$cardCount]["InAFSC"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th style='text-align: left;'>Out Rank: " . $data[$cardCount]["OutRank"] . "</th>";
                    $outputVar .= "<th style='text-align: left;'>In Rank: " . $data[$cardCount]["InRank"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th style='text-align: left;'>Out SEI: " . $data[$cardCount]["OutSEI"] . "</th>";
                    $outputVar .= "<th style='text-align: left;'>In SEI: " . $data[$cardCount]["InSEI"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th style='text-align: left;'>Out Level: " . $data[$cardCount]["OutSkillLevel"] . "</th>";
                    $outputVar .= "<th style='text-align: left;'>In Level: " . $data[$cardCount]["InSkillLevel"] . "</th>";
                    $outputVar .= "</tr>";

                    
                    $outputVar .= "</table>";
                    if ($data[$cardCount] == ""){
                        $cardCount++;
                        break;
                    }
                    echo '          <div class="w3-round-xlarge w3-animate-zoom card"><p>' . $outputVar .'</p></div>';
                    $cardCount++;
                    $item++;
                }
                echo '      </div>';
            }
            echo '  </div>';
        }    
    echo '</div>';
}

function GetAllCards($columns=3){
    $data = GetAllBilletPosts(99,0,1);
    CardifyPost($data,$columns);
}

function GetDashboardCards($columns=3){
    $data = GetBilletPosts($_SESSION['id'],99,0,1);
    CardifyPost($data,$columns);
}

function GetMatchesCards($columns=3, $id){
    $data = GetMatches();
    echo var_dump($data[$id]);
    echo CardifyPost($data[$id], $columns);
}

//returns only username
function GetUserNameFromID($userID){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();

    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM Accounts WHERE UserID = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            $stmt->bind_result(	$UserID, $UserName, $Passwd, $FirstName, $LastName, $Rank, $Unit, $Email, $PhoneNumber, $PASCode);
            $returnData = array();
            
            $stmt->fetch();
            $returnData = $UserName;
            
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

//Returns userid, username, email, firstname, lastname, rank, phonenumber, and unit.
function GetUserPublicDataFromID($userID){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();

    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare('SELECT * FROM Accounts WHERE UserID = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows != 0) {
            $stmt->bind_result(	$UserID, $UserName, $Passwd, $FirstName, $LastName, $Rank, $Unit, $Email, $PhoneNumber, $PASCode);
            
            $stmt->fetch();
            $returnData = array( 'UserID'=>$UserID, 'UserName'=>$UserName, 'FirstName'=>$FirstName, 'LastName'=>$LastName, 'Rank'=>$Rank, 'Email'=>$Email, 'PhoneNumber'=>$PhoneNumber, 'Unit'=>$Unit);
            
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

function ChangePassword($pPostData){
    if (!isset($_SESSION['id'])){
        die ('USER NOT LOGGED IN');
    }
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    $data = GetSessionUserProfileData();
    echo password_verify($pPostData['oldPassword'], $data['Passwd']);
    if (password_verify($pPostData['oldPassword'], $data['Passwd'])){
        if ($stmt = $con->prepare("UPDATE Accounts SET Passwd=? WHERE UserID=?")) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            //Store new password
            $stmt->bind_param('si', password_hash($pPostData['newPassword'], PASSWORD_DEFAULT), $_SESSION["id"]);
            if ($stmt->execute()){
                return True;
            }
            else{
                return False;            
            }
            return False;
            $stmt->close();
        }
        else{
            return False;
        }
    }
    else{
        echo "PASSWORD MISMATCH<br>";
        return False;
    }
}
?>
