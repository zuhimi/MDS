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
						$posted_date = $today;
						$title = $_POST['title'];
						$awareness = htmlspecialchars($_POST['awareness'], ENT_QUOTES);
						
						
						$file_location 	= $_FILES['image']['tmp_name'];
						$file_type		= $_FILES['image']['type'];
						$file_name		= $_FILES['image']['name'];
						
						move_uploaded_file($file_location,"awareness/$file_name");
						
						$sql = mysqli_query($conn, "INSERT INTO awareness (posted_date, title, awareness, image)
																	VALUES ('$posted_date', '$title', '$awareness', '$file_name')");
															
						if($sql == true)
						{
							$title = "";
							$awareness = "";
							
							echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> New awareness successfully posted.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}

			?>
              <div class="card">
                <div class="card-body">

                  <form method="post" enctype="multipart/form-data">
					<p class="card-description text-success">
                      <i class="mdi mdi-message-text"></i> Post Awareness<br />
					  <small class="text-muted">Fill in awareness details</small>
                    </p>
					
					<hr />
					
                    <div class="row">
					  <div class="col-md-6">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="title" value="<?php echo $title; ?>" placeholder="Title" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Related Image</label>
							<input type="file" class="form-control" style='padding-top:4px; padding-bottm:4px' name="image" placeholder="Related Image" required />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Awareness</label>
							<textarea class="form-control" name="awareness" rows="10" placeholder="Write awareness details here..." required><?php echo $awareness; ?></textarea>
						</div>
                      </div>
                    </div>
                   
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-success mr-2"><i class="mdi mdi-check"></i> Post</button>
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