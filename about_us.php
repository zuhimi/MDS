<?php
include "conn/conn.php";
error_reporting(2);
session_start();

if (!empty($_SESSION['user_id']) AND !empty($_SESSION['password']))
{
  header('location:dashboard.php');
}
else
{
	
?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "layout/head.php";?>

<body>
  <div class="container-scroller">
  
    <!-- partial:partials/_navbar.html -->

	<?php include "layout/top_public.php"; ?>
	
    
      
      <!-- partial -->
	  <div class="container-fluid page-body-wrapper">
      <div class="main-panel" style="width: 100%;">
        <div class="content-wrapper">
			
			<?php
			
				//get about details
				$sql = mysqli_query($conn, "SELECT * FROM about");
				$row = mysqli_fetch_array($sql);
			
			?>
			
			<div class="row">
				 
				<div class="col-md-4 grid-margin stretch-card">
				  <div class="card">
						<img class="card-img-top" src="images/<?php echo $row['image']; ?>" alt="about">
				  </div>
				</div>	
				
			  <div class="col-md-8 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
					  <h1 class="display-5 text-success">About MDS</h1><br />
					  <textarea class="form-control" name="description" rows="40" required><?php echo $row['description']; ?></textarea>
					</div>
				  </div>
				</div>	  
            
          </div>
			
			
		
         
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
		<?php include "layout/footer.php";?>
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  
   <!-- SCRIPT -->
   <?php include "layout/script.php";?>

</body>

</html>
<?php
}
?>