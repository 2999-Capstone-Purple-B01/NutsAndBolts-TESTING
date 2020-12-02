<!DOCTYPE html>
<html lang="en">
<?php
$conn = mysqli_connect("localhost", "root", "Root@123456789", "cart1");

if($conn -> connect_errno) {
	echo "failed to connect:".$conn -> connect_error;
	exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($action == 'addinventory' && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql =  "INSERT INTO products (id, name, description, code, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "issidis", $id, $name, $description, $code, $price, $quantity, $image);
		$id = '';
		$name = $_POST['name'];
		$description = $_POST['description'];
		$code = $_POST['code'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$image = '/image';
		
		if(mysqli_stmt_execute($stmt)){
			echo "records added";
		} else {
			echo "error: $sql.".mysqli_error($conn);
		}
	} else{
		echo "Error: $sql.".mysqli_error($conn);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

?>
<body>
<h1> Add Inventory</h1>
<form action="formraj.php?action=addinventory" method="post">
    <p>
        <label for="name">Product:</label>
        <input type="text" name="name" id="name" required>
    </p>
    <p> <label for="description">Description:</label>
        <input type="text" name="description" id="description" required>
    </p>
    <p> <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
    </p>
    <p> <label for="code">SKU:</label>
        <input type="number" name="code" id="code" required>
    </p>
    <p> <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>
    </p>
    <input type="submit" value="Submit">
</form>


<!--<form id="searchform" action="formraj.php?action=ChangeInventory" method="post" enctype="multipart/form-data">
  <div align="center">
 <fieldset>

   <div align="center">
     <legend align="center" >Stock!</legend>
   </div>
   <div class="fieldset">
     <p>
   <label class="field" for="date">Date: </label>

       <input name="date" type="text" class="tcal" value="<?php //echo date("Y-m-d");; ?>" size="30"/>
         </p>
   <p>
     <label class="field" for="item">Item: </label>

     <input name="item" type="text"  value=" "  size="30"/>
   </p>

       <p>
       <label class="field" >Quantity :</label>
       <input  name="quantity" type="text" value=""  size="30"/>
     </p> 
       <p>
       <label class="field" >Amount :</label>
       <input  name="amount" type="text" value=""  size="30"/>
     </p> 
  </div>
 </fieldset>
   <p align="center" class="required style3">Please Fill The Complete Form </p>
   <div align="center">
     <input name="submit" type="submit" class="style1" value="Submit">

   </div>
 </form> 
-->


</body>
</html>    
