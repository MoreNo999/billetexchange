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
            <h2>About</h2>
        </div>
        <h3> This project was brought to you by MurkSec. 
        It required approximately 80 man hours to complete. 
        Over this period, 223 commits or changes were done to the code base.  
        The site is 2,188 lines of PHP, HTML, CSS, and SQL.
        This came from the writing of 3,874 lines of code and subsequent removal of 1,686 lines of code.
    </div>
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>

