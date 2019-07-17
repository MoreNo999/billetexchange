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
<div id="container">
    <body style="background-image: url(/img/content/usaf_wallpaper.jpg);">
    <div id="content">
<<<<<<< HEAD
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <div class="w3-container w3-blue w3-mobile">
                    <h2>New Billet</h2>
                </div>
                 <div style="width:40%; margin-left: 30%; margin-top: 3%; background-color: grey;" class="w3-mobile">
                <form class="w3-container" action="./scripts/CreatePost.php" method="POST">
                    
                    
                    <label class="w3-text-black"><b>In-AFSC</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="InAFSC" name="InAFSC">
                  
                    
                  
                    <label class="w3-text-black"><b>In-Rank</b></label>
                    <select class="w3-select" name="InRank" id="InRank">
                            <option value="" disabled selected>Choose your option</option>
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

                    <label class="w3-text-black"><b>In-SEI</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="InSEI" name="InSEI">

                    <label class="w3-text-black"><b>In-Skill Level</b></label>
                    <select class="w3-select" name="InSkillLevel" id="InSkillLevel">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="9">9</option>
                            
                    </select>

                    <label class="w3-text-black"><b>Out-AFSC</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="OutAFSC" name="OutAFSC">
                  
                    
                  
                    <label class="w3-text-black"><b>Out-Rank</b></label>
                    <select class="w3-select" name="OutRank" id="OutRank">
                            <option value="" disabled selected>Choose your option</option>
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

                    <label class="w3-text-black"><b>Out-SEI</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="OutSEI" id="OutSEI">

                    <label class="w3-text-black"><b>Out-Skill Level</b></label>
                    <select class="w3-select" name="OutSkillLevel" id="OutSkillLevel">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="9">9</option>
                            
                    </select>

                    <label class="w3-text-black"><b>Position #</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="PositionNumber" id="PositionNumber">

                    <label class="w3-text-black"><b>Description</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="Description" id="Description">


                    <input class="w3-btn w3-blue-grey" type="submit" id="submit" value="Create Billet Post">
                </form> 
                </div>   
</body>
=======
		<link rel="stylesheet" type="text/css" href="./css/postbillet.css?ver=3">
        <div class="postbillet">
                <h1>Create your billet post:</h1>
                <form action="./scripts/CreatePost.php" method="POST">
                    <p>In-AFSC</p>
                    <input type="text" id="InAFSC" name="InAFSC" placeholder="Enter AFSC of personnel you would like to receive.">
                    <p>In-Rank</p>
                    <input type="text" id="InRank" name="InRank" placeholder="Enter Rank of personnel you would like to receive.">
                    <p>In-SEI</p>
                    <input type="text" id="InSEI" name="InSEI" placeholder="Enter SEI of personnel you would like to receive. (Optional)">
                    <p>In-SkillLvl</p>
                    <input type="text" id="InSkillLevel" name="InSkillLevel" placeholder="Enter Skill Level of personnel you would like to receive. (Optional)">
                    <p>Out-AFSC</p>
                    <input type="text" id="OutAFSC" name="OutAFSC" placeholder="Enter AFSC of billet you are willing to trade.">
                    <p>Out-Rank</p>
                    <input type="text" id="OutRank" name="OutRank" placeholder="Enter Rank of billet you are willing to trade."><br>
                    <p>Out-SEI</p>
                    <input type="text" id="OutSEI" name="OutSEI" placeholder="Enter SEI of billet you are willing to trade. (Optional)">
					<p>Out-SkillLvl</p>
                    <input type="text" id="OutSkillLevel" name="OutSkillLevel" placeholder="Enter Skill Level of billet you are willing to trade. (Optional)">
					<p>Position#</p>
                    <input type="text" id="PositionNumber" name="PositionNumber" placeholder="Enter Position Number of billet. (Optional)">
					<p>Description</p>
                    <input type="text" id="Description" name="Description" placeholder="Enter a description of the duties for the billet you are posting.">
					<input type="submit" id="submit" value="Create Billet Post">                                  
                </form>
            </div>
    </div>
>>>>>>> c1fe4eb09efc56215dc6a6d268e7b7ce4ea7ec70
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>