<?php $this->load->helper('url');
if(!isset($role_id))
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
  <head>
   <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>system/assets/css/patternfly/dist/img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>system/assets/css/patternfly/dist/img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>system/assets/css/patternfly/dist/img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>system/assets/css/patternfly/dist/img/apple-touch-icon-57-precomposed.png">
    <link href="<?php echo base_url(); ?>system/assets/css/patternfly/dist/css/patternfly.css" rel="stylesheet" media="screen, print">
    <link href="<?php echo base_url(); ?>system/assets/css/patternfly/dist/css/datepicker.css" rel="stylesheet" media="screen, print">
    <script src="<?php echo base_url(); ?>system/assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/components/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/components/datatables-colvis/js/dataTables.colVis.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/components/datatables-colreorder/js/dataTables.colReorder.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/dist/js/patternfly.min.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/components/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url(); ?>system/assets/css/patternfly/components/Bootstrap-DatePicker/bootstrap-datepicker.js"></script>
   <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../components/html5shiv/dist/html5shiv.min.js"></script>
    <script src="../components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <!-- IE8 requires jQuery and Bootstrap JS to load in head to prevent rendering bugs -->
    <!-- IE8 requires jQuery v1.x -->
  </head>
  <body>
  	<?php include("settings.php"); ?>
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
           <!--<a  href="<?php echo base_url();?>home/logout">Logout</a>-->
           <a  href="#"><b><?php echo $role_name;?></b></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="pficon pficon-user"></span>
              <?php echo $user_name;?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li>
               <a class='edit ml10' href='javascript:void(0)' onclick='edit_populate(<?php echo $user_id;?>)' data-toggle='modal' data-target='#settingsModal' title='Settings'>Settings</a>
              </li>
              <li>
                 <a class='edit ml10' href='javascript:void(0)' onclick='cleardata();' data-toggle='modal' data-target='#pwdChangeModal' title='Change password'>Change password</a>
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
          <li class="<?php echo $link_val1;?>">
            <a href="<?php echo base_url();?>users/dashboard">Dashboard</a>
          </li>
         <li class="<?php echo $link_val2;?>">
            <a href="<?php echo base_url().strtolower($role_name);?>"><?php echo $role_name;?></a>
          </li>
        </ul>
      </div>
    </nav>
   