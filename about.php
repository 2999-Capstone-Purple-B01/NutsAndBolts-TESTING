<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title></title>
    </head>
    <body>

        <!-- Start of hero image, This is where the picture with all of the containers includeing the nutsandbolts logo is located -->
               <div class="hero-image">
                 <div class="hero-text">
                    <img class="mainlogo" src="img/nutsandbolts.jpg" alt="Website's Logo">
                    <p>HARDWARE TOOLS THAT DO THE JOB AT A FAIR PRICE</p>
                 </div>
               </div>
        <!-- End of hero image section -->


	<!-- Start of header navigation bar navigation -->
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
                    <a href="about.php" class="active">About</a>
                </li>
                <li>
                    <a href="contact.php" class="hov">Contact</a>
                </li>
		<li>
                    <a href="shop.php" class="hov">Shop</a>
		</li>
                <li>
                    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Cart Items</button>
		</li>
                <li id="right">
                    <a href="login.php" class="hov">Login</a>
                </li>
            </ul>
        <!-- End of menu navigation bar --> 
<script>
/* Get the modal */
var modal = document.getElementById('id01');

/* When the user clicks anywhere outside of the modal, close it */
 window.onclick = function(event) {
	    if (event.target == modal) {
		           modal.style.display = "none";
			            }
	             }
</script>


<?php
error_reporting(0);
session_start();

$total = 0;

/*database connection*/
$conn = new PDO("mysql:host=localhost;dbname=cart1", 'root', 'Root@123456789');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*Get action String */
$action = isset($_GET['action']) ? $_GET['action'] : ""; 

/* Add to cart */
if ($action == 'addcart' && $_SERVER['REQUEST_METHOD'] == 'POST') {

/*Finding the product by code */
$query = "SELECT * FROM products WHERE code=:code";
$stmt = $conn->prepare($query);
$stmt->bindParam('code', $_POST['code']);
$stmt->execute();
$product = $stmt->fetch();

$currentQty = $_SESSION['products'][$_POST['code']]['qty'] + 1; //Incrementing the product qty in cart
$_SESSION['products'][$_POST['code']] = array('qty' => $currentQty, 'name' => $product['name'], 'image' => $product['image'], 'price' => $product['price']);
$product = '';
header("Location:index.php");
}

/* Empty All */
if ($action == 'emptyall') {
$_SESSION['products'] = array();
header("Location:index.php");
}

/* Empty one by one */
if ($action == 'empty') {
$code = $_GET['code'];
$products = $_SESSION['products'];
unset($products[$code]);
$_SESSION['products'] = $products;
header("Location:index.php");
}


/* Get all Products */
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();

?> 

<div id="id01" class="modal" style="display: none;">
<span onclick="document.getElementById('id01').style.display='block'" class="close" title="Close Modal">&times;</span>
<div class="modal-content">
<div class="container" style="width:600px; padding:0px;">
        <?php if (!empty($_SESSION['products'])) : ?>
            <nav class="navbar navbar-inverse" style="background:#04B745;">
                <div class="container-fluid pull-left" style="width:300px;">
                    <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
                </div>
                <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="index.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
            </nav>
            <table class="table table-striped">
            <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($_SESSION['products'] as $key => $product) : ?>
                    <tr>
                        <td><img src="<?php print $product['image'] ?>" width="50"></td>
                        <td><?php print $product['name'] ?></td>
                        <td>$<?php print $product['price'] ?></td>
                        <td><?php print $product['qty'] ?></td>
                        <td><a href="index.php?action=empty&code=<?php print $key ?>" class="btn btn-info">Delete</a></td>
                    </tr>
                    <?php $total = $total + $product['price']; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" align="right">
                        <h4>Total:$<?php print $total ?></h4>
                    </td>
                </tr>
            </table>
	    <?php endif; ?>
	    <button><a href="shop.php">Checkout</a></button>
            <button><a href="about.php">Return</a></button>
         </div>
     </div>
  </div>

	<!-- Start of Company Bio -->  
                        </div>
                        <div class="bio">
                        At NutzAndBoltz we take pride in providing your with the right tools to <br>
                        <br>
                        <br>
                        for you DIY projects! Since 1983, we have provided our community with <br>
                        <br>
                        <br>
                        the best customer experience. Our experinced team is always here to help those <br>
                        <br>
                        <br>
                        needs of finding that obscure bolt. So come on down to see what our shop has to offer!<br>
                        <br>
                        <br>
                        Satisfaction at affordable prices. We work from our hearts, not strength
            </div>
       <!-- End of company bio -->




        <!--
            Code for sticky navigation bar, removes class "sticky" on scroll down
        -->
        <script type="text/javascript">

            window.onscroll = function() {myFunction()};

            var nav = document.getElementById("myNav");
            var sticky = nav.offsetTop;

            function myFunction() {
              if (window.pageYOffset > sticky) {
                nav.classList.add("sticky");
              } else {
                nav.classList.remove("sticky");
              }
            }
            </script>
        <!-- End of javascript for sticky navigation bar -->


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
