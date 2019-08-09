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
<link rel="stylesheet/less" type="text/css" href="../../css/my_account.less?ver=1.1.1">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>My Account</h2>
        </div>
        <div class="box">
            <div class="w3-animate-zoom card">
            <table class="my_table" align="center">
                <tr>
                    <th>
                        <b style="color:white">Username: </b><br><?php echo $data['UserName'];?>
                    </th>
                </tr>
                <tr>
                    <th> <b style="color:white">Rank: </b><br><?php echo $data['Rank'];?>
                </th>
                </tr>
                    <th>
                        <b style="color:white">Name: </b><br><?php echo $data['FirstName'];?> <?php echo $data['LastName'];?>
                    </th>
                </tr>
                    <th>
                        <b style="color:white">Email: </b><br><?php echo $data['Email'];?>
                    </th>
                </tr>
                    <th>
                        <b style="color:white">Phone Number: </b><br><?php echo $data['PhoneNumber'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b style="color:white">Unit: </b><br><?php echo $data['Unit'];?>
                    </th>
                </tr>
				<tr>
                    <th>
                        <b style="color:white">MAJCOM: </b><br><?php echo $data['Majcom'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b style="color:white">PAS Code (If Applicable): </b><br><?php echo $data['PASCode'];?>
                    </th>
                </tr>
				
            </table>                  
            <div class="buttons">
			 <a href="edit_profile.php" title="Edit Profile"><button class="w3-button w3-blue">Edit Profile</button></a>
             <a href="change_password.php" title="Change Password"><button class="w3-button w3-blue">Change Password</button></a>
            </div><br>
        </div>
    </div>
        
		
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
	</div>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>