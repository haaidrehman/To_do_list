<?php
session_start();
date_default_timezone_set('asia/calcutta');
$store = [];
$emailErr = '';
$msg = '';

if(isset($_POST['add'])){
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['task'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$date = date('M-D-Y', time());
		$task = $_POST['task'];
		$store = compact('name', 'email', 'date', 'task');
		$_SESSION[time().uniqid()] = $store;
	  
   }
}

// delete any task
if(isset($_POST['delete'])){
	foreach($_SESSION as $key2 => $value2){
		if($key2 == $_POST['delete']){
			unset($_SESSION[$key2]);
		}
	}
}



// update any task
if(isset($_POST['update'])){
	echo "<form action='' method='POST'>
      <input type='text' name='name' placeholder='Enter name'><br>
      <input type='email' name='email' placeholder='Enter email'><br>
      <input type='text' name='task' placeholder='Enter task'><br>
      <input type='submit' value='Update' name='updateTask'>
	</form>";

	
}
if(isset($_POST['updateTask'])){
	 if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['task'])){
	 	$upName = $_POST['name'];
	 	$upEmail = $_POST['email'];
	 	$upDate = date('D-M-Y', time());
	 	$upTask = $_POST['task'];
	 	$updatedArr = compact('upName', 'upEmail', 'upDate', 'upTask');
	 		foreach($_SESSION as $key5 => $value5){
	 			if($key5 == $_SESSION['key']){
                    $_SESSION[$key5] = $updatedArr;
	 			}
	 		}
	 }
}


if(!empty($_SESSION)){
	echo "<table class='table-bordered'>";
	echo "<tr>";
	echo "<td>Name</td>";
	echo "<td>Email</td>";
	echo "<td>Date</td>";
	echo "<td>Task</td>";
	echo "</tr>";
foreach($_SESSION as $key => $value){

	echo "<tr>";
	foreach($value as $key8 => $value8){
	
			echo "<td>$value8</td>";

	}
	echo "<td>";
	echo "<form action='' method='POST'>";

	echo "<button type='submit' name='delete' value='$key' class='btn btn-danger'>Delete</button>";
	echo "<button type='submit' name='update' value='$key' class='btn btn-primary'>Update</button>";
	if(isset($_POST['update'])){
		$_SESSION['key'] = $_POST['update'];
	}
	echo "<form>";
	echo "</td>";
	echo "</tr>";
  


}

echo "</table>";

}





// session_unset();
// session_destroy();
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
						<input type="text" name="task" placeholder="Add task" class="form-control mt-3">
						<span class="pl-2 err-msg" style="font-size: 12px; color: red"><?php echo $emailErr; ?></span>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Add" name="add" class="form-control btn btn-primary mt-2">
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

<?php 

// echo $updateForm;

?>


	<?php require_once('template/footer.php'); ?>
</html>