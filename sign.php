<?php
  
  include('config/db_connect.php');

  $username = $password = $confirm_password = $email = "";
  $errors = array('username'=>'', 'password'=>'','confirm_password'=>'', 'email'=>'');

  if(isset($_POST['sign-up'])){
  	//check Username
  	if(empty($_POST['username'])){
  		$errors['username'] = 'Username is required';
  	}else{
  		$username = $_POST['username'];
  		if(!preg_match('/^[a-zA-Z0-9]([._-](?![._-])|[a-zA-Z0-9]){5,20}$/', $username)){
  			$errors['username'] = 'username must start with an alphanumeric character, follow by a dot,hyphen, or underscore or an alphanumeric character and ensures the length between 5 and 20';
  		}
  	}

  	// check Password

  	if(empty($_POST['password'])){
  		$errors['password'] = 'Password is required';
  	}else{
  		$password = $_POST['password'];
  		if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', $password)){
  			$errors['password'] = 'password must be at least one digit, one upercase character,one special character and 8 characters in length but no more than 20';
  		}
  	}

    //check confirm_password
  	if(empty($_POST['confirm_password'])){
  		$errors['confirm_password'] = 'Password is again required';
  	}else{
  		$confirm_password = $_POST['confirm_password'];
  		if($confirm_password != $password){
  			$errors['confirm_password'] = 'Passwords must be equal';
  		}
  	}

  	if(empty($_POST['email'])){
  		$errors['email'] = 'email is required';
  	}else{
  		$email = $_POST['email'];
  		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  			$errors['email'] = 'email must be a valid address';
  		}
  	}

  	if(array_filter($errors)){

  	}else{

  		$username = mysqli_real_escape_string($conn, $_POST['username']);
  		$password = mysqli_real_escape_string($conn, $_POST['password']);
  		$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
  		$email = mysqli_real_escape_string($conn, $_POST['email']);

  		//create sql
  		$sql = "INSERT INTO adac_mitarbeiter(username,password,confirm_password,email) VALUES ('$username','$password','$confirm_password','email')";

  		//save to db and check
  		if (mysqli_query($conn,$sql)) {
  			// success
  			header('Location: index.php');
  		}else{
  			//error
  			echo'query error:'.mysqli_error($conn);
  		}
  	}
  } // end of Post Check



?>


<html >

	<?php include('templates/header.php');?>

	<div class="container mx-5 ">
		<div class="row ">
			<div class="col-6 mx-auto">
				<h2>Sign-up</h2>
			    <p>Hier können Sie sich registrieren<p>
			    	<form action="" method="POST">
			    		<div class="form-group">
			    			<label >Username:</label><br>
			    		  <input type="text" name="username" value=""><br>
			    		  <span class="text-danger"><?php echo $errors['username']; ?></span>
			    		</div>
			    		<div class=" form-group">
			    			<label >Password:</label><br>
			    		  <input type="text" name="password" value=""><br>
			    		  <span class="text-danger"><?php echo $errors['password']; ?></span>
			    		</div>
			    		<div class=" form-group">
			    			<label >Confirm Password:</label><br>
			    		  <input type="text" name="confirm_password" value=""><br>
			    		  <span class="text-danger"><?php echo $errors['confirm_password']; ?></span>
			    		</div>
			    		<div class=" form-group">
			    			<label >email:</label><br>
			    		  <input type="text" name="email" value=""><br>
			    		  <span class="text-danger"><?php echo $errors['email']; ?></span><br>
			    		</div>
			    		<div class="form-group">
			    			<input type="submit" name="sign-up" value="sign-up">
			    		</div>
			    		<p>Schon ein Konto ?<a href="index.php">Jetzt einloggen</a></p>
			    	</form>
			    </div>
			</div>
			
		</div>
	</div>


	<?php include('templates/footer.php');?>


</html>