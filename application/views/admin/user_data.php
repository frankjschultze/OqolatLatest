<script>
		var user_data = <?php echo json_encode($result); ?>;
		var roles_json =<?php echo json_encode($roles); ?>;
		var tableView_json = <?php echo json_encode($table_view);?>;
	   
        /*Displaying Roles in table*/
		$(document).ready(function() {
			$('.selectpicker').selectpicker();
			$('#del_row').hide();
			var leng = user_data.length;
			var lengt = roles_json.length;
			if(leng > 0){
				for(var j=0;j<leng;j++){
				var user_rid=user_data[j].users_role;
				for(var k=0; k<lengt; k++)
				{
					var ids = user_data[j].user_id;
					if(user_rid == roles_json[k].roles_id)
					{
						$('#t11_'+ids).html(roles_json[k].roles_name);
					}
					if($('#t11_'+ids).is(':empty') ) {
						$('#t11_'+ids).html("<font style='font-style: italic;'>pending</font>");
					}
				}
				
			}

			}

		});

   
    function get_stations(id)
    {

      var station;
      $.ajax({
    	    url: 'get_stations',
    	    dataType:'json',
    	    method: "POST",
    	    async: false,
    	    data : {id:id},
    	    success: function(json){
    	          	              station=json;
    	        }
    	    
    	    
    	});
    	return station;
    }    
		
	function modal_populate(id) {
		$('#rowkey').val(id);
		$('#uid').val(user_data[id].user_id);
		$('#username').val(user_data[id].username);
		$('#email').val(user_data[id].email);
		$('#fname').val(user_data[id].fname);
		$('#lname').val(user_data[id].lname);
		$('#tel').val(user_data[id].tel_number);
		$('#mobile').val(user_data[id].mob_number);
		$('#adr1').val(user_data[id].add1);
		$('#adr2').val(user_data[id].add2);
		$('#adr3').val(user_data[id].add3);
		$('#pcode').val(user_data[id].pcode);
		var role=user_data[id].users_role;
		//alert(roles_json[id].roles_id );
		//var roleupd=roles_json[id].roles_id;
		var txt="";
		var key="";
		var val="";
		$('#role')
    	.empty();
		
		
		var len = roles_json.length;
		if(len > 0){
                  for(var i=0;i<len;i++){
		
		
			
    	if(roles_json[i].roles_id == role)
    	{
    		txt+="<option value='"+roles_json[i].roles_id +"'>"+roles_json[i].roles_name +"</option>";
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Please choose role</option>";
		}
		
		
		
			
    	
	//	else
	//	{
		//	txt+="<option value=''>Please choose user role</option>";
	//	}
		$("#role").append(txt);
	//	$('select').append($('<option>', {value:1, text:'One'}));
		
			
		$.each(roles_json,function(key,val) {
           $('#role').append('<option value="'+ roles_json[key].roles_id + '">' + roles_json[key].roles_name + '</option>');
		});

		
		var station=get_stations(user_data[id].user_id);
        $('#stations').empty();
        $.each(station,function(key,val)
        { 
            
           if(station[key].user_id)
        	{	
        	    $('#stations').append('<option value="'+ station[key].id +'" selected>' + station[key].name + '</option>');
        	}
        	else
        	{
        		$('#stations').append('<option value="'+ station[key].id +'">' + station[key].name + '</option>');
        	}	    
		});
		$('.selectpicker').selectpicker('refresh');

	}

	function modal_del_populate(id) {
		$("#deluser").hide();
		$('#rowkey').val(id);
		//$('#userstatus').val(status);
		$('#userstatus').val(user_data[id].users_status);
		$('#uid').val(user_data[id].user_id);
		$('#username').val(user_data[id].username);
		var fname = user_data[id].fname;
		var lname = user_data[id].lname;
		var st=user_data[id].users_status;
		if(st==1)
		{
			$("#deluser").show();
			$("#deluser").html("&nbsp;deactivate&nbsp;" + fname + '&nbsp;' + lname);
		}
		else
		{
			$("#deluser").show();
			$("#deluser").html("&nbsp;activate&nbsp;" +fname + '&nbsp;' + lname);
		}
	}

	function updatedata() {
		var key = $('#rowkey').val();
		
		$.ajax({
			type : "POST",
			url : "user_update",
			data : {
				user_id : $('#uid').val(),
				username : $('#username').val(),
				email : $('#email').val(),
				fname : $('#fname').val(),
				lname : $('#lname').val(),
				tel : $('#tel').val(),
				mobile : $('#mobile').val(),
				adr1 : $('#adr1').val(),
				adr2 : $('#adr2').val(),
				adr3 : $('#adr3').val(),
				pcode : $('#pcode').val(),
				role_id : $('#role option:selected').val(),
				stations : $('#stations').val()

			}
		}).done(function(msg) {
			if (msg == 1) {
				user_data[key].user_id = $('#uid').val();
				var ad = $('#uid').val();
				user_data[key].username = $('#username').val();
				user_data[key].email = $('#email').val();
				user_data[key].fname = $('#fname').val();
				user_data[key].lname = $('#lname').val();
				user_data[key].tel_number = $('#tel').val();
				user_data[key].mob_number = $('#mobile').val();
				user_data[key].add1 = $('#adr1').val();
				user_data[key].add2 = $('#adr2').val();
				user_data[key].add3 = $('#adr3').val();
				user_data[key].pcode = $('#pcode').val();
				user_data[key].users_role = $('#role option:selected').val();
				
				//rid= $('#role option:selected').val();
				$('#myModal').modal('toggle');

				$('#t1_' + ad).html($('#uid').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t2_' + ad).html($('#username').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t3_' + ad).html($('#fname').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t4_' + ad).html($('#lname').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t5_' + ad).html($('#email').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t6_' + ad).html($('#tel').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t7_' + ad).html($('#mobile').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t8_' + ad).html($('#adr1').val() + "<br>" + $('#adr2').val() + "<br>" + $('#adr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t9_' + ad).html($('#pcode').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t11_' + ad).html($('#role option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

			}
		});
	}

	function change_status_user() {

		var key = $('#rowkey').val();
		var status = $('#userstatus').val();
		if(status==1)
			var ustatus=2;
		else
			var ustatus=1;
		$.ajax({
			type : "POST",
			url : "user_change_status",
			data : {
				user_id : $('#uid').val(),
				status : status

			}

		}).done(function(msg) {
			if (msg == 1) {

				var ad = $('#uid').val();
				//var status = $('#userstatus').val();
				user_data[key].users_status = ustatus;
				//Hide  a row
				/*
				$("#r1_" + ad).animate({ backgroundColor: "#fbc7c7" }, "fast")
				.animate({ opacity: "hide" }, "slow");*/
				
				//End hide a row
				
				$("#r1_" + ad).css({
					"font-weight" : "bold",
					"background-color" : "#FFF",
					"color" : "#333"
				});
				//.animate({ opacity: "hide" }, "slow");
				
				//$('#r1_' + ad).html("dleep");
				$('#modalDel').modal('toggle');
			//	location.reload();
				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
	}

	$(document).ready(function() {
    $('#selectall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row').fadeIn(200);
			     $('#del_row').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal"  data-target="#modalDelall" title="Remove"><span style="color: #800; font-weight: bold;" >Delete selected: <span class="pficon pficon-delete"></span></a>');       
            });
           $("#selectall_e").prop("checked", true);
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"      
                 $('#del_row').fadeOut(500);                    
            });  
           $("#selectall_e").prop("checked", false);    
        }
    });
    
    $('#selectall_e').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row').fadeIn(200);
			     $('#del_row').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal"  data-target="#modalDelall" title="Remove"><span style="color: #800; font-weight: bold;" >Delete selected: <span class="pficon pficon-delete"></span></a>');       
            });
           $("#selectall").prop("checked", true);
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"      
                $('#del_row').fadeOut(500);                  
            });  
           $("#selectall").prop("checked", false);    
        }
    });
    var f=0;
    $('.checkbox1').click(function(event) {  //on click
        if(this.checked) { // check select status
           
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row').fadeIn(200);
			     $('#del_row').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal"  data-target="#modalDelall" title="Remove"><span style="color: #800; font-weight: bold;" >Delete selected: <span class="pficon pficon-delete"></span></a>');       
           
           
        }else{
            
            $('.checkbox1').each(function() { //loop through each checkbox
               if(this.checked == true)
               { 
               		var f=1;   
                exit();
               }
                   
            }); 
            if(f==0)
            {
            	 $('#del_row').fadeOut(500);
            }    
        }
          
    });
    
});


