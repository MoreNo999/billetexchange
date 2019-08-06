<?php
    session_start();
    require_once("scripts/functions.php");
    // load up your config file
    require_once("config.php");
     
    require_once(TEMPLATES_PATH . "/header.php");

    if (!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    $postID = htmlspecialchars($_GET['Card'], ENT_NOQUOTES);
    $data = GetSingleBilletPost($postID);
?>
<link rel="stylesheet" type="text/css" href="/css/background.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>View Post</h2>
        </div>

<style>
.box{
  display: flex;
  justify-content: center;
  margin: 30px;
  text-align: center;
}
.myform{
  background-color: grey;
  padding: 5px;
  border-radius: 8px;
  
}
</style>
    <div class="box">
        <div class="w3-animate-zoom myform">                  
            <label class="w3-text-black"><b>Posted By: <br></b></label>
            <div class="w3-text-white"><b><a href=view_profile.php?profile=<?php echo $data['OwnerID'];?>><?php echo GetUserNameFromID($data['OwnerID']);?></a></b></div>
            <label class="w3-text-black"><br><b>Offered AFSC:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['OutAFSC'];?></b></div>
            <label class="w3-text-black"><br><b>Offered Rank:<br></b></label>
            <div class="w3-text-white"><b><?php echo 'E-' . $data['OutRank'];?></b></div>
            <label class="w3-text-black"><br><b>Offered SEI:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['OutSEI'];?></b></div>
            <label class="w3-text-black"><br><b>Offered Skill Level:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['OutSkillLevel'];?></b></div>
            <label class="w3-text-black"><br><b>Requested AFSC:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['InAFSC'];?></b></div>
            <label class="w3-text-black"><br><b>Requested Rank:<br></b></label>
            <div class="w3-text-white"><b><?php echo 'E-' . $data['InRank'];?></b></div>
            <label class="w3-text-black"><br><b>Requested SEI:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['InSEI'];?></b></div>
            <label class="w3-text-black"><br><b>Requested Skill Level:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['InSkillLevel'];?></b></div>
            <label class="w3-text-black"><br><b>Description:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['Description'];?></b></div>
            <label class="w3-text-black"><br><b>Date Posted:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['DatePosted'];?></b></div>
            <label class="w3-text-black"><br><b>Position Number:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['PositionNumber'];?></b><br><br></div>
            <div class="w3-button w3-blue w3-mobile"><b><a href=view_matches.php?Card=<?php echo $_GET['Card'];?>><?php echo "View Matches";?></b></div>
        </div>
    </div>     
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>
