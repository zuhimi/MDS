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
            
            
           
            
            
            <div class="col-12 grid-margin">
			<?php
					
					if (isset($_POST['submit']))
					{
						
						$username = $_POST['username'];
						$first_name = $_POST['first_name'];
						$last_name = $_POST['last_name'];
						$gender_id = $_POST['gender_id'];
						$email = $_POST['email'];
						$phone_num = $_POST['phone_num'];
						$address = $_POST['address'];
						
						
						$file_location 	= $_FILES['photo']['tmp_name'];
						$file_type		= $_FILES['photo']['type'];
						$file_name		= $_FILES['photo']['name'];
						
						if (empty($file_location))
						{
							$sql = mysqli_query($conn, "UPDATE member SET first_name = '$first_name',
																	last_name = '$last_name',
																	gender_id = '$gender_id',
																	email = '$email',
																	phone_num = '$phone_num',
																	address = '$address'
																	WHERE username = '$username'");
						}
						else
						{
							move_uploaded_file($file_location,"photo/$file_name");
							
							$sql = mysqli_query($conn, "UPDATE member SET first_name = '$first_name',
																	last_name = '$last_name',
																	gender_id = '$gender_id',
																	email = '$email',
																	phone_num = '$phone_num',
																	address = '$address',
																	photo = '$file_name'
																	WHERE username = '$username'");
							
						}							
						
						if($sql == true)
						{
							echo "<script>window.location = 'profile_member.php?code=display';</script>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					$code = $_GET['code'];
					if($code == "display")
					{
						echo "<div class='alert alert-success alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Thank you!</strong> Your account is successfully updated.
							</div>";
					}
					
					$sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '$_SESSION[user_id]'");
					$row = mysqli_fetch_array($sql);
					
					
					

			?>
              <div class="card">
                <div class="card-body">
                  <p class="card-description text-success">
                      <i class="mdi mdi-account"></i> Update Your Profile<br />
					  <small class="text-muted">Update your profile if necessary.</small>
                  </p>
                  <hr />

                  <form method="post" enctype="multipart/form-data">
					
                    <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Member ID</label>
								<input type="text" id="username" class="form-control" placeholder="Member ID" name="username" value="<?php echo $row['username']; ?>" readonly />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" id="first_name" class="form-control" placeholder="Member First Name" name="first_name" value="<?php echo $row['first_name']; ?>" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" id="last_name" class="form-control" placeholder="Member Last Name" name="last_name" value="<?php echo $row['last_name']; ?>" required />
							</div>
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-md-3">
							<div class="form-group">
								<label>Gender</label>
								<select id="gender_id" class="form-control" name="gender_id" required />
									<option value="">- choose gender -</option>
									<?php
										$sqlG = mysqli_query($conn, "SELECT * FROM gender");
										while($rowG = mysqli_fetch_array($sqlG))
										{
											if($rowG['gender_id'] == $row['gender_id'])
												echo "<option value='$rowG[gender_id]' selected>$rowG[gender]</option>";
											else 
												echo "<option value='$rowG[gender_id]'>$rowG[gender]</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Phone No.</label>
								<input type="text" id="phone_num" class="form-control" placeholder="Mobile Phone No." name="phone_num" value="<?php echo $row['phone_num']; ?>" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email" class="form-control" placeholder="Email address" name="email" value="<?php echo $row['email']; ?>" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>New Photo <span class="text-warning">(optional)</span></label>
								<input type="file" class="form-control" name="photo" placeholder="Photo" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Address</label>
								<textarea id="address" class="form-control" rows="5" placeholder="Your address..." name="address" required><?php echo $row['address']; ?></textarea>
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