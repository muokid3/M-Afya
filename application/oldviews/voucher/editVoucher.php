			
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
	    url: '<?php echo base_url(); ?>voucher/edit',
	    type: 'post',
	    data: $('#editForm :input'),
	    dataType: 'html',		
	    success: function(html) {
		   if(html == 'Voucher successfully Updated')
		   {
			   $('#editForm')[0].reset();
			   
			  
		   }
		   bootbox.alert(html);
		   
		   $('#editVoucher').modal('hide');
			  location.reload();
	    }
    });
  });
});

</script>					<form id="editForm" class="form-horizontal style-form" method="post">
							<?php
								$voucher = $voucher->result()[0];
							?>
		                          <div class="form-group">
		                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
		                              <div class="col-sm-10">
		                                  <input type="hidden" name="voucher_id" value="<?php echo $voucher->id; ?>" class="form-control">
		                                  <input type="text" name="name" value="<?php echo $voucher->name; ?>" class="form-control">

		                              </div>
		                          </div>

		                          	<div class="form-group">
										<label class="col-sm-2 control-label">Description </label>
										<div class="col-sm-10">
											<textarea class="form-control" rows="3" name="description"><?php echo $voucher->description; ?></textarea>
										</div>
									</div>

									 <div class="modal-footer">
					                <center>
						                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						                <button type="submit" class="btn btn-primary">Save</button>
					                </center>
					            	</div>
		                          
		                    </form>