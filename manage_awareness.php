<?php
include "conn/conn.php";
error_reporting(1);
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
		<?php
			
				$code=$_GET['code'];
				$act=$_GET['act'];

				if ($act=='del')
				{
					$awareness_id =  $_GET['awareness_id'];
					
					$delete = mysqli_query($conn, "DELETE FROM awareness WHERE awareness_id = '$awareness_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Awareness details successfully updated.
							</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				  <p class='card-description text-success'>
					<i class='mdi mdi-table-large'></i> List of Awareness
				  </p>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Posted Date</th>
                          <th>Title</th>
                          <th>View</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysqli_query($conn, "SELECT * FROM awareness");
						while($row = mysqli_fetch_array($sql))
						{
							$tarikhString = str_replace('-', '/', $row['posted_date']);
							$tarikhStringFormat = date('d/m/Y', strtotime($tarikhString));
			
							
							echo "<tr>
									<td class='py-1'><img src='awareness/$row[image]' /></td>
									<td>$tarikhStringFormat</td>
									<td>$row[title]</td>
									<td>
										<a href='#'  data-toggle='modal'
											data-target='#details$row[awareness_id]'>
											<i class='mdi mdi-eye text-warning' style='font-size: 18px;'></i>
										</a>
									</td>
									<td>
										<a href='update_awareness.php?awareness_id=$row[awareness_id]'
											data-toggle='tooltip' data-placement='left' title='Update'>
											<i class='mdi mdi-lead-pencil text-success' style='font-size: 18px;'></i>
										</a>
										<a href='manage_awareness.php?act=del&awareness_id=$row[awareness_id]'
											data-toggle='tooltip' data-placement='left' title='Remove'
											onclick=\"return confirm('Are you sure you want to remove awareness $row[title] ?');\">
											<i class='mdi mdi-delete text-danger' style='font-size: 18px;'></i>
										</a>
									</td>
									</tr>";
						
							include "modal_awareness.php";
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