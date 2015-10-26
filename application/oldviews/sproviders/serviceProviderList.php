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
            username: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Username!"
                    }
                }
            },

            facilityno: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Facility Number!"
                    }
                }
            },

            businessno: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Business Number!"
                    }
                }
            },

            licenseno: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a License Number!"
                    }
                }
            },

            phoneno: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Phone Number!"
                    }
                }
            },

            balance: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in the Current Balance!"
                    }
                }
            },

            commission: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Commission Percentage!"
                    }
                }
            },

            email: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in an Email Address!"
                    }
                }
            },

            password: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Password!"
                    }
                }
            },

         

            confpass: {
                validators: {
                    notEmpty: {
                        message: "You're required to Confirm your Password!"
                    },

                     identical: {
                    	field: 'password',
                    	message: 'Password and Confirm Password must match'
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
	    url: '<?php echo base_url(); ?>Service_providers/add',
	    type: 'post',
	    data: $('#addForm :input'),
	    dataType: 'html',		
	    success: function(html) {
			bootbox.alert(html);
		   if(html == 'Service Provider Successfully Added')
			{
			   $('#addForm')[0].reset();
			   $('#addServiceProvider').modal('hide');
			   location.reload();
			}
			if(html == 'The Service Provider is not Recognized by the Government')
			{
				$('#addForm')[0].reset();
				$('#addServiceProvider').modal('hide');
				location.reload();
			} 

	    }
    });
  });
});

function edit(id)
{
$.ajax({
	    url: '<?php echo base_url(); ?>admin/edit/' + id,
	    type: 'post',
	    dataType: 'html',		
	    success: function(html) {
		   $('#edit-admin-content').html(html);
			   
	    }
    });
}

function rm(nm,id){
  bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>Service_providers/delete/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'Service Provider Deleted Successfully')
				location.reload();
		}
	});
    
    }
    
  }); 
}

