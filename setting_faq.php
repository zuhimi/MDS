<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION['user_id']) AND empty($_SESSION['password']))
{
  header('location:index.php');
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
    <!-- partial:../../partials/_navbar.html -->
    <?php include "layout/top.php";?>
	
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
		

          <div class="row">
			 
			 <div class="col-12 grid-margin">
			  
            
			<?php
			
				//include modal add FAQ
				include("modal_add_faq.php");
				
				$act=$_GET['act'];

				if ($act=='del')
				{
					$faq_id =  $_GET['faq_id'];
					$question =  $_GET['question'];
					
					$sql = mysqli_query($conn, "DELETE FROM faq WHERE faq_id = '$faq_id'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> FAQ for Question $question successfully removed.
									</div>";
					}
						
				}
			?>
			  
              <div class="card">
                <div class="card-body">
                  
				  <div class="row">
						<div class="col">
							<p class="card-description text-success">
							  <i class="mdi mdi-settings"></i> Setting FAQ<br />
							  <small class="text-muted">Add or Manage FAQ details</small>
						  </p>
						</div>
						<div class="col-auto">
							<a href='#' data-toggle='modal' data-target='#addFAQ'
								class="btn btn-success mr-2">
								<i class="mdi mdi-plus"></i>
								Add New FAQ
							</a>
						</div>
				  </div>
				  
                  <div class="table-responsive">
                    <table id="datatable" class="table" role="grid">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Question & Answer</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
						
						$bil = 1;
						$sql = mysqli_query($conn, "SELECT * FROM faq ORDER BY faq_id ASC");
						while($row = mysqli_fetch_array($sql))
						{

							echo "<tr>	
									<td class='py-1 text-success'>$bil</td>
									<td>
										<span class='text-success'>Q: $row[question]</span><br />
										A: $row[answer]
									</td>
									<td>
										<a href='#'  data-toggle='modal'
											data-target='#updateFAQ$row[faq_id]'>
											<i class='mdi mdi-lead-pencil text-success' style='font-size:18px;'></i>
										</a>
										<a href='setting_faq.php?act=del&faq_id=$row[faq_id]&question=$row[question]'
											data-toggle='tooltip' data-placement='left' title='Remove'
											onclick=\"return confirm('Are you sure you want to remove FAQ for Question $row[question]?');\">
											<i class='mdi mdi-delete text-danger' style='font-size:18px;'></i>
										</a>
									</td>
									</tr>";
						
							include("modal_update_faq.php");
							
							$bil++;
						}
					  ?>
                        
                      </tbody>
                    </table>
                  </div>
                
                </div>
              </div>
            </div>
          
			 
          </div>
		  
		  
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include "layout/footer.php";?>
		
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- SCRIPT -->
   <?php include "layout/script.php";?>
</body>

</html>
<?php
}
?>