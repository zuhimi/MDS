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
<style type="text/css">
	@media print
	{
		body {
			visibility: hidden;
		}
		button, a {
			display: none !important;
		}
		.noprint {
			display: none !important;
		}
		.visible {
			visibility: visible;
			position: absolute;
			top: 50px;
			left: 10px;
		}
	}
	</style>
	
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
              <div class="card">
                <div class="card-body">
					<p class="card-description text-success">
                      <i class="mdi mdi-chart-bar"></i> Scanned File(s) Graph Report<br />
					  <small class="text-muted">Generate Scanned File(s) Graph Report</small>
                    </p>
					<hr />

                  <form method="post" enctype="multipart/form-data">
                    
					
                    <div class="row">
					  
					  <div class="col-md-4">
						<div class="form-group">
							<label>Year</label>
							<select class='form-control' style="width: 100%;" name='year' required>
								<option value="">- choose year -</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
								<option value="2027">2027</option>
								<option value="2028">2028</option>
								<option value="2029">2029</option>
								<option value="2030">2030</option>
							</select>
						</div>
                      </div>
                    </div>
                    
                   
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="generate" class="btn btn-success mr-2"><i class="mdi mdi-check"></i> Generate</button>
                  </form>
				  
				  <?php
						if(isset($_POST['generate']))
						{
							$year = $_POST['year'];
							
							/* calculate total scanned files */
							$sqlM1 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '1'
																			AND YEAR(upload_date) = '$year'");

							$rowM1 = mysqli_fetch_array($sqlM1);
							
							$sqlM2 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '2'
																			AND YEAR(upload_date) = '$year'");
							$rowM2 = mysqli_fetch_array($sqlM2);
							
							
							$sqlM3 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '3'
																			AND YEAR(upload_date) = '$year'");
							$rowM3 = mysqli_fetch_array($sqlM3);
							
							
							$sqlM4 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '4'
																			AND YEAR(upload_date) = '$year'");
							$rowM4 = mysqli_fetch_array($sqlM4);
							
							
							$sqlM5 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '5'
																			AND YEAR(upload_date) = '$year'");
							$rowM5 = mysqli_fetch_array($sqlM5);
							
							
							
							$sqlM6 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '6'
																			AND YEAR(upload_date) = '$year'");
							$rowM6 = mysqli_fetch_array($sqlM6);
							
							
							
							$sqlM7 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '7'
																			AND YEAR(upload_date) = '$year'");
							$rowM7 = mysqli_fetch_array($sqlM7);
							
							
							$sqlM8 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '8'
																			AND YEAR(upload_date) = '$year'");
							$rowM8 = mysqli_fetch_array($sqlM8);
							
							
							$sqlM9 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '9'
																			AND YEAR(upload_date) = '$year'");
							$rowM9 = mysqli_fetch_array($sqlM9);
							
							
							$sqlM10 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '10'
																			AND YEAR(upload_date) = '$year'");
							$rowM10 = mysqli_fetch_array($sqlM10);
							
							
							$sqlM11 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '11'
																			AND YEAR(upload_date) = '$year'");
							$rowM11 = mysqli_fetch_array($sqlM11);
							
							
							
							$sqlM12 = mysqli_query($conn, "SELECT COUNT(*) AS total_scan FROM `file`
																			WHERE MONTH(upload_date) = '12'
																			AND YEAR(upload_date) = '$year'");
							$rowM12 = mysqli_fetch_array($sqlM12);
							
							
							
							/* calculate total safe files */

							$sqlSafe1 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '1'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe1 = mysqli_fetch_array($sqlSafe1);
							
							$sqlSafe2 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '2'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe2 = mysqli_fetch_array($sqlSafe2);
							
							
							$sqlSafe3 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '3'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe3 = mysqli_fetch_array($sqlSafe3);
							
							
							$sqlSafe4 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '4'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe4 = mysqli_fetch_array($sqlSafe4);
							
							
							$sqlSafe5 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '5'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe5 = mysqli_fetch_array($sqlSafe5);
							
							
							
							$sqlSafe6 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '6'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe6 = mysqli_fetch_array($sqlSafe6);
							
							
							
							$sqlSafe7 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '7'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe7 = mysqli_fetch_array($sqlSafe7);
							
							
							$sqlSafe8 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '8'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe8 = mysqli_fetch_array($sqlSafe8);
							
							
							$sqlSafe9 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '9'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe9 = mysqli_fetch_array($sqlSafe9);
							
							
							$sqlSafe10 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '10'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe10 = mysqli_fetch_array($sqlSafe10);
							
							
							$sqlSafe11 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '11'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe11 = mysqli_fetch_array($sqlSafe11);
							
							
							
							$sqlSafe12 = mysqli_query($conn, "SELECT COUNT(*) AS total_safe FROM `file`
																			WHERE MONTH(upload_date) = '12'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Safe'");
							$rowSafe12 = mysqli_fetch_array($sqlSafe12);
							
							/* calculate total detected files */

							$sqlDetect1 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '1'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect1 = mysqli_fetch_array($sqlDetect1);
							
							$sqlDetect2 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '2'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect2 = mysqli_fetch_array($sqlDetect2);
							
							
							$sqlDetect3 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '3'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect3 = mysqli_fetch_array($sqlDetect3);
							
							
							$sqlDetect4 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '4'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect4 = mysqli_fetch_array($sqlDetect4);
							
							
							$sqlDetect5 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '5'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect5 = mysqli_fetch_array($sqlDetect5);
							
							
							
							$sqlDetect6 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '6'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect6 = mysqli_fetch_array($sqlDetect6);
							
							
							
							$sqlDetect7 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '7'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect7 = mysqli_fetch_array($sqlDetect7);
							
							
							$sqlDetect8 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '8'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect8 = mysqli_fetch_array($sqlDetect8);
							
							
							$sqlDetect9 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '9'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect9 = mysqli_fetch_array($sqlDetect9);
							
							
							$sqlDetect10 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '10'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect10 = mysqli_fetch_array($sqlDetect10);
							
							
							$sqlDetect11 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '11'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect11 = mysqli_fetch_array($sqlDetect11);
							
							
							
							$sqlDetect12 = mysqli_query($conn, "SELECT COUNT(*) AS total_detected FROM `file`
																			WHERE MONTH(upload_date) = '12'
																			AND YEAR(upload_date) = '$year'
																			AND status = 'Malware'");
							$rowDetect12 = mysqli_fetch_array($sqlDetect12);
							
							
							
							echo "<hr/>
									<div class='visible'>
										<div class='container'>
											<canvas class='col-md-9 grid-margin stretch-card' id='myChart'></canvas>
										</div>
									</div>";
								
							echo "<div class='container-fluid w-100'>
									  <button type='submit' name='submit' class='btn btn-success float-left mt-4'  onclick='window.print()'>
										<i class='mdi mdi-printer mr-1'></i>Print
										</button>
									</div>";
						}
				?>
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
   <script>
						var ctx = document.getElementById("myChart");
						var myBarChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
								datasets: [{
										label: 'Total Scanned File for Year <?php echo $year; ?> ',
										data: [<?php echo $rowM1['total_scan'] . "," .
															$rowM2['total_scan'] . "," .
															$rowM3['total_scan'] . "," .
															$rowM4['total_scan'] . "," .
															$rowM5['total_scan'] . "," .
															$rowM6['total_scan'] . "," .
															$rowM7['total_scan'] . "," .
															$rowM8['total_scan'] . "," .
															$rowM9['total_scan'] . "," .
															$rowM10['total_scan'] . "," .
															$rowM11['total_scan'] . "," .
															$rowM12['total_scan']; ?>],
										backgroundColor: [
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)'
										],
										borderColor: [
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(255, 206, 86, 1)'
										],
										borderWidth: 1
									},
									{
										label: 'Total Safe File Scanned for Year <?php echo $year; ?> ',
										data: [<?php echo $rowSafe1['total_safe'] . "," .
															$rowSafe2['total_safe'] . "," .
															$rowSafe3['total_safe'] . "," .
															$rowSafe4['total_safe'] . "," .
															$rowSafe5['total_safe'] . "," .
															$rowSafe6['total_safe'] . "," .
															$rowSafe7['total_safe'] . "," .
															$rowSafe8['total_safe'] . "," .
															$rowSafe9['total_safe'] . "," .
															$rowSafe10['total_safe'] . "," .
															$rowSafe11['total_safe'] . "," .
															$rowSafe12['total_safe']; ?>],
										backgroundColor: [
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)'
										],
										borderColor: [
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)',
											'rgba(27, 207, 180, 1)'
										],
										borderWidth: 1
									},
									{
										label: 'Total Detected File Scanned for Year <?php echo $year; ?>',
										data: [<?php echo $rowDetect1['total_detected'] . "," .
															$rowDetect2['total_detected'] . "," .
															$rowDetect3['total_detected'] . "," .
															$rowDetect4['total_detected'] . "," .
															$rowDetect5['total_detected'] . "," .
															$rowDetect6['total_detected'] . "," .
															$rowDetect7['total_detected'] . "," .
															$rowDetect8['total_detected'] . "," .
															$rowDetect9['total_detected'] . "," .
															$rowDetect10['total_detected'] . "," .
															$rowDetect11['total_detected'] . "," .
															$rowDetect12['total_detected']; ?>],
										backgroundColor: [
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)'
										],
										borderColor: [
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)',
											'rgba(230, 82, 81, 1)'
										],
										borderWidth: 1
									}]
							},
							options: {
								scales: {
									yAxes: [{
											ticks: {
												beginAtZero: true
											}
										}]
								}
							}
						});
					</script>
</body>

</html>
<?php
}
?>