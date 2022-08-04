<?php 

   include('config/db_connect.php');


   $nachname = $vorname = $geburtsdatum = $geschlecht = $email = $anschrift = $postleitzahl = $stadt = $versicherungsart = "";

   $errors = array('nachname'=>'', 'vorname'=>'', 'geschlecht'=>'', 'geburtsdatum'=>'', 'anschrift'=>'', 'postleitzahl'=>'', 'stadt'=>'', 'versicherungsart'=>'','email'=>'','image'=>'');


   if (isset($_POST['submit'])){

   	  // check Nachname
       if(empty($_POST['nachname'])){
           $errors['nachname'] = 'A Nachname is required' ;
        }else{
           $nachname = $_POST['nachname'];
           if(!preg_match("/^([a-zA-Z]+)$/",$nachname)){
            $errors['nachname'] = 'Nachname must be letters';
         }
      }

      // check Vorname
     if(empty($_POST['vorname'])){
      $errors['vorname'] = 'A Vorname is required ';
      }else{
         $vorname = $_POST['vorname'];
         if(!preg_match("/^([a-zA-Z]+)$/",$vorname)){
            $errors['vorname'] = 'Vorname must be letters';
         }
      }

      // check Geburtsdatum
     if(empty($_POST['geburtsdatum'])){
      $errors['geburtsdatum'] = 'An Geburtsdatum is required ';
      }else{
         $geburtsdatum = $_POST['geburtsdatum'];
         
      }

      // check Geschlecht
     if(empty($_POST['geschlecht'])){
      $errors['geschlecht'] = 'An Geschlecht is required' ;
      }else{
         $geschlecht = $_POST['geschlecht'];

      }

      // check Email
     if(empty($_POST['email'])){
      $errors['email'] = 'An Email is required' ;
      }else{
         $email = $_POST['email'];
         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address';
         }
      }

      // check Anschrift
     if(empty($_POST['anschrift'])){
      $errors['anschrift'] = 'An Anschrift is required' ;
      }else{
         $anschrift = $_POST['anschrift'];
         if(!preg_match('/^()([a-zA-Z0-9\s]+)$/',$anschrift)){
            $errors['anschrift'] = 'Anschrift must be letters, numbers and spaces only';
         }
      }

      // check Postleitzahl
     if(empty($_POST['postleitzahl'])){
      $errors['postleitzahl'] = 'A Postleitzahl is required' ;
      }else{
         $postleitzahl = $_POST['postleitzahl'];
         if(!preg_match('/^[0-9]+$/',$postleitzahl)){
            $errors['postleitzahl'] = 'Postleitzahl must be numbers and maximal 5';
         }
      }

      // check Stadt
     if(empty($_POST['stadt'])){
      $errors['stadt'] = 'A Stadt is required ';
      }else{
         $vorname = $_POST['stadt'];
         if(!preg_match('/^[a-zA-Z\s]+$/',$stadt)){
            $errors['stadt'] = 'Stadt must be letters';
         }
      }

      // check Versicherungsart
     if(empty($_POST['versicherungsart'])){
      $errors['versicherungsart'] = 'An Versicherungsart is required' ;
      }else{
         $versicherungart = $_POST['versicherungsart'];
      }
      
      if(empty($_FILES['image'])){
         $errors['image'] = 'Please select an image file to upload';
      }else{
         $image = file_get_contents($_FILES['image']['tmp_name']);
      }


      if(array_filter($errors)){
      	// echo 'errors in the form'
      }else{
      	 $nachname = mysqli_real_escape_string($conn, $_POST['nachname']);
      	 $vorname = mysqli_real_escape_string($conn, $_POST['vorname']);
      	 $geburtsdatum = mysqli_real_escape_string($conn, $_POST['geburtsdatum']);
      	 $geschlecht = mysqli_real_escape_string($conn, $_POST['geschlecht']);
      	 $email = mysqli_real_escape_string($conn, $_POST['email']);
      	 $anschrift = mysqli_real_escape_string($conn, $_POST['anschrift']);
      	 $postleitzahl = mysqli_real_escape_string($conn, $_POST['postleitzahl']);
      	 $stadt = mysqli_real_escape_string($conn, $_POST['stadt']);
      	 $versicherungsart = mysqli_real_escape_string($conn, $_POST['versicherungsart']);
          $image =  addslashes(file_get_contents($_FILES['image']['tmp_name']));

      	 //create sql
      	 $sql = "INSERT INTO adac_kunden (nachname,vorname,geburtsdatum,geschlecht,email,anschrift,postleitzahl,stadt,versicherungsart,image) VALUES ('$nachname','$vorname','$geburtsdatum','$geschlecht','$email','$anschrift','$postleitzahl','$stadt','$versicherungsart','$image')";

      	 if(mysqli_query($conn,$sql)){
      	 	//success
      	 	header('Location: kunde.php');
      	 }else{
      	 	echo 'query error: ' .mysqli_error; 
      	 }

      }

   }

 ?>



 <html >
   <?php include('templates/header.php') ?>;
 	
   <section class="container ">
      <h4 class="text-center">Add a Kunde</h4>
      <form action="add.php" method="POST" enctype="multipart/form-data" class="bg-white text-center">
      	<label> Nachname:</label>
      	<input type="text" name="nachname" value="<?php echo htmlspecialchars($nachname) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['nachname']) ?> </div>
      	<label> Vorname:</label>
      	<input type="text" name="vorname" value="<?php echo htmlspecialchars($vorname) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['vorname']) ?> </div>
      	<label> Geburtsdatum:</label>
      	<input type="date" name="geburtsdatum" value="<?php echo htmlspecialchars($geburtsdatum) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['geburtsdatum']) ?> </div>
      	<label> Geschlecht:</label>
      	<select name="geschlecht" id="geschlecht" value	="<?php echo htmlspecialchars($geschlecht) ?>">
      		<option value="männlich">Männlich</option>
      		<option value="weiblich">Weiblich</option>
      	</select>
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['geschlecht']) ?> </div>
      	<label> E-mail:</label>
      	<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['email']) ?> </div>
      	<label> Anschrift:</label>
      	<input type="text" name="anschrift" value="<?php echo htmlspecialchars($anschrift) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['anschrift']) ?> </div>
      	<label> Postleitzahl:</label>
      	<input type="text" name="postleitzahl" value="<?php echo htmlspecialchars($postleitzahl) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['postleitzahl']) ?> </div>
      	<label> Stadt:</label>
      	<input type="text" name="stadt" value="<?php echo htmlspecialchars($stadt) ?>">
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['stadt']) ?> </div>
      	<label> Versicherungsart:</label>
      	<select name="versicherungsart" id="versicherungsart" value = " <?php echo htmlspecialchars($versicherungsart) ?> ">
      		<option value="basis">Basis-versicherung</option>
      		<option value="normal">Normal-versicherung</option>
      		<option value="premium">Premium-versicherung</option>
      	</select>
      	<div class="text-danger"> <?php echo htmlspecialchars($errors['versicherungsart']) ?> </div>
         <label>Image:</label>
         <input type="file" name="image" accept=".png,.gif,.jpg,.webp" required>
         

      	<input type="submit" name="submit" value="submit" class="btn btn-primary">
      	
      </form>	
   </section>
   

   <?php include('templates/footer.php') ?>	;
 
 </html> 

