<?php 
session_start();

$errMsg ='';
if(isset($_POST['login'])){
	if(!empty($_POST['email']) && !empty($_POST['password'])){
       if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
           if($_POST['email'] == $_SESSION['email'] && $_POST['password'] == $_SESSION['password']){
           header('location: task.php');
       }
       else{
            $errMsg = 'Please check your email or password.';
	    }
	
	     

      }
      else{
           $errMsg = 'Email is not valid.';
      }
   }
   else{
      $errMsg = 'Please enter your registered email and password.';
  }
}


?>
<!DOCTYPE html>
<html lang="en">
	<?php require_once('template/header.php'); ?>
	<div class="container body-height">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			<table class="mx-auto">
				<tr>
					<td>
						<input type="text" name="email" placeholder="Enter your email" class="form-control mt-3">
					</td>
				</tr>
				<tr>
					<td>
						<input type="password" name="password" placeholder="Enter a password" class="form-control mt-3">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Login" name="login" class="form-control btn btn-primary mt-2">
					</td>
				</tr>
			</table>
		</form>
		<div class="outer text-center mx-auto bg-light mt-4" style="max-width: 844px;">
			<div class="msg d-inline-block">
				<p class="text-center"><?php echo $errMsg; ?></p>
			</div>
		</div>
	</div>
	<?php require_once('template/footer.php'); ?>
</html>