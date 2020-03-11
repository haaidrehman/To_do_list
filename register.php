<?php 
session_start();

$msg = '';
$emailErr = '';
if(isset($_POST['register'])){
	if(!empty($_POST['email'])){
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$_SESSION['name'] = $_POST['name'];
			 $_SESSION['email'] = $_POST['email'];
			 $_SESSION['password'] = $_POST['password']; 
	 	}
		else{
	 		$emailErr = 'Please enter a valid email.';
	 	}
	 }
	 else{
		$emailErr = 'Please enter your email.';
	}
}

// session_unset();
// session_destroy();
echo "<pre>"; 
print_r($_SESSION);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
	<?php require_once('template/header.php'); ?>
	<div class="container body-height">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			<table class="mx-auto">
			<tr>
					<td>
						<input type="text" name="name" placeholder="Enter your name" class="form-control mt-3">
						<span class="pl-2 err-msg" style="font-size: 12px; color: red"><?php echo $emailErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" name="email" placeholder="Enter your email" class="form-control mt-3">
						<span class="pl-2 err-msg" style="font-size: 12px; color: red"><?php echo $emailErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>
						<input type="password" name="password" placeholder="Enter a password" class="form-control mt-3">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Register" name="register" class="form-control btn btn-primary mt-2">
					</td>
				</tr>
			</table>
		</form>
		<div class="outer text-center mx-auto bg-light mt-4" style="max-width: 844px;">
			<div class="msg d-inline-block">
				<p class="text-center"><?php echo $msg; ?></p>
			</div>
		</div>
	</div>
	<?php require_once('template/footer.php'); ?>
</html>