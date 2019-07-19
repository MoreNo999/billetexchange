<?php
    session_start();
    require_once("scripts/functions.php");
    // load up your config file
    require_once("config.php");
     
    require_once(TEMPLATES_PATH . "/header.php");

    if (!isset($_SESSION['id'])){
        header('Location: index.php');
    }
	$data = GetSessionUserProfileData();
?>
<link rel="stylesheet" type="text/css" href="../../css/home.css?ver=3">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>My Account</h2>
        </div>
		<div style="width:20%; margin-left: 40%; margin-top: 3%; background-color: grey; text-align: center;" class="w3-mobile w3-round w3-modal-content w3-animate-zoom">                  
            <label class="w3-text-black"><b>Username:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['UserName'];?></b></div>
			<label class="w3-text-black"><br><b>Rank:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['Rank'];?></b></div>
			<label class="w3-text-black"><br><b>Name:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['FirstName'];?></b><b> </b><b><?php echo $data['LastName'];?></b></div>
			<label class="w3-text-black"><br><b>Email:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['Email'];?></b></div>
			<label class="w3-text-black"><br><b>Phone Number:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['PhoneNumber'];?></b></div>
			<label class="w3-text-black"><br><b>Unit:<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['Unit'];?></b></div>
			<label class="w3-text-black"><br><b>PAS Code (If Applicable):<br></b></label>
            <div class="w3-text-white"><b><?php echo $data['PASCode'];?></b><br><br><br></div>
			<div class="w3-button w3-blue w3-mobile" style="border-spacing: 30px"> <a href="edit_profile.php" title="Edit Profile">Edit Profile</a><br></div>
			<div class="w3-button w3-blue w3-mobile" style="border-spacing: 30px"> <a href="change_password.php" title="Change Password">Change Password</a></div>
		</div>
		
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
	</div>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>