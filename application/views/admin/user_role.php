<?php $this->load->helper('url');
if($role_id!=2)
{
	header("location:". base_url()."home/logout");
	exit();
}
?>

	<script>
	// Initialize Boostrap-select
	var data = <?php echo json_encode($result); ?>;
	var len = data.length;
		$(document).ready(function() {
			$('#load').html("Loading page...").show();
			var len = data.length;
			 var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        if(data[i].roles_id && data[i].roles_name){
                            txt+= "<tr id='r1_"+data[i].roles_id+"'><td>"+(i+1)+"</td><td>"+data[i].roles_name+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='role_del_populate("+i+")'  data-toggle='modal' data-target='#roleDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load').hide();
                        $(".datatable").append(txt).removeClass("hidden");
                    }
                }
		});
		 function add_new_role()
         {
         	var role = $("#role").val();
         	$(".role_nm").val(role);
         	if(role=="")
         	{
         		$('#errmsg').show(500).html("Please input valid name!!").css({
					"font-weight" : "",
					"color" : "red"
				}); 
         		
         	}
         	else
         	{
         		var txt = "";
         		var val = 'role=' + role;
				$.ajax({
				type : "POST",
				url : "add_new_role",
				data : val

				}).done(function(msg) {
				if (msg) {
					if(!len) 
					{
						len=0;
						location.reload();
					}
					else
						len=len+1;
					id=len-1;
				//Pushing new data to json
				
				data.push({roles_id:msg, roles_name:role});
				txt+="<tr id='r1_"+msg+"'><td>"+len+"</td><td>"+role+"</td>";
				//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='role_del_populate("+id+")'  data-toggle='modal' data-target='#roleDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
				$(".datatable").append(txt).removeClass("hidden");
				$("#role").val("");
				
				$('#myModal').modal('toggle');

				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

				}
				});
         	}
         }
         
         
        function role_del_populate(id) 
        {
        	var role_nm=data[id].roles_name;
        	var rid=data[id].roles_id;
        	$('#rid').val(rid);
        	$('#delrole').html("&nbsp;"+role_nm+"&nbsp;");
        	
		}
		function delete_user_role()
		{
			var rid=$('#rid').val();
			var val = 'rid=' + rid;
			$.ajax({
			type : "POST",
			url : "delete_user_role",
			data : val

		}).done(function(msg) {
			if (msg == 1 ) {
				
				//Hide  a row
				
				$("#r1_" + rid).animate({ backgroundColor: "#fbc7c7" }, "fast")
				.animate({ opacity: "hide" }, "slow");
				$('#roleDel').modal('toggle');
				//data.pop({roles_id:rid});
				//End hide a row
				// var myaddr= ad.split(',');
				//var array = JSON.parse("[" + ad + "]");
				 //$.each(ad, function(i,element){
				 	
                  // 	$("#r1_"+element).animate({ backgroundColor: "#fbc7c7" }, "fast")
				//	.animate({ opacity: "hide" }, "slow");
				}
				else
				{
					$('#err_role').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this role</button>").css({
					"font-weight" : "bold",
					"color" : "#800"
					}); 
					setTimeout(function(){
   						$('#roleDel').modal('toggle');
   						$('#err_role').hide();
						}, 1500);
				}	
                });
		}
		</script>
    
    
  
    <div class="container-fluid">
    	
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="admin">Admin</a></li>
            <li><?php echo $title;?></li>
          </ol>
          <h3></h3>
           <p style="margin-left: px;"><button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal" title="Add new user role"><i class="glyphicon glyphicon-plus"></i> Add new role</button></p>
           <p id="load"></p>
          <?php
          	if($result)
			{?>
				<div class="table-responsive">
             <table id="" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Role id</th>
                  <th>Role name</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>	
			<?php 
			}
          ?>
         
         <!--Add new role modal-->
 
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new user role</h4>
                </div>
                <div class="modal-body">
                 
         
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput">New role name</label>
              <div class="col-md-6">
              	  <input class="role_nm"  type="hidden">
                <input id="role" name="role" required  type="text">
                <p id="errmsg" style="display: none;"></p>
              </div>
              
            </div>
            
            
                        
            <div class="form-group">
            	 <br>
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_role()" name="sub"  class="btn btn-lg btn-success">Save new role</button>
                
              </div>
            </div>
		  
		 </span>
                 
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add new role modal-->  
       
       
       
       <!--Delete user role modal-->
 
		<div class="modal fade" id="roleDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete user role</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="rid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="delrole"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_user_role()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;" >
              	  
                
                <label  id="err_role"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete user role modal-->  
       
       
        
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left" style="min-height: 550px;">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                    Users
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>admin/user_data">User data</a></li>
                    <li class="active"><a href="<?php echo base_url();?>admin/user_role">User roles</a></li>
                   
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
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed">
                    Platforms
                  </a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>admin/manage_stations">Add Monitoring</a></li>
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
        $(document).ready(function() {
        	
          // Initialize Datatables
          var table = $('.datatable').DataTable({
          	
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
            // Customize the ColVis button text so it's an icon and align the dropdown to the right side
            "colVis": {
              "buttonText": "<i class='fa fa-columns'></i>",
              "sAlign": "right",
  
              "showAll": "<button class='btn-block'>Show all</button>",
              "showNone": "<button class='btn-block'>Show none</button>"
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
      </script>