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
			
			<div class="row">
            
			 
			 <div class="col-12 grid-margin">
			  
			  
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-success">List of FAQ</h4>
				  
                    
					  <?php
					  
						$bil = 1;
						$sql = mysqli_query($conn, "SELECT * FROM faq ORDER BY faq_id ASC");
						while($row = mysqli_fetch_array($sql))
						{
							echo "
									<small class='text-success'>$bil. $row[question]</small><br />
									<small>$row[answer]</medium><br /><br />";
							
							$bil++;
						}
					  ?>
                  
                
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