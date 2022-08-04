<?php 

  include('config/db_connect.php');

  

  if (isset($_GET['id'])){

  	$id = mysqli_real_escape_string($conn, $_GET['id']);

  	$sql = "SELECT * FROM adac_kunden WHERE id = $id";

  	$result = mysqli_query($conn, $sql);

  	$kunde = mysqli_fetch_assoc($result);

  	mysqli_free_result($result);
  	mysqli_close($conn);


  }

  if (isset($_POST['delete'])){
     
     $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

     $sql = "DELETE FROM adac_kunden WHERE id = $id_to_delete";

     if(mysqli_query($conn, $sql)){
     	//success
     	header('Location: kunde.php');
     }else{
     	//failure
     	echo 'query error: '.mysqli_error($conn);
     }


  }

 

?>

<html >
   <?php include('templates/header.php'); ?>

   <div class="container text-center text-muted m-2">
   	  <?php if ($kunde): ?>

   	  	<h4>Versicherungsinformationen</h4>
   	  	<p>Nachname:  <?php echo htmlspecialchars($kunde['nachname']); ?></p>
   	  	<p>Vorname:  <?php echo htmlspecialchars($kunde['vorname']); ?></p>
   	  	<p>Geschlecht:  <?php echo htmlspecialchars($kunde['geschlecht']); ?></p>
   	  	<p>Geburtsdatum:  <?php echo htmlspecialchars($kunde['geburtsdatum']); ?></p>
   	  	<p>E-mail:  <?php echo htmlspecialchars($kunde['email']); ?></p>
   	  	<p>Anschrift:  <?php echo htmlspecialchars($kunde['nachname']); ?></p>
   	  	<p>Postleitzahl:  <?php echo htmlspecialchars($kunde['postleitzahl'].' in '.$kunde['stadt']); ?></p>
   	  	<p>Versicherungsart:  <?php echo htmlspecialchars($kunde['versicherungsart']); ?></p>
   	  	<p>Erstellt am:  <?php echo htmlspecialchars($kunde['created_at']); ?></p>

   	  	<form action="details.php" method="POST">
   	  		<input type="hidden" name="id_to_delete" value="<?php echo $kunde['id']; ?>">
   	  		<input type="submit" name="delete" value="delete" class="btn btn-danger">
   	  	</form>




   	  <?php else: ?>

   	  	<h5>Keine Informationen zu der Kunde!</h5>

   	  <?php endif; ?>	
   	   
   </div>
	
   <?php include('templates/footer.php');?>

</html>