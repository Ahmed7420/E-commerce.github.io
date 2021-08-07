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
			<div id="product_box">
				<?php 
				$get_product = "select * from products";
				$run_product = mysqli_query($conn , $get_product);
				while ($row_product = mysqli_fetch_array($run_product)) {
					$pro_id = $row_product['product_id'];
					$pro_title = $row_product['product_title'];
					$pro_cat = $row_product['cate_id'];
					$pro_brand = $row_product['brand_id'];
					$pro_desc = $row_product['product_desc'];
					$pro_price = $row_product['product_price'];
					$pro_img = $row_product['product_img1'];
				
				echo "
				<div id='single_product'>
					<h3 id='text'>$pro_title</h3>
					<img src='admin_area/product-images/$pro_img' width='180px' height='180px';<br>
					<h4 id='text'>Rs $pro_price /_</h4>
					<p id='text'>$pro_desc</p>
					<a href='details.php?pro_id=$pro_id'style='float:left;'>Details</a>
					<a href='index.php?add_cart=$pro_id'style='float:left;'>
					<button style='margin-left:10px;'>Add to Cart</button></a>
				</div>";
}

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