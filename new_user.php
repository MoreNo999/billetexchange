<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Create Account</title>
  </head>
  <style>
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
  </style>

<script>
var check = function() {
	if ((document.getElementById('pass').value) ==
    (document.getElementById('verifyPassword').value) && (document.getElementById('pass').value.length>0)) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Passwords Match';
	  document.getElementById('submit').disabled = false;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Passwords DO NOT Match';
  }
}
</script>
  
  <body>
  <form class="form-signin" action="./scripts/CreateUser.php" method="post">
  <h1 class="h3 mb-3 font-weight-normal">Create a new Account</h1>
  <label for="user" class="sr-only">Username</label>
  <input class="form-control"type="text" id="user" name="user" minlength=3 maxlength=20 title="minimum length of 3 and a maximum of 20" placeholder="Enter Username">
  <label for="password" class="sr-only">Password</label>
  <input class="form-control" type="password" id="pass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Please don't write it down under your keyboard :)" placeholder="Enter Password" onkeyup='check();'>
  <input class="form-control" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters. Please don't write it down under your keyboard :)" required placeholder="Verify Password" id="verifyPassword" name="verifyPassword" onkeyup='check();'>
  <label for="email" class="sr-only">Email</label>
  <input class="form-control" type="text" id="email" name="email" required placeholder="Enter Email Address" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title=" user@example.mil">  
  <label for="unit" class="sr-only">Unit</label>
  <input class="form-control" type="text" id="unit" name="unit" minlength=3 maxlength=20 title="minimum length of 3 and a maximum of 40" required placeholder="Enter Unit">
  <label for="phone" class="sr-only">Phone number</label>
  <script src="js/phone_complete.js"></script>
  <input class="w3-input w3-border w3-light-grey" id="firstname" name="firstname" placeholder="First Name">
  <input class="w3-input w3-border w3-light-grey" id="lastname" name="lastname" placeholder="Last Name"></br>
  <input class="form-control" type="text" id="phone" name="phone" pattern="\([0-9]{3}\)[0-9]{3}-[0-9]{4}" placeholder="Format: (123)456-7890" title="Format: (123)456-7890" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
  <label class="w3-text-black">Rank:
  <select class="w3-select w3-light-grey w3-border" style="text-align: center" id="rank" name="rank" placeholder="RANK">
    <option value="E-1">E-1</option>
    <option value="E-2">E-2</option>
    <option value="E-3">E-3</option>
    <option value="E-4">E-4</option>
    <option value="E-5">E-5</option>
    <option value="E-6">E-6</option>
    <option value="E-7">E-7</option>
    <option value="E-8">E-8</option>
    <option value="E-9">E-9</option>
  </select></label>
  <label class="w3-text-black"><br><b>MAJCOM:<br></b></label>
  <select class="w3-select w3-light-grey w3-border" style="text-align: center" id="majcom" name="majcom" placeholder="MAJCOM">
  <option value="ACC">ACC</option>
    <option value="AETC">AETC</option>
    <option value="AFGSC">AFGSC</option>
    <option value="AFMC">AFMC</option>
    <option value="AFSPC">AFSPC</option>
    <option value="AMC">AMC</option>
    <option value="AFSOC">AFSOC</option>
    <option value="PACAF">PACAF</option>
    <option value="USAFE">USAFE</option>
    <option value="Other">Other</option>
  </select>
  <span id='message'></span>

  <button class="btn btn-lg btn-primary btn-block" disabled type="submit" id="submit">Create Account</button>
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>