function deletedata_all() {

	// event.preventDefault();
    var searchIDs = $(".datatable input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
  		var ad = searchIDs;
		var data = 'user_id=' + searchIDs;
		$.ajax({
			type : "POST",
			url : "user_delete_selected",
			data : data

		}).done(function(msg) {
			if (msg == 1) {
				// var myaddr= ad.split(',');
				//var array = JSON.parse("[" + ad + "]");
				 $.each(ad, function(i,element){
				 	
                   	$("#r1_"+element).animate({ backgroundColor: "#fbc7c7" }, "fast")
					.animate({ opacity: "hide" }, "slow");
					
                });
		//$("#r1_"+ad).animate({ backgroundColor: "#fbc7c7" }, "fast")
//.animate({ opacity: "hide" }, "slow");
		
		
				
				$('#modalDelall').modal('toggle');
				//$('#r1_' + ad).html("dleep");
				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
	}
	
</script>
  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2" style="min-height: 598px;">
          <ol class="breadcrumb">
            <li><a href="admin">Admin</a></li>
            <li><?php echo $title;?></li>
          </ol>
          <h3></h3>
           <span id="success_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-success"></span>
            <span id="warning_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-warning"></span>
           <label style="top: 32px; position: absolute;" class="btn btn-sm btn-default" id="del_row" type="button"></label>
         <div class="table-responsive">
		 <table id="example" class="datatable table table-striped table-bordered">
        <thead>
        	
            <tr>
                <th>
                <input type="checkbox" id="selectall" >
              </th>
                <th>User Id</th>
                <th>User Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Tel.No</th>
                <th>Mob.No</th>
                <th>Address</th>
                <th>Post code</th>
                <th>Status</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            
        </thead>
 
        <tfoot>
        	
            <tr>
            	<th>
                <input type="checkbox" id="selectall_e">
              </th>
                <th>User Id</th>
                <th>User Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Tel.No</th>
                <th>Mob.No</th>
                <th>Address</th>
                <th>Post code</th>
                <th>Status</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </tfoot>
 
        <tbody>
        	<?php
         if($result)
		{
		 foreach ($result as $row=>$res)
		 {
			 $ud=$res['user_id'];
			 $user_status=$res['users_status'];
			 if($user_status==2)
			 {
			 	 ?> <tr style="font-style: ; color: #1569C7; " id="r1_<?php echo $ud; ?>"><?php
			 }
			 else {?>
				 <tr id="r1_<?php echo $ud; ?>">
				 	<?php
			 }
			 $stus=$res['users_status'];
			 if($stus==1)
			 {
			 	$status=" <div class='onoffswitch'>
    						<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='".$ud."1' checked>
    <label class='onoffswitch-label' for='".$ud."1'>
    <span class='onoffswitch-inner'></span>
    <span class='onoffswitch-switch'></span>
    </label>
    </div> ";
			 }
			 else {
				 $status="<div class='onoffswitch'>
    						<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='".$ud."1'>
    <label class='onoffswitch-label' for='".$ud."1'>
    <span class='onoffswitch-inner'></span>
    <span class='onoffswitch-switch'></span>
    </label>
    </div>";
			 }
			 ?>
		 
            
            	<td>
                <input type="checkbox" id="check[]"  value="<?php echo $res['user_id']; ?>" class="checkbox1" name="check[]">
              </td>
            	<td id="t1_<?php echo $ud; ?>"><?php echo $res['user_id']; ?></td>
                <td id="t2_<?php echo $ud; ?>"><?php echo $res['username']; ?></td>
                <td id="t3_<?php echo $ud; ?>"><?php echo $res['fname']; ?></td>
                <td id="t4_<?php echo $ud; ?>"><?php echo $res['lname']; ?></td>
                <td id="t5_<?php echo $ud; ?>"><?php echo $res['email']; ?></td>
                <td id="t6_<?php echo $ud; ?>"><?php echo $res['tel_number']; ?></td>
                <td id="t7_<?php echo $ud; ?>"><?php echo $res['mob_number']; ?></td>
                <td id="t8_<?php echo $ud; ?>"><?php echo $res['add1'] . '<br>' . $res['add2'] . '<br>' . $res['add3']; ?></td>
                <td id="t9_<?php echo $ud; ?>"><?php echo $res['pcode']; ?></td>
                <td id="t10_<?php echo $ud; ?>"><label onclick="modal_del_populate(<?php echo $row; ?>)" data-toggle="modal" data-target="#modalDel" title="Change status">
                <?php echo $status; ?></label></td>
                <td id="t11_<?php echo $ud; ?>"></td>
                <td>
                	<a class="edit ml10" href="javascript:void(0)" onclick="modal_populate(<?php echo $row; ?>)" data-toggle="modal" data-target="#myModal" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                	<!--<a class="remove ml10" href="javascript:void(0)" onclick="modal_del_populate(<?php echo $row; ?>)" data-toggle="modal" data-target="#modalDel" title="Change status"><i class="glyphicon glyphicon-remove"></i></a>-->
                	</td>
               
            </tr>
            <?php } } ?>
        </tbody>
    </table>
	</div>
 <!--Edit users modal-->
 
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Edit user/Set user role</h4>
                </div>
                <div class="modal-body">
                 <?php

				$this -> load -> helper('form');
				$this -> load -> library('form_validation');
				echo '<label style="color: red;">' . validation_errors() . '</label>';
				echo form_open('admin/user_update');
          ?>
          <input type="hidden" id="uid" value="" />
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput">User Name(login)</label>
              <div class="col-md-6">
                <input id="username" name="username" readonly required value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">Email Address</label>
              <div class="col-md-6">
                <input id="email" name="email" required value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput3">First Name</label>
              <div class="col-md-6">
                <input id="fname" name="fname" required value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Last Name</label>
              <div class="col-md-6">
                <input id="lname" name="lname" value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Tel. Number</label>
              <div class="col-md-6">
                <input id="tel" name="tel" value="" class="form-control" type="text">
              </div>
            </div>
            
             
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Mobile  No.</label>
              <div class="col-md-6">
                <input id="mobile" name="mobile" required value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Address 1</label>
              <div class="col-md-6">
                <input id="adr1" name="adr1" required='required' value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Address 2</label>
              <div class="col-md-6">
                <input id="adr2" name="adr2" value="" class="form-control" type="text">
              </div>
            </div>
              <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Address 3</label>
              <div class="col-md-6">
                <input id="adr3" name="adr3" value="" class="form-control" type="text">
              </div>
            </div>
          
             <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Post Code</label>
              <div class="col-md-6">
                <input id="pcode" name="postal" required value="" class="form-control" type="text">
              </div>
            </div>
            
               <div class="form-group">
             <label class="col-md-5 control-label"  for="textInput4">User role</label>
              <div class="col-md-6">
                <select class="form-control" id="role" >
                </select>
              </div>
            </div>
           
           
              <div class="form-group">
             <label class="col-md-5 control-label"  for="textInput4">Select radio stations</label>
              <div class="col-md-6">
                <select class="form-control selectpicker" multiple id='stations'>
                </select>
                </select>
              </div>
            </div>
           
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-8">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="updatedata()" name="sub"  class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
		  
		 </span>
                  </form>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End edit users modal-->  
          
         <!--Modal Delete-->
         
         <div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" onclick="location.reload(); " data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Change status</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="uid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to <label style="font-weight: bold" id="deluser"></label> ? </label>
            
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="change_status_user()" name="sub"  class="btn btn-primary">Yes</button>
                <button type="reset" onclick="location.reload(); " class="btn btn-default" data-dismiss="modal">No</button>
              </div>
            </div>
		  
		 </span>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!-- End modal Delete -->
       
       
        <!--Modal DeleteAll-->
         
         <div class="modal fade" id="modalDelall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete user(s)</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="uid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to delete all selected users from the list? There is NO undo!</label>
             
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="deletedata_all()" name="sub"  class="btn btn-primary">Delete</button>
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
		  
		 </span>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!-- End modal DeleteAll -->
      
        
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left" style="min-height: 598px;">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  >
                    Users
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="<?php echo base_url(); ?>admin/user_data">User data</a></li>
                    <li><a href="<?php echo base_url();?>admin/user_role">User roles</a></li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                    Contracts
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>admin/platform">Platform</a></li>
                    <li><a href="<?php echo base_url();?>admin/contract_line_type">Contract Line Type</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                    Clients
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>admin/punch_data">Add Data</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed">
                    Graphs
                  </a>
                </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>admin/graph_sales">Sales</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /col -->
      </div><!-- /row -->
    </div><!-- /container -->
<script>
			var lastValue;
			$("#role").bind("click", function(e) {
				lastValue = $(this).val();
			}).bind("change", function(e) {
				changeConfirmation = confirm("You are changing user role. Do you want to continue?");
				if (changeConfirmation) {
					// Proceed as planned
				} else {
					
					$(this).val(lastValue);
				}
			});
			
	 $(document).ready(function() {
	 	
	 	if(tableView_json)
	 	{
	 		var userTable=tableView_json[0].table_order;
	 		if(userTable==null)
	 			table_val=[];	
	 		else
	 			var table_val = userTable.split(',').map(Number);
	 	}
	 	else
	 		table_val=[];
	 	//console.log(table_val);
	 	//alert(table_val);
        //Initialize Datatables
          var table = $('.datatable').DataTable({
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
       
        columnDefs: [
            { visible: false, targets: table_val }
           
        ],
            // Customize the ColVis button text so it's an icon and align the dropdown to the right side
            "colVis": {
              "buttonText": "<i class='fa fa-columns'></i>",
              "sAlign": "right",
               
              "restore": "<button class='btn-block'>Restore</button>",
              "showAll": "<button class='btn-block'>Show all</button>",
              "showNone": "<button class='btn-block'>Show none</button>",
              "preserve": "<button class='btn-block' title='Save current state' onclick='visible();'>Preserve</button>",
              exclude: [ 0 ]
            } 
                   
          });
          
          // On click of ColVis_Button, add Bootstrap classes and...
          $(".ColVis_Button").addClass("btn btn-default dropdown-toggle").click(function() {
            // Add Bootstrap classes to ColVis_Button's parent
            $(this).parent(".ColVis").addClass("btn-group open");
            // Add Bootstrap classes to the checkboxes
            $(".ColVis_collection label").addClass("checkbox");
            // Remove class from ColVis when clicking outside ColVis_Collection
            $(".ColVis_collectionBackground, .ColVis_catcher").click(function() {
              $(".ColVis").removeClass("open");
            });
          });
        });	
    
    // cutom function DLP : Get selected datatable columns     
    var fnGetVisibleColumns = function(oTable) {
    var counter = 0;
    aColumns = new Array();
    $.each(oTable.fnSettings().aoColumns, function(c){
        if(oTable.fnSettings().aoColumns[c].bVisible == false){
            aColumns.push(counter)
         }
        counter++;
    });
    return aColumns;
    }
    function visible()
    {
    $('#success_tbl').html("Please wait..").show();
    var aVisibleColumns = fnGetVisibleColumns($('.datatable').dataTable());
    //console.log(aVisibleColumns);
    var location="<?php echo base_url();?>users/preserve_datatable_view";
    var user_id=<?php echo $user_id;?>;
    var table="user_data";
    //console.log(aVisibleColumns);
    $.ajax({
			type : "POST",
			url : location,
			data : {
				user_id: user_id,
				table_val: aVisibleColumns,
				table:table
			}

		}).done(function(msg) {
			$('#success_tbl').hide();
			if (msg == 1 ) {
				$('#success_tbl').html("Table preserved").show();
				if(tableView_json)
					tableView_json[0].table_order=aVisibleColumns;
				setTimeout(function(){
   						$('#success_tbl').fadeOut(500);
						}, 2500);
				
				}
				else
				{
					$('#warning_tbl').html("No changes were made!").show();
				setTimeout(function(){
   						$('#warning_tbl').fadeOut(500);
						}, 2500);
				}	
                });
   	}
</script>