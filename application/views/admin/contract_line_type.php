<?php $this->load->helper('url');
if($role_id!=2)
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
	var line_type_json = <?php echo json_encode($linetype); ?>;
	var len_type = line_type_json.length;
	//Contract Line Type tab
  $(document).ready(function() {
  		$('#load_type').html("Loading Table...").show();
			var len_type = line_type_json.length;
			if(!len_type)
			{
				$('#load_type').hide();	
			}
			 var txt = "";
                if(len_type > 0){
                    for(var i=0;i<len_type;i++){
                        if(line_type_json[i].id && line_type_json[i].name){
                            txt+= "<tr id='r1_"+line_type_json[i].id+"'><td>"+(i+1)+"</td><td>"+line_type_json[i].name+"</td><td>"+line_type_json[i].description+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='type_del_populate("+i+")'  data-toggle='modal' data-target='#typeDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load_type').hide();
                        $("#tbl_type").append(txt).removeClass("hidden");
                    }
                }
      
		});

// Contract Line Type
	function add_new_type()
	{
		var type = $("#type").val();
		var des_type = $("#des_type").val();
		//console.log(des_pfm);
		$(".type_nm").val(type);
		if(type=="")
		{
			$('#errmsg_type').fadeIn(500).html("Please input valid name!!");

		}	
		else
		{
			var txt = "";
			var location="<?php echo base_url(); ?>traffic/add_new_type";
			$.ajax({
			type : "POST",
			url : location,
			data : {
				type : type,
				des_type : des_type
			}

			}).done(function(msg) {
			if (msg) {
				len_type=len_type+1;
		
	//Pushing new data to json
		if(line_type_json)
			line_type_json.push({id:msg, name:type, description: des_type});
		else
		{
			//Creating new json
			line_type_json=[];
			item = {}
       	 	item ["id"] = msg;
       	 	item ["name"] = type;
       	 	item ["description"] = des_type;
			len_type=1;
       	 	line_type_json.push(item);
		}
		id=len_type-1;
		key=len_type-1;
		txt+="<tr id='r1_"+msg+"'><td>"+len_type+"</td><td>"+type+"</td><td>"+des_type+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
		txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='type_del_populate("+id+")'  data-toggle='modal' data-target='#typeDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
		$("#tbl_type").append(txt).removeClass("hidden");
		$("#type").val("");
		$("#des_type").val("");
		$('#line_type').append('<option value="'+ line_type_json[key].id + '">' + line_type_json[key].name + '</option>');
		$('#newType').modal('toggle');

	//$('#dis').show(500);
	//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

		}
		});
	}
	}
function type_del_populate(id) 
{
   var type_nm=line_type_json[id].name;
   var type_id=line_type_json[id].id;
   $('#tid').val(type_id);
   $('#deltype').html("&nbsp;"+type_nm+"&nbsp;");
}
function delete_type()
{
	var location="<?php echo base_url(); ?>traffic/delete_type";
	var tid=$('#tid').val();
	var val = 'tid=' + tid;
	$.ajax({
	type : "POST",
	url : location,
	data : val

	}).done(function(msg) {
	if (msg == 1 ) {

	//Hide  a row

	$("#r1_" + tid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	$('#typeDel').modal('toggle');
	}
	else
	{
	$('#err_type').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this data</button>").css({
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
            <li><a href="admin/dashboard">Dashboard</a></li>
            <li>Admin</li>
          </ol>
          <p><hr><button class="btn btn-info" type="button" data-toggle="modal" data-target="#newType" title="Add new Contract Line Type">Add new Contract Line Type</button>
           <hr>
           <p id="load"></p>
          
				<div class="table-responsive">
             <table id="tbl_type" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Id</th>
                  <th>Type Name</th>
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
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Contracts
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>admin/platform">Platform</a></li>
                    <li class="active"><a href="<?php echo base_url();?>admin/contract_line_type">Contract Line Type</a></li>
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
     <!--Add new Contract Line Type modal-->
 
		<div class="modal fade" id="newType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new Contract Line Type</h4>
                </div>
                <div class="modal-body">
                 
         <p> 	<div class="form-group">
              <label class="col-md-10 control-label" for="textInput">Type Name</label>
              <div class="col-md-5">
               <input class="type_nm"  type="hidden">
                <input id="type" class="form-control" name="type"  required  type="text">
                <p id="errmsg_type" class="label label-warning" style="display: none;"></p>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Description</label>
              <div class="col-md-5">
                <textarea class="form-control" id="des_type" rows="3"></textarea>
              </div>
               
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_type()" name="sub"  class="btn btn-lg btn-success">Save</button>
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
       <!--End add new Contract Line Type modal--> 
       
       
         <!--Delete Contract Line Type modal-->
 
		<div class="modal fade" id="typeDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete Contract Line Type</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="tid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="deltype"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_type()" name="sub"  class="btn btn-primary">Yes</button>
                
                
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
       <!--End Contract Line Type modal--> 
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
    