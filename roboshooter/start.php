<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$email = $_SESSION['email'];
mysql_connect('***', '***', '***') or die(mysql_error());
    mysql_select_db('***');

$sql = "SELECT id FROM roboshooter WHERE email = '$email'";
$result = mysql_query($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ROBOSHOOTER</title>
<!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
<div id="fb-root"></div>
<script>
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      window.location = "index.html";
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
     window.location = "index.html";
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '342681595892718', // Change to your app-ID (via Facebook Dashboard)
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/nl_NL/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
  }
  
  //Gebruiker uitloggen
  function fbLogoutUser() {
    FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                window.location = "index.html";
            });
        }
    });
}
</script>
       <div class="container">
       

            <div class="row">
            	<div class="col-lg-offset-3 col-lg-6">
                	<div class="form-heading">
                    	<h1 class="text-center"><img src="RoboshooterJules-2-@2x.png" alt="RoboShooter!" title="RoboShooter!" width="400" height="150" ></h1>
                        	<hr>
                    </div>
            	</div>
            </div>
            <!-- ROW geef aan dat we de pagina in kolommen kunnen opdelen (col-lg-x) -->
            <div class="row">
            	
                <div class="col-lg-offset-3 col-lg-6">
                	<div class="form-heading">
                    	<h2 class="text-center"><i class="fa fa-plus"></i>&nbsp;<strong>New game</strong></h2>
                        <hr>
                    </div>
                            <div class="form-body">
                            <!-- Formulier waar de gebruiker zich kan aanmelden voor het spel -->
                            	<p class="text-center">Hoi <?php echo $_SESSION['first_name'] ?>,</p>
                                <p class="text-center">Gebruik onderstaande code om het spel te starten.</p>
                                <h3 class="text-center">code: <?php while($content = mysql_fetch_assoc($result)
){ echo $content['id']; } ?></h3>
                                <br><br>
                                <button class="btn btn-lg btn-default col-lg-offset-5" onClick="fbLogoutUser()"><i class="fa fa-facebook-square"></i>&nbsp;Uitloggen</button>
                            </div>
                </div>
            </div>
     	</div>
</body>
</html>
