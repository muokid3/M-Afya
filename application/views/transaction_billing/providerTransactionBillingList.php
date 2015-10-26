<script type="text/javascript">


$(document).ready(function(){

   $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});

});
	
	
</script>	

<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4 style="color:#E01FEB"><i class="fa fa-money fa-fw"></i> <strong>Service Provider Transaction Billing</strong></h4>
					<div class="panel panel-info">
						
						
						<div class="panel-heading">
							<table>
								<tr>
										<td class="col-md-3">
											<form name="search" method="post" action="">
												<div class="input-group custom-search-form">
												  <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
												  
												</div>
										</td>
							
										<td>
											<label>From</label>
										</td>
										<td>
											<input name="from" class="form-control datepicker" placeholder="From Date">
											
										</td>

										<td>
											<label>To</label>
										</td>
										<td>
											<input name="to" class="form-control datepicker" placeholder="To Date">
										</td>
										<td style="padding:10px">
											<span class="input-group-btn">
													  <button class="btn btn-default" type="submit">Filter
															<i class="fa fa-search"></i>
													  </button>
												 </span>
										</td>
									</tr>

									
									
								</table>
								
							</form>

						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Account Number</th>
                                  <th>Business Name</th>
                                  <th>Location</th>
                                  <th>User Type</th>
								  <th>Amount</th>
								  <th>Transaction Type</th>
								  <th>Date</th>
								  
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($trans_billing->result() as $trans_bill){?>
								
								<tr>
									  <td><?php echo $trans_bill->ts_id; ?></td>
									  <td><?php echo $trans_bill->account_number; ?></td>
									  <td><?php echo $trans_bill->bs_name; ?></td>
									  <td><?php echo $trans_bill->location; ?></td>
									  <td><?php echo $trans_bill->user_type; ?></td>
									  <td><?php echo $trans_bill->amount; ?></td>
									  <td><?php echo $trans_bill->transaction_type; ?></td>
									  <td><?php echo $trans_bill->datetime; ?></td>
									  
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