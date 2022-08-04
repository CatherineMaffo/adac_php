<?php  

  include('config/db_connect.php');

  session_start();
   $user = $_SESSION['login_user'];

   


   // write query from all Kunden
   $sql = 'SELECT nachname,vorname,geburtsdatum,versicherungsart,image,id FROM adac_kunden ORDER BY nachname ';

   //make query and get result
   $result = mysqli_query($conn,$sql);

   //  fetch the resulting array
   $kunden = mysqli_fetch_all($result, MYSQLI_ASSOC);

   // free result from memory
   mysqli_free_result($result);

   //close connection
   mysqli_close($conn);


?>


<html >

   <?php include('templates/header.php'); ?>

   <div class="container text-center m-0">
   	<div class="user d-flex flex-row justify-content-between">
   		<h4 class="">Hello <?php echo htmlspecialchars($user) ?> </h4>
   		<a href="add.php" > Add a new Kunde</a>
   	</div>
   	<div class="row">
   		<?php foreach ($kunden as $kunde){?>	
   			<div class="col-6 mx-auto">
   			<div class="card ">
          <div class="image">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($kunde['image']) ;?>"/>
          </div>
   				<div class="card-content ">
   					<h6><?php echo htmlspecialchars($kunde['nachname']); ?></h6>
   					<h6><?php echo htmlspecialchars($kunde['vorname']); ?></h6>
   					<h6><?php echo htmlspecialchars($kunde['geburtsdatum']); ?></h6>
   					<h5><?php echo htmlspecialchars($kunde['versicherungsart']); ?></h5>

   				</div>
   				<div class="card-action text-end m-2">
   					<a href="details.php?id=<?php echo $kunde['id'] ?>">more infos</a>
   				</div>
   			</div>
   		</div>
   		<?php } ?>
   		
   	</div>
   </div>

	
   <?php include('templates/footer.php'); ?>	

</html>