<?php
require_once("config.php");
$lDbName = $config["db"]["db1"]["dbname"];
$lDbUser = $config["db"]["db1"]["username"];
$lDbPass = $config["db"]["db1"]["password"];
$lDbHost = $config["db"]["db1"]["host"];
$con = new mysqli($lDbHost, $lDbUser, $lDbPass, $lDbName);
$sql = "SELECT * FROM BilletEntry";
$result = $con -> query($sql);
$data = $results -> fetch_assoc();
echo $data


    ?>