<?php
  
  include('config/db_connect.php');
  session_start();

  $username = $password = $login_err = "" ;
  $errors = array('username'=>'', 'password'=>'','login_err'=>'');

  if(isset($_POST['login'])){
  	//check Username
  	if(empty($_POST['username'])){
  		$errors['username'] = 'Username is required';
  	}else{
  		$username = $_POST['username'];
  		
  	}

  	// check Password

  	if(empty($_POST['password'])){
  		$errors['password'] = 'Password is required';
  	}else{
  		$password = $_POST['password'];
  	}

  	if(array_filter($errors)){

  	}else{

  		 $sql = "SELECT * FROM adac_mitarbeiter WHERE username = '$username' and password = '$password'";

  	   // get the query result
  	   $result = mysqli_query($conn, $sql);

  	   //fetch resulting row as a  array
  	   $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
  	   $count = mysqli_num_rows($result);

  	   //if result matches
  	   if($count == 1) {

  		   $_SESSION['login_user'] = $username;

  		   header('Location: kunde.php');

  	    }else{
  		     $errors['login_err'] = 'Your Login Username or Password is invalid';
  	    }

  	}

  }




?>


<html >

	<?php include('templates/header.php');?>

	<div class="container m-0">
		<div class="row">
			<div class="col-6 mx-auto ">
				<h2>Login</h2>
			    <p>Hier können Sie sich als Mitarbeiter einloggen<p>
			    	<form action="" method="POST">
			    		<div class="  form-group">
			    			<label >Username:</label><br>
			    		    <input type="text" name="username" value=""><br>
			    		    <span class="text-danger"><?php echo htmlspecialchars($errors['username']); ?></span>
			    		</div>
			    		<div class=" form-group">
			    			<label >Password:</label><br>
			    		    <input type="text" name="password" value=""><br>
			    		    <span class="text-danger"><?php echo htmlspecialchars($errors['password']); ?></span>
			    		</div>
			    		<div class="form-group">
			    			<span class="text-danger"><?php echo htmlspecialchars($errors['login_err']); ?></span><br>
			    			<input type="submit" name="login" value="Login">
			    		</div>
			    		<p>Noch kein Konto?<a href="sign.php">Sign-up now</a></p>
			    	</form>
			    </div>
			</div>
			
		</div>
	</div>


	<?php include('templates/footer.php');?>


</html>