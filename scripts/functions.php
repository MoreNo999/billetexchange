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

class MyTuple{
    public $a;
    public $b;
    public function __construct($pa, $pb){
        $this->a = $pa;
        $this->b = $pb;
    }
}

function GetBilletPosts($userid, $number = 5, $first = 0, $status = 1, $days = -1){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    //Prepare our sql statement, nullify SQL Injection
    if ($days == -1){
        if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE OwnerID = ? AND Status = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc)
            $stmt->bind_param('ii', $userid, $status);
        }      
        else{
            return FALSE;
        } 
    }
    else {
        if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status=? AND DatePosted BETWEEN DATE(NOW()) - INTERVAL ? DAY AND DATE(NOW())+1 ORDER BY DatePosted DESC')) {
            // Bind parameters (s = string, i = int, b = blob, etc)
            $stmt->bind_param('iii', $userid, $status, $days);
        }
        else{
            return FALSE;
        }
    }
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0 and $stmt->num_rows > $first ) {
        $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status, $Majcom);
        $returnData = array();
        $iterator = 0;
        while ($stmt->fetch() and $iterator < $number + $first){
            if ($iterator >= $first){
                array_push($returnData, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status, "Majcom"=>$Majcom));
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
    $stmt->close();
}

function GetAllBilletPosts($number = 5, $first = 0, $status = 1, $days = -1){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    //Prepare our sql statement, nullify SQL Injection
    if ($days == -1){
        if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc)
            $stmt->bind_param('i', $status);
        }      
        else{
            return FALSE;
        } 
    }
    else {
        if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status=? AND DatePosted BETWEEN DATE(NOW()) - INTERVAL ? DAY AND DATE(NOW())+1  ORDER BY DatePosted DESC'))  {
            // Bind parameters (s = string, i = int, b = blob, etc)
            $stmt->bind_param('ii', $status, $days);
        }
        else{
            return FALSE;
        }
    }
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0 and $stmt->num_rows > $first ) {
        $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status, $Majcom);
        $returnData = array();
        $iterator = 0;
        while ($stmt->fetch() and $iterator < $number + $first){
            if ($iterator >= $first){
                array_push($returnData, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status, "Majcom"=>$Majcom));
            }
            ++$iterator;
        }
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        $stmt->close();
        return $returnData;
    } 
    else {
        $stmt->close();
        return FALSE;
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
            $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status, $Majcom);
            $stmt->fetch();
            $returnData = array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status, "Majcom"=>$Majcom);
            // WE now have the post, lets return it.
            return $returnData;
        } 
        else {
            return FALSE;
        }
    }
    $stmt->close();
}

function DeletePost($pPostID){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare("UPDATE BilletEntry SET Status = ? WHERE ID = ? and OwnerID = ?")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

        $stmt->bind_param('iii', $a = 3, $pPostID, $_SESSION['id']);

        if ($stmt->execute()){
            return True;
        }
        else{
            echo "Stmt exec fail";
            return False;            
        }
        return False;
        $stmt->close();
    }
    else{
        echo "stmt prep fail";
        return False;
    }
}

