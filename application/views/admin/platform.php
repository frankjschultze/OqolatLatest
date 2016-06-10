<?php $this->load->helper('url');
if($role_id!=2)
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
	var platform_json = <?php echo json_encode($platform); ?>;
	var len_pfm = platform_json.length;
	//Platform tab
  $(document).ready(function() {
  		$('#load_pfm').html("Loading Table...").show();
			var len_pfm = platform_json.length;
			if(!len_pfm)
			{
				$('#load_pfm').hide();	
			}
			 var txt = "";
                if(len_pfm > 0){
                    for(var i=0;i<len_pfm;i++){
                        if(platform_json[i].id && platform_json[i].name){
                            txt+= "<tr id='r1_"+platform_json[i].id+"'><td>"+(i+1)+"</td><td>"+platform_json[i].name+"</td><td>"+platform_json[i].description+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='platform_del_populate("+i+")'  data-toggle='modal' data-target='#pfmDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load_pfm').hide();
                        $("#tbl_pfm").append(txt).removeClass("hidden");
                    }
                }
  
    });
    function add_new_platform()
	{
		var platform = $("#platform").val();
		var des_pfm = $("#des_pfm").val();
		//console.log(des_pfm);
		$(".platform_nm").val(platform);
		if(platform=="")
		{
			$('#errmsg_pfm').show(500).html("Please input valid name!!");

		}	
		else
		{
			var txt = "";
			var location="<?php echo base_url(); ?>traffic/add_new_platform";
			$.ajax({
			type : "POST",
			url : location,
			data : {
				pfm : platform,
				des_pfm : des_pfm
			}

			}).done(function(msg) {
			if (msg) {
				len_pfm=len_pfm+1;
		
	//Pushing new data to json
		if(platform_json)
			platform_json.push({id:msg, name:platform, description: des_pfm});
		else
		{
			//Creating new json
			platform_json=[];
			item = {}
       	 	item ["id"] = msg;
       	 	item ["name"] = platform;
       	 	item ["description"] = des_pfm;
			len_pfm=1;
       	 	platform_json.push(item);
		}
		id=len_pfm-1;
		key=len_pfm-1;
		txt+="<tr id='r1_"+msg+"'><td>"+len_pfm+"</td><td>"+platform+"</td><td>"+des_pfm+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
		txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='platform_del_populate("+id+")'  data-toggle='modal' data-target='#pfmDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
		$("#tbl_pfm").append(txt).removeClass("hidden");
		$("#platform").val("");
		$("#des_pfm").val("");
		$('#line_platform').append('<option value="'+ platform_json[key].id + '">' + platform_json[key].name + '</option>');
		$('#newPfm').modal('toggle');

	//$('#dis').show(500);
	//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

		}
		});
	}
	}
function platform_del_populate(id) 
{
   var platform_nm=platform_json[id].name;
   var pfm_id=platform_json[id].id;
   $('#pfm').val(pfm_id);
   $('#delpfm').html("&nbsp;"+platform_nm+"&nbsp;");
}
function delete_platform()
	{
	var location="<?php echo base_url(); ?>traffic/delete_platform";
	var pfm=$('#pfm').val();
	var val = 'pfm=' + pfm;
	$.ajax({
	type : "POST",
	url : location,
	data : val

	}).done(function(msg) {
	if (msg == 1 ) {
	//Hide  a row

	$("#r1_" + pfm).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	$('#pfmDel').modal('toggle');
	}
	else
	{
	$('#err_pfm').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this data</button>").css({
	"font-weight" : "bold",
	"color" : "#800"
	});
	setTimeout(function(){
	$('#pfmDel').modal('toggle');
	$('#err_pfm').hide();
	}, 1500);
	}
	});
	}		
</script>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="admin/dashboard">Dashboard</a></li>
            <li>Admin</li>
          </ol>
         <p><hr><button class="btn btn-info" type="button" data-toggle="modal" data-target="#newPfm" title="Add new Platform details">Add new Platform details</button>
           <hr>
           <p id="load_pfm"></p>
          
				<div class="table-responsive">
             <table id="tbl_pfm" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>	
			
          </p>
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left" style="min-height: 598px;">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" >
                    Users
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li class=""><a href="<?php echo base_url();?>admin/user_data">User data</a></li>
                    <li><a href="<?php echo base_url();?>admin/user_role">User roles</a></li>
                   
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >
                    Contracts
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="<?php echo base_url();?>admin/platform">Platform</a></li>
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
    <!--Add new Platform modal-->
 
		<div class="modal fade" id="newPfm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new Platform</h4>
                </div>
                <div class="modal-body">
                 
         
                 <p> 	<div class="form-group">
              <label class="col-md-10 control-label" for="textInput">Platform Name</label>
              <div class="col-md-5">
               <input class="platform_nm"  type="hidden">
                <input id="platform" class="form-control" name="platform"  required  type="text">
                <p id="errmsg_pfm" class="label label-warning" style="display: none;"></p>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Description</label>
              <div class="col-md-5">
                <textarea class="form-control" id="des_pfm" rows="3"></textarea>
              </div>
               
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_platform()" name="sub"  class="btn btn-lg btn-success">Save</button>
                <span id="spin" style="position: absolute;"></span>
              </div>
            </div>  
             </p>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add new Platform modal-->    
       
       
      <!--Delete Platform modal-->
 
		<div class="modal fade" id="pfmDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete Platform</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="pfm" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="delpfm"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_platform()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;" >
              	  
                
                <label  id="err_pfm"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete platform modal-->
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