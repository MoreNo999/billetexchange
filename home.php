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
<link rel="stylesheet" type="text/css" href="../../css/home.css?ver=4.1">
<div id="container">
    <div id="content">
        <div class="w3-container w3-blue w3-mobile">
            <h2>Home Page</h2>
        </div>


    </div>
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>

<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>