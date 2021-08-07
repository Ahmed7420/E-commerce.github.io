<?php
include ("includes/db.php");
include ("functions/function.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<!--Main container-->
<div class="main-wrapper">
	<!--Header start-->
	
	<!--Header End-->

	<!--Navbar start-->
	<div id="navbar">
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_products.php">All Products</a></li>
			<li><a href="my_account.php">My Account</a></li>
			<li><a href="user_register.php">Sign up</a></li>
			<li><a href="cart.php">Shooping Cart</a></li>
			<li><a href="contact.php">Contact Us</a></li>
		</ul>
		<form id="form" method="get" action="results.php" enctype="multipart/form-data">
			<input type="text" name="user-query" placeholder="Search a Product">
			<input type="submit" name="search" value="search">
		</form>

	</div>
	<!--Navbar start-->
	<div class="content-wraper">
		<div id="left-sidebar">
			<div id="sidebar-tittle">Categories</div>
			<ul id="cats">
			  <?php getCat(); ?>
			 
		    </ul>
		    <div id="sidebar-tittle">Brands</div>
			<ul id="cats">
				<?php getBrand();?>
		    </ul>
	    </div>

		<div id="right-sidebar">
			<div id="headline">
				<div id="headline_content">
					<b>Welcome Guest!</b>
					<b style="color: yellow; margin-left: 10px;margin-right: 10px;">Shopping Cart </b>
					<span>Price-<?php total_price(); ?> -Total Items = <?php items(); ?> <a href="cart.php" style="color: #ff0">Go To Cart-</a></span>
				</div>
			</div>
			<?php cart(); ?>
			<div id="product_box">
				<form method="POST" action="cart.php" enctype="multipart/form-data">
					<table width="900" border="1" align="center" bgcolor="#ff9" style="color: black">
						<tr>
							<td height="50"><b>Remove</b></td>
							<td><b>Products(s)</b></td>
							<td><b>Quantity</b></td>
							<td><b>Total price</b></td>
						</tr>

						<?php
						$total = 0;
		$ip_add = getIp();
		$sel_price = "select * from cart where ip_add ='$ip_add'";
		$run_price = mysqli_query($db, $sel_price);
		while ($record = mysqli_fetch_array($run_price)) {
			$pro_id = $record['p_id'];
			$pro_price =" select * from products where product_id = '$pro_id'";
			$run_pro_price = mysqli_query($db, $pro_price);
			while ($p_price = mysqli_fetch_array($run_pro_price)) {
				$product_title = $p_price['product_title'];
				$product_image = $p_price['product_img1'];
				$only_Price = $p_price['product_price']; 
				$product_Price =array( $p_price['product_price']);
				$values = array_sum($product_Price);
				$total += $values;
			?>
                        <tr>
							<td><input type="checkbox" value="<?php echo $pro_id?>" name="remove[]"></td>
							<td><?php echo $product_title;?> <br><img src="admin_area/product-images/<?php echo $product_image; ?>" height="80px" width="80px"> </td>
							<td><input type="number" min="1" max="10" name="qty" value="1" style="width: 30px;"></td>
							<?php

							if (isset($_POST['update'])) {
								$qty = $_POST['qty'];
								$insert_qty = "update cart set qty = '$qty' where ip_add = '$ip_add'";
								$run_qty = mysqli_query($conn , $insert_qty);
								$total = $total*$qty;
							}
							?>
							<td><?php echo "RS/-" . $only_Price; ?></td>
						</tr>
						<?php 
				        }
		                 }
				          ?>
				          <tr>
				          	<td colspan="3" height="40px" bgcolor="green"><b style="color: white">Sub Total:</b></td>
				          	<td bgcolor="green"><b style="color: white"><?php echo
				          	"RS/-" .  $total;?></b></td>
				          </tr>
				          <tr>
				      <td><input type="submit" name="update" value="update Cart"></td>
				      <td colspan="2"><input type="submit" name="continue" value="continue shopping"></td>
				      <td><button><a href="checkout.php" style="color: #000; text-decoration: none;">Checkout</a></button></td>
				          </tr>
					</table>
					
				</form>
				<?php
				function update_cart()
				{
					global $conn;
					if (isset($_POST['update'])) {
	foreach ($_POST['remove'] as $remove_id) {
		$delete_products = "delete from cart where p_id = '$remove_id'";
		$run_delete = mysqli_query($conn ,$delete_products);
		if ($run_delete) {
			echo "<script>window.open('cart.php','_self')</script>";
		}
	}
}

	if (isset($_POST['continue'])) {
		echo "<script>window.open('index.php','_self')</script>";
	}
				}
				echo @$up_cart = update_cart();

				?>

				</div>

		</div>
	</div>
	<div id="footer">
		<h1 id="rights">All rights Reserved © 2021 Ahmed Butt</h1>
	</div>
</div>
</body>
</html>