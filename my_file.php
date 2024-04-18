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
					$file_id =  $_GET['file_id'];
					$file =  $_GET['file'];
					
					$delete = mysqli_query($conn, "DELETE FROM file WHERE file_id = '$file_id'");
					
					//remove deleted file from server
					$uploadedFilePath = "uploads/" . $file;
					unlink($uploadedFilePath);
					
					if($delete == true)
					{
						echo "<script>window.location = 'my_file.php';</script>";
					}
						
				}
				
				
				if(isset($_POST['update']))
				{
					$file_id = $_POST['file_id'];
					$previous_title = $_POST['previous_title'];
					$title = $_POST['title'];
					
					$sql = mysqli_query($conn, "UPDATE file SET title = '$title' WHERE file_id = '$file_id'");
					
					if ($sql == true)
					{
							
							echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
								  <strong>Thank you!</strong> Previous file title <b>$previous_title</b> successfully updated to a new title <b>$title</b>.
								  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								  </button>
								</div>";
					}
				}
				
				

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				  <p class='card-description text-success'>
					<i class='mdi mdi-table-large'></i> List of All Your File(s)
				  </p>
				  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>#ID</th>
                          <th>Upload Date</th>
                          <th>Title</th>
                          <th>File</th>
                          <th>Extension</th>
						  <th>Status</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
							
						$sql = mysqli_query($conn, "SELECT * FROM file WHERE uploader = '$_SESSION[user_id]' ORDER BY file_id ASC");
						while($row = mysqli_fetch_array($sql))
						{
							$uploadDateString = str_replace('-', '/', $row['upload_date']);
							$uploadDateStringFormat = date('d/m/Y', strtotime($uploadDateString));
							
							//highlight Status
							if($row['status'] == "Safe")
							{
								//allow user download back their safe file
								$download = "<a href='download.php?file_id=$row[file_id]'>
												<i class='mdi mdi-cloud-download text-success' style='font-size:22px;'></i>
											</a>";
											
								$status = "<span class='badge badge-success'>$row[status]</span>";
							}
							else if($row['status'] == "Malware")
							{ 	
								//prohibit user to download back their malicious file
								$download = "<a href='#'
												data-toggle='tooltip'
												data-placement='left'
												title='Sorry, our system will not allow member to download back their malicious file for security purpose.'>
												<i class='mdi mdi-cloud-download text-secondary' style='font-size:22px;'></i>
											</a>";
								$status = "<span class='badge badge-danger'>$row[status]</span>";
							}
							
							echo "<tr>
									<td><span class='badge badge-success'>$row[file_id]</span></td>
									<td>$uploadDateStringFormat</td>
									<td>$row[title]</td>
									<td>$download</td>
									<td>.$row[extension]</td>
									<td>$status</td>
									<td>			
										
										<a href='my_file.php?act=del&file_id=$row[file_id]&file=$row[file]'
											data-toggle='tooltip' data-placement='left' title='Remove'
											onclick=\"return confirm('Are you sure you want to remove file $row[title]?');\">
											<i class='mdi mdi-delete text-danger' style='font-size:18px;'></i>
										</a>
									</td>
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