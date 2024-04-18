<?php
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
			
			if (isset($_POST['login']))
			{
				
				//post data user id and password
				$user_id = $_POST['user_id'];
				$password = $_POST['password'];

				//authenticate user id and password
				$login = mysqli_query($conn, "SELECT * FROM login WHERE user_id = '$user_id' AND status = 'Active'");
				$success = mysqli_num_rows($login);
				$row = mysqli_fetch_array($login);

				if ($success > 0)
				{
					$hashedPassword = $row["password"];
					
					if (password_verify($password, $hashedPassword))
					{
							session_start();		
					
							$_SESSION['user_id'] = $row['user_id'];
							$_SESSION['password'] = $row['password'];				
							$_SESSION['level'] = $row['level'];	
							
							if($row['level'] == 1)
							{
								$sql = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$row[user_id]'");
								$row = mysqli_fetch_array($sql);
								$_SESSION['level_type'] = "Admin";
							}
							else if($row['level'] == 2)
							{
								$sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '$row[user_id]'");
								$row = mysqli_fetch_array($sql);
								$_SESSION['level_type'] = "Member";
							}
							
							echo "<script>window.location = 'dashboard.php';</script>";

					}
					else
					{
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> Authentication failed.
								</div>";
					}
					
				}
				else
					echo "<div class='alert alert-danger alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Sorry!</strong> Your account id does not valid. Please contact administrator for further details. Thank you.
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
                  <label class="label">Password</label>
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
                  <button type="submit" name="login" class="btn btn-success submit-btn btn-block">Login</button>
                </div>
				<p class="text-center">
					 <small><a href="forgot_password.php">Forgot Password?</a></small><br />
					 <small>New user? <a href="register.php">Sign up today!</a></small><br />
					<small> 2024 <a href="#">© ZUL HILMI </a>. All rights reserved.</small>
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