<?php
@session_start();
include("includes/db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="width: 100%">
	<h2 style="color: black">Login or Register</h2>
	<form method="post" action="checkout.php" >
		<input type="text" name="c_email" placeholder="Enter your email"><br><br>
		<input type="password" name="c_pass" placeholder="password"><br><br>
		<a href="forget_pass">Forget Password</a><br><br>
		<input type="submit" name="c_login" value="Login"><br><br>
		<a href="customer_register">New Register here!!!</a>
	</form>
</div>
<?php
if (isset($_POST['c_login'])) {
	$c_email = $_POST['c_email'];
	$c_pass = $_POST['c_pass'];
	$select_customer = "select * from customers WHERE customer_email ='$c_email' AND customer_password = '$c_pass'";
	$run_customer = mysqli_query($conn,$select_customer);
	$check_customer = mysqli_num_rows($run_customer);
	$getIP = getIp();
	$select_cart = "select * from cart where ip_add = '$getIP' ";
	$run_cart = mysqli_query($conn,$select_cart);
	$check_cart = mysqli_num_rows($run_cart);
	if ($check_customer==0) {
		echo "<script>alert('password and email is not correct')</script>";
		exit();
	}
	if ($check_customer == 1 AND $check_cart==0) {
		$_SESSION['customer_email'] = $c_email;
		echo "<script>window.open('customers/my_account.php','_self')</script>";
	}
	else{
		$_SESSION['customer_email'] = $c_email;
		echo "<script>alert('successfully logged in shopping now!!')</script>";
		include 'payment_options.php';
	}
}
?>
</body>
</html>