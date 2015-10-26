			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4><i class="fa fa-cogs fa-spin"></i> <strong>Audit Trail</strong></h4>
					<div class="panel panel-info">
						
						
						<div class="panel-heading">
							<form name="search" method="post" action="">
								<div class="col-md-4 input-group custom-search-form">
								  <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
								  <span class="input-group-btn">
									  <button class="btn btn-default" type="submit">
											<i class="fa fa-search"></i>
									  </button>
								 </span>
								</div>
							</form>
						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Datetime</th>
                                  <th>Username</th>
								  <th>Transaction Description</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($audits->result() as $audit){?>
								
								<tr>
									  <td><?php echo $audit->audit_id; ?></td>
									  <td><?php echo $audit->datetime; ?></td>
									  <td><?php echo $audit->user_username; ?></td>
									  <td><?php echo $audit->detail; ?></td>
									  
								</tr>
									  <?php } ?>
                              
                              
                              </tbody>
                          </table>
						  
						  
						  
						  
						
						
					</div>
                      
					  
					  
					  
					  
						
                          <section id="unseen">
                            
							
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->