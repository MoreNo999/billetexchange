<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Billet Trading</title>
</head>
<body>
        <div class="w3-bar w3-grey">
                <a href="../../home.php" class="w3-bar-item w3-button w3-mobile w3-large">Dashboard</a>
                <div class="w3-dropdown-hover w3-mobile">
                        <button class="w3-button w3-large">Browse</button>
                        <div class="w3-dropdown-content w3-bar-block w3-card-4">
                          <a href="../../view_all.php" class="w3-bar-item w3-button">All</a>
                          <a href="../../view_recent.php" class="w3-bar-item w3-button">Recent</a>
                          <a href="../../view_matches.php" class="w3-bar-item w3-button">Matches</a>
                        </div>
                      </div>
                <a href="../../post_billet.php" class="w3-bar-item w3-button w3-mobile w3-large">Post</a>
                <a href="../../my_account.php" class="w3-bar-item w3-button w3-mobile w3-large">My Account</a>
                <a href="../../scripts/logout.php" class="w3-bar-item w3-button w3-mobile w3-large w3-right">Logout</a>
              </div> 
              <div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
                <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                <a href="../../about.php" class="w3-bar-item w3-button">About</a>
                <a href="../../contact-us.php" class="w3-bar-item w3-button">Contact Us</a>
                <a href="../../support.php" class="w3-bar-item w3-button">Support</a>
              </div>
              
              <div class="w3-blue" style="transform: translateY(-18%);">
                <button class="w3-button w3-black w3-xlarge w3-right" onclick="openRightMenu()">&#9776;</button>
            
              </div>

              <script>
                function openLeftMenu() {
                  document.getElementById("leftMenu").style.display = "block";
                }
                
                function closeLeftMenu() {
                  document.getElementById("leftMenu").style.display = "none";
                }
                
                function openRightMenu() {
                  document.getElementById("rightMenu").style.display = "block";
                }
                
                function closeRightMenu() {
                  document.getElementById("rightMenu").style.display = "none";
                }
                </script>
        