</script>  			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
					  
					  
					  
					<h4><i class="fa fa-medkit"></i> <strong>Service Providers</strong></h4>
					<div class="panel panel-info">
						
						<div class="panel-heading">
							
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addServiceProvider"><span class="fa fa-plus"></span> Add Service Provider</button>
						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>User Name</th>
                                  <th>Business Name</th>
                                  <th>Business Number</th>
								  
								  <th>Phone No.</th>
								  <th>Location</th>
								  <th>Balance</th>
								  <th>Commission %</th>
								  <th>Active</th>
								  <th>Email</th>
								  <th style="width:15%">Action</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($sproviders->result() as $sprovider){?>
								
								<tr>
									  <td><?php echo $sprovider->id; ?></td>
									  <td><?php echo $sprovider->username; ?></td>
									  <td><?php echo $sprovider->bs_name; ?></td>
									  <td><?php echo $sprovider->business_no; ?></td>
									  
									  <td><?php echo $sprovider->phone_no; ?></td>									  
									  <td><?php echo $sprovider->location; ?></td>
									  <td><?php echo $sprovider->balance; ?></td>
									  <td><?php echo $sprovider->commission; ?></td>
									  <td><?php if ($sprovider->active == 1)
									  			{
									  				echo "Yes";
									  				}
									  				else
									  				{
									  					echo "No";
									  					} ?>
									  </td>
									  <td><?php echo $sprovider->email; ?></td>
									  <td style="width:20%">

										<!--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit">
										  		<span class="glyphicon glyphicon-pencil"></span> Edit
										</button>-->

										<a href="javascript:void(0);" onclick="rm('<?php echo $sprovider->bs_name; ?>','<?php echo $sprovider->id; ?>');">
										 	<span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></a>
											<!--<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRole" onclick="edit('<?php /*echo $sprovider->id; */?>')">
											<span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
										  	<a href="javascript:void(0);" onclick="rm('<?php /*echo $sprovider->username;*/ ?>','<?php /*echo $sprovider->id;*/ ?>');">
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






		  	<div id="addServiceProvider" class="modal fade" style="">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Add Service Provider</h4>
			                </center>
			            </div>
			            <div class="modal-body" >
			                <form id="addForm" class="form-horizontal style-form" method="post">
		                          
		                          <div class="row">
		                          <div class="form-group col-sm-12" style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">Facility Number</label>
	                              		<div class="col-sm-6">
		                                  <input type="text" name="facilityno" class="form-control">
		                              	</div>
		                          </div>

		                          <!--<div class="form-group col-sm-6" style="border-bottom:none">
		                              <label style="color:#000" class="col-sm-5 col-sm-5 control-label">Business Number</label>
		                              <div class="col-sm-7">
		                                  <input type="text" name="businessno" class="form-control">
		                              </div>
		                          </div>-->
		                          

		                          <!--<div class="form-group col-sm-6" style="border-bottom:none">
		                              <label style="color:#000" class="col-sm-5 col-sm-5 control-label">License Number</label>
		                              <div class="col-sm-7">
		                                  <input type="text" name="licenseno" class="form-control">
		                              </div>
		                          </div>-->

		                          <div class="form-group col-sm-12" style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">Phone Number</label>
		                              <div class="col-sm-6">
		                                  <input type="text" name="phoneno" class="form-control">
		                              </div>
		                          </div>
		                          


		                          

		                          <div class="form-group col-sm-12"style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">E mail</label>
		                              <div class="col-sm-6">
		                                  <input type="email" name="email" class="form-control">
		                              </div>
		                          </div>

		                          <!--<div class="form-group col-sm-6" style="border-bottom:none">
		                              <label style="color:#000" class="col-sm-5 col-sm-5 control-label">Balance</label>
		                              <div class="col-sm-7">
		                                  <input type="text" name="balance" class="form-control">
		                              </div>
		                          </div>-->
		                          
		                        

		                          	                          

		                          <div class="form-group col-sm-12" style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">Commission</label>
		                              <div class="col-sm-6">
		                                  <input type="text" name="commission" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group col-sm-12" style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">User Name</label>
		                              <div class="col-sm-6">
		                                  <input type="text" name="username" class="form-control">
		                              </div>
		                          </div>
		                         

		                                    


		                          <div class="form-group col-sm-12" style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">Password</label>
		                              <div class="col-sm-6">
		                                  <input type="password" name="password" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group col-sm-12" style="border-bottom:none; padding:0px">
		                              <label style="color:#000; padding-left:20%" class="col-sm-5 col-sm-5 control-label">Confirm Password</label>
		                              <div class="col-sm-6">
		                                  <input type="password" name="confpass" class="form-control">
		                              </div>
		                          </div>
		                          </div>

		                          
		                    
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				              
				                	<button type="button" class="btn btn-default col-sm-3 col-sm-offset-5" style="margin-right:5%" data-dismiss="modal">Close</button>
				                	<button type="submit" class="btn btn-primary col-sm-3">Add</button>
				              
			                </center>
			            </div>

			              </div>
			            </form>
			        </div>
			    </div>
			</div>




			<!--<div id="edit" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Edit Service Provider</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                <form class="form-horizontal style-form" method="post">
		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">User Name</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="username" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Business Number</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="businessno" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">License Number</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="licenseno" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="phoneno" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Location</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="location" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Balance</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="balance" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Commission</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="commission" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">E mail</label>
		                              <div class="col-sm-10">
		                                  <input type="email" name="email" class="form-control">
		                              </div>
		                          </div>
		                          
		                    </form>
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                <button type="button" class="btn btn-primary">Save</button>
			                </center>
			            </div>
			        </div>
			    </div>
			</div>-->




			<div id="delete" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Delete Service Provider</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                <center>
			                	<p>Are you sure you want to delete this service provider?</p>
			                </center>
			                
			            </div>
			            <div class="modal-footer">
			                <center>
				                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				                <button type="button" class="btn btn-primary">Delete</button>
			                </center>
			            </div>
			        </div>
			    </div>
			</div>