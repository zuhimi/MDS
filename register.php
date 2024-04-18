<?php
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
		
          <div class="col-lg-7 mx-auto">
		  
            <div class="auto-form-wrapper" style="margin-top: 90px;">
			<h1 class="display-3 text-bold-500 text-success text-center">M D S</h1>
			<p class="text-center">Malware Detection System</p>
			<hr />
			<?php
									$username = "";
									if (isset($_POST['register']))
									{
										$username = $_POST['username'];
										$first_name = $_POST['first_name'];
										$last_name = $_POST['last_name'];
										$gender_id = $_POST['gender_id'];
										$phone_num = $_POST['phone_num'];
										$email = $_POST['email'];
										$address = $_POST['address'];
										
										$password = $_POST['password'];
										$cpassword = $_POST['cpassword'];
										
										if($password != $cpassword)
										{
											echo "<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry!</strong> password does not match.
												</div>";
										}
										else
										{			

											$hashedPassword = password_hash($password, PASSWORD_DEFAULT);	
				
											$addLogin = mysqli_query($conn, "INSERT INTO login (user_id, password, level)
																				VALUES ('$username', '$hashedPassword', '2')");
										
											if($addLogin == true)
											{
												$file_location 	= $_FILES['photo']['tmp_name'];
												$file_type		= $_FILES['photo']['type'];
												$file_name		= $_FILES['photo']['name'];
												
												move_uploaded_file($file_location,"photo/$file_name");
						
												$addMember = mysqli_query($conn, "INSERT INTO member (username,
																								first_name,
																								last_name,
																								gender_id,
																								phone_num,
																								email,
																								address,
																								photo)
																						VALUES ('$username',
																								'$first_name',
																								'$last_name',
																								'$gender_id',
																								'$phone_num',
																								'$email',
																								'$address',
																								'$file_name')");
																				
												
												if($addMember == true)
												{
													$username = "";
													$first_name = "";
													$last_name = "";
													$gender_id = "";
													$phone_num = "";
													$email = "";
													$address = "";
													$password = "";
													$cpassword = "";
													
													echo "<div class='alert alert-success alert-dismissible'>
																<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																<strong>Thank you!</strong> You may login now.
															</div>";
												}
												
											}
											else
												echo "<div class='alert alert-danger alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Sorry!</strong> Username $username already being used.
													</div>";
											
													
											
										}
										
									}

			?>
              <form method="post" enctype="multipart/form-data">
				<div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <div class="col-sm-12">
								<label class="label">Username</label>
								<div class="input-group">
								<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Username" required />
								<div class="input-group-append">
								  <span class="input-group-text">
									<i class="mdi mdi-account-outline"></i>
								  </span>
								</div>
							  </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label class="label">Password</label>
							  <div class="input-group">
								<input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="*********" required />
								<div class="input-group-append">
								  <span class="input-group-text">
									<i class="mdi mdi-textbox-password"></i>
								  </span>
								</div>
							  </div>
                            </div>
                          </div>
                        </div>
						<div class="col-md-4">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label class="label">Password Confirmation</label>
							  <div class="input-group">
								<input type="password" class="form-control" name="cpassword" value="<?php echo $cpassword; ?>" placeholder="*********" required />
								<div class="input-group-append">
								  <span class="input-group-text">
									<i class="mdi mdi-textbox-password"></i>
								  </span>
								</div>
							  </div>
                            </div>
                          </div>
                        </div>
                 </div>
				 
				 <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
								<label class="label">First Name</label>
								  <div class="input-group">
									<input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" placeholder="First Name" required />
									<div class="input-group-append">
									  <span class="input-group-text">
										<i class="mdi mdi-account-box-outline"></i>
									  </span>
									</div>
								  </div>
                            </div>
                          </div>
                        </div>
						<div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
								<label class="label">Last Name</label>
								  <div class="input-group">
									<input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name" required />
									<div class="input-group-append">
									  <span class="input-group-text">
										<i class="mdi mdi-account-box-outline"></i>
									  </span>
									</div>
								  </div>
                            </div>
                          </div>
                        </div>
                 </div>
				 
				 <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
								<label class="label">Gender</label>
								  <div class="input-group">
									<select class="form-control" style="height: calc(2.25rem + 8px);" name="gender_id" required />
											<option value="">- choose -</option>
											<?php
												$sqlGender = mysqli_query($conn, "SELECT * FROM gender");
												while($rowGender = mysqli_fetch_array($sqlGender))
												{
													if($rowGender['gender_id'] == $gender_id)
														echo "<option value='$rowGender[gender_id]' selected>$rowGender[gender]</option>";
													else
														echo "<option value='$rowGender[gender_id]'>$rowGender[gender]</option>";
												}
											?>
									</select>
									<div class="input-group-append">
									  <span class="input-group-text">
										<i class="mdi mdi-gender-male-female"></i>
									  </span>
									</div>
								  </div>
                            </div>
                          </div>
                        </div>
						<div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label class="label">Phone No.</label>
							  <div class="input-group">
								<input type="text" class="form-control" name="phone_num" value="<?php echo $phone_num; ?>" placeholder="Phone No." required />
								<div class="input-group-append">
								  <span class="input-group-text">
									<i class="mdi mdi-cellphone"></i>
								  </span>
								</div>
							  </div>
                            </div>
                          </div>
                        </div>
                 </div>
				 
				 <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
								<label class="label">Email</label>
								  <div class="input-group">
									<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email" required />
									<div class="input-group-append">
									  <span class="input-group-text">
										<i class="mdi mdi-email"></i>
									  </span>
									</div>
								  </div>
                            </div>
                          </div>
                        </div>
						<div class="col-md-6">
                          <div class="form-group row">
                            <div class="col-sm-12">
                              <label class="label">Picture</label>
							  <div class="input-group">
								<input type="file" class="form-control" name="photo" value="<?php echo $photo; ?>" placeholder="Photo" required />
								<div class="input-group-append">
								  <span class="input-group-text">
									<i class="mdi mdi-image"></i>
								  </span>
								</div>
							  </div>
                            </div>
                          </div>
                        </div>
                 </div>
				 
				 
				 
				 <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-12">
								<label class="label">Address</label>
								  <div class="input-group">
									<textarea class="form-control" name="address" placeholder="Your address" required><?php echo $address; ?></textarea>
									<div class="input-group-append">
									  <span class="input-group-text">
										<i class="mdi mdi-map-marker-multiple"></i>
									  </span>
									</div>
								  </div>
                            </div>
                          </div>
                        </div>
				 </div>
					  
               
                <div class="form-group">
                  <button type="submit" name="register" class="btn btn-success submit-btn btn-block">Register</button>
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
  <!-- plugins:js -->
  <!-- SCRIPT -->
   <?php include "layout/script.php";?>
</body>

</html>
<?php
}
?>