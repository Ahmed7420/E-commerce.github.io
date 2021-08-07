<?php include ('includes/db.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="insert_product.php" enctype="multipart/form-data">
	<table width="700"  align="center" border="1"style="margin-top: 200px;">
	<tr>
		<td colspan="2" align="center" ><h2>Insert new products</h2></td>
	</tr> 
		<tr>
			<td><b>product_title:</b></td>
			<td>
			<input type="text" name="product_title" required="">
		    </td>
		</tr>
		<tr>
			<td><b>product_title:</b></td>
			<td>
			<select name="product_cat">
				<option>Select a category</option>
				<?php
				$get_cat = "select * from categories";
				$run_cat = mysqli_query($conn,$get_cat);
				while ($row_cat = mysqli_fetch_array($run_cat)) {
					$cat_id = $row_cat['cate_id'];
					$cat_title = $row_cat['cate_title'];

				
			      echo "<option value='$cat_id'>$cat_title</option>";
			  }
			  ?>
			</select>
		</td>
		</tr>
		<tr>
			<td><b>product_brands:</b></td>
			<td>
			<select name="product_brand">
				<option>Select a brands</option>


				<?php
				$get_b = "select * from brands";
				$run_b = mysqli_query($conn,$get_b);
				while ($row_b = mysqli_fetch_array($run_b)) {
					$brand_id = $row_b['brand_id'];
					$brand_title = $row_b['brand_title'];

				
			      echo "<option value='$brand_id'>$brand_title</option>";
			  }
			  ?>



			</select>
		</td>
		</tr>
		<tr>
			<td><b>product_img1:</b></td>
			<td>
			<input type="file" name="product_img1" required="">
		</td>
	</tr>
		<tr>
			<td><b>product_img2:</b></td>
			<td>
			<input type="file" name="product_img2" required="">
		</td>
	</tr>
		<tr>
			<td><b>product_img3:</b></td>
			<td>
			<input type="file" name="product_img3" required="">
		    </td>
	    </tr>
		<tr>
			<td><b>product_price:</b></td>
			<td>
			<input type="text" name="product_price" required="">
		   </td>
	   </tr>
		<tr>
			<td><b>product_Description:</b></td>
			<td>
			<input type="text" name="product_desc" required="">
		    </td>
	    </tr>
		<tr>
			<td><b>product_Keywords:</b></td>
			<td>
			<input type="text" name="product_keywords" required="">
		    </td>
	    </tr>
		  <tr>
		  	<td><b>Submit:</b></td>
			<td>
			<input id="t" type="submit" name="insert_product" value="Insert product">
		    </td>
	     </tr>
	</table>
</form>
</body>
</html>

<?php
  if (isset($_POST['insert_product'])) {
  	$product_title = $_POST['product_title'];
  	$product_cat = $_POST['product_cat'];
  	$product_brand = $_POST['product_brand'];
  	$product_price = $_POST['product_price'];
  	$product_desc = $_POST['product_desc'];
  	$product_keywords = $_POST['product_keywords'];
  	$status = 'on';


//names
  	$product_img1 = $_FILES['product_img1']['name'];
  	$product_img2 = $_FILES['product_img2']['name'];
  	$product_img3 = $_FILES['product_img3']['name'];


//temp name
  	$temp_name1 = $_FILES['product_img1']['tmp_name'];
  	$temp_name2 = $_FILES['product_img2']['tmp_name'];
  	$temp_name3 = $_FILES['product_img3']['tmp_name'];

  	if ($product_title =='' OR $product_cat =='' OR $product_brand =='' 
  		OR $product_desc ==''OR $product_img1==''OR $product_img3==''OR $product_img3=='') {
  		echo " 
  		<script>
  		alert('Please fill all fields.');
  		</script>";
  		exit();
  	}
  	else{
  		move_uploaded_file($temp_name1, "product-images/$product_img1");
  		move_uploaded_file($temp_name2, "product-images/$product_img2");
  		move_uploaded_file($temp_name3, "product-images/$product_img3");
     $insert_product = "insert into products(cate_id ,brand_id,date,product_title,product_img1,product_img2	,product_img3,product_price,	product_desc,	status )
      values('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','status')";
     $run_product = mysqli_query($conn, $insert_product);
     if ($run_product) {
     	echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
     	<script>
     	btn = document.getElementById('t');
btn.addEventListener('click',function() {
	swal({
  title: 'Good job!',
  text: 'You clicked the button!',
  icon: 'success',
  button: 'yes!',

});

})
</script>";
     }
        }
  	}

?>