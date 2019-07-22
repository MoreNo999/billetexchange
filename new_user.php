<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
		<title>Billet Trading New User</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css?ver=3.7">
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
					<h1>Create Your Account</h1>
					<form action="./scripts/CreateUser.php" method="POST">
						<p>Username</p>
						<input type="text" id="user" name="user" minlength=3 maxlength=20 title="minimum length of 3 and a maximum of 20" placeholder="Enter Username">
						<p>Password</p>
						<input type="password" id="pass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Please don't write it down under your keyboard :)" placeholder="Enter Password">
						<p>Email Address</p>
						<input type="text" id="email" name="email" required placeholder="Enter Email Address" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title=" user@example.mil">
						<p>Unit</p>
						<input type="text" id="unit" name="unit" minlength=3 maxlength=20 title="minimum length of 3 and a maximum of 40" required placeholder="Enter Unit">
						<p>Phone number (optional)</p>
						<input type="text" id="phone" name="phone" style="text-align: center" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890" title="Format: 123-456-7890"><br><br>
						<input class="w3-button w3-blue" style="justify-content: center" type="submit" id="submit" value="Create User">
					</form>
				</div>
			</div>
		</div>
	</div>		
    </body>
</html>