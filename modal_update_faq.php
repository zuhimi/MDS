
			  <!-- Modal -->
              <div class="modal fade" id="updateFAQ<?php echo $row['faq_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title"><i class="mdi mdi-lead-pencil text-success"></i> Update FAQ</p>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>

                            <form method="post" action="updateFAQ.php">
							<input type="hidden" class="form-control" name="faq_id" value="<?php echo $row['faq_id']; ?>" readonly />
                            <div class="modal-body">
									  <div class="modal-body">
								
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Question</label>
														<input type="text" class="form-control" name="question" value="<?php echo $row['question']; ?>" placeholder="Write question here..." required />
													</div>
												  </div>
												</div>
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label>Additional Stock</label>
														<textarea class="form-control" rows="5" name="answer" placeholder="Write answer here..." required><?php echo $row['answer']; ?></textarea>							
													</div>
												  </div>
												</div>
									  </div>
									  
                            </div>
                            <div class="modal-footer">
                                <button style="margin-left:10px;width:90px" data-dismiss="modal" class="btn btn-outline-dark" type="button"><i class="mdi mdi-close"></i> Close</button>
                                <button type="submit" name="submit" class="btn btn-success"><i class="mdi mdi-check"></i> Update</button>
                            </div>
							</form>
                        </div>
                  </div>
              </div>
              <!-- modal end -->