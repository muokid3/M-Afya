<script type="text/javascript">



function unsuspend(id){
  bootbox.confirm("Are you sure you want to unsuspend this transaction? ", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>suspended/unsuspend/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'Transaction Unsuspended')
				location.reload();
		}
	});
    
    }
    
  }); 
}



</script>  

			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  <?php $login=$this->session->userdata('logged_in');
					  		$login_role=$login['role']; ?>
					  
					<h4 style="color:#E01FEB"><i class="fa fa-exclamation"></i> <strong>Suspended Payments</strong></h4>
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
								  <?php if ($login_role==22) {?>
								  <th>Action</th>
								  <?php } ?>
								  
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($suspended->result() as $suspend){?>
								
								<tr>
									  <td><?php echo $suspend->ms_id; ?></td>
									  <td><?php echo $suspend->datetime; ?></td>
									  
									  <td><?php echo $suspend->business_no; ?></td>
									  <td><?php echo $suspend->bs_name; ?></td>									  
									  <td><?php echo $suspend->amount; ?></td>
									  
									  <td><?php if($suspend->debit == 1)
									  			{
									  				echo "Debit";
									  			}
									  			else
									  			{
									  				echo "Credit";
									  			} ?>
									  </td>


									  <?php if ($login_role==22) {?>
										  <td>
										  	<a href="javascript:void(0);" onclick="unsuspend('<?php echo $suspend->ms_id ;?>')">
											<span class="btn btn-primary"><span class="fa fa-link"></span>&nbsp;Unsuspend</span></a>
										  </td>
									   <?php } ?>
									  
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