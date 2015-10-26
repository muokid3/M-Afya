     		
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
            name: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a full name!"
                    }
                }
            }, 
			username: {
				validators: {
					notEmpty: {
					message: "You're required to fill in a Username!"
					},
                   stringLength: {
                    min: 5,
                    max: 30,
                    message: 'The username must be more than 5 and less than 30 characters long'
                }
				} 
			},
			password: {
				validators: {
					notEmpty: {
					message: "You're required to fill in a password"
					},
					different: {
					field: 'username',
						message: 'The password cannot be the same as username'
						}
					}
				},
			cpassword: {
				validators: {
					notEmpty: {
					message: "You're required to confirm password!"
					},
					identical: {
					field: 'password',
						message: 'The confirm password must match password'
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
	    url: '<?php echo base_url(); ?>admin/add',
	    type: 'post',
	    data: $('#addForm :input'),
	    dataType: 'html',		
	    success: function(html) {
			bootbox.alert(html);
		   if(html == 'System User successfully added')
			{
			   $('#addForm')[0].reset();
			   $('#addAdmin').modal('hide');
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
		url: '<?php echo base_url(); ?>admin/delete/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
				bootbox.alert(html);
		    if(html == 'System User Deleted Successful')
				location.reload();
		}
	});
    
    }
    
  }); 
}

</script>        
        <div id="page-wrapper">
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-user-plus"></i> System Users</h1>
            </div>
        </div>
		
			<?php if($this->session->flashdata('message')==null)
				{
		
				}
					else
				{ ?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<?php echo $this->session->flashdata('message'); ?>.
					</div>
				<?php } ?>
		<div id="deleteAdmin" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						The System User will be permanently deleted!!!
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary">OK</button>
					</div>
				</div>
			</div>
		</div> 
		<div id="editAdmin" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Edit System Admin Details</h4>
					</div>
					<div class="modal-body" id="edit-admin-content">
						
					</div>
				</div>
			</div>
		</div>
		<div id="addAdmin" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Add a System User</h4>
					</div>
					<div class="modal-body">
						<form id="addForm" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-4 control-label">Name <sup>*</sup></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name="name" placeholder="Name" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Username <sup>*</sup></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name="username" placeholder="Username" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Select a Role <sup>*</sup></label>
								<div class="col-sm-8">
									<select class="form-control" id="role" name="role">
										<?php foreach ($roles->result() as $role){?>
											<?php if($role->id != 5){?>
												<option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Password <sup>*</sup></label>
								<div class="col-lg-8">
									<input type="password" class="form-control" name="password" placeholder="Password" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-4 control-label">Confirm Password <sup>*</sup></label>
								<div class="col-lg-8">
									<input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" />
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
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Add User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdmin"><span class="fa fa-plus"></span> Add System User</button>
						</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
								<table class="table table-bordered table-stripped">
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Username</th>
										<th>Role</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
										<?php 	foreach ($admins->result() as $admin){?>
									<tr>
										<td><?php echo $admin->id; ?></td>
										<td><?php echo $admin->name; ?></td>
										<td><?php echo $admin->username; ?></td>
										<td><?php echo $admin->role; ?></td>
										<td><?php if($admin->status == 1) echo "Active"; else echo "Inactive"; ?></td>
										<td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAdmin" onclick="edit('<?php echo $admin->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
										<a href="javascript:void(0);" onclick="rm('<?php echo $admin->username; ?>','<?php echo $admin->id; ?>');"><span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></a></td>
									</tr>
										<?php } ?>
								</table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>