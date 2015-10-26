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
					  
					  
					  
					<h4><i class="fa fa-send fa-fw"></i> <strong>Voucher Transfers</strong></h4>
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
                                  <th>Sender Account Number</th>
								  <th>Recipient Account Number</th>
								  <th>Voucher Type</th>
								  <th>Amount</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($voucher_trans->result() as $voucher_tran){?>
								
								<tr>
									  <td><?php echo $voucher_tran->id; ?></td>
									  <td><?php echo $voucher_tran->datetime; ?></td>
									  
									  <td><?php echo $voucher_tran->account_from; ?></td>
									 
									  <td><?php echo $voucher_tran->account_to; ?></td>
									  <td><?php echo $voucher_tran->voucher_type; ?></td>
									  
									  <td><?php echo $voucher_tran->amount; ?></td>
									  
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