<?php $this->load->helper('url');?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
  <head>
    <title>Dashboard - Dovecor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>system/assets/css/patternfly/dist/img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>system/assets/css/patternfly/dist/img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>system/assets/css/patternfly/dist/img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>system/assets/css/patternfly/dist/img/apple-touch-icon-57-precomposed.png">
    <link href="<?php echo base_url();?>system/assets/css/patternfly/dist/css/patternfly.css" rel="stylesheet" media="screen, print">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../components/html5shiv/dist/html5shiv.min.js"></script>
    <script src="../components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <!-- IE8 requires jQuery and Bootstrap JS to load in head to prevent rendering bugs -->
    <!-- IE8 requires jQuery v1.x -->
    <script src="<?php echo base_url();?>system/assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url();?>system/assets/css/patternfly/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>system/assets/css/patternfly/dist/js/patternfly.min.js"></script>
    <script src="<?php echo base_url();?>system/assets/css/patternfly/components/bootstrap-select/bootstrap-select.min.js"></script>
    <script>
      // Initialize Boostrap-select
      $(document).ready(function() {
        $('.selectpicker').selectpicker();
      });
    </script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-pf" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
        	<strong>DOVECOR</strong> ENTERPRISE APPLICATION     
         
        </a>
      </div>
      <div class="collapse navbar-collapse navbar-collapse-1">
        <ul class="nav navbar-nav navbar-utility">
          <li>
           <a style="font-weight: bold; margin-right:  20px;"  href="<?php echo base_url();?>">Login</a>
          </li>
          <!--
          <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="pficon pficon-user"></span>
                        User <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#">Link</a>
                        </li>
                        <li>
                          <a href="#">Another link</a>
                        </li>
                        <li>
                          <a href="#">Something else here</a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu">
                          <a tabindex="-1" href="#">More options</a>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="#">Link</a>
                            </li>
                            <li>
                              <a href="#">Another link</a>
                            </li>
                            <li>
                              <a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li>
                              <a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                              <a href="#">One more separated link</a>
                            </li>
                          </ul>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a href="index.html">Logout</a>
                        </li>
                      </ul>
                    </li>-->
          
        </ul>
       <!--
        <ul class="nav navbar-nav navbar-primary">
                 <li class="active">
                   <a href="dashboard.html">Dashboard</a>
                 </li>
                 <li>
                   <a href="#">Sales</a>
                 </li>
                 <li>
                   <a href="#">Traffic</a>
                 </li>
                 <li>
                   <a href="#">Analytics</a>
                 </li>
                 <li>
                   <a href="#">Admin</a>
                 </li>
               </ul>-->
       
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <!--
            <li><a href="#">Home</a></li>
                        <li>Dashboard</li>-->
            
          </ol>
          <h1 style="font-weight: bold;">Registration</h1>
          <?php 
          	$this->load->helper('form');
			$this->load->library('form_validation');
          	echo '<label style="color: red;">'.validation_errors().'</label>';
          	echo form_open('users/create');
          ?>
		<span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput">User Name(login)</label>
              <div class="col-md-6">
                <input id="username" name="username" required value="<?php echo set_value('username');?>" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">Email Address</label>
              <div class="col-md-6">
                <input id="email" name="email" required value="<?php echo set_value('email');?>" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput3">First Name</label>
              <div class="col-md-6">
                <input id="fname" name="fname" required value="<?php echo set_value('fname');?>" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Last Name</label>
              <div class="col-md-6">
                <input id="lname" name="lname" value="<?php echo set_value('lname');?>" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Tel. Number</label>
              <div class="col-md-6">
                <input id="tel" name="tel" value="<?php echo set_value('tel');?>" class="form-control" type="text">
              </div>
            </div>
            
             
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Mobile  No.</label>
              <div class="col-md-6">
                <input id="mobile" name="mobile" required value="<?php echo set_value('mobile');?>" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Address 1</label>
              <div class="col-md-6">
                <input id="adr1" name="adr1" required='required' value="<?php echo set_value('adr1');?>" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Address 2</label>
              <div class="col-md-6">
                <input id="adr2" name="adr2" value="<?php echo set_value('adr2');?>" class="form-control" type="text">
              </div>
            </div>
              <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Address 3</label>
              <div class="col-md-6">
                <input id="adr3" name="adr3" value="<?php echo set_value('adr3');?>" class="form-control" type="text">
              </div>
            </div>
          
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Post Code</label>
              <div class="col-md-6">
                <input id="post" name="postal" required value="<?php echo set_value('postal');?>" class="form-control" type="text">
              </div>
            </div>
            
           
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Password</label>
              <div class="col-md-6">
                <input id="adr3" name="password" required class="form-control" type="password">
              </div>
            </div>
           
         
            
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Re-type Password</label>
              <div class="col-md-6">
                <input id="password" name="password_check" required class="form-control" type="password">
              </div>
            </div>
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-8">
                <button type="submit" name="sub"  class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default">Cancel</button>
              </div>
            </div>
		  
		 </span>
         </form>
        </div><!-- /col -->
        <!--
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Link 1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#">active link</a></li>
                            <li><a href="#">sub link 1</a></li>
                            <li><a href="#">sub link 2</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                            Link 2
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                          <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">sublink 1</a></li>
                            <li><a href="#">sublink 2</a></li>
                            <li><a href="#">sublink 3</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                            Link 3
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">sub link 1</a></li>
                            <li><a href="#">sublink 2</a></li>
                            <li><a href="#">sublink 3</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /col -->
        
      </div><!-- /row -->
    </div><!-- /container -->
    <div id="footer">
			<p>All rights reserved &copy; Dovecor Digital CC</p>
		</div>
  </body>
</html>
