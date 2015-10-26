			
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
	    url: '<?php echo base_url(); ?>Service_providers/actionVerify/',
	    type: 'post',
	    data: $('#editForm :input'),
	    dataType: 'html',		
	    success: function(html) {
		   if(html == 'Service Provider Verified Successfully')
		   {
			   $('#editForm')[0].reset();
			   
			  
		   }
		   bootbox.alert(html);
		   
		   $('#edit').modal('hide');
			  location.reload();
	    }
    });
  });
});

</script>					<form id="editForm" class="form-horizontal style-form" method="post">
							<?php
								$provider = $sprovider->result();
								$sprovider = $provider[0];
							?>
		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
		                              <div class="col-sm-4">
		                                  <input type="hidden" name="provider_id" value="<?php echo $sprovider->id; ?>" class="form-control">
		                                  <input type="text" name="bs_name" value="<?php echo $sprovider->bs_name; ?>" class="form-control">

		                              </div>
		                          
										<label class="col-sm-2 control-label">Phone No. </label>
										<div class="col-sm-4">
											<input type="text" name="phone_no" value="<?php echo $sprovider->phone_no; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Location </label>
										<div class="col-sm-4">
											<input type="text" name="location" value="<?php echo $sprovider->location; ?>" class="form-control">
										</div>
									
										<label class="col-sm-2 control-label">E Mail </label>
										<div class="col-sm-4">
											<input type="text" name="email" value="<?php echo $sprovider->email; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Commission </label>
										<div class="col-sm-4">
											<input type="text" name="commission" value="<?php echo $sprovider->commission; ?>" class="form-control">
										</div>
									
										<label class="col-sm-2 control-label">Username </label>
										<div class="col-sm-4">
											<input type="text" name="username" value="<?php echo $sprovider->username; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">PIN </label>
										<div class="col-sm-4">
											<input type="text" name="merchant_pin" value="<?php echo $sprovider->merchant_pin; ?>" class="form-control">
										</div>
									
										<label class="col-sm-2 control-label">Preffered Settlement </label>
										<div class="col-sm-4">
											<input type="text" name="preferred_settlement" value="<?php echo $sprovider->preferred_settlement; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Bank Account No. </label>
										<div class="col-sm-4">
											<input type="text" name="merchant_bank_account" value="<?php echo $sprovider->merchant_bank_account; ?>" class="form-control">
										</div>
									
										<label class="col-sm-2 control-label">Bank Name </label>
										<div class="col-sm-4">
											<input type="text" name="merchant_bank_name" value="<?php echo $sprovider->merchant_bank_name; ?>" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Bank Branch </label>
										<div class="col-sm-4">
											<input type="text" name="merchant_bank_branch" value="<?php echo $sprovider->merchant_bank_branch; ?>" class="form-control">
										</div>
									</div>

									 <div class="modal-footer">
					                <center>
						                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						                <button type="submit" class="btn btn-primary">Save</button>
					                </center>
					            	</div>
		                          
		                    </form>