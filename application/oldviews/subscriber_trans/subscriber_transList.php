			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4><i class="fa fa-plus-circle fa-fw"></i> <strong>Subscriber Transaction Reports</strong></h4>
					<div class="panel panel-info">
						
						
						<div class="panel-heading">
							<div class="col-md-4 input-group custom-search-form">
							  <input type="text" class="form-control" placeholder="Search...">
							  <span class="input-group-btn">
								  <button class="btn btn-default" type="button">
										<i class="fa fa-search"></i>
								  </button>
							 </span>
							</div>
						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Date</th>
                                  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Account Number</th>
								  <th>Provider Name</th>
								  <th>Provider Number</th>
								  <th>Voucher Type</th>
								  <th>Transacition Type</th>
								  
								  <th>Amount</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($sub_trans->result() as $sub_tran){?>
								
								<tr>
									  <td><?php echo $sub_tran->st_id; ?></td>
									  <td><?php echo $sub_tran->datetime; ?></td>
									  <td><?php echo $sub_tran->fname; ?></td>
									  <td><?php echo $sub_tran->lname; ?></td>
									  <td><?php echo $sub_tran->account_no; ?></td>
									  <td><?php echo "--" ?></td>
									  <td><?php echo "--" ?></td>
									  <td><?php echo $sub_tran->voucher; ?></td>
									  <td><?php if ($sub_tran->debit = 1) {
									  					echo "Debit";
									  			}
									  			else
									  			{
									  				echo "Credit";
									  			} ?></td>
									  
									  <td><?php echo $sub_tran->amount; ?></td>
									  
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