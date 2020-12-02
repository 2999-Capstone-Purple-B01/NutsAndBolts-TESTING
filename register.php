<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/stylesTEST.css">
    <title>Register User</title>
</head>

<body>
<div class="hero-image">
                   <div class="hero-text">
                   <img class="mainlogo" src="img/nutsandbolts.jpg" alt="Website's Logo">
                   <p>HARDWARE TOOLS THAT DO THE JOB AT A FAIR PRICE</p>
                   </div>
</div>

<div id="myNav">
    <ul class="fix">
        <li>
            <a href="index.php" class="hov">
                <img class="logo" src="img/logo.jpg" alt="Website's Logo">
            </a>
        </li>
        <li>
            <a href="index.php" class="hov">Home</a>
        </li>
        <li>
            <a href="about.php" class="hov">About</a>
        </li>
        <li>
            <a href="contact.php" class="hov">Contact</a>
        </li>
        <li>
            <a href="shop.php" class="hov">Shop</a>
        </li>
        <li id="right">
            <a href="login.php" class="hov">Login</a>
        </li>
    </ul>
</div>

<?php

session_start();
$host="localhost"; // Host name                                                                                                                                                               
$username="root"; // Mysql username                                                                                                                                                        
$password="Root@123456789"; // Mysql password                                                                                                                                                    
$db_name="cart1"; // Database name                                                                                                                                                        
$tbl_name="users"; // Table name

// Connect to server and select databse.
$conn = mysqli_connect("$host", "$username", "$password", $db_name)or die("cannot connect");
//mysqli_select_db($dbhandle, $db_name)or die("cannot select DB");

//$username=$_POST['username'];
//$password=$_POST['password'];
//$sq=$_POST['sq'];
//$sa=$_POST['securityquestions'];

$message = '';

if(!empty($_POST['username']) && !empty($_POST['password'])):
    $sql = "INSERT INTO users (username, password, Security_Questions, Security_Answers) VALUES (:username, :password, :sq, :sa)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
    $stmt->bindParam(':Security_Questions', $_POST['sq']);
    $stmt->bindParam(':Security_Answers', $_POST['sa']);

    if( $stmt->execute() ):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry there must have been an issue creating your account';
	endif;

endif;

?>


<form action="register.php">
 <div class="RegisterForm">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

    <label for="securityquestions">Choose a Security Question:</label>
    <select name="securityquestions">
        <option value="school" name="sq">What primary school did you attend?</option>
        <option value="city" name="sq">What city were you born in?</option>
        <option value="job" name="sq">In what town or city was your first job?</option>
    </select>
    <input type="text" name="sa" required>

    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>
 </div>
  
  <div class="RegisterForm signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>


<!-- Start of Footer -->
<footer>
  <div class="footer-gray">
    <div class="footer-custom">
      <div class="footer-lists">
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr-column1">Contact Phone</h6>
          <ul class="ftr-links-sub-column1">
            <li>1-800-443-501</li>
          </ul>
                  <h6 class="ftr-hdr-column1">Address</h6>
                  <ul class="ftr-links-sub-column1">
                    <li>331 E Main Ave<br>Mountain View, OH 43026 USA</li>
          </ul>
                  <h6 class="ftr-hdr-column1">Email Us</h6>
                  <ul class="ftr-links-sub-column1">
                  <li><a href="contact.php" rel="nofollow">Boltz@NutzAndBoltz.com</a></li>
                  </ul>
	</div>
   </div>


        <!--/.footer-list-wrap-->
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr-column2">About</h6>
          <ul class="ftr-links-sub-column2">
            <li><a href="about.php" rel="nofollow">Our Company</a></li>
            <li><a href="about.php" rel="nofollow">Our Customers</a></li>
            <li><a href="about.php" rel="nofollow">Our Team</a></li>
            <li><a href="about.php" rel="nofollow"></a>Jobs</li>
          </ul>
        </div>
        <!--/.footer-list-wrap-->
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr-column3">My Account</h6>
          <ul class="ftr-links-sub-column3">
            <art:content rule="!loggedin">
              <li class="ftr-Login"><span class="link login-trigger"><a href="login.php">Login</a></span></li>
              <li><span class="link" onclick="link('/asp/secure/your_account/track_orders-asp/_/posters.htm')">Track my Order</span></li>
                          <li><span class="link" onclick="link('/asp/secure/your_account/track_orders-asp/_/posters.htm')">Order History</span></li>
                                                  <li><a class="link" href="faq.php">FAQ</a></li>
            </art:content>
          </ul>
        </div>
        <!--/.footer-list-wrap-->
      </div>
      <div class="footer-legal">
        <p>&copy; NutzAndBoltz.com All Rights Reserved. | <a href="/help/privacy-policy.html" rel="nofollow">Privacy Policy</a> | <a href="/help/terms-of-use.html" rel="nofollow">Terms of Use</a> | <a href="/help/terms-of-sale.html" rel="nofollow">Terms of Sale</a></p>
        <p>NutzAndBoltz.com and Photos [to] Art are trademarks or registered trademarks of NutzAndBoltz Inc.</p>
      </div>
      <!--/.footer-legal-->

      <!--/.footer-payment-->
    </div>
    <!--/.footer-custom-->
  </div>
  <!--/.footer-gray-->
</footer>
     <!--End of Footer -->

</body>
</html>
