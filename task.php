<?php
session_start();
$storeTask = [];
$updateErrMsg = '';

if(isset($_POST['add'])){
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['task'])){
		$_POST['date'] = date('D-M-Y', time());
        $storeTask = $_POST;
        unset($storeTask['add']);

        $_SESSION[time().uniqid()] = $storeTask;
	}
}

// Delete any task
if(isset($_POST['delete'])){
    foreach($_SESSION as $key2 => $value2){
    	if($key2 == $_POST['delete']){
    		unset($_SESSION[$key2]);
    	}
    }    
 }

// Update any task
 if(isset($_POST['update'])){
 	$_SESSION['update'] = $_POST['update'];
 }
 if(isset($_POST['updateTask'])){
 	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['task'])){
 		$_POST['date'] = date('D-M-Y', time());
 	$updateKey = $_SESSION['update'];
 	unset($_POST['updateTask']);
 	$_SESSION[$updateKey] = $_POST;
 	}
 	else{
 		$updateErrMsg = "Update fields cannot be empty.";
 	}
 }


if(count($_SESSION) < 2){
	unset($_SESSION);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('template/header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="form mx-auto">
				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<input type="text" name="name" class="form-control mt-3" placeholder="Enter your name">
					<input type="text" name="email" class="form-control mt-3" placeholder="Enter your email">
					<input type="text" name="task" class="form-control mt-3" placeholder="Enter task">
					<input type="submit" name="add" value="Add Task" class="form-control btn btn-primary mt-3">
				</form>
			</div>
		</div>
		<div class="col-md-8">
			<?php
			if(!empty($_SESSION)){
               $headerText = "<h5 class='text-center py-3'>Your data and task.</h5>";
               echo $headerText;

               echo "<table>";
               echo "<tr>
               <td class='px-2'>Name</td><td class='px-2'>Email</td><td class='px-2'>Task</td><td class='px-2'>Date</td>
               </tr>";
               foreach($_SESSION as $key => $value){
               	if($key == 'update'){
               		continue;
               	}
               	  echo "<tr class='added-task bg-task'>";
                  foreach($value as $key1 => $value1){
                  	echo "<td>$value1</td>";
                  } 
                  echo "<form action='' method='POST'>
                  <td>
                  <button type='submit' value='$key' name='delete' class='btn btn-danger'>Delete</button>
                  <button type='submit' value='$key' name='update' class='btn btn-success'>Update</button>
                  </td>
                  </form>";
               	  echo "</tr>";
               }
               echo "</table>";
               if(isset($_POST['update'])){
               	 echo "<div class='updateForm' style='max-width: 350px'>
               	 <form action='' method='POST'>
                 <input type='text' name='name' placeholder='Enter name' class='form-control my-2'>
                 <input type='email' name='email' placeholder='Enter email' class='form-control my-2'> 
                 <input type='text' name='task' placeholder='Enter task' class='form-control my-2'>
                 <input type='submit' name='updateTask' class=' btn btn-success form-control my-2' value='Update'>
               	 </form></div>";
               }
               echo $updateErrMsg;

			}
			else{
				$headerText = "<h5>Your data and task will appear here.</h5>";
				echo $headerText;
			}
			?>
		</div>
	</div>
</div>
<?php require_once('template/footer.php'); ?>
</html>

