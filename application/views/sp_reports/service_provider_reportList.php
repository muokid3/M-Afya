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
					  
					  
					  
					<h4 style="color:#E01FEB"><i class="fa fa-money fa-fw"></i> <strong>Transactions</strong></h4>
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
                                  <th>Date</th>
                                  <th>Provider Name</th>
								  <th>Provider Number</th>
								  <th>Voucher Type</th>
								  <th>Subscriber First Name</th>
								  <th>Subscriber Last Name</th>
								  
								  <th>Transaction Type</th>
								  <th>Amount</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($sp_reports->result() as $sp_report){?>
								
								<tr>
									  <td><?php echo $sp_report->id; ?></td>
									  <td><?php echo $sp_report->datetime; ?></td>
									  <td><?php echo $sp_report->bs_name; ?></td>
									  <td><?php echo $sp_report->business_no; ?></td>
									  <td><?php echo $sp_report->voucher; ?></td>
									  <td><?php echo $sp_report->fname; ?></td>
									  <td><?php echo $sp_report->lname; ?></td>
									  <td><?php if ($sp_report->debit = 1) {
									  				echo "Debit";
									  			}else
									  			{
									  				echo "Credit";
									  			}?></td>
									
									  <td><?php echo $sp_report->amount; ?></td>
									  
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