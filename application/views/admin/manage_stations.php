<?php $this->load->helper('url');
if($role_id!=2)
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
function add_station()
{
	$.ajax({
 	           url: 'add_station',
 	           method: "POST",
 	           data : {station:$('#station').val(),
 	 	               url:$('#url').val()},
 	           success: function(){
                        
                          	               
 	        }
 	     });
	$('#newSt').modal('hide');
	return true;
}
function delete_stations()
{
	var stations = $(".station_id:checked").map(function(){
	      return $(this).val();
	    }).get();
	$.ajax({
         url: 'delete_station',
         method: "POST",
         data : {station:stations},
         success: function(){
       }
   });
    	   
   $('#station_table').DataTable().ajax.reload();
   $('#delModal').modal('hide');   
   return true;	   
}
function edit_station()
{
	$.ajax({
        url: 'edit_station',
        method: "POST",
        data : {id:$('#txt_station_id').val(),
                name:$('#estation').val(),
                url:$('#eurl').val()},
        success: function(){
      }
  });
  $('#station_table').DataTable().ajax.reload();
  $('#editModal').modal('hide');   
  return true;	
}
function modal_populate(id)
{
	var info;
	$.ajax({
        url: 'get_station_details',
        method: "POST",
        dataType: 'json',
        async: false,
        data : {id:id},
        success: function(msg){
           info=msg;
      }
  });
$.each(info,function(key,val){
	   $('#txt_station_id').val(info[key].id);
	   $('#estation').val(info[key].name);
	   $('#eurl').val(info[key].url);
   });
	   	   
  
}
$(document).ready(function(){
	$('#station_table').DataTable( {
	ajax: 'get_station_datatable',
	    
	} );
	$('.selectall').click(function(){
		if($(this).is(':checked'))
		{
            $('#del_but').show();
			$('.station_id').prop('checked',true);
			$('.selectall').prop('checked',true);
		}
		else
		{
            $('#del_but').hide();
			$('.station_id').prop('checked',false);
			$('.selectall').prop('checked',false);
		}		
			
	});
	$(document).on("click",".station_id",function(){
		if($(".station_id:checked").map(function(){return $(this).val();}).get().length>0)
		{
			$('#del_but').show();
		}
		else
		{
			$('#del_but').hide();
		}				
	});
		   
});

</script>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="admin/dashboard">Dashboard</a></li>
            <li>Admin</li>
          </ol>
          
 <!--  contents -->         
          <h3>Manage Radio stations</h3>
         
         <button class="btn btn-info" type="button" data-toggle="modal" data-target="#newSt" title="Add new station">Add new Radio Station</button>
         <br/><br/>
         
         
         <span id="success_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-success"></span>
         <span id="warning_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-warning"></span>
         <label class="btn btn-sm btn-default" id="del_but" type="button" style='display:none'><a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal"  data-target="#delModal" title="Remove"><span style="color: #800; font-weight: bold;" >Delete selected: <span class="pficon pficon-delete"></span></a></label>
           
         <div class="table-responsive">
		 <table id="station_table" class="datatable table table-striped table-bordered">
        <thead>
        	
            <tr>
                <th>
                <input type="checkbox" class="selectall" >
              </th>
                <th>Station Id</th>
                <th>Name</th>
                <th>Url</th>
                <th>Action</th>
                
            </tr>
            
        </thead>
       
        <tfoot>
              <tr>
            	<th>
                <input type="checkbox" class="selectall">
              </th>
                <th>Station Id</th>
                <th>Name</th>
                <th>Url</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table> 
        </div> 
         
         
         
         <!-- Add radio station modal -->
         <div class="modal fade" id="newSt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		          <span class="pficon pficon-close"></span>
		        </button>
		        <h4 class="modal-title" id="myModalLabel">Add new radio station</h4>
		      </div>
		      
		      <div class="modal-body">
		        <form class="form-horizontal">
		          <div class="form-group">
		            <label class="col-sm-3 control-label" for="textInput-modal-markup">Station</label>
		            <div class="col-sm-9">
		              <input type="text" id='station' class="form-control"></div>
		          </div>
		          <div class="form-group">
		            <label class="col-sm-3 control-label" for="textInput-modal-markup">Url</label>
		            <div class="col-sm-9">
		              <input type="text" id='url' class="form-control"></div>
		          </div>
		         </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button type="button" class="btn btn-primary" onclick="return add_station()">Add</button>
		      </div>
		    </div>
		  </div>
		  </div>
		   <!--  Add radio station modal ends -->
		   
		 <!-- Edit radio station modal -->
         <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		          <span class="pficon pficon-close"></span>
		        </button>
		        <h4 class="modal-title" id="myModalLabel">Add new radio station</h4>
		      </div>
		      
		      <div class="modal-body">
		        <form class="form-horizontal">
		          <input type='hidden' id='txt_station_id'/>
		          <div class="form-group">
		            <label class="col-sm-3 control-label" for="textInput-modal-markup">Station</label>
		            <div class="col-sm-9">
		              <input type="text" id='estation' class="form-control"></div>
		          </div>
		          <div class="form-group">
		            <label class="col-sm-3 control-label" for="textInput-modal-markup">Url</label>
		            <div class="col-sm-9">
		              <input type="text" id='eurl' class="form-control"></div>
		          </div>
		         </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        <button type="button" class="btn btn-primary" onclick="return edit_station()">Edit</button>
		      </div>
		    </div>
		  </div>
		  </div>
		   <!--  Edit radio station modal ends -->
		   
		   
		   <!-- delete radio station modal -->
		   
           <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            
              <label class="col-md-14 control-label">Are you sure you want to delete all the selected stations from the list?</label>
             
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="delete_stations()" name="sub"  class="btn btn-primary">Delete</button>
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
          <!-- delete radio station modal ends  -->       
         
         
         
         
           
         <br><br>
        <!--  content ends --> 
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left">
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
                    <li><a href="<?php echo base_url();?>admin/manage_station">Add Monitoring</a></li>
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
    