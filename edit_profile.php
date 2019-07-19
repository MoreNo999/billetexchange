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
<link rel="stylesheet" type="text/css" href="../../css/home.css?ver=3.1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>Edit Profile</h2>
        </div>
		<form action="./scripts/UpdateProfile.php" method="POST">
		<div style="width:20%; margin-left: 40%; margin-top: 1%; font-size: 14px; background-color: grey; text-align: center;" class="w3-mobile w3-round w3-modal-content w3-animate-zoom">                  
			<label class="w3-text-black"><br><b>Rank:<br></b></label>
			<select class="w3-select w3-light-grey w3-border w3-mobile" style="text-align: center" id="rank" name="rank">
                            <option value="<?php echo $data['Rank'];?>" selected><?php echo 'E-' . $data['Rank'];?></option>
                            <option value="1">E-1</option>
                            <option value="2">E-2</option>
                            <option value="3">E-3</option>
                            <option value="4">E-4</option>
                            <option value="5">E-5</option>
                            <option value="6">E-6</option>
                            <option value="7">E-7</option>
                            <option value="8">E-8</option>
                            <option value="9">E-9</option>
            </select>
			<label class="w3-text-black"><br><br><b>First Name:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" style="color: black; text-align: center;" value="<?php echo $data['FirstName'];?>" id="firstName" name="firstName">
			<label class="w3-text-black"><br><b>Last Name:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" style="color: black; text-align: center;" value="<?php echo $data['LastName'];?>" id="lastName" name="lastName">
			<label class="w3-text-black"><br><b>Email:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" style="color: black; text-align: center;" value="<?php echo $data['Email'];?>" id="email" name="email">
			<label class="w3-text-black"><br><b>Phone Number:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" style="color: black; text-align: center;" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Format: 123-456-7890" value="<?php echo $data['PhoneNumber'];?>" id="phone" name="phone">
			<label class="w3-text-black"><br><b>Unit:<br></b></label>
            <input class="w3-input w3-border w3-light-grey" style="color: black; text-align: center;" value="<?php echo $data['Unit'];?>" id="unit" name="unit">
			<label class="w3-text-black"><br><b>PAS Code (If Applicable):<br></b></label>
            <input class="w3-input w3-border w3-light-grey" style="color: black; text-align: center;" value="<?php echo $data['PASCode'];?>" id="PASCode" name="PASCode"><br><br>
			<input class="w3-button w3-blue" type="submit" id="submit" value="Submit Changes">
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
