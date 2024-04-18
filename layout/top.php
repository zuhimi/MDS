<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <h3 class="page-title text-success">M D S</h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
           <h5 class="page-title text-success">M D S</h5>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        
        <ul class="navbar-nav navbar-nav-right">
         <?php
		 
			if($_SESSION['level'] == 1)
			{
				$sql = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$_SESSION[user_id]'");
				$row = mysqli_fetch_array($sql);
				
				echo "<li class='nav-item dropdown  d-xl-inline-block'>
						<a class='nav-link dropdown-toggle' id='UserDropdown' href='#' data-toggle='dropdown' aria-expanded='false'>
						  <span class='profile-text'>Welcome, $row[name] !</span>
						  <img class='img-xs rounded-circle' src='photo/$row[photo]' alt='Profile image'>
						</a>
						<div class='dropdown-menu dropdown-menu-right navbar-dropdown' aria-labelledby='UserDropdown'>
						  <a href='profile_admin.php' class='dropdown-item mt-2'>
							<i class='mdi mdi-account-outline text-success'></i>	Profile
							</a>
						  <a href='update_password.php' class='dropdown-item'>
							<i class='mdi mdi-lock-outline text-primary'></i> Password
						  </a>
						  <a href='logout.php' class='dropdown-item'>
							<i class='mdi mdi-arrow-top-right text-danger'></i> Logout
						  </a>
						</div>
					  </li>";
				
			}
			else if($_SESSION['level'] == 2)
			{
				$sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '$_SESSION[user_id]'");
				$row = mysqli_fetch_array($sql);
				
				echo "<li class='nav-item dropdown  d-xl-inline-block'>
						<a class='nav-link dropdown-toggle' id='UserDropdown' href='#' data-toggle='dropdown' aria-expanded='false'>
						  <span class='profile-text'>Welcome, $row[first_name] $row[last_name] !</span>
						  <img class='img-xs rounded-circle' src='photo/$row[photo]' alt='Profile image'>
						</a>
						<div class='dropdown-menu dropdown-menu-right navbar-dropdown' aria-labelledby='UserDropdown'>
						  <a href='profile_member.php' class='dropdown-item mt-2'>
							<i class='mdi mdi-account-outline text-success'></i>	Account
							</a>
						  <a href='update_password.php' class='dropdown-item'>
							<i class='mdi mdi-lock-outline text-primary'></i> Password
						  </a>
						  <a href='logout.php' class='dropdown-item'>
							<i class='mdi mdi-arrow-top-right text-danger'></i> Logout
						  </a>
						</div>
					  </li>";
					  
				
			}
			
			
		 ?>
          
        </ul>
		<button class='navbar-toggler navbar-toggler-right d-lg-none align-self-center' type='button' data-toggle='offcanvas'>
			<span class='mdi mdi-menu'></span>
		</button>
      </div>
    </nav>