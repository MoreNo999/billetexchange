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
<link rel="stylesheet/less" type="text/css" href="../../css/my_account.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>My Account</h2>
        </div>
		<div class="w3-animate-zoom card">
            <table class="my_table">
                <tr>
                    <th>
                        <b>Username:</b>
                    </th> 
                </tr>
                <tr>
                    <th>
                        <?php echo $data['UserName'];?>
                    </th>
                </tr>
                <tr>
                    <th> <b>Rank:</b></th>
                </tr>
                <tr>
                    <th>
                        <?php echo $data['Rank'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b>Name:</b>
                    </th>
                </tr>
                <tr>
                    <th>
                        <?php echo $data['FirstName'];?> <?php echo $data['LastName'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b>Email:</b>
                    </th>
                </tr>
                <tr>
                    <th>
                        <?php echo $data['Email'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b>Phone Number:</b>
                    </th>
                </tr>
                <tr>
                    <th>
                        <?php echo $data['PhoneNumber'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b>Unit:</b>
                    </th>
                </tr>
                <tr>
                    <th>
                        <?php echo $data['Unit'];?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <b>PAS Code (If Applicable):</b>
                    </th>
                </tr>
                <tr>
                    <th>
                        <?php echo $data['PASCode'];?>
                    </th>
                </tr>
            </table>                  
            
			 <a href="edit_profile.php" title="Edit Profile"><button>Edit Profile</button></a>
			 <a href="change_password.php" title="Change Password"><button>Change Password</button></a>
		</div>
		
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
	</div>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>