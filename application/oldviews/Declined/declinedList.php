			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4><i class="fa fa-times"></i> <strong>Declined Payments</strong></h4>
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
                                  <th>Transaction Date</th>
                                  
                                  <th>Business Number</th>
								  <th>Business Name</th>
								  <th>Amount</th>
								  
								  <th>Transaction Type</th>
								  <th>Status</th>
								  
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($declined->result() as $decline){?>
								
								<tr>
									  <td><?php echo $decline->ms_id; ?></td>
									  <td><?php echo $decline->datetime; ?></td>
									  
									  <td><?php echo $decline->business_no; ?></td>
									  <td><?php echo $decline->bs_name; ?></td>									  
									  <td><?php echo $decline->amount; ?></td>
									  
									  <td><?php if($decline->debit == 1)
									  			{
									  				echo "Debit";
									  			}
									  			else
									  			{
									  				echo "Credit";
									  			} ?>
									  </td>


									  <td><?php if ($decline->settlement_status == 0)
									  			{
									  				echo "Received";
									  			}
									  			elseif ($decline->settlement_status == 1) {
									  			 	echo "Settled";
									  			 }
									  			 elseif ($decline->settlement_status == 2) {
									  			  	echo "Processing";
									  			  }
									  			  elseif ($decline->settlement_status == 3) {
									  			   	echo "Suspended";
									  			   }
									  			   elseif ($decline->settlement_status == 4) {
									  			    	echo "Declined";
									  			    }
									  			    else
									  			    {
									  			    	echo "Unknown";
									  			    	} ?>
									  </td>
									  
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