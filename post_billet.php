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
    <div id="content">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="/css/postbillet.css?ver=4.1">
        <div class="w3-container w3-blue w3-mobile">
                    <h2>New Billet</h2>
                </div>
                 <div style="width:40%; margin-left: 30%; margin-top: 3%; background-color: grey;" class="w3-mobile w3-round w3-modal-content w3-animate-zoom">
                <form class="w3-container w3-round" action="./scripts/CreatePost.php" method="POST">
                    
                    
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
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>