<?php
include "conn/conn.php";
error_reporting(1);
session_start();
if (!empty($_SESSION['user_id']) AND empty(!$_SESSION['password']))
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
<style>
	
	.carousel-inner > .carousel-item {
	   height: 500px;
	}
	.carousel-caption {
	  top: 8rem;
	  left: 8rem;
	  z-index: 10;
	}
	#loadMore {
		padding-bottom: 30px;
		padding-top: 30px;
		text-align: center;
		width: 100%;
	}
	#loadMore a {
		display: inline-block;
		padding: 10px 30px;
		transition: all 0.25s ease-out;
		-webkit-font-smoothing: antialiased;
	}
	</style>


<body>
  <div class="container-scroller">
  
    <!-- partial:partials/_navbar.html -->
	<?php include "layout/top_public.php";?>
	
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial -->
      <div class="main-panel" style="width: 100%;">
        <div class="content-wrapper">
		<div class="page-header">
              <h5 class="page-title text-white">
			  <span class="page-title-icon text-white mr-2">
                  <i class="mdi mdi-view-grid"></i>
               </span>
			  Welcome to MDS. Your one stop platform for Malware Detection System.
			  </h5>
        </div>
		<div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Carousel indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
					<!-- Wrapper for carousel items -->
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="carousel/slider-1001.jpg" alt="First Slide">
						</div>
						<div class="carousel-item">
							<img src="carousel/slider-1002.jpg" alt="Second Slide">
						</div>
						<div class="carousel-item">
							<img src="carousel/slider-1003.jpg" alt="Third Slide">
						</div>
					</div>
					<!-- Carousel controls -->
					<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					</a>
					<a class="carousel-control-next" href="#myCarousel" data-slide="next">
						<span class="carousel-control-next-icon"></span>
					</a>
					
					  <div class="carousel-caption">
						<h1><span class="text-light">Search Awareness</span></h1>
						   <div class="row">
							  <div class="col-lg-6 mx-auto">
								<div class="card" style="background-color: rgba(0,0,0,.25);">
								  <div class="card-body">
									<form method="post">
									<div class="form-group row">
										<div class="col-sm-12">
											<input type="text" class="form-control" name="keywords" value="<?php echo $keywords; ?>" placeholder="Insert keywords" required />
										</div>
									</div>
									<p><button type="submit" name="search" class="btn btn-success"><i class="mdi mdi-account-search"></i> Search Now!</button></p>
									</form>
								  </div>
							  </div>
							</div>
						  </div>
					  </div>
					
					  
				</div>
		
              
				</div>
			</div>
		 </div>   
			
				
          <div class="row">
		  <?php
				
				$result = "found";
				
				if(isset($_POST['search']))
				{
					$keywords = $_POST['keywords'];
					
					
					$sql = mysqli_query($conn, "SELECT * FROM awareness
													WHERE title like '%{$keywords}%'
													OR awareness like '%{$keywords}%'
													ORDER BY awareness_id ASC");
															
					
													
					$num_rows = mysqli_num_rows($sql);
					
					if($num_rows < 1)
						$result = "notfound";
					else
						$result = "found";
				}
				else
				{
					$sql = mysqli_query($conn, "SELECT * FROM awareness ORDER BY awareness_id ASC");
				}
				
				if($result == "found")
				{
					$counter = 0;
					$hideStyle = "";
						
					while($row = mysqli_fetch_array($sql))
					{
						$desc = mb_substr($row['awareness'], 0, 100);
						
						
						$tarikhString = str_replace('-', '/', $row['posted_date']);
						$tarikhStringFormat = date('d/m/Y', strtotime($tarikhString));
												
						
						$display = "<a href='#modal' data-toggle='modal' data-target='#details$row[awareness_id]' class='btn btn-outline-success btn-md'>
										<i class='mdi mdi-arrow-expand'></i> More Details
									</a>";
						
						echo "<div class='col-md-3 grid-margin stretch-card text-center blogBox moreBox' $hideStyle>
									<div class='card'>
										<img class='card-img-top' src='awareness/$row[image]' alt='picture' style='height:250px'>
										<div class='card-body'>
											<h5 class='card-title text-success'>$row[title]</h5>
											<span class='badge badge-success mb-3'>Posted Date: $tarikhStringFormat</span>
											<br />
											<small>$desc...</small>
											<div class='d-flex align-items-center justify-content-between text-muted border-top py-3 mt-3'>
											  
											  <p class='mb-0 text-center'>
												<center>$display</center>
											  </p>
											  
											</div>
										</div>
									</div>
								</div>";
																	
										
						$counter++;
										
						if($counter > 2)
							$hideStyle = "style='display: none;'";
					
					
						include "modal_awareness.php";
					}
					
					echo "<div id='loadMore' style=''>
								<a href='#' class='btn mb-1 btn-outline-warning btn-lg'>
									<i class='icon-load-d'></i> Load More
								</a>
							</div>";
				}
				else if($result == "notfound")
				{
					echo "<div class='col-md-12 grid-margin stretch-card'>
							<p class='lead text-danger'>
								<i class='mdi mdi-emoticon-sad'></i> Sorry!, Keywords was not found.
								<a class='btn btn-outline-danger btn-sm' href='index.php'><i class='mdi mdi-refresh'></i> Refresh</a>
							</p>
							</div>";
				}
			
				
				
			?>
            
          </div>
          
          
          
         
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
		<?php include "layout/footer.php";?>
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  
   <!-- SCRIPT -->
   <?php include "layout/script.php";?>
   <script>
	$( document ).ready(function () {
	  $(".moreBox").slice(0, 4).show();
		if ($(".blogBox:hidden").length != 0) {
		  $("#loadMore").show();
		}   
		$("#loadMore").on('click', function (e) {
		  e.preventDefault();
		  $(".moreBox:hidden").slice(0, 4).slideDown();
		  if ($(".moreBox:hidden").length == 0) {
			$("#loadMore").fadeOut('slow');
		  }
		});
	  });
	  </script>

</body>

</html>
<?php
}
?>