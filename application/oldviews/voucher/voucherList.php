<script type="text/javascript">

$(document).ready(function() {

    $('#addForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a full name!"
                    }
                }
            },

            description: {
            	validators: {
            		notEmpty: {
            			message: "You must fill this one too"
            		}
            	}
            }
        }
    })
  .on('success.form.bv', function(e) {
      // Prevent form submission
      e.preventDefault();
      // Get the form instance
      var $form = $(e.target);

      // Get the BootstrapValidator instance
      var bv = $form.data('bootstrapValidator');

      // Use Ajax to submit form data
      $.ajax({
	    url: '<?php echo base_url(); ?>voucher/add',
	    type: 'post',
	    data: $('#addForm :input'),
	    dataType: 'html',		
	    success: function(html) {
			bootbox.alert(html);
		   if(html == 'Voucher successfully added')
			{
			   $('#addForm')[0].reset();
			   $('#addVoucher').modal('hide');
			   location.reload();
			} 

	    }
    });
  });
});

function edit(id)
{
$.ajax({
	    url: '<?php echo base_url(); ?>voucher/edit/' + id,
	    type: 'post',
	    dataType: 'html',		
	    success: function(html) {
		   $('#edit-voucher-content').html(html);
			   
	    }
    });
}

function rm(nm,id){
  bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>voucher/delete/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'Voucher Deleted Successful')
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
					  
					  
					  
					<h4><i class="fa fa-list-alt"></i> <strong>Vouchers</strong></h4>
					<div class="panel panel-info">
						
						<div class="panel-heading">
							
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVoucher"><span class="fa fa-plus"></span> Add Voucher</button>
						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($vouchers->result() as $voucher){?>
								
								<tr>
									  <td><?php echo $voucher->id; ?></td>
									  <td><?php echo $voucher->name; ?></td>
									  <td><?php echo $voucher->description; ?></td>
									  <td>
											

										 	<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editVoucher" onclick="edit('<?php echo $voucher->id; ?>')">
											<span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
											
											<a href="javascript:void(0);" onclick="rm('<?php echo $voucher->name; ?>','<?php echo $voucher->id; ?>');">
										 	<span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></a>
										  <!--<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRole" onclick="edit('<?php /*echo $voucher->id; */?>')">
											<span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
										 	<a href="javascript:void(0);" onclick="rm('<?php /*echo $voucher->name;*/ ?>','<?php /*echo $voucher->id; */?>');">
										 	<span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></a>-->
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







		  	<div id="addVoucher" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Add Voucher</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                
			                <form id="addForm" class="form-horizontal style-form" method="post">
		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
		                              <div class="col-sm-10">
		                                  <input type="text" id="name" name="name" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Description</label>
		                              <div class="col-sm-10">
		                              	<textarea name="description" class="form-control"></textarea>
		                                  <!--<input type="text" id="description" name="description" class="form-control">-->
		                              </div>
		                          </div>
		                          
		                   
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                <button type="submit" class="btn btn-primary">Save</button>
			                </center>
			            </div> 
			          </form>
			        </div>
			    </div>
			</div>





			<div id="editVoucher" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Edit Voucher</h4>
			                </center>
			            </div>
			            <div class="modal-body" id="edit-voucher-content">
			                
			                
			            </div>
			           
			        </div>
			    </div>
			</div>


