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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css?ver=5.1">
<link rel="stylesheet/less" type="text/css" href="../../css/styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>Recent Posts</h2>
        </div>
        <div class="w-3 container w3-mobile">
        <h3 style="color:white;"> Guide </h3>

        <h3 style="color:white;">
        This site was created to allow Air Force leaders to publish billet swaps they are willing to make in their units. This will allow for a quicker and more dynamic ability to manage manpower at the unit level. </br></br>

        After creating an account and logging in users will be able to: Browse all billets, Post a swap criteria, View matches. </br></br>

        The Dashboard page allows users to view or delete any post they have made. </br></br>

        The Browse page has three options All, Recent, or Matches. The Recent view will show all post created on the site in the last week. The Matches view will check the user's post and return any matches from other user's posts. </br></br>

        The Post page is where users will submit their manning swaps.</br></br>

        The My Account page is where users can edit their profile or change their password. </br></br>
        </h3>

        <h3 style="color:white;"> FAQ </h3>
        <h3 style="color:white;">What format should the AFSC be?</br></br>

        AFSC should be in the '1B4X1' format. This skill level is entered seperately later on the Post page based on what swap the user is hoping to make. </br></br> </h3>

        <h3 style="color:white;"> Contact Us </h3>
        <h3 style="color:white;"> Send an email to gwa2100@gmail.com</h3>
        </div>
    </div>
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>