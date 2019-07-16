<!DOCTYPE html>
<html>
    <head>
        <title>Billet Trading New Post</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css?ver=123">
        <body>
            <div class="New Billet Posting Box">
                <h1>Create your billet post:</h1>
                <form action="./scripts/CreatePost.php" method="POST">
                    <p>In-AFSC</p>
                    <input type="text" id="In-AFSC" name="In-AFSC" placeholder="Enter AFSC of personnel you would like to receive.">
                    <p>In-Rank</p>
                    <input type="text" id="In-Rank" name="In-Rank" placeholder="Enter Rank of personnel you would like to receive.">
                    <p>In-SEI</p>
                    <input type="text" id="In-SEI" name="In-SEI" placeholder="Enter SEI of personnel you would like to receive. (Optional)">
                    <p>In-SkillLvl</p>
                    <input type="text" id="In-SkillLvl" name="In-SkillLvl" placeholder="Enter Skill Level of personnel you would like to receive. (Optional)">
                    <p>Out-AFSC</p>
                    <input type="text" id="Out-AFSC" name="Out-AFSC" placeholder="Enter AFSC of billet you are willing to trade.">
                    <p>Out-Rank</p>
                    <input type="text" id="Out-Rank" name="Out-Rank" placeholder="Enter Rank of billet you are willing to trade."><br>
                    <p>Out-SEI</p>
                    <input type="text" id="Out-SEI" name="Out-SEI" placeholder="Enter SEI of billet you are willing to trade. (Optional)">
					<p>Out-SkillLvl</p>
                    <input type="text" id="Out-SkillLvl" name="Out-SkillLvl" placeholder="Enter Skill Level of billet you are willing to trade. (Optional)">
					<p>Position#</p>
                    <input type="text" id="Position#" name="Position#" placeholder="Enter Position Number of billet. (Optional)">
					<p>Description</p>
                    <input type="text" id="description" name="description" placeholder="Enter a description of the duties for the billet you are posting.">
					<input type="submit" id="submit" value="Create Billet Post">                                  
                </form>
            </div>

        </body>
    </head>
</html>