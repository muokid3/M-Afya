<script type="text/javascript">


$(document).ready(function(){

   $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});

});
	
	
</script>			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4><i class="fa fa-mobile"></i> <strong>Mobile Wallet Transactions</strong></h4>
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
                                  <th>Transaction Date</th>
                                  
                                  <th>Transaction ID</th>
								  <th>First Name</th>
								  <th>Last Name</th>
								  
								  <th>Phone Number</th>
								  <th>Amount</th>
								  <th>Transaction Type</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($mpesa->result() as $smallMpesa){?>
								
								<tr>
									  <td><?php echo $smallMpesa->id; ?></td>
									  <td><?php echo $smallMpesa->date; ?></td>
									  
									  <td><?php echo $smallMpesa->mp_transaction_id; ?></td>
									  <td><?php echo $smallMpesa->first_name; ?></td>									  
									  <td><?php echo $smallMpesa->last_name; ?></td>
									  
									  <td><?php echo $smallMpesa->phone_no; ?></td>
									  <td><?php echo $smallMpesa->amount; ?></td>
									  <td><?php echo $smallMpesa->transaction_type; ?></td>
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