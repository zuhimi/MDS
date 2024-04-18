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
						
						//post data
						$about_id = $_POST['about_id'];
						$description = htmlspecialchars($_POST['description'], ENT_QUOTES);
						
						$file_location 	= $_FILES['image']['tmp_name'];
						$file_type		= $_FILES['image']['type'];
						$file_name		= $_FILES['image']['name'];
						
						if (empty($file_location))
						{
							$sql = mysqli_query($conn, "UPDATE about SET description = '$description'
																	WHERE about_id = '$about_id'");
						}
						else
						{
							//move uploaded file to folder image
							move_uploaded_file($file_location,"images/$file_name");
							
							$sql = mysqli_query($conn, "UPDATE about SET description = '$description',
																	image = '$file_name'
																	WHERE about_id = '$about_id'");
						}
						
						if($sql == true)
						{
							
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> About us page successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
						
					}
					
					//get about details
					$sql = mysqli_query($conn, "SELECT * FROM about");
					$row = mysqli_fetch_array($sql);

				?>
              <div class="card">
                <div class="card-body">
                  <p class="card-description text-success">
                      <i class="mdi mdi-settings"></i> Setting About<br />
					  <small class="text-muted">Change any necessary details for about page</small>
                  </p>
                  <hr />
                  <form method="post" enctype="multipart/form-data">
					<input type="hidden" class="form-control" name="about_id" value="<?php echo $row['about_id']; ?>" readonly />
					
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Image <span class="badge badge-warning">(if necessary)</span></label> 
								<input type="file" class="form-control" name="image" placeholder="New Image" /><br />
								<img src="images/<?php echo $row['image']; ?>" class="img-fluid" alt="about us image" />
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" name="description" rows="43" placeholder="Write some description for about page here..." required><?php echo $row['description']; ?></textarea>
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