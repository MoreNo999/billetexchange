<!DOCTYPE html>
<html>
    <head>
        <title>Billet Trading New User</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css?ver=3">
        <body>
            <div class="loginbox">
                <h1>Create your account</h1>
                <form action="./scripts/CreateUser.php" method="POST">
                    <p>Username</p>
                    <input type="text" id="user" name="user" required placeholder="Enter Username ">
                    <p>Password</p>
                    <input type="password" id="pass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Enter Password">
                    <p>Email Address</p>
                    <input type="email" id="email" name="email" required placeholder="Enter .mil Email Address">
                    <p>Unit</p>
                    <input type="text" id="unit" name="unit" required placeholder="Enter Unit">
                    <p>Phone number (optional)</p>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890">
                    <input type="submit" id="submit" value="Create User">
                </form>
            </div>
        </body>
    </head>
</html>