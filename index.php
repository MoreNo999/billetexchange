<?php
session_start();
if (isset($_SESSION['id']))
{
    header('Location: ../home.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Billet Trading Login</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css?ver=3.6">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>

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
    <div id="container">
        <div id="content">
            <div class="box">
                <div class="myform">
                    <h1>Login Here</h1>
                    <form action="./scripts/login.php" method="POST">
                        <p>Username</p>
                        <input type="text" id="user" name="user" placeholder="Enter Username">
                        <p>Password</p>
                        <input type="password" id="pass" name="pass" placeholder="Enter Password"><br>
                        <input class='w3-button w3-blue' type="submit" id="submit" value="login">
                        <a href="#">Forgot Password?</a>
                        <a href="./new_user.php">Create Account</a>
                        </form>
                        <img src="./img/content/USAF_logo.png" width="300" height="200">
                </div>
            </div>
        </div>
    </div>
                <?php
                if (isset($_SESSION['errorMessage'])){
                    echo $_SESSION['errorMessage'];
                    $_SESSION['errorMessage'] = null;
                }
                ?>
            </div>

        </body>
</html>
