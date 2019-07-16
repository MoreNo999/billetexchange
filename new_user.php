<!DOCTYPE html>
<html>
    <head>
        <title>Billet Trading New User</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <body>
            <div class="loginbox">
                <h1>Create your account</h1>
                <form action="./scripts/CreateUser.php" method="POST">
                    <p>Username</p>
                    <input type="text" id="user" name="user" placeholder="Enter Username ">
                    <p>Password</p>
                    <input type="password" id="pass" name="pass" placeholder="Enter Password">
                    <p>Email Address</p>
                    <input type="text" id="email" name="email" placeholder="Enter .mil Email Address">
                    <p>Unit</p>
                    <input type="text" id="unit" name="unit" placeholder="Enter Unit">
                    <p>Phone number</p>
                    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number (optional)">
                    <input type="submit" id="submit" value="Create User">
                </form>
            </div>

        </body>
    </head>
</html>