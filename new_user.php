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
                    <input type="text" id="user" name="user" minlength=3 maxlength=20 title="minimum length of 3 and a maximum of 20" required placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" id="pass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Please don't write it down under your keyboard :)" required placeholder="Enter Password">
                    <p>Email Address</p>
                    <input type="text" id="email" name="email" required placeholder="Enter Email Address" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address: user@example.com">
                    <p>Unit</p>
                    <input type="text" id="unit" name="unit" minlength=3 maxlength=20 title="minimum length of 3 and a maximum of 40" required placeholder="Enter Unit">
                    <p>Phone number (optional)</p>
                    <input type="text" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890" title="Format: 123-456-7890">
                    <input type="submit" id="submit" value="Create User">
                </form>
            </div>
        </body>
    </head>
</html>