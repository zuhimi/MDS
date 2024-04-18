<?php
// Declare PHPMailer at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
	<?php include "layout/top_public.php";?>
  
  
	
	
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
		
          <div class="col-lg-4 mx-auto">
		  
            <div class="auto-form-wrapper">
			<h1 class="display-3 text-bold-500 text-success text-center">M D S</h1>
			<p class="text-center">Malware Detection System</p>
			<hr />
			<?php
							if (isset($_POST['resetpswrd']))
							{
								//cek samada id wujud/tidak
								$user_id = $_POST['user_id'];
								$sqlUser = mysqli_query($conn, "SELECT * FROM login WHERE user_id = '$user_id'");
								$rowUser = mysqli_fetch_array($sqlUser);
								$numRowUser = mysqli_num_rows($sqlUser);
								
								if($numRowUser > 0)
								{
									//kalau user level admin, dapatkan email admin
									if($rowUser['level'] == 1)
									{
										//dapatkan email admin
										$sqlEmail = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$user_id'");
										$rowEmail = mysqli_fetch_array($sqlEmail);
									}
									//kalau user level member, dapatkan email member
									else if($rowUser['level'] == 2)
									{
										//dapatkan email member
										$sqlEmail = mysqli_query($conn, "SELECT * FROM member WHERE username = '$user_id'");
										$rowEmail = mysqli_fetch_array($sqlEmail);
									}
									
									//set to sama dgn email
									$to = $rowEmail['email'];
									
									//date_default_timezone_set('Etc/UTC'); 
									date_default_timezone_set("Asia/Kuala_Lumpur");
									
									// Use PHPMailer
									require 'PHPMailer/src/Exception.php';
									require 'PHPMailer/src/PHPMailer.php';
									require 'PHPMailer/src/SMTP.php';
		
									$mail = new PHPMailer;
									$mail->isSMTP();
									$mail->SMTPDebug = 0;
									$mail->Debugoutput = 'html';
									$mail->Host = 'smtp.hostinger.com';
									$mail->Port = 587;
									$mail->SMTPSecure = 'tls';
									$mail->SMTPAuth = true;
									 
									//your email account user_id
									$mail->Username = "noreply@resetpswrd.online";
									 
									//your email account Password to use for SMTP authentication
									$mail->Password = "Res3tp@swrd";
									 
									//your email account user_id
									$mail->setFrom('noreply@resetpswrd.online', 'MDS');
									 
									//recipient
									$mail->addAddress($to);
									 
									$mail->isHTML(true);  // Set email format to HTML
									
									//generate random token
									$resetToken = bin2hex(random_bytes(16));
									

									//update reset link based on system folder name. (mds.latest ikut nama folder sistem. contoh kalau tukar kepada nama baru,
									// mds.final ganti mds.latest kepada mds.final)
									$bodyContent = "<h1>Reset Password</h1>";
									$bodyContent .= "<p>Click the following link to reset your password. <a href='http://localhost/mds/reset_password.php?resetToken=$resetToken'>Click here to proceed.</a></p>";

									$mail->Subject = '[ MDS - Reset Password ]';
									$mail->Body    = $bodyContent;
									
									if($mail->send())
									{
										//if mail sent, update reset token from user login table
										$sqlUpdate = mysqli_query($conn, "UPDATE login SET reset_token = '$resetToken' WHERE user_id = '$user_id'");
										
										echo "<div class='alert alert-success alert-dismissible'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<strong>Thank you!</strong> The reset password link are sent to your email. Please check your email for verification.
											</div>";
									}
									else
									{
										echo "<div class='alert alert-warning alert-dismissible'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<strong>Sorry!</strong> We can't sent the email reset link because either
												internet connection not connected or the email linked with the user id are not valid.
												Please contact admin for further request. Thank you. 
											</div>";
									}
									
				
									
								}
								else
									echo "<div class='alert alert-danger alert-dismissible'>
												<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
												<strong>Sorry!</strong> User ID $user_id not found in our database.
											</div>";
							}

			?>
              <form id="myForm" method="post">
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="user_id" placeholder="Username" required />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-account-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="resetpswrd" class="btn btn-success submit-btn btn-block">Email Reset Link</button>
                </div>
				<p class="text-center">
					<small>Already registered? <a href="index.php">Login</a></small><br />
					<small>© 2024 <a href="#">MDS</a>. All rights reserved.</small>
				</p>
              </form>
			  
		
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