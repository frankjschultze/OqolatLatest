<?php $this->load->helper('url');
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 login-pf"><![endif]-->
<!--[if IE 9]><html class="ie9 login-pf"><![endif]-->
<!--[if gt IE 9]><!-->
<html class="login-pf">
	<!--<![endif]-->
	<head>
		<title>Dovecor</title>
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

		<script type="text/javascript">
			$(document).ready(function() {
				$('#submit').click(function() {
					var username = $('#user').val();
					var password = $('#pass').val();
					if (username == "") {
						$('#dis').show(500);
						$('#dis').slideDown().html("<span style='color: red;'>Please type Username</span>");
						return false;
					} else if (password == "") {
						$('#dis').show(500);
						$('#dis').slideDown().html('<span span style="color: red;">Please type Password</span>');
						return false;
					}
					/*
					else
										{
											$('#dis').show(500);
											$('#dis').slideDown().html('<span span style="color: red;">Invalid username or password. (dovecor/password)</span>');
											return false;
										}*/
					
				});
				<?php
			if(isset($error))
			{?>
				$('#dis').show(500);
				$('#dis').slideDown().html('<span span style="color: red;"><?php echo $error; ?></span>');
				<?php
			}
			?>
			});
			
		</script>

	</head>
	<body>
		<span id="badge"> {logo} </span>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="brand">
						<h1><strong>DOVECOR</strong> ENTERPRISE APPLICATION </h1>
					</div><!--/#brand-->
					<?php
					if(isset($msg))
						echo $msg; ?>
				</div><!--/.col-*-->
				<div class="col-sm-7 col-md-6 col-lg-5 login">
					<?php
					$this->load->helper('form');
					$this->load->library('form_validation');
					echo form_open('users/login_check');
					?>
					<span class="form-horizontal" role="form">
						<div class="form-group">
							<label id="dis" style="color: red;"></label>
							<br>
							<label for="inputUsername"  class="col-sm-2 col-md-2 control-label">Username</label>
							<div class="col-sm-10 col-md-10">
								<input type="text" name="username" class="form-control" id="user" placeholder="" tabindex="1">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword"  class="col-sm-2 col-md-2 control-label">Password</label>
							<div class="col-sm-10 col-md-10">
								<input type="password" name="password" class="form-control" id="pass" placeholder="" tabindex="2">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-8 col-sm-offset-2 col-sm-6 col-md-offset-2 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" tabindex="3">
										Remember Username </label>
								</div>
								<span class="help-block" style="width: 115%;"> Forgot <a style="color: #FAE026;" href="users/change_password" tabindex="5">Username</a> or <a href="users/change_password" style="color: #FAE026" tabindex="6">Password</a><span>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 submit">
								<button type="submit" class="btn btn-primary btn-lg" id="submit" tabindex="4">
									Log In
								</button>
							</div>
						</div>
					</span>
					</form>
				</div><!--/.col-*-->
				<div class="col-sm-5 col-md-6 col-lg-7 details">
					<p>
						<strong>Welcome to Dovecor!</strong>
						<br>
						Introduction message
					</p>
				</div><!--/.col-*-->
			</div><!--/.row-->
		</div><!--/.container-->
		
	</body>
</html>
