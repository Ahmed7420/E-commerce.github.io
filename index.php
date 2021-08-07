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
	<div class="header-wrapper">
		<a href="index.php"><img src="images/shop_logo.png" width="120px;" height="100px;" style="float: left;"></a>
		<img src="images/547.png" height="100px;" width="1020px" style="float: right;">


	</div>
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
					<span>Price-<?php total_price(); ?> -Total Items = <?php items(); ?> <a href="cart.php" style="color: #ff0">Go To Cart-</a>
						<a href="logout.php" style="color: #fc0">Logout</a></span>
				</div>
			</div>
			<?php cart(); ?>
			<div id="product_box">
				<?php 
				getPro();
				getCatPro();
				getbrandPro();
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