	
<script type="text/javascript">
$(document).ready(function() {
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
                        message: 'Name is required and cannot be empty'
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
	    url: '<?php echo base_url(); ?>role/edit',
	    type: 'post',
	    data: $('#editForm :input'),
	    dataType: 'html',		
	    success: function(html) {
		   if(html == 'Role successfully Updated')
		   {
			   $('#editForm')[0].reset();
			   
			  
		   }
		   bootbox.alert(html);
		   
		   $('#editRole').modal('hide');
			  location.reload();
	    }
    });
  });
});

</script>

	<form id="editForm" method="post" class="form-horizontal">
	<?php 
	$role = $role->result()[0];
	?>
		<div class="form-group">
			<label class="col-lg-3 control-label">Name <sup>*</sup></label>
			<div class="col-lg-9">
			<input type="hidden" name="item_id" value="<?php echo $role->id; ?>" />
				<input value ="<?php echo $role->name; ?>" type="text" class="form-control" name="name"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label">Description </label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="3" name="description"><?php echo $role->description; ?></textarea>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	</form>