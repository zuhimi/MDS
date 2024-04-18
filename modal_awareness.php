
					  <div class="modal fade" id="details<?php echo $row['awareness_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title"><i class="mdi mdi-message-text text-success"></i> Awareness Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								  </div>
								  <form method="post" enctype="multipart/form-data">
									  <div class="modal-body">
												<div class="row">
												  <div class="col-md-6">
													<div class="form-group">
														<label>Posted Date</label>
														<input type="text" class="form-control" name="posted_date" value="<?php echo $tarikhStringFormat; ?>" readonly />
													</div>
												  </div>
												  <div class="col-md-6">
													<div class="form-group">
														<label>Title</label>
														<input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>" readonly />
													</div>
												  </div>
												</div>
												
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Image</label>
														<img class="img-fluid" src="awareness/<?php echo $row['image']; ?>" alt="picture">
													</div>
												  </div>
												</div>
												
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Awareness</label>
														<textarea class="form-control" name="awareness" rows="10" readonly><?php echo $row['awareness']; ?></textarea>
													</div>
												  </div>
												</div>
												
											
									  </div>
								  </form>
								</div>
							  </div>
					  </div>