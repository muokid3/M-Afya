<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>M-Afya</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
        <div class="container">
        
            
            <?php $attributes = array('class' =>'form-login'); ?>
            <?php echo form_open('login/verifylogin', $attributes); ?>
            
                <h2 class="form-login-heading">Log in now</h2>
                <div class="login-wrap">
                
                    <fieldset>
                        <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                        <br>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <label class="checkbox">
                            <span class="pull-right">
                                <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
            
                            </span>
                            <span class="pull-left">
                                <a data-toggle="modal" href="#merchantLogin"> Merchant Login</a>
            
                            </span>
                        </label><?php echo validation_errors(); ?>
                        <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> LOG IN</button>
                    </fieldset>
            </form>
                    <hr>
                    
                    
                    
        
                </div>
        
                  <!-- Modal -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title">Forgot Password ?</h4>
                              </div>
                              <div class="modal-body">
                            <form>
                                  <p>Enter your e-mail address below to reset your password.</p>
                                  <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
        
                              </div>
                              <div class="modal-footer">
                                  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                  <button class="btn btn-theme" type="button">Submit</button>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
                  <!-- modal -->

                  <!-- Modal -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="merchantLogin" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 align="center" class="modal-title">Merchant Login</h4>
                              </div>
                              <div class="modal-body">
                                  <fieldset>
                                  <?php $attributes = array('class' =>'form-login', 'style' => 'margin-top:0px'); ?>
                                  <?php echo form_open('login/merchantLogin', $attributes); ?>
                                  
                                      
                                  
                                      
                                          
                                              <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                                              <br>
                                              <input type="password" class="form-control" name="password" placeholder="Password">
                                              <span>
                                                <?php echo validation_errors(); ?>
                                              <span>
                                              <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> LOG IN</button>
                                          </fieldset>
                                  </form>
                            
                              </div>
                      </div>
                  </div>
                  <!-- modal -->
        
                     
        
        </div>
      </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/weather.jpg", {speed: 500});
    </script>


  </body>
</html>
