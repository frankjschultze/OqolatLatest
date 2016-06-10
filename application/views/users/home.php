<?php $this->load->helper('url');

?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
  <head>
    <title><?php echo $title;?></title>
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
           <a  href="<?php echo base_url();?>home/logout">Logout</a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="pficon pficon-user"></span>
              <?php echo $user_name;?> <b class="caret"></b>
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
               <a  href="<?php echo base_url();?>home/logout">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-primary">
          <li class="active">
            <a href="#">Dashboard</a>
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
            <a href="<?php echo base_url();?>admin">Admin</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          
          <h3></h3><br><br>
        	<label class="label label-danger"><?php echo $role_name; ?> not defined. Please contact admin</label>
        </div><!-- /col -->
        
      </div><!-- /row -->
    </div><!-- /container -->
    
  </body>
</html>
