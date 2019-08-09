<?php
    session_start();
    require_once("scripts/functions.php");
    // load up your config file
    require_once("config.php");
     
    require_once(TEMPLATES_PATH . "/header.php");

    if (!isset($_SESSION['id'])){
        header('Location: index.php');
    }
	$data = GetUserPublicDataFromID($_GET['profile']);
?>
<link rel="stylesheet" type="text/css" href="../../css/home.css?ver=3">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>Profile</h2>
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
            <div class="myform">
                <label class="w3-text-black"><b>Username:<br></b></label>
                <div class="w3-text-white"><b><?php echo $data['UserName'];?></b></div>
                <label class="w3-text-black"><br><b>Name:<br></b></label>
                <div class="w3-text-white"><b><?php echo $data['FirstName'];?></b><b> </b><b><?php echo $data['LastName'];?></b></div>
                <label class="w3-text-black"><br><b>Rank:<br></b></label>
                <div class="w3-text-white"><b><?php echo $data['Rank'];?></b></div>
                <label class="w3-text-black"><br><b>Email:<br></b></label>
                <div class="w3-text-white"><b><?php echo $data['Email'];?></b></div>
                <label class="w3-text-black"><br><b>Unit:<br></b></label>
                <div class="w3-text-white"><b><?php echo $data['Unit'];?></b></div>
            </div>                    
		</div>
    </div>
</div>
		
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>