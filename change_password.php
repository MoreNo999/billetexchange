<?php
    session_start();
    require_once("scripts/functions.php");
    // load up your config file
    require_once("config.php");
     
    require_once(TEMPLATES_PATH . "/header.php");

    if (!isset($_SESSION['id'])){
        header('Location: index.php');
    }
?>
<link rel="stylesheet" type="text/css" href="../../css/home.css?ver=3.1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>Change Password</h2>
        </div>
		<form action="./scripts/ChangePassword.php" method="POST">
		<div style="width:20%; margin-left: 40%; margin-top: 1%; font-size: 14px; background-color: grey; text-align: center;" class="w3-mobile w3-round w3-modal-content w3-animate-zoom">                  
			<label class="w3-text-black"><br><br><b>Old Password:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" type="password" style="color: black; text-align: center;" required placeholder="Enter Old Password" id="oldPassword" name="oldPassword">
			<label class="w3-text-black"><br><b>New Password:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" type="password" style="color: black; text-align: center;" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Please don't write it down under your keyboard :)" required placeholder="Enter New Password" id="newPassword" name="newPassword"><br>
			<input class="w3-button w3-blue" type="submit" id="submit" value="Submit New Password">
		</div>
		
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
	</div>
	</form>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>
