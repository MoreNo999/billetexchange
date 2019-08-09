<?php
    //Will receive a GET request with postid as the post that needs to be edited.
    //This will allow it to load.
    session_start();
    require_once("scripts/functions.php");
    // load up your config file
    require_once("config.php");
     
    require_once(TEMPLATES_PATH . "/header.php");

    if (!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    $postID = $_GET['postid'];
    $post = GetSingleBilletPost($postID);
    $_RANKS = array('E-1', 'E-2','E-3','E-4','E-5','E-6','E-7','E-8','E-9');
    $_MAJCOMS = array('ACC', 'AETC', 'AFGSC', 'AFMC', 'AFSPC', 'AMC', 'AFSOC', 'PACAF', 'USAFE', 'Other');
    $_SKILLLVLS = array(1,3,5,7,9);
    $_MAJCOMOPTIONS = array("ANY", $_SESSION['majcom']);
?>
<div id="container">
    <div id="content">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="/css/postbillet.css?ver=4.1">
        <div class="w3-container w3-blue w3-mobile">
                    <h2>Edit Billet</h2>
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
                <div class="w3-animate-zoom myform">
                    <form class="w3-container w3-round" action="./scripts/CreatePost.php" method="POST">
                    
                    <label class="w3-text-black"><b>In-AFSC</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="InAFSC" name="InAFSC" value="<?php echo $post['InAFSC']?>">
                  
                    <label class="w3-text-black"><b>In-Rank</b></label>
                    <?php echo CreateOptionList($_RANKS, $post['InRank'],"w3-select","InRank","InRank")?>

                    <label class="w3-text-black"><b>In-SEI</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="InSEI" name="InSEI" value="<?php echo $post['InSEI']?>">

                    <label class="w3-text-black"><b>In-Skill Level</b></label>
                    <?php echo CreateOptionList($_SKILLLVLS, $post['InSkillLevel'],"w3-select","InSkillLevel","InSkillLevel")?>

                    <label class="w3-text-black"><b>Out-AFSC</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="OutAFSC" name="OutAFSC" value="<?php echo $post['OutAFSC']?>">                    
                  
                    <label class="w3-text-black"><b>Out-Rank</b></label>
                    <?php echo CreateOptionList($_RANKS, $post['OutRank'],"w3-select","OutRank","OutRank")?>
                    
                    <label class="w3-text-black"><b>Out-SEI</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="OutSEI" id="OutSEI" value="<?php echo $post['OutSEI']?>">

                    <label class="w3-text-black"><b>Out-Skill Level</b></label>
                    <?php echo CreateOptionList($_SKILLLVLS, $post['OutSkillLevel'],"w3-select","OutSkillLevel","OutSkillLevel")?>

                    <label class="w3-text-black"><b>Position #</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="PositionNumber" id="PositionNumber" value="<?php echo $post['PositionNumber']?>">

                    <label class="w3-text-black"><b>MAJCOM</b></label>
                    <?php echo CreateOptionList($_MAJCOMOPTIONS, $post['Majcom'],"w3-select","Majcom","Majcom")?>

                    <label class="w3-text-black"><b>Description</b></label>
                    <input class="w3-input w3-border w3-light-grey" type="text" name="Description" id="Description" value="<?php echo $post['Description']?>"><br>


                    <input class="w3-btn w3-blue" type="submit" id="submit" value="Update Billet Post">
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