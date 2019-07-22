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
            <h2>My Matches</h2>
        </div>
        <?php
        $matches = GetMatches();
        $data = array();
        foreach ($matches as $one){
            foreach ($one->b as $aMatch){
                array_push($data, GetSingleBilletPost($aMatch));
            } 
        }
        CardifyPost($data);
        ?>
    </div>
    <?php
        require_once(TEMPLATES_PATH . "/rightPanel.php");
    ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>