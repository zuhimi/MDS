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
  
    <!-- partial:partials/_navbar.html -->
	<?php include "layout/top.php";?>
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
	  <?php  include "layout/menu.php"; ?>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
		
		<?php


		date_default_timezone_set("Asia/Kuala_Lumpur");
		$today = date("Y-m-d");

		$todayString = str_replace('-', '/', $today);
		$todayStringFormat = date('d/m/Y', strtotime($todayString));
		
		
		//dashboard admin
		if($_SESSION['level'] == 1) 
		{
			
			//calculate total active member
			$sqlMember = mysqli_query($conn, "SELECT * FROM login l, member m WHERE l.user_id = m.username AND l.status = 'Active'");
			$numRowMember = mysqli_num_rows($sqlMember);
			
			
			//calculate number of scanned files by all member
			$sqlFiles = mysqli_query($conn, "SELECT * FROM file");
			$numRowFiles = mysqli_num_rows($sqlFiles);
			
			//calculate number of safe files scanned by all member
			$sqlSafeFiles = mysqli_query($conn, "SELECT * FROM file WHERE status = 'Safe'");
			$numRowSafeFiles = mysqli_num_rows($sqlSafeFiles);
			
			//calculate number of DETECTED files scanned by all member
			$sqlDetectedFiles = mysqli_query($conn, "SELECT * FROM file WHERE status = 'Malware'");
			$numRowDetectedFiles = mysqli_num_rows($sqlDetectedFiles);
			
							
			echo "<div class='row'>
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-account-circle text-warning icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Member</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowMember</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of Active Member Account.
						  </small>
						</div>
					  </div>
					</div>
					
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-file-find text-primary icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>File</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowFiles</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of Uploaded File(s) scanned by all member.
						  </small>
						</div>
					  </div>
					</div>
					
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-file-check text-success icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Safe</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowSafeFiles</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of Safe File(s) scanned by all member.
						  </small>
						</div>
					  </div>
					</div>
					
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-alert text-danger icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Detected</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowDetectedFiles</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of Detected File(s) scanned by all member.
						  </small>
						</div>
					  </div>
					</div>
					
					
					
				  </div>";
				  
				  echo "<div class='row'>
					<div class='col-lg-12 grid-margin'>
					  <div class='card'>
						<div class='card-body'>
						  <p class='card-description text-success'>
							  <i class='mdi mdi-table-large'></i> List of Scanned File(s) for Today $todayStringFormat
						  </p>
						  <div class='table-responsive'>
							<table id='datatable' class='table dataTable no-footer' role='grid'>
							  <thead>
								<tr>
								  <th>ID #</th>
								  <th>Uploader</th>
								  <th>Title</th>
								  <th>Extension</th>
								  <th>Status</th>
								</tr>
							  </thead>
							  <tbody>";
							  
								//display today files uploaded and scan by all user
								  $sql = mysqli_query($conn, "SELECT * FROM file WHERE upload_date = '$today' ORDER BY upload_date DESC");
								  while($row = mysqli_fetch_array($sql))
									{
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
												<td>$row[uploader]</td>
												<td>$row[title]</td>
												<td>.$row[extension]</td>
												<td>$status</td>
												</tr>";
									
									}
								
							  
								
							 echo"</tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
				  </div>";
				  
		}
		
		// dashboard member
		else if($_SESSION['level'] == 2) 
		{
			
			//calculate number of scanned files
			$sqlFiles = mysqli_query($conn, "SELECT * FROM file WHERE uploader = '$_SESSION[user_id]'");
			$numRowFiles = mysqli_num_rows($sqlFiles);
			
			//calculate number of safe files
			$sqlSafeFiles = mysqli_query($conn, "SELECT * FROM file WHERE status = 'Safe' AND uploader = '$_SESSION[user_id]'");
			$numRowSafeFiles = mysqli_num_rows($sqlSafeFiles);
			
			//calculate number of DETECTED files
			$sqlDetectedFiles = mysqli_query($conn, "SELECT * FROM file WHERE status = 'Malware' AND uploader = '$_SESSION[user_id]'");
			$numRowDetectedFiles = mysqli_num_rows($sqlDetectedFiles);
			
			echo "<div class='row'>
					
					
					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-file-find text-primary icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>File</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowFiles</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of Scanned File(s).
						  </small>
						</div>
					  </div>
					</div>
					
					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-file-check text-success icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Safe</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowSafeFiles</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of Safe File(s).
						  </small>
						</div>
					  </div>
					</div>
					
					<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card'>
					  <div class='card card-statistics'>
						<div class='card-body'>
						  <div class='clearfix'>
							<div class='float-left'>
							  <i class='mdi mdi-alert text-danger icon-lg'></i>
							</div>
							<div class='float-right'>
							  <p class='mb-0 text-right'>Detected</p>
							  <div class='fluid-container'>
								<h3 class='font-weight-medium text-right mb-0'>$numRowDetectedFiles</h3>
							  </div>
							</div>
						  </div>
						  <small class='text-muted mt-3 mb-0'>
							<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Number of File(s) Detected as Malware.
						  </small>
						</div>
					  </div>
					</div>
				</div>";
				
				
				echo "<div class='row'>
					<div class='col-lg-12 grid-margin'>
					  <div class='card'>
						<div class='card-body'>
						  <p class='card-description text-success'>
							  <i class='mdi mdi-table-large'></i> List of All Your Scanned File(s) for Today $todayStringFormat
						  </p>
						  <div class='table-responsive'>
							<table id='datatable' class='table dataTable no-footer' role='grid'>
							  <thead>
								<tr>
								  <th>ID #</th>
								  <th>Title</th>
								  <th>File</th>
								  <th>Extension</th>
								  <th>Status</th>
								</tr>
							  </thead>
							  <tbody>";
							  
								
									
								//display today files
								$sql = mysqli_query($conn, "SELECT * FROM file WHERE uploader = '$_SESSION[user_id]' AND upload_date = '$today' ORDER BY file_id ASC");
								while($row = mysqli_fetch_array($sql))
								{
									//highlight Status
									if($row['status'] == "Safe")
									{
										//allow user download back their safe file
										$download = "<a href='download.php?file_id=$row[file_id]' target='_blank'>
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
											<td>$row[title]</td>
											<td>$download</td>
											<td>.$row[extension]</td>
											<td>$status</td>
											</tr>";
								
								}
								
							  
								
							 echo"</tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
				  </div>";
		}
		
		
	
		?>
          
          
         
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