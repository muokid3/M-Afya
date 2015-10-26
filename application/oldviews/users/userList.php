<script type="text/javascript">



$(document).ready(function() {

	$("#active_").change(function() {
    if(this.checked) {
        $('#active').val(1);
    }
 else
  $('#active').val(0);
});

    $('#addForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user_name: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a full name!"
                    }
                }
            },

            user_username: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a username!"
                    }
                }
            },

            user_password: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a password!"
                    }
                }
            },

            user_confpass: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Confirmation Password!"
                    },

                    identical: {
                    	field: 'user_password',
                    	message: "Password and Confirm Password must match!"
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
	    url: '<?php echo base_url(); ?>users/add',
	    type: 'post',
	    data: $('#addForm :input'),
	    dataType: 'html',		
	    success: function(html) {
			bootbox.alert(html);
		   if(html == 'User successfully added')
			{
			   $('#addForm')[0].reset();
			   $('#addUser').modal('hide');
			   location.reload();
			} 

	    }
    });
  });
});

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

function rm(nm,id){
  bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>users/delete/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'User Deleted Successful')
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
					  
					  
					  
					<h4><i class="fa fa-users"></i> <strong>Users</strong></h4>
					<div class="panel panel-info">
						
						<div class="panel-heading">
							
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser"><i class="fa fa-user"></i> Add User</button>

						</div>
						
						
						<table class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Username</th>
                                  <th>Active</th>
								  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
							  <?php  
								
								foreach ($users->result() as $user){?>
								
								<tr>
									  <td><?php echo $user->id; ?></td>
									  <td><?php echo $user->name; ?></td>
									  <td><?php echo $user->username; ?></td>
									  <td><?php if ($user->active == 1) {
									  	echo "Yes";
									  } else
									  {
									  	echo "No";
									  	} ?></td>
									  <td>
										

										<span class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#edit"  onclick="edit('<?php echo $user->id ;?>')"> 
										<span class="glyphicon glyphicon-pencil"></span>&nbsp; Edit</span>

										<a href="javascript:void(0);" onclick="rm('<?php echo $user->name; ?>','<?php echo $user->id; ?>');">
										<span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></a>

										<!--<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUser" onclick="edit('<?php /*echo $user->id; */?>')">
										<span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
									  	<a href="javascript:void(0);" onclick="rm('<?php /*echo $user->name; */?>','<?php /*echo $user->id; */?>');">
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







		  	<div id="addUser" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Add User</h4>
			                </center>
			            </div>
			            <div class="modal-body">
			                <form id="addForm" class="form-horizontal style-form" method="post">
		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="user_name" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">User Name</label>
		                              <div class="col-sm-10">
		                                  <input type="text" name="user_username" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Password</label>
		                              <div class="col-sm-10">
		                                  <input type="password" name="user_password" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
		                              <div class="col-sm-10">
		                                  <input type="password" name="user_confpass" class="form-control">
		                              </div>
		                          </div>

		                          <div class="form-group">
		                          	<label class="col-sm-2 col-sm-2 control-label">Role</label>
		                          	<div class="col-sm-10">
		                          	<select name="user_role" class="form-control" >
									  <?php
									  	foreach ($roles->result() as $role)
											{?>
												<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
										<?php } ?>
									
									</select>
									</div>
								</div>

							<div class="form-group">
								<div class="col-lg-8" style="padding-left:50px;">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="active_" id="active_" class="active_"/> <b>Active Status</b>
										</label>
										
								<input type="hidden" name="active" id="active" value="" />
									</div>
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

		  	<div id="edit" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header" style="color:#0093af">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <center>
			                	<h4 class="modal-title">Edit User</h4>
			                </center>
			            </div>
			            <div class="modal-body" id="edit-user-content">
			                
			                
			            </div>
			            
			        </div>
			    </div>
			</div>


