	
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
                        message: 'Role name is required and cannot be empty'
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
	    url: '<?php echo base_url(); ?>role/add',
	    type: 'post',
	    data: $('#addForm :input'),
	    dataType: 'html',		
	    success: function(html) {
		   if(html == 'Role successfully added')
		   {
			   $('#addForm')[0].reset();
			   
			   $('#addRole').on('hidden.bs.modal',
			   function () {
			   location.reload();
			   });
			   
			   $('#addRole').modal('hide');
			   
		   }
		   bootbox.alert(html);
	    }
    });
  });
});

function edit(id)
{
$.ajax({
	    url: '<?php echo base_url(); ?>role/edit/' + id,
	    type: 'post',
	    dataType: 'html',		
	    success: function(html) {
		   $('#edit-role-content').html(html);
			   
	    }
    });
}

function rm(nm,id){
  bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
      if(result) {
      
	  $.ajax({
		url: '<?php echo base_url(); ?>role/delete/' + id,
		type: 'post',
		data: {id: id},
		dataType: 'html',		
		success: function(html) {
		    if(html == 'User Deleted Successful')
				bootbox.alert(html);
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
					<h1 class="page-header"><i class="fa fa-wrench"></i> Roles</h1>
				</div>
			</div>
			
				
		<div id="editRole" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Edit Role Details</h4>
					</div>
					<div class="modal-body" id="edit-role-content">
						
					</div>
				</div>
			</div>
		</div>
		
		<div id="addRole" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Add a Role</h4>
					</div>
					<div class="modal-body">
						<form id="addForm" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-3 control-label">Name <sup>*</sup></label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="name" placeholder="Role Name" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Description </label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="3" name="description" placeholder="Enter Role Description"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary">Add Role</button>
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
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRole"><span class="fa fa-plus"></span> Add Role</button>
						</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
								<table class="table table-bordered table-stripped">
									<tr>
										<th class="col-md-1">No</th>
										<th class="col-md-2">Name</th>
										<th class="col-md-3">Description</th>
										<th class="col-md-2">Actions</th>
									</tr>
										<?php 	foreach ($roles->result() as $role){?>
									<tr>
										<td><?php echo $role->id; ?></td>
										<td><?php echo $role->name; ?></td>
										<td><?php echo $role->description; ?></td>
										<td><span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRole" onclick="edit('<?php echo $role->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
										<a href="javascript:void(0);" onclick="rm('<?php echo $role->name; ?>','<?php echo $role->id; ?>');"><span class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></a></td>
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