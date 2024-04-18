
					  <div class="modal fade" id="details<?php echo $row['username'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title"><i class="mdi mdi-account-circle"></i> Member Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								  </div>
								  <form method="post" enctype="multipart/form-data">
									  <div class="modal-body">
												<div class="row">
												  <div class="col-md-4">
													<div class="form-group">
														<label>Member ID</label>
														<input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" multiple placeholder="Staff ID" readonly />
													</div>
												  </div>
												  <div class="col-md-4">
													<div class="form-group">
														<label>First Name</label>
														<input type="text" class="form-control" name="name" value="<?php echo $row['first_name']; ?>" placeholder="First Name" readonly />
													</div>
												  </div>
												  <div class="col-md-4">
													<div class="form-group">
														<label>Last Name</label>
														<input type="text" class="form-control" name="name" value="<?php echo $row['last_name']; ?>" placeholder="Last Name" readonly />
													</div>
												  </div>
												</div>
												 
												 <div class="row">
												  <div class="col-md-4">
													<div class="form-group">
														<label>Gender</label>
														<input type="text" class="form-control" name="gender_id" value="<?php echo $rowG['gender']; ?>" placeholder="Gender" readonly />
													</div>
												  </div>
												  <div class="col-md-4">
													<div class="form-group">
														<label>Phone No.</label>
														<input type="text" class="form-control" name="phone_num" value="<?php echo $row['phone_num']; ?>" multiple placeholder="Phone No." readonly />
													</div>
												  </div>
												  <div class="col-md-4">
													<div class="form-group">
														<label>Email</label>
														<input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" multiple placeholder="Email" readonly />
													</div>
												  </div>
												</div>
												
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Address</label>
														<textarea id="address" class="form-control" rows="5" placeholder="Member address" name="address" readonly><?php echo $row['address']; ?></textarea>
													</div>
												  </div>
												</div>
											
											
									  </div>
								  </form>
								</div>
							  </div>
					  </div>