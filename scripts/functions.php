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
            $returnData = array();
            
            while ($stmt->fetch()){
                    array_push($returnData, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status));
            }
            //We now have the data, need to run over it and find matches.  This may be expensive :S
            //Currently only matching AFSC Rank SkillLevel
            $matchedPosts = array(); 
            $AllPostsMatches = array();
            $aSearchKeys = array( "OutAFSC", "InAFSC", "OutRank", "InRank", "OutSkillLevel", "InSkillLevel");
            $bSearchKeys = array( "InAFSC", "OutAFSC", "InRank", "OutRank", "InSkillLevel", "OutSkillLevel");
            $flag = True;

            foreach($returnData as $post){
                //We have a list of the posts made by this user.  Now we check for any that match what we want on the SQL Server.
                if ($searchStmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = 1 and OutAFSC = ? and InAFSC = ? and OutRank = ? and InRank = ? and OutSkillLevel = ? and InSkillLevel = ?')) {
                    // Bind parameters (s = string, i = int, b = blob, etc)
                    //The variables will line up as opposites of the where statement, as we are trying to find a possible match.  InAFSC - OutAFSC.
                    $searchStmt->bind_param('ssiiii', $post['InAFSC'], $post['OutAFSC'], $post['InRank'], $post['OutRank'], $post['InSkillLevel'], $post['OutSkillLevel']);
                    $searchStmt->execute();
                    // Store the results so we can process them.
                    $searchStmt->store_result();
                    if ($searchStmt->num_rows > 0) {
                        $searchStmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status);
                        $returnData = array();
                        
                        while ($searchStmt->fetch()){
                            array_push($returnData, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status));
                            array_push($matchedPosts, $ID);
                        }                        
                        array_push($AllPostsMatches, array($post['ID'], $matchedPosts));
                    }
                    else {
                        return False;
                    }
                }
                else {
                    return False;
                }
                $searchStmt->close();
            }
            foreach($AllPostsMatches as $match){
                foreach($match[1] as $fmatch){
                    if ($matchStmt = $con->prepare("INSERT INTO Matches(PostAKey, PostBKey) VALUES (?, ?)")) {
                        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                        $matchStmt->bind_param('ii', $match[0], $fmatch);
                        if ($matchStmt->execute()){
                            return $returnData;
                        }
                        else {
                            return False;
                        }
                    }
                    else{
                        return False;
                    }
                    $matchStmt->close();
                }
            }
        } 
        else {
            return FALSE;
        }
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

        $stmt->bind_param('sssssssi', htmlspecialchars($pPostData['email'], ENT_NOQUOTES), htmlspecialchars($pPostData['unit'], ENT_NOQUOTES), htmlspecialchars($pPostData['phone'], ENT_NOQUOTES), htmlspecialchars($pPostData['firstName'], ENT_NOQUOTES), htmlspecialchars($pPostData['lastName'], ENT_NOQUOTES), htmlspecialchars($pPostData['rank'], ENT_NOQUOTES), htmlspecialchars($pPostData['PASCode'], ENT_NOQUOTES), $_SESSION['id']);

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


function GetAllCards($columns=3){
    $data = GetAllBilletPosts(99,0,1);
    $currentRow = 0;
    $currentColumn = 0;
    $cardCount = 0;
    echo '<div class="dashboard-cards">';
        for ($item = 0; $item < count($data); $item++){
            echo '  <div class="row">';
            for($it = 0; $it < $columns; $it++){
                echo '      <div class="column">';
                for ($cc = $it; $cc < count($data);$cc+=4){
                    $outputVar = "<h2> <a href='./view_post.php?Card=" . $cardCount . "'>View Post</a></h2></br>";
                    $outputVar .= "<table style='border-left: 1px;'>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Position #</th><th>" . $data[$cardCount]["PositionNumber"] . "</th>";
                    $outputVar .= "<th>Timestamp</th><th>" . $data[$cardCount]["DatePosted"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out AFSC</th><th>" . $data[$cardCount]["OutAFSC"] . "</th>";
                    $outputVar .= "<th>In AFSC</th><th>" . $data[$cardCount]["InAFSC"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out Rank</th><th>" . $data[$cardCount]["OutRank"] . "</th>";
                    $outputVar .= "<th>In Rank</th><th>" . $data[$cardCount]["InRank"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out SEI</th><th>" . $data[$cardCount]["OutSEI"] . "</th>";
                    $outputVar .= "<th>In SEI</th><th>" . $data[$cardCount]["InSEI"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out Level</th><th>" . $data[$cardCount]["OutSkillLevel"] . "</th>";
                    $outputVar .= "<th>In Level</th><th>" . $data[$cardCount]["InSkillLevel"] . "</th>";
                    $outputVar .= "</tr>";

                    
                    $outputVar .= "</table>";
                    echo '          <div class="card"><p>' . $outputVar .'</p></div>';
                    $cardCount++;
                    $item++;
                }
                echo '      </div>';
            }
            echo '  </div>';
        }    
    echo '</div>';
}

function GetDashboardCards($columns=3){
    $data = GetBilletPosts($_SESSION['id'],99,0,1);
    $currentRow = 0;
    $currentColumn = 0;
    $cardCount = 0;
    echo '<div class="dashboard-cards w3-container">';
        for ($item = 0; $item < count($data); $item++){
            echo '  <div class="row w3-container w3-cell">';
            for($cc = $it; $cc < count($data);$cc+=$columns){
                echo '      <div class="column">';
                for ($it = 0; $it < $columns; $it++){
                    $outputVar = "<h2> <a href='./view_post.php?Card=" . $cardCount . "'>View Post</a></h2></br>";
                    $outputVar .= "<table style='border-left: 1px;'>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Position #</th><th>" . $data[$cardCount]["PositionNumber"] . "</th>";
                    $outputVar .= "<th>Timestamp</th><th>" . $data[$cardCount]["DatePosted"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out AFSC</th><th>" . $data[$cardCount]["OutAFSC"] . "</th>";
                    $outputVar .= "<th>In AFSC</th><th>" . $data[$cardCount]["InAFSC"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out Rank</th><th>" . $data[$cardCount]["OutRank"] . "</th>";
                    $outputVar .= "<th>In Rank</th><th>" . $data[$cardCount]["InRank"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out SEI</th><th>" . $data[$cardCount]["OutSEI"] . "</th>";
                    $outputVar .= "<th>In SEI</th><th>" . $data[$cardCount]["InSEI"] . "</th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th>Out Level</th><th>" . $data[$cardCount]["OutSkillLevel"] . "</th>";
                    $outputVar .= "<th>In Level</th><th>" . $data[$cardCount]["InSkillLevel"] . "</th>";
                    $outputVar .= "</tr>";

                    
                    $outputVar .= "</table>";
                    if ($data[$cardCount] == ""){
                        $cardCount++;
                        break;
                    }
                    echo '          <div class="card w3-round-xxlarge w3-animate-zoom w3-cell"><p>' . $outputVar .'</p></div>';
                    $cardCount++;
                    $item++;
                }
                echo '      </div>';
            }
            echo '  </div>';
        }    
    echo '</div>';
}
?>