<script>
	
	function edit_populate(id)
	{
		var data = 'user_id=' + id;
		var location="<?php echo base_url();?>users/settings_get_user";
		$.ajax({
			type : "POST",
			url : location,
			dataType: "json",
			data : data
			
		}).done(function(msg) {
			if (msg) {
				var edit_data=(msg);
				$('#ed_username').val(edit_data[0].username);
				$('#ed_email').val(edit_data[0].email);
				$('#ed_fname').val(edit_data[0].fname);
				$('#ed_lname').val(edit_data[0].lname);
				$('#ed_tel').val(edit_data[0].tel_number);
				$('#ed_mobile').val(edit_data[0].mob_number);
				$('#ed_adr1').val(edit_data[0].add1);
				$('#ed_adr2').val(edit_data[0].add2);
				$('#ed_adr3').val(edit_data[0].add3);
				$('#ed_pcode').val(edit_data[0].pcode);
		

			}
		});

	}	
	
	
	function settings_updatedata() {
		$('#sucess').html("Please wait..").show();
		var location="<?php echo base_url();?>users/settings_user_update";
		var id=<?php echo $user_id; ?>;
		
		$.ajax({
			type : "POST",
			url : location,
			data : {
				user_id : id,
				username : $('#ed_username').val(),
				email : $('#ed_email').val(),
				fname : $('#ed_fname').val(),
				lname : $('#ed_lname').val(),
				tel : $('#ed_tel').val(),
				mobile : $('#ed_mobile').val(),
				adr1 : $('#ed_adr1').val(),
				adr2 : $('#ed_adr2').val(),
				adr3 : $('#ed_adr3').val(),
				pcode : $('#ed_pcode').val()

			}
		}).done(function(msg) {
			if (msg == 1) {
				
				$('#sucess').html("<span class='pficon pficon-ok'></span>Data updated").css({
					"font-weight" : "bold",
					"background-color" : "#5CB75C",
					"color" : "#FFF",
					"padding": "4px"
				}).show();
				//rid= $('#role option:selected').val();
				setTimeout(function(){
   				$('#settingsModal').modal('toggle');
   				$('#sucess').hide();
				}, 1000);
			

				
				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

			}
		});
	}
	

</script>

<!--Edit users modal-->
 
		<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Edit personal data</h4>
                </div>
                <div class="modal-body">
                
         <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput">User Name(login)</label>
              <div class="col-md-6">
                <input id="ed_username" name="username" readonly required value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">Email Address</label>
              <div class="col-md-6">
                <input id="ed_email" name="email" required value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput3">First Name</label>
              <div class="col-md-6">
                <input id="ed_fname" name="fname" required value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Last Name</label>
              <div class="col-md-6">
                <input id="ed_lname" name="lname" value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Tel. Number</label>
              <div class="col-md-6">
                <input id="ed_tel" name="tel" value="" class="form-control" type="text">
              </div>
            </div>
            
             
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Mobile  No.</label>
              <div class="col-md-6">
                <input id="ed_mobile" name="mobile" required value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Address 1</label>
              <div class="col-md-6">
                <input id="ed_adr1" name="adr1" required='required' value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Address 2</label>
              <div class="col-md-6">
                <input id="ed_adr2" name="adr2" value="" class="form-control" type="text">
              </div>
            </div>
              <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Address 3</label>
              <div class="col-md-6">
                <input id="ed_adr3" name="adr3" value="" class="form-control" type="text">
              </div>
            </div>
          
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Post Code</label>
              <div class="col-md-6">
                <input id="ed_pcode" name="postal" required value="" class="form-control" type="text">
              </div>
            </div>
            
                   
            <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="settings_updatedata()" name="sub"  class="btn btn-primary">Update</button>
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button><br>
               <br>
               <span id="sucess"></span>
              </div>
            </div>
		  
		 </span>
                </div>
                <div class="modal-footer">
                	
                </div>
              </div>
            </div>
          </div>
       <!--End edit users modal-->  
       

<!--Change password modal-->
 
		<div class="modal fade" id="pwdChangeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Change password</h4>
                </div>
                <div class="modal-body">
                
         <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput">Current password</label>
              <div class="col-md-6">
                <input id="pd_current"  name="pd_current" required value="" class="form-control" type="password">
              </div>
              <span id="sucess_icn"></span>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">New password</label>
              <div class="col-md-6">
                <input id="pd_new" name="pd_new" required value="" class="form-control" type="password">
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">Retype password</label>
              <div class="col-md-6">
                <input id="pd_retype" onblur="check_password();" name="pd_retype" required value="" class="form-control" type="password">
              </div>
            </div>
                   
            <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button id="update" type="button" onclick="return password_change()" name="sub"  class="btn btn-lg btn-success">Update</button>
               <br><br>
              <span id="success_msg"></span>
              </div>
            </div>
		  
		 </span>
                </div>
                <div class="modal-footer">
                	
                </div>
              </div>
            </div>
          </div>
       <!--Change password modal-->  
<script>
//Password Change
function cleardata()
{
	$('#pd_new').val("");
	$('#pd_retype').val("");
	$('#pd_current').val("");
}
	$(document).ready(function() {
		$('#update').hide();
	$('#pd_current').blur(function() {
	var id=<?php echo $user_id; ?>;
	var pwd=$(this).val();
	var location="<?php echo base_url();?>users/settings_check_password";
	
	$.ajax({
			type : "POST",
			url : location,
			data : {
				user_id : id,
				password : pwd
			}
		}).done(function(msg) {
			if (msg) {
				if(msg==1)
				{
					$('#sucess_icn').html("<span class='pficon pficon-ok'></span> ").show();
					
					setTimeout(function(){
											   $('#sucess_icn').hide(500);
											}, 1000);
					
					$('#update').show(500);
				}
				else
				{
					$('#sucess_icn').html("<span class='pficon-layered > pficon pficon-error-octagon + pficon pficon-error-exclamation'></span> ").show();
					setTimeout(function(){
   						$('#sucess_icn').hide(500);
						}, 5000);
						$('#update').hide(100);
				}
				

			}
		});
	
});


});
function check_password()
{
	var first= $('#pd_new').val();
	var second= $('#pd_retype').val();
	if(first!=second)
	{
		alert('Password mismatch');
		$('#pd_retype').val("");
	}
}

function password_change()
{
	var first= $('#pd_new').val();
	var second= $('#pd_retype').val();
	var org= $('#pd_current').val();
	if((first=="") || (second=="") || (org=""))
	{
		alert("Please fill all the fields");
		return false;
	}
	else
	{
		$('#success_msg').html("Please wait...").show();
		var id=<?php echo $user_id; ?>;
		var location="<?php echo base_url();?>users/settings_change_password";
		$.ajax({
			type : "POST",
			url : location,
			data : {
				user_id : id,
				password : first
			}
		}).done(function(msg) {
			if (msg) {
				if(msg==1)
				{
					$('#success_msg').html("<span class='pficon pficon-ok'></span><font color= 'green'>Password updated</font> ").show();
					setTimeout(function(){
   						$('#success_msg').hide(500);
   						$('#pwdChangeModal').modal('toggle');
						}, 1000);
				}
				else
				{
					$('#success_msg').html("<span style='font-weight: bold; color: red;'>Some error occurred</span>").show();
					setTimeout(function(){
   						$('#success_msg').hide(500);
						}, 5000);
				}
				

			}
		});
	}	
}
</script>