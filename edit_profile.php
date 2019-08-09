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

<style>
.box{
  display: flex;
  justify-content: center;
  margin: 30px;
  text-align: center;
  padding: 20px;
}
.myform{
  background-color: grey;
  padding: 5px;
  border-radius: 8px;
  
}
</style>  
<script type="text/javascript">
function CheckMAJCOM(val){
 var element=document.getElementById('otherMAJCOM');
 if(val=='Other')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script>
      
        <div class="box">
            <div class='myform w3-animate-zoom'> 
            <form action="./scripts/UpdateProfile.php" method="POST">                 
                <label class="w3-text-black"><br><b>Rank:<br></b></label>
                <select class="w3-select w3-light-grey w3-border" style="text-align: center" id="rank" name="rank">
                                <option value="<?php echo $data['Rank'];?>" selected><?php echo $data['Rank'];?></option>
                                <option value="E-1">E-1</option>
                                <option value="E-2">E-2</option>
                                <option value="E-3">E-3</option>
                                <option value="E-4">E-4</option>
                                <option value="E-5">E-5</option>
                                <option value="E-6">E-6</option>
                                <option value="E-7">E-7</option>
                                <option value="E-8">E-8</option>
                                <option value="E-9">E-9</option>
                </select>
                <label class="w3-text-black"><br><br><b>First Name:<br></b></label>
                <input class="w3-input w3-border w3-light-grey"value="<?php echo $data['FirstName'];?>" id="firstName" name="firstName">
                <label class="w3-text-black"><br><b>Last Name:<br></b></label>
                <input class="w3-input w3-border w3-light-grey" value="<?php echo $data['LastName'];?>" id="lastName" name="lastName">
                <label class="w3-text-black"><br><b>Email:<br></b></label>
                <input class="w3-input w3-border w3-light-grey" value="<?php echo $data['Email'];?>" id="email" name="email">
                <label class="w3-text-black"><br><b>Phone Number:<br></b></label>
                <input class="w3-input w3-border w3-light-grey" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Format: 123-456-7890" value="<?php echo $data['PhoneNumber'];?>" id="phone" name="phone">
                <label class="w3-text-black"><br><b>Unit:<br></b></label>
                <input class="w3-input w3-border w3-light-grey" value="<?php echo $data['Unit'];?>" id="unit" name="unit">
				<label class="w3-text-black"><br><b>MAJCOM:<br></b></label>
				<select class="w3-select w3-light-grey w3-border" style="text-align: center" id="Majcom" name="Majcom" onchange="CheckMAJCOM(this.value);">
								<option value="<?php echo $data['Majcom'];?>" selected><?php echo $data['Majcom'];?></option>
								<option value="ACC">ACC</option>
								<option value="AETC">AETC</option>
								<option value="AFGSC">AFGSC</option>
								<option value="AFMC">AFMC</option>
								<option value="AFSPC">AFSPC</option>
								<option value="AMC">AMC</option>
								<option value="AFSOC">AFSOC</option>
								<option value="PACAF">PACAF</option>
								<option value="USAFE">USAFE</option>
								<option value="Other">Other</option>
                </select>
				<input placeholder="Please Enter MAJCOM:" title="Please Enter MAJCOM:" class="w3-input w3-border w3-light-grey" type="text" name="otherMAJCOM" id="otherMAJCOM" style="display:none;"/>
                <label class="w3-text-black"><br><br><b>PAS Code (If Applicable):<br></b></label>
                <input class="w3-input w3-border w3-light-grey" value="<?php echo $data['PASCode'];?>" id="PASCode" name="PASCode"><br><br>
                <input class="w3-button w3-blue" type="submit" id="submit" value="Submit Changes">
            </form>
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
