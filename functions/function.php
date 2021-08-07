<?php
//connection with database
$db = mysqli_connect("localhost","root","","myshop");

// getting the products on homepage from datbase 
function getPro()
{
	
		
	
	            global $db;
	            if (!isset($_GET['cat'])) {
		if (!isset($_GET['brand'])) {
	            $get_product = "select * from products  LIMIT 0,4";
				$run_product = mysqli_query($db , $get_product);
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
			}
			}	
					
}
// getting the products from categories  
function getCatPro()
{
	
		
	
	            global $db;
	            if (isset($_GET['cat'])) {
	            	$cat_id = $_GET['cat'];
	            $get_cat_pro = "select * from products where cate_id ='$cat_id'";
				$run_cat_pro = mysqli_query($db , $get_cat_pro);
				$get_count = mysqli_num_rows($run_cat_pro);
				if ($get_count == 0) {
				echo "<h2 style='color:black;'>No products Found In This Category</h2>";
				}
				while ($row_cat_product = mysqli_fetch_array($run_cat_pro)) {
					$pro_cat_id = $row_cat_product['product_id'];
					$pro_cat_title = $row_cat_product['product_title'];
					$pro_cat_cat = $row_cat_product['cate_id'];
					$pro_cat_brand = $row_cat_product['brand_id'];
					$pro_cat_desc = $row_cat_product['product_desc'];
					$pro_cat_price = $row_cat_product['product_price'];
					$pro_cat_img = $row_cat_product['product_img1'];
				
				echo "
				<div id='single_product'>
					<h3 id='text'>$pro_cat_title</h3>
					<img src='admin_area/product-images/$pro_cat_img' width='180px' height='180px';<br>
					<h4 id='text'>Rs $pro_cat_price /_</h4>
					<p id='text'>$pro_cat_desc</p>
					<a href='details.php?pro_id=$pro_cat_id'style='float:left;'>Details</a>
					<a href='index.php?add_cart=$pro_cat_id'style='float:left;'>
					<button style='margin-left:10px;'>Add to Cart</button></a>
				</div>";
}
			}
			}	
// getting the products from brands 
function getbrandPro()
{
	
		
	
	            global $db;
	            if (isset($_GET['brand'])) {
	            	$brand_id = $_GET['brand'];
	            $get_brand_pro = "select * from products where brand_id ='$brand_id'";
				$run_brand_pro = mysqli_query($db , $get_brand_pro);
				$get_count = mysqli_num_rows($run_brand_pro);
				if ($get_count == 0) {
				echo "<h2 style='color:black;'>No products Found In This Brand</h2>";
				}
				while ($row_brand_product = mysqli_fetch_array($run_brand_pro)) {
					$pro_brand_id = $row_brand_product['product_id'];
					$pro_brand_title = $row_brand_product['product_title'];
					$pro_brand_cat = $row_brand_product['cate_id'];
					$pro_brand_brand = $row_brand_product['brand_id'];
					$pro_brand_desc = $row_brand_product['product_desc'];
					$pro_brand_price = $row_brand_product['product_price'];
					$pro_brand_img = $row_brand_product['product_img1'];
				
				echo "
				<div id='single_product'>
					<h3 id='text'>$pro_brand_title</h3>
					<img src='admin_area/product-images/$pro_brand_img' width='180px' height='180px';<br>
					<h4 id='text'>Rs $pro_brand_price /_</h4>
					<p id='text'>$pro_brand_desc</p>
					<a href='details.php?pro_id=$pro_brand_id'style='float:left;'>Details</a>
					<a href='index.php?add_cart=$pro_brand_id'style='float:left;'>
					<button style='margin-left:10px;'>Add to Cart</button></a>
				</div>";
}
			}
			}	
				
 //getting the brand list
function getBrand()
{
                global $db;
				$get_b = "select * from brands";
				$run_b = mysqli_query($db,$get_b);
				while ($row_b = mysqli_fetch_array($run_b)) {
					$brand_id = $row_b['brand_id'];
					$brand_title = $row_b['brand_title'];

				
			      echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
			  }
			 
}
//getting the categories list
function getCat(){
	          global $db;

			  $get_cats = "select * from categories";

			  $run_cats = mysqli_query($db, $get_cats);

			  while ($row_cats= mysqli_fetch_array($run_cats)) {

			  	$cat_id=$row_cats['cate_id'];

			  	$cat_title=$row_cats['cate_title'];

			  	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
			  }

}
//getting real customer ip address
function getIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
}
//getting the product into the cart
function cart()
{
	global $db;
	if (isset($_GET['add_cart'])) {
		$ip_add = getIp();
		$p_id = $_GET['add_cart'];
		$check_pro = "select * from cart where p_id = '$p_id' AND ip_add = '$ip_add'";
		$run_check = mysqli_query($db , $check_pro);
		if (mysqli_num_rows($run_check)>0) {
			echo "";
		}
		else{
			$q = "insert into cart (p_id , ip_add) value('$p_id','$ip_add')";
			$run_q = mysqli_query($db , $q);
			echo "<script>window.open('index.php','_self')</script>";
		}

	}


}
//getting the total products
function items()
{
	if (isset($_GET['add_cart'])) {
		global $db;
		$ip_add = getIp();
		$get_items = "select * from cart where ip_add = '$ip_add'";
		$run_items = mysqli_query($db , $get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	else{
		global $db;
		$ip_add = getIp();
		$get_items = "select * from cart where ip_add = '$ip_add'";
		$run_items = mysqli_query($db , $get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	echo "<span style='color:orange; font-size:20px;'>$count_items</span>";
}


//getting the total price from cart
function total_price()
{
	global $db;
	$total = 0;
		$ip_add = getIp();
		$sel_price = "select * from cart where ip_add ='$ip_add'";
		$run_price = mysqli_query($db, $sel_price);
		while ($record = mysqli_fetch_array($run_price)) {
			$pro_id = $record['p_id'];
			$pro_price =" select * from products where product_id = '$pro_id'";
			$run_pro_price = mysqli_query($db, $pro_price);
			while ($p_price = mysqli_fetch_array($run_pro_price)) {
				$product_Price =array( $p_price['product_price']);
				$values = array_sum($product_Price);
				$total += $values;
			}
		}
		echo "<span style='color:orange; font-size:20px;'>$$total</span>";
}
?>