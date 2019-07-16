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
        <link rel="stylesheet" type="text/css" href="./css/style.css?ver=3">
        <body>
            <div class="loginbox">
                <h1>Login Here</h1>
                <form action="./scripts/login.php" method="POST">
                    <p>Username</p>
                    <input type="text" id="user" name="user" required placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" id="pass" name="pass" required placeholder="Enter Password"><br>
                    <input type="submit" id="submit" value="login">
                    <a href="#">Forgot Password?</a>
                    <a href="./new_user.php" class="button">Create Account</a>                 
                    <img src="./img/content/USAF_logo.png" width="300" height="200">
                    
                </form>
                <?php
                if (isset($_SESSION['errorMessage'])){
                    echo $_SESSION['errorMessage'];
                    $_SESSION['errorMessage'] = null;
                }
                ?>
            </div>

        </body>
    
    </head>
</html>
