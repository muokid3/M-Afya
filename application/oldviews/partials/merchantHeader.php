<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>M-AFYA PORTAL</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <!--<script src="assets/js/chart-master/Chart.js"></script>-->
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>


    <!--common script for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url(); ?>assets/js/sparkline-chart.js"></script>    
    <script src="<?php echo base_url(); ?>assets/js/zabuto_calendar.js"></script> 


    <script type="text/javascript">



$(document).ready(function() {

  
    $('#changePassForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            oldpass: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in the Old Password!"
                    }
                }
            },

            newpass: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a New Password!"
                    }
                }
            },

            confpass: {
                validators: {
                    notEmpty: {
                        message: "You're required to fill in a Confirmation Password!"
                    },

                    identical: {
                      field: 'newpass',
                      message: "New Password and Confirm Password must match!"
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
      url: '<?php echo base_url(); ?>Home/merchantChangePass',
      type: 'post',
      data: $('#changePassForm :input'),
      dataType: 'html',
      success: function(html) {
        bootbox.alert(html);
       if(html == 'Password Changed Successfully')
      {
         $('#changePassForm')[0].reset();
         $('#changePass').modal('hide');
         location.reload();
      }

      if(html == 'Wrong Old Password')
      {
         $('#changePassForm')[0].reset();
         $('#changePass').modal('hide');
         location.reload();
      }
      

      }
    });
  });
});


</script>   

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header style="background-color:#424a5d" class="header black-bg">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:#FFF" href="<?php echo base_url(); ?>subscribers">M-Afya</a>
            </div>
            <!-- /.navbar-header -->
            <?php  $login=$this->session->userdata('logged_in') ?>
            <ul class="nav navbar-top-links navbar-right">
                <li style="float:left; margin-top:7%; color:#FFF" class="dropdown">
                         <span> Welcome </span><?php echo $login['username']; ?>
      
                </li>

                <!-- /.dropdown -->
                <li style="float:left; color:#FFF" class="dropdown">
                    <a class="dropdown-toggle" style="color:#FFF" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="#" data-toggle="modal" data-target="#changePass"><i class="fa fa-gear fa-fw"></i>Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>home/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
     

                  <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
						
             
                 
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Reports</span>
                      </a>
                      <ul class="sub">
                          <li><a href="<?php echo base_url(); ?>Merchant_transactions"><i class="fa fa-money fa-fw"></i>Transactions</a></li>
						  <!--<li><a href="<?php echo base_url(); ?>subscriber_trans"><i class="fa fa-plus-circle fa-fw"></i>Subscriber Transactions</a></li>-->
						  
						  
                         
                           
                      </ul>
                  </li>
                  

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

      
     <div id="changePass" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header" style="color:#0093af">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <center>
                        <h4 class="modal-title">Change Password</h4>
                      </center>
                  </div>
                  <div class="modal-body" id="edit-user-content">
                      <form  id="changePassForm" class="form-horizontal style-form" method="post">
                          
                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Old Password</label>
                                  <div class="col-sm-10">
                                      <input type="hidden" name="hidden_id" value="<?php echo $login['id']; ?>" class="form-control">
                                      <input type="password" name="oldpass" class="form-control">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">New Password</label>
                                  <div class="col-sm-10">
                                      <input type="password" name="newpass" class="form-control">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>
                                  <div class="col-sm-10">
                                      <input type="password" name="confpass" class="form-control">
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
      </div>    
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

          

     