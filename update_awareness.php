<?php
include "conn/conn.php";
error_reporting(1);
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
			
					date_default_timezone_set("Asia/Kuala_Lumpur");
					$today = date("Y-m-d");
					
					if (isset($_POST['submit']))
					{
						$awareness_id = $_POST['awareness_id'];	
						$posted_date = $today;
						$title = $_POST['title'];
						$awareness = htmlspecialchars($_POST['awareness'], ENT_QUOTES);
						
						
						$file_location 	= $_FILES['image']['tmp_name'];
						$file_type		= $_FILES['image']['type'];
						$file_name		= $_FILES['image']['name'];
						
						if (empty($file_location))
						{
							$sql = mysqli_query($conn, "UPDATE awareness SET title = '$title',
																		awareness = '$awareness'
																		WHERE awareness_id = '$awareness_id'");
						}
						else
						{
							move_uploaded_file($file_location,"awareness/$file_name");
							
							$sql = mysqli_query($conn, "UPDATE awareness SET title = '$title',
																		awareness = '$awareness',
																		image = '$file_name'
																		WHERE awareness_id = '$awareness_id'");
						}
						
						if($sql == true)
						{
							
							echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Awareness details successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					$awareness_id = $_GET['awareness_id'];
					$sql = mysqli_query($conn, "SELECT * FROM awareness WHERE awareness_id = '$awareness_id'");
					$row = mysqli_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" class="form-control" name="awareness_id" value="<?php echo $row['awareness_id']; ?>" placeholder="Awareness ID" readonly />
					<p class="card-description text-success">
                      <i class="mdi mdi-message-text"></i> Update Awareness<br />
					  <small class="text-muted">Update awareness details</small>
                    </p>
					
					<hr />
					
                    <div class="row">
					  <div class="col-md-6">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" placeholder="Title" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>New Related Image <span class="text-warning">(if necessary)</span></label>
							<input type="file" class="form-control" style='padding-top:4px; padding-bottm:4px'  name="image" placeholder="Image" />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Awareness</label>
							<textarea class="form-control" name="awareness" rows="10" placeholder="Write awareness details here..." required><?php echo $row['awareness']; ?></textarea>
						</div>
                      </div>
                    </div>
                   
                    
                    <br />
                    <a href="manage_awareness.php" class="btn btn-outline-dark">
						<i class="mdi mdi-keyboard-backspace"></i> Back
					</a>
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