function GetMatches(){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();
    if (!isset($_SESSION['id'])){
        die ('USER NOT LOGGED IN');
    }

    //Prepare our sql statement, nullify SQL Injection
    //Grab all posts by the logged in user to act as the matcher.
    //Matchers will be stored in $allUsersPosts array.
    if ($stmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = 1 and OwnerID = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        // Store the results so we can process them.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status, $Majcom);
            $allUsersPosts = array();
            
            while ($stmt->fetch()){
                    array_push($allUsersPosts, array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status, "Majcom"=>$Majcom));
            }
            //We now have the data, need to run over it and find matches.  This may be expensive :S
            //Currently only matching AFSC Rank SkillLevel
            $matchedPosts = array(); 
            $AllPostsMatches = array();

            //iterate over all of the posts as matcher.
            foreach($allUsersPosts as $post){
                //We have a list of the posts made by this user.  Now we check for any that match what we want on the SQL Server.
                if ($searchStmt = $con->prepare('SELECT * FROM BilletEntry WHERE Status = 1 and OutAFSC = ? and InAFSC = ? and OutRank = ? and InRank = ? and OutSkillLevel = ? and InSkillLevel = ? and (Majcom=? or Majcom="Any")')) {
                    // Bind parameters (s = string, i = int, b = blob, etc)
                    //The variables will line up as opposites of the where statement, as we are trying to find a possible match.  InAFSC - OutAFSC.
                    //echo $post['InAFSC'], $post['OutAFSC'], $post['InRank'], $post['OutRank'], $post['InSkillLevel'], $post['OutSkillLevel'];
                    $searchStmt->bind_param('ssssiis', $post['InAFSC'], $post['OutAFSC'], $post['InRank'], $post['OutRank'], $post['InSkillLevel'], $post['OutSkillLevel'], $post['Majcom']);
                    if ($searchStmt->execute()){
                        // Store the results so we can process them.
                        $searchStmt->store_result();
                        if ($searchStmt->num_rows > 0) {
                            $searchStmt->bind_result(	$ID, $OwnerID,$OutAFSC, $OutRank, $OutSEI, $OutSkillLevel, $InAFSC, $InRank, $InSEI, $InSkillLevel, $PositionNumber, $Description, $DatePosted, $Views, $Clicks, $Status, $Majcom);
                            while ($searchStmt->fetch()){
                                //For this we are changing from taking all the data, and just grabbing the found ID number of the match.
                                //$foundData = array( "ID"=>$ID, "OwnerID"=>$OwnerID, "OutAFSC"=>$OutAFSC, "OutRank"=>$OutRank, "OutSEI"=>$OutSEI, "OutSkillLevel"=>$OutSkillLevel, "InAFSC"=>$InAFSC, "InRank"=>$InRank, "InSEI"=>$InSEI, "InSkillLevel"=>$InSkillLevel, "PositionNumber"=>$PositionNumber, "Description"=>$Description, "DatePosted"=>$DatePosted, "Views"=>$Views, "Clicks"=>$Clicks, "Status"=>$Status);
                                $foundData = $ID;
                                array_push($matchedPosts, $foundData);
                            }                        
                        //array_push($AllPostsMatches, array($post['ID'], $matchedPosts));
                        $compiledPosts = new MyTuple($post['ID'], $matchedPosts);
                        array_push($AllPostsMatches, $compiledPosts);
                        }
                    }
                }
                $searchStmt->close();
            }
            /*   This is taken out for now as we do not use the databases stored matches for anything.
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
            */
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
            $stmt->bind_result(	$UserID, $UserName, $Passwd, $FirstName, $LastName, $Rank, $Unit, $Email, $PhoneNumber, $PASCode, $Majcom);
            $returnData = array();
            
            $stmt->fetch();
            $returnData = array( 'UserID'=>$UserID, 'UserName'=>$UserName, 'Passwd'=>$Passwd, 'FirstName'=>$FirstName, 'LastName'=>$LastName, 'Rank'=>$Rank, 'Unit'=>$Unit, 'Email'=>$Email, 'PhoneNumber'=>$PhoneNumber, 'PASCode'=>$PASCode, 'Majcom'=>$Majcom);
            
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

//Expects postdata to be sent by parameter for use.  Doesnt Update Password or Username.mmmmm
function UpdateSessionUserProfileData($pPostData){
    $conMan = new SQLConnectionManager();
    $con = $conMan->StartConnection();

    if (!isset($_SESSION['id'])){
        die ('USER NOT LOGGED IN');
    }

    //Prepare our sql statement, nullify SQL Injection
    if ($stmt = $con->prepare("UPDATE Accounts SET Email=?, Unit=?, PhoneNumber=?, FirstName=?, LastName=?, Rank=?, PASCode=?, Majcom=? WHERE UserID=?")) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

        $stmt->bind_param('ssssssssi', htmlspecialchars($pPostData['email'], ENT_NOQUOTES), htmlspecialchars($pPostData['unit'], ENT_NOQUOTES), htmlspecialchars($pPostData['phone'], ENT_NOQUOTES), htmlspecialchars($pPostData['firstName'], ENT_NOQUOTES), htmlspecialchars($pPostData['lastName'], ENT_NOQUOTES), $pPostData['rank'], htmlspecialchars($pPostData['PASCode'], ENT_NOQUOTES), htmlspecialchars($pPostData['Majcom'], ENT_NOQUOTES), $_SESSION['id']);

        if ($stmt->execute()){
            $id = $_SESSION['id'];
            $user = $_SESSION['name'];
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $user;
            $_SESSION['majcom'] = $pPostData['Majcom'];
            $_SESSION['id'] = $id;
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
                echo '      <div class="card_row">';
                for ($it = 0; $it < $columns; $it++){
                    $outputVar = "<a href='./view_post.php?Card=" . $data[$cardCount]["ID"] . "'><button class='button'><span>View Post</span></button></a></br>";
                    $outputVar .= "<table class='data_table'>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th class='data_name'>Position #: <mark class='data'>" . $data[$cardCount]["PositionNumber"] . "</mark></th>";
                    $outputVar .= "<th class='data_name'>Timestamp: <mark class='data'>" . $data[$cardCount]["DatePosted"] . "</mark></th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th class='data_name'>Out AFSC: <mark class='data'>" . $data[$cardCount]["OutAFSC"] . "</mark></th>";
                    $outputVar .= "<th class='data_name'>In AFSC: <mark class='data'>" . $data[$cardCount]["InAFSC"] . "</mark></th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th class='data_name'>Out Rank: <mark class='data'>" . $data[$cardCount]["OutRank"] . "</mark></th>";
                    $outputVar .= "<th class='data_name'>In Rank: <mark class='data'>" . $data[$cardCount]["InRank"] . "</mark></th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th class='data_name'>Out SEI: <mark class='data'>" . $data[$cardCount]["OutSEI"] . "</mark></th>";
                    $outputVar .= "<th class='data_name'>In SEI: <mark class='data'>" . $data[$cardCount]["InSEI"] . "</mark></th>";
                    $outputVar .= "</tr>";

                    $outputVar .= "<tr>";
                    $outputVar .= "<th class='data_name'>Out Level: <mark class='data'>" . $data[$cardCount]["OutSkillLevel"] . "</mark></th>";
                    $outputVar .= "<th class='data_name'>In Level: <mark class='data'>" . $data[$cardCount]["InSkillLevel"] . "</mark></th>";
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

function ListifyPost($data){
    echo "<div class='posts'> \n";
    foreach($data as $entry){
        echo "<div class='post'>";
        $outputVar .= "<table>\r\n";
            $outputVar .= "<tr>\r\n";

                $outputVar .= "<th>Out AFSC</th>";
                $outputVar .= "<th>In AFSC</th>";
                $outputVar .= "<th>Out Rank</th>";
                $outputVar .= "<th>In Rank</th>";
                $outputVar .= "<th>Out Level</th>";
                $outputVar .= "<th>In Level</th>";
                $outputVar .= "<th>Majcom</th>";

        $outputVar .= "</tr>\r\n";
        $outputVar .= "<tr>\r\n";
                $outputVar .= "<th>" . $entry["OutAFSC"];
                $outputVar .= "<th>" . $entry["InAFSC"];
                $outputVar .= "<th>" . $entry["OutRank"];
                $outputVar .= "<th>" . $entry["InRank"];
                $outputVar .= "<th>" . $entry["OutSkillLevel"];
                $outputVar .= "<th>" . $entry["InSkillLevel"];
                $outputVar .= "<th>" . $entry["Majcom"];

        $outputVar .= "</tr>\r\n";
        $outputVar .= "</table>";
        $outputVar .= "<a href='./view_post.php?Card=" . $entry["ID"] . "'><button class='button'><span>View Post</span></button></a>";
        if ($entry["OwnerID"] == $_SESSION['id']){
            $outputVar .= "<a href='./edit_billet.php?postid=" . $entry["ID"] . "'><button class='button'><span>Edit Post</span></button></a>";
            $outputVar .= "<a href='./scripts/DeletePost.php?PostID=" . $entry["ID"] . "'><button class='button'><span>Delete Post</span></button></a>";
        }
        echo $outputVar .'</div>';
        $outputVar = "";
    }
    echo '</div>';
    //echo $outputVar;

}

function GetAllPostList(){
    $data = GetAllBilletPosts(99,0,1);
    ListifyPost($data);
}

function GetDashboardPostList(){
    $data = GetBilletPosts($_SESSION['id'],99,0,1);
    ListifyPost($data);
}

function GetMatchesPostList($columns=3, $id){
    $data = GetMatches();
    echo var_dump($data[$id]);
    ListifyPost($data[$id]);
}

function GetRecentPostList($columns=3, $days = 7){
    $data = GetAllBilletPosts(99, 0,1, $days);
    ListifyPost($data);
}

function GetDashboardCards($columns=3){
    $data = GetBilletPosts($_SESSION['id'],99,0,1);
    CardifyPost($data,$columns);
}

function GetMatchesCards($columns=3, $id){
    $data = GetMatches();
    echo var_dump($data[$id]);
    CardifyPost($data[$id], $columns);
}

function GetRecentCards($columns=3, $days = 7){
    $data = GetAllBilletPosts(99, 0,1, $days);
    CardifyPost($data,$cols);
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
            $stmt->bind_result(	$UserID, $UserName, $Passwd, $FirstName, $LastName, $Rank, $Unit, $Email, $PhoneNumber, $PASCode, $Majcom);
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
            $stmt->bind_result(	$UserID, $UserName, $Passwd, $FirstName, $LastName, $Rank, $Unit, $Email, $PhoneNumber, $PASCode, $Majcom);
            
            $stmt->fetch();
            $returnData = array( 'UserID'=>$UserID, 'UserName'=>$UserName, 'FirstName'=>$FirstName, 'LastName'=>$LastName, 'Rank'=>$Rank, 'Email'=>$Email, 'PhoneNumber'=>$PhoneNumber, 'Unit'=>$Unit, 'Majcom'=>$Majcom);
            
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


//Options will be both the value and text.
function CreateOptionList($pOptions, $pDefault, $pClass = null, $pName = null, $pID = null, $pStyle = null, $pOnChange = null){
    $data = "<select ";
    if (isset($pClass)){
        $data .= 'class="' . $pClass . '" ';
    }
    if (isset($pName)){
        $data .= 'name="' . $pName . '" ';
    }
    if (isset($pID)){
        $data .= 'id="' . $pID . '" ';
    }
    if (isset($pStyle)){
        $data .= 'style="' . $pStyle . '" ';
    }
    if (isset($pOnChange)){
        $data .= 'onchange="' . $pOnChange . '" ';
    }

    $data .= ">";
    foreach ($pOptions as $option){
        if ($option == $pDefault){
            $data .= '<option value="' . $option . '" selected>' . $option . '</option>';
        }
        else{
            $data .= '<option value="' . $option . '">' . $option . '</option>';
        }
    }
    $data .= "</select>";
    return $data;
}
?>