<script type="text/javascript">
$(document).ready(function() {
$("#edit_active_").change(function() {
    if(this.checked) {
        $('#edit_active').val(1);
    }
	else
		$('#edit_active').val(0);
});
    $('#editForm').bootstrapValidator({
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
	    url: '<?php echo base_url(); ?>admin/edit',
	    type: 'post',
	    data: $('#editForm :input'),
	    dataType: 'html',		
	    success: function(html) {
		   bootbox.alert(html);
		   if(html == 'System User successfully Updated')
		   {
				$('#editForm')[0].reset();
				$('#editAdmin').modal('hide');
				location.reload();
		   }
	    }
    });
  });
});

</script>
	<form id="editForm" method="post" class="form-horizontal">
	<?php 
	$admin = $admin->result()[0];
	?>
		<div class="form-group">
			<label class="col-lg-3 control-label">Name <sup>*</sup></label>
			<div class="col-lg-9">
			<input type="hidden" name="item_id" value="<?php echo $admin->id; ?>" />
				<input value ="<?php echo $admin->name; ?>" type="text" class="form-control" name="name"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label">Select Role <sup>*</sup></label>
			<div class="col-lg-9">
				<select class="form-control" id="role" name="role">
					<?php foreach ($roles->result() as $role){?>
					<option value="<?php echo $role->id; ?>" <?php if($role->id == $admin->role) {?> selected="Yes" <?php } ?>><?php echo $role->name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
                <input type="hidden" name="active" id="active">
			<div class="col-lg-8" style="padding-left:50px;">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="edit_active_" id="edit_active_" class="edit_active_" <?php if($admin->status == 1) {?> checked="checked" <?php } ?>/> <b>Active Status</b>
					</label>
					<input type="hidden" name="edit_active" id="edit_active" value="<?php echo $admin->status; ?>" />
				</div>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	</form>