<?php
// Declare PHPMailer at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "conn/conn.php";
error_reporting(0);
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
	<?php include "layout/top_public.php";?>
  
  
	
	
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">

        <?php
            
            //display above form
            //get user details based on reset token bsent to user email
							$resetToken = $_GET['resetToken'];
							$sql = mysqli_query($conn, "SELECT * FROM login WHERE reset_token = '$resetToken'");
							$row = mysqli_fetch_array($sql);
              $numRow = mysqli_num_rows($sql);

              //echo "bill row: " . $numRow;

              
              //if reset token valid
              if($numRow > 0)
              {
                $displayResetForm = "yes";
              }
              else
              {
                  $displayResetForm = "no";
              }

              //echo "reset form : " . $displayResetForm;

                //display reset form for reset token not equal to null
                if($displayResetForm == "no")
                {
                  //display alert and redirect user to login page.
                  echo "<script>alert('Sorry. Reset Token already being used.'); window.location = 'login.php';</script>";
                 
                }
                else if($displayResetForm == "yes")
                {

            ?>
		
          <div class="col-lg-4 mx-auto" style="padding-top:100px;">
		  
            <div class="auto-form-wrapper">

            
			<h1 class="display-3 text-bold-500 text-success text-center">M D S</h1>
			<p class="text-center">Malware Detection System</p>
			<hr />
			<?php
							if (isset($_POST['resetpswrd']))
							{
								//post user data
								$user_id = $_POST['user_id'];
								$password = $_POST['password'];
								$cpassword = $_POST['cpassword'];
								
                //if password and confirmation match, reset password to new password and reset token to null.
								if($password == $cpassword)
								{
									//reset to new password
									$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
									$sql = mysqli_query($conn, "UPDATE login SET password = '$hashedPassword' WHERE user_id = '$user_id'");
									
									//update reset token to null.. let say reset token reset to null... if user click again same emaail, the reset token will be invalid.
									$sqlUpdate = mysqli_query($conn, "UPDATE login SET reset_token = NULL WHERE user_id = '$user_id'");
									
                  //redirect user to login page.
									echo "<script>alert('Thank you! Your password successfully reset. You may login now.'); window.location = 'login.php';</script>";

								}
								else
								{
									echo "<div class='alert alert-danger alert-dismissible'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<strong>Sorry!</strong> new password and password confirmation does not match.
											</div>";
								}
							}
							
							
							

			?>
              <form id="myForm" method="post">
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>" placeholder="Username" readonly />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-account-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">New Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" placeholder="*********" required />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-textbox-password"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password Confirmation</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="cpassword" placeholder="*********" required />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-textbox-password"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="resetpswrd" class="btn btn-success submit-btn btn-block">Reset Password</button>
                </div>
				<p class="text-center">
					<small>Already registered? <a href="index.php">Login</a></small><br />
					<small>© 2024 <a href="#">MDS</a>. All rights reserved.</small>
				</p>
              </form>

              <?php
              }
              
              ?>
			  
		
            </div>
            <br />
			 
          </div>
        </div>
		

      </div>
      <!-- content-wrapper ends -->

    </div>
    <!-- page-body-wrapper ends -->
	
  </div>
  <!-- container-scroller -->
        <!-- partial:partials/_footer.html -->
		<?php include "layout/footer.php";?>
  <!-- plugins:js -->
  <!-- SCRIPT -->
   <?php include "layout/script.php";?>
</body>

</html>
<?php
}
?>