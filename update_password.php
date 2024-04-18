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
       <?php  include "layout/menu.php"; ?>
	   
	  
	   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            
            
            <div class="col-12 grid-margin">
			<?php
					
					if (isset($_POST['submit']))
					{
						$password = $_POST['password'];
						$cpassword = $_POST['cpassword'];
						
						if($password == $cpassword)
						{
              $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

							$sql = mysqli_query($conn, "UPDATE login SET password = '$hashedPassword' WHERE user_id = '$_SESSION[user_id]'");
							
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Your password successfully updated.
													  </div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> password Mismatch.
																  </div>";
					}
					

			?>
              <div class="card">
                <div class="card-body">
                  <p class="card-description text-success">
                      <i class="mdi mdi-lock"></i> Update Your Password<br />
					  <small class="text-muted">Update your password once in a while.</small>
                  </p>
                  <hr />

                  <form method="post" enctype="multipart/form-data">
					
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="*******" required />
						</div>
                      </div>
                    </div>
                    
                   <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Password Confirmation</label>
							<input type="password" class="form-control" name="cpassword" placeholder="*******" required />
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-success mr-2"><i class="mdi mdi-check"></i> Update</button>
                  </form>
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