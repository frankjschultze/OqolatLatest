<?php $this->load->helper('url');
if(($role_id!=3) && ($role_id!=2) && (!$nav))
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
	<script>
	var data = <?php echo json_encode($result); ?>;
	var len = data.length;
		$(document).ready(function() {
			$('#load').html("Loading page...").show();
			var len = data.length;
			 var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        if(data[i].type_id && data[i].type_name){
                            txt+= "<tr id='r1_"+data[i].type_id+"'><td>"+(i+1)+"</td><td>"+data[i].type_name+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='type_del_populate("+i+")'  data-toggle='modal' data-target='#typeDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load').hide();
                        $(".datatable").append(txt).removeClass("hidden");
                    }
                }
		});
		 function add_new_type()
         {
         	var type = $("#type").val();
         	$(".type_nm").val(type);
         	if(type=="")
         	{
         		$('#errmsg').show(500).html("Please input valid name!!").css({
					"font-weight" : "",
					"color" : "red"
				}); 
         		
         	}
         	else
         	{
         		var txt = "";
         		var location="<?php echo base_url();?>sales/add_new_type";
         		var val = 'type=' + type;
				$.ajax({
				type : "POST",
				url : location,
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
				data.push({type_id:msg, type_name:type});
				txt+="<tr id='r1_"+msg+"'><td>"+len+"</td><td>"+type+"</td>";
				//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='type_del_populate("+id+")'  data-toggle='modal' data-target='#typeDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
				$(".datatable").append(txt).removeClass("hidden");
				$("#type").val("");
				
				$('#myModal').modal('toggle');

				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

				}
				});
         	}
         }
         
         
        function type_del_populate(id) 
        {
        	var type_nm=data[id].type_name;
        	var rid=data[id].type_id;
        	$('#rid').val(rid);
        	$('#deltype').html("&nbsp;"+type_nm+"&nbsp;");
        	
		}
		function delete_client_type()
		{
			var location="<?php echo base_url();?>sales/delete_client_type";
			var rid=$('#rid').val();
			var val = 'rid=' + rid;
			$.ajax({
			type : "POST",
			url : location,
			data : val

		}).done(function(msg) {
			if (msg == 1 ) {
				
				//Hide  a row
				
				$("#r1_" + rid).animate({ backgroundColor: "#fbc7c7" }, "fast")
				.animate({ opacity: "hide" }, "slow");
				$('#typeDel').modal('toggle');
				//data.pop({type_id:rid});
				//End hide a row
				// var myaddr= ad.split(',');
				//var array = JSON.parse("[" + ad + "]");
				 //$.each(ad, function(i,element){
				 	
                  // 	$("#r1_"+element).animate({ backgroundColor: "#fbc7c7" }, "fast")
				//	.animate({ opacity: "hide" }, "slow");
				}
				else
				{
					$('#err_type').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this type</button>").css({
					"font-weight" : "bold",
					"color" : "#800"
					}); 
					setTimeout(function(){
   						$('#typeDel').modal('toggle');
   						$('#err_type').hide();
						}, 1500);
				}	
                });
		}
		</script>
    
    <div class="container-fluid">
    	
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>users/dashboard">Dashboard</a></li>
            <li><?php echo $title;?></li>
          </ol>
          <h3></h3>
           <hr><button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal" title="Add new client type">Add new client type</button>
           <hr>
           <p id="load"></p>
          <?php
          	if($result)
			{?>
				<div class="table-responsive">
             <table id="" class="datatable table table-striped table-bordered" >
              <thead>
                <tr>
                  <th>Type Id</th>
                  <th>Type Name</th>
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
         
         <!--Add new Type modal-->
 
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new client type</h4>
                </div>
                <div class="modal-body">
                 
         
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput">New type name</label>
              <div class="col-md-6">
              	  <input class="type_nm"  type="hidden">
                <input id="type" name="type" required  type="text">
                <p id="errmsg" style="display: none;"></p>
              </div>
              
            </div>
            
            
                        
            <div class="form-group">
            	 <br>
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_type()" name="sub"  class="btn btn-lg btn-success">Save new type</button>
                
              </div>
            </div>
		  
		 </span>
                 
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add new Type modal-->  
       
       
       
       <!--Delete user type modal-->
 
		<div class="modal fade" id="typeDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete user Type</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="rid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="deltype"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_client_type()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;" >
              	  
                
                <label  id="err_type"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete user type modal-->  
       
       
        
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left" style="min-height: 598px;">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                   Clients
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                 	<?php
                 	if(($role_id==4) || ($nav=="tfc")) {?>
                    <li><a href="<?php echo base_url();?>sales/add_clients/<?php echo $nav;?>">Add Data</a></li>
                    <?php
					}
				    ?>
                    <li><a href="<?php echo base_url();?>sales/manage_clients/<?php echo $nav;?>">Clients Data</a></li>
                    <li class="active"><a href="<?php echo base_url();?>sales/client_type/<?php echo $nav;?>">Clients Type</a></li>
                   
                  </ul>
                </div>
              </div>
            </div>
           <?php
            if($nav=="tfc") {?>
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
                    <li><a href="<?php echo base_url();?>traffic/manage_contracts">Edit Contracts</a></li>
                    
                  </ul>
                </div>
              </div>
            </div>
			<?php } else { ?>
           
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
                    </div> <?php } ?>
            
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