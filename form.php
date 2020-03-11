<?php
session_start();

date_default_timezone_set('asia/calcutta');


if(isset($_POST['submit'])){
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
		$_POST['date'] = date('D-M-Y', time());
		$_SESSION[time().uniqid()] = $_POST;
	}
}

// session_unset();
// session_destroy();




foreach($_SESSION as $key => $value){

	   if(isset($_POST['delete'])){
	   	 if($key == $_POST['delete']){
	   	 	unset($_SESSION[$key]);
	   	 }
	   }
	}


  foreach($_SESSION as $key => $value){
  	if(isset($_POST['update'])){
       	if($key == $_POST['update']){
       		echo "<h1 style='color: red'>$key</h1>";
       		$_SESSION['updateId'] = $key;

       	}
       }
  }


  if(isset($_POST['submit1'])){
         if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
         	$getId = $_SESSION['updateId'];
         	$_SESSION[$getId] = $_POST;
         	echo "<h1>$getId</h1>";
         }         
      }


echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<br>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		input{
			padding: 10px;
		}
		.myTable{
			border-collapse: collapse;
		}
		.myTable tr,td{
            border: 1px solid black;
            
		}
	</style>
</head>
<body>
	<form action="" method="POST">
	    <table>
	    	<tr>
	    		<td>
	    			<input type="text" name="name" placeholder="Enter name">
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			<input type="text" name="email" placeholder="Enter email">
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			<input type="password" name="password" placeholder="Enter password">
	    		</td>
	    	</tr>
	    	<tr>
	    		<td>
	    			<input type="submit" name="submit" value="Submit">
	    		</td>
	    	</tr>
	    </table>	
	</form>



	
</body>
</html>


<?php



if(!empty($_SESSION)){
	echo "<table class='myTable'>";
	foreach($_SESSION as $key => $value){
		echo "<tr></tr>";

		foreach($value as $key1 => $value1){
			echo "<td>$value1</td>";
		}
       echo "<td>";
       echo "<form action='' method='POST'>";
	   echo "<button type='submit' value='$key' name='delete'>Delete</button>
       <button type='submit' value='$key' name='update'>Update</button>";

	   echo "</form>";
	   echo "</td>";

        
	}
	
}


	echo "</table>";
 if(isset($_POST['update'])){
	   	  echo "<form action='' method='POST'>
           <input type='text' name='name' placeholder='Enter name'><br>
           <input type='text' name='email' placeholder='Enter email'><br>
           <input type='password' name='password' placeholder='Enter password'>
           <input type='submit' value='Submit' name='submit1'>
	   	  </form>";
	}

    

?>
