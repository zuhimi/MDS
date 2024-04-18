<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          
		  
		  <?php
		  
		  if($_SESSION['level'] == 1)
		  {
			  //get admin details
			  $sql = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$_SESSION[user_id]'");
			  $row = mysqli_fetch_array($sql);
				
			
			  echo "<li class='nav-item nav-profile'>
					<div class='nav-link'>
					  <div class='user-wrapper'>
						<div class='profile-image'>
						  <img src='photo/$row[photo]' alt='profile image'>
						</div>
						<div class='text-wrapper'>
						  <p class='profile-name'>$row[name]</p>
						  <div>
							<small class='designation text-muted'>$_SESSION[level_type]</small>
							<span class='status-indicator online'></span>
						  </div>
						</div>
					  </div>
					</div>
				  </li>";
				  
			  echo "<li class='nav-item'>
					<a class='nav-link' href='dashboard.php'>
					  <i class='menu-icon mdi mdi-home'></i>
					  <span class='menu-title'>Dashboard</span>
					</a>
				  </li>
				  
				  <li class='nav-item'>
					<a class='nav-link' href='member.php'>
					  <i class='menu-icon mdi mdi-account-circle'></i>
					  <span class='menu-title'>Member</span>
					</a>
				  </li>
				  
						  
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-awareness' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-message-text'></i>
							<span class='menu-title'>Awareness</span>
						<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-awareness'>
						<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
								<a class='nav-link' href='post_awareness.php'>Post Awareness</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='manage_awareness.php'>Manage Awareness</a>
							</li>
						</ul>
					</div>
				  </li>
				  
						  
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-files' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-file-document-box'></i>
							<span class='menu-title'>Files</span>
						<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-files'>
						<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
								<a class='nav-link' href='overall_file.php'>Overall Files</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='safe_file.php'>Safe Files</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='detected_file.php'>Detected Files</a>
							</li>
						</ul>
					</div>
				  </li>
				  
				  
				  <li class='nav-item'>
					<a class='nav-link' href='report.php'>
					  <i class='menu-icon mdi mdi-chart-bar'></i>
					  <span class='menu-title'>Report</span>
					</a>
				  </li>
				  
				  
				  
						  
				  <li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-setting' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-settings'></i>
							<span class='menu-title'>Setting</span>
						<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-setting'>
						<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
								<a class='nav-link' href='setting_about.php'>About</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='setting_faq.php'>FAQ</a>
							</li>
						</ul>
					</div>
				  </li>
				  
				  
				  
				  
				  ";
		  }
		  
		  // member menu
		  else if($_SESSION['level'] == 2)
		  {
			  $sql = mysqli_query($conn, "SELECT * FROM member WHERE username = '$_SESSION[user_id]'");
			  $row = mysqli_fetch_array($sql);
				
			  echo "<li class='nav-item nav-profile'>
					<div class='nav-link'>
					  <div class='user-wrapper'>
						<div class='profile-image'>
						  <img src='photo/$row[photo]' alt='profile image'>
						</div>
						<div class='text-wrapper'>
						  <p class='profile-name'>$row[first_name] $row[last_name]</p>
						  <div>
							<small class='designation text-muted'>$_SESSION[level_type]</small>
							<span class='status-indicator online'></span>
						  </div>
						</div>
					  </div>
					</div>
				  </li>";
				  
			  echo "<li class='nav-item'>
					<a class='nav-link' href='dashboard.php'>
					  <i class='menu-icon mdi mdi-home'></i>
					  <span class='menu-title'>Dashboard</span>
					</a>
				  </li>
				  
				  
					 <li class='nav-item'>
						<a class='nav-link' href='upload_file.php'>
						  <i class='menu-icon mdi mdi-cloud-upload'></i>
						  <span class='menu-title'>Upload &amp; Scan</span>
						</a>
					  </li>
					  
					  
					  <li class='nav-item'>
						<a class='nav-link' href='my_file.php'>
						  <i class='menu-icon mdi mdi-file-document-box'></i>
						  <span class='menu-title'>My Files</span>
						</a>
					  </li>
					  
					 
				  
				  ";
		  }
		  
		  
		 
		  
		  
		  ?>
          
         
          
        </ul>
      </nav>