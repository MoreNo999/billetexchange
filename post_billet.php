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
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>