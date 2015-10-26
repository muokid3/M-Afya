			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4 style="color:#E01FEB"><i class="fa fa-users"></i> <strong>Subscribers</strong></h4>
					<div class="panel panel-info">
						
						<div class="panel-heading">
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
						
						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Password</th>
								  <th>Account No.</th>
								  <th>Open Voucher Balance</th>
								  <th>Afya Balance</th>
								  <th>Active</th>
								  <th>PIN</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($subscribers->result() as $subscriber){?>
								
								<tr>
									  <td><?php echo $subscriber->ma_id; ?></td>
									  <td><?php echo $subscriber->fname; ?></td>
									  <td><?php echo $subscriber->lname; ?></td>
									  <td><?php echo $subscriber->password; ?></td>
									  <td><?php echo $subscriber->ma_account_no; ?></td>									  
									  <td><?php echo $subscriber->ma_balance; ?></td>
									  <td><?php echo $subscriber->vm_balance; ?></td>
									  <td><?php if ($subscriber->active == 1) echo "YES"; else echo "NO"; ?>
										</td>
									  <td><?php echo $subscriber->password; ?></td>
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


