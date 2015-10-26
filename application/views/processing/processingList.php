<script type="text/javascript">

function edit(id)
{
$.ajax({
	    url: '<?php echo base_url(); ?>users/edit/' + id,
	    type: 'post',
	    dataType: 'html',		
	    success: function(html) {
		   $('#edit-user-content').html(html);
			   
	    }
    });
}

function accept(id){
  bootbox.confirm("Are you sure you want to accept this transaction? ", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>processing/accept/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'Transaction Accepted')
				location.reload();
		}
	});
    
    }
    
  }); 
}

function suspend(id){
  bootbox.confirm("Are you sure you want to suspend this transaction? ", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>processing/suspend/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'Transaction Suspended')
				location.reload();
		}
	});
    
    }
    
  }); 
}

function decline(id){
  bootbox.confirm("Are you sure you want to decline this transaction? ", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>processing/decline/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'Transaction Declined')
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
					  
					<h4 style="color:#E01FEB"><i class="fa fa-refresh fa-spin"></i> <strong>Processing Payments</strong></h4>
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
								  <?php if ($login_role==22) {?>
								  <th>Action</th>
								  <?php } ?>
								  
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($processing->result() as $process){?>
								
								<tr>
									  <td><?php echo $process->ms_id; ?></td>
									  <td><?php echo $process->datetime; ?></td>
									  
									  <td><?php echo $process->business_no; ?></td>
									  <td><?php echo $process->bs_name; ?></td>									  
									  <td><?php echo $process->amount; ?></td>
									  
									  <td><?php if($process->debit == 1)
									  			{
									  				echo "Debit";
									  			}
									  			else
									  			{
									  				echo "Credit";
									  			} ?>
									  </td>


									  <td><?php if ($process->settlement_status == 0)
									  			{
									  				echo "Received";
									  			}
									  			elseif ($process->settlement_status == 1) {
									  			 	echo "Settled";
									  			 }
									  			 elseif ($process->settlement_status == 2) {
									  			  	echo "Processing";
									  			  }
									  			  elseif ($process->settlement_status == 3) {
									  			   	echo "Suspended";
									  			   }
									  			   elseif ($process->settlement_status == 4) {
									  			    	echo "Declined";
									  			    }
									  			    else
									  			    {
									  			    	echo "Unknown";
									  			    	} ?>
									  </td>

									  <?php if ($login_role==22) {?>
									  <td>
										

										<a href="javascript:void(0);" onclick="accept('<?php echo $process->ms_id ;?>')">
										<span class="btn btn-primary"><span class="fa fa-check"></span>&nbsp;Accept</span></a>

										<a href="javascript:void(0);" onclick="suspend('<?php echo $process->ms_id ;?>')">
										<span class="btn btn-warning"><span class="fa fa-unlink"></span>&nbsp;Suspend</span></a>

										<a href="javascript:void(0);" onclick="decline('<?php echo $process->ms_id ;?>')">
										<span class="btn btn-danger"><span class="fa fa-times"></span>&nbsp;Decline</span></a>
	
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


		  	<div id="accept" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Accept Payment</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                <center>
			                	<p>Please confirm that you want to accept this payment.</p>
			                </center>
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                <button type="submit" class="btn btn-primary">Confirm</button>
			                </center>
			            </div>
			        </div>
			    </div>
			</div>

			<div id="suspend" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Suspend Payment</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                <center>
			                	<p>Please confirm that you want to suspend this payment.</p>
			                </center>
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                <button type="button" class="btn btn-primary">Suspend</button>
			                </center>
			            </div>
			        </div>
			    </div>
			</div>

			<div id="decline" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Decline Payment</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                <center>
			                	<p>Please confirm that you want to decline this payment.</p>
			                </center>
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                <button type="button" class="btn btn-primary">Decline</button>
			                </center>
			            </div>
			        </div>
			    </div>
			</div>