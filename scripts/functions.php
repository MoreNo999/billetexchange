<?php
function GetBilletPosts($con, $userid, $number = 5, $first = 0, $status = 1){
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
?>