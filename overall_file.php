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
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				  <p class='card-description text-success'>
					<i class='mdi mdi-table-large'></i> List of Overall File(s)
				  </p>
				  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th># ID</th>
                          <th>Upload Date</th>
                          <th>Uploader</th>
                          <th>Title</th>
                          <th>Extension</th>
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
							
						$sql = mysqli_query($conn, "SELECT * FROM file ORDER BY upload_date DESC");
						while($row = mysqli_fetch_array($sql))
						{
							$uploadDateString = str_replace('-', '/', $row['upload_date']);
							$uploadDateStringFormat = date('d/m/Y', strtotime($uploadDateString));
							
							//highlight Status
							if($row['status'] == "Safe")
							{
								$status = "<span class='badge badge-success'>$row[status]</span>";
							}
							else if($row['status'] == "Malware")
							{ 	
								$status = "<span class='badge badge-danger'>$row[status]</span>";
							}
							
							echo "<tr>
									<td>
										<a href='result_details.php?file_id=$row[file_id]&title=$row[title]'>
											<span class='badge badge-success'>
												$row[file_id]
											</span>
										</a>
									</td>
									<td>$uploadDateStringFormat</td>
									<td>$row[uploader]</td>
									<td>$row[title]</td>
									<td>.$row[extension]</td>
									<td>$status</td>
									</tr>";
						
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