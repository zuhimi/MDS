
			  <!-- Modal -->
              <div class="modal fade" id="addFAQ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title"><i class="mdi mdi-plus text-success"></i> Add New FAQ</p>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>

                            <form method="post" action="addFAQ.php">
                            <div class="modal-body">
									  <div class="modal-body">
								
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Question</label>
														<input type="text" class="form-control" name="question" placeholder="Write question here..." required />
													</div>
												  </div>
												</div>
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Additional Stock</label>
														<textarea class="form-control" rows="5" name="answer" placeholder="Write answer here..." required></textarea>							
													</div>
												  </div>
												</div>
									  </div>
									  
                            </div>
                            <div class="modal-footer">
                                <button style="margin-left:10px;width:90px" data-dismiss="modal" class="btn btn-outline-dark" type="button"><i class="ti ti-close"></i> Close</button>
                                <button type="submit" name="submit" class="btn btn-success"><i class="mdi mdi-check"></i> Submit</button>
                            </div>
							</form>
                        </div>
                  </div>
              </div>
              <!-- modal end -->