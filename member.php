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
		<?php
		
				$act = $_GET['act'];
				
				
				if ($act=='activate')
				{
					$username =  $_GET['username'];
					
					$sql = mysqli_query($conn, "UPDATE login SET status = 'Active' WHERE user_id = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Member account successfully activated.
									</div>";
					}
						
				}
				else if ($act=='deactivate')
				{
					$username =  $_GET['username'];
					
					$sql = mysqli_query($conn, "UPDATE login SET status = 'Inactive' WHERE user_id = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Member account successfully deactivated.
								</div>";
					}
						
				}
		?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<p class='card-description text-success'>
					<i class='mdi mdi-table-large'></i> List of Member
				</p>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Photo</th>
                          <th>Member</th>
						  <th>Gender</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysqli_query($conn, "SELECT * FROM login l, member s
															WHERE l.user_id = s.username
															AND l.level = 2");
						while($row = mysqli_fetch_array($sql))
						{
							//get gender name
							$sqlG = mysqli_query($conn, "SELECT * FROM gender WHERE gender_id = '$row[gender_id]'");
							$rowG = mysqli_fetch_array($sqlG);
							
							// if status active, admin can click to deactivate cust acc
							if($row['status'] == "Active")
							{
								$displaystatus = "<a href='member.php?act=deactivate&username=$row[username]'
													data-toggle='tooltip' data-placement='right' title='Deactivate'
													onclick=\"return confirm('Are you sure you want to deactivated member $row[first_name] $row[last_name] account?');\">
														<button class='btn btn-success btn-xs'>
															$row[status]
														</button>
													</a>";
							}
							// if inactive or tersilap klik inactivte, can click again to reactivated
							else if($row['status'] == "Inactive")
							{
								$displaystatus = "<a href='member.php?act=activate&username=$row[username]'
													data-toggle='tooltip' data-placement='right' title='Activate'>
														<button class='btn btn-danger btn-xs'>
															$row[status]
														</button>
													</a>";
							}
							

							echo "<tr>	
									<td class='py-1'><img src='photo/$row[photo]' data-toggle='tooltip' data-placement='right' title data-original-title='$row[username]'/></td>
									<td>
										<a href='#'  data-toggle='modal'
											data-target='#details$row[username]'>
											<span class='badge badge-success'>$row[first_name] $row[last_name]<br />$row[username]</span>
										</a>
									</td>
									<td>$row[gender_id]</td>
									<td>$row[phone_num]</td>
									<td>$row[email]</td>
									<td>$displaystatus</td>
									</tr>";
						
							include "modal_member_details.php";
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