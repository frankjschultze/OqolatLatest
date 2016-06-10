<?php $this->load->helper('url');
if(($role_id!=4) && ($role_id!=2) )
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
	var contract_line =<?php echo json_encode($contract_line);?> 
	var linetype_json =<?php echo json_encode($linetype); ?>;
	var platform_json =<?php echo json_encode($platform); ?>;
	var txt="";
	var no="";
	var total="";
	
	$(document).ready(function() {
		no=1;
		$('#search').datepicker({format: 'M-yyyy'}).on('changeDate', function(e){
$(this).datepicker('hide');
});
	$.each(contract_line,function(key,val) {
		var lenp = platform_json.length;
		if(lenp > 0){
        	for(var i=0;i<lenp;i++){
			if(platform_json[i].id == contract_line[key].platform_id)
			{
				pid=platform_json[i].id;
				plt=platform_json[i].name;
				break;
			}
			}
		}
		var lent = linetype_json.length;
		if(lent > 0){
        	for(var i=0;i<lent;i++){
			if(linetype_json[i].id == contract_line[key].type_id)
			{
				ltype=linetype_json[i].id;
				type=linetype_json[i].name;
				break;
			}
			}
		}
			
			var line_id=contract_line[key].id;
			var st=contract_line[key].start_time;
			var et=contract_line[key].end_time;
			var duration=contract_line[key].duration;
			var rate = contract_line[key].rate;
			var des = contract_line[key].description;
			if( contract_line[key].line_total==null)
				var total =0;
			else
				var total=contract_line[key].line_total;
			contract_id=parseFloat(contract_line[key].contract_id)+1000;
				txt+='<tr class="line_cnt" id="r1_'+ contract_line[key].id + '">';
				txt+='<td id="c0_'+ contract_line[key].id + '">' + no + '</td>';
				txt+='<td id="c1_'+ contract_line[key].id + '">' + contract_id + '</td>';
				txt+='<td id="c2_'+ contract_line[key].id + '">' + plt + '</td>';
    			txt+='<td id="c3_'+ contract_line[key].id + '">' + type + '</td>';
				txt+='<td id="c4_'+ contract_line[key].id + '">' + contract_line[key].start_time + '</td>';
				txt+='<td id="c5_'+ contract_line[key].id + '">' + contract_line[key].end_time + '</td>';
				txt+='<td id="c6_'+ contract_line[key].id + '">' + contract_line[key].description + '</td>';
				txt+='<td id="c7_'+ contract_line[key].id + '">' + contract_line[key].duration + '</td>';
				txt+='<td id="c8_'+ contract_line[key].id + '">' + contract_line[key].rate + '</td>';
				txt+='<td id="c11_'+ contract_line[key].id + '">' + contract_line[key].quantity + '</td>';
				txt+='<td id="c9_'+ contract_line[key].id + '">' + total + '</td></tr>';
				
				no+=1;
			});
			$('#line_contract').append(txt).removeClass("hidden");;
	});
</script>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>users/dashboard">Dashboard</a></li>
            <li><a href="<?php echo base_url();?>traffic">Traffic</a></li><li>Contract Lines</li>
          </ol>
       <!-- *****************  Traffic data********************-->
       <label class="label label-info">
	   <i class="glyphicon glyphicon-list"></i>
	   Contract Lines
       </label>
          <hr>
          <form name="f" method="post" action="<?php echo base_url();?>traffic/contract_lines">
          	
          <div class="input-group" >
    <div class="form-inline">
      <div class="input-append date"  >
	<input type="search" placeholder="Filter by Month" id="search" name="search" readonly="readonly" class="form-control" style="width: 150px; font-weight: bold;" >
	<button class="btn btn-default" type="submit"><span class="fa fa-search"></span></button>

	<span class="add-on"><i class="icon-th"></i></span>
	</div>
      
    </div>
</div>
</form>
     	 <table id="line_contract" class="datatable table table-striped table-bordered">
        <thead>
        	
            <tr>
 				<th>Id</th>             
                <th>Contract No.</th>
                <th>Platfrom</th>
                <th>Type</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Total</th>
                
            </tr>
            
        </thead>
 
        <tfoot>
        	
            <tr>
            	<th>Id</th>    
                <th>Contract No.</th>
                <th>Platfrom</th>
                <th>Type</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Total</th>
                
            </tr>
        </tfoot>
 		<tbody>
       
        </tbody>
      </table>
      <!-- *****************  End Traffic data********************-->
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left" style="min-height: 598px;">
          <div class="panel-group" id="accordion">
             <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" >
                    Clients
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url();?>sales/manage_clients/tfc">Clients Data</a></li>
                    
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
                   <!-- <li><a href="<?php echo base_url();?>traffic/add_contracts">Add Contracts</a></li>-->
                    <li><a href="<?php echo base_url();?>traffic/manage_contracts">Edit Contracts</a></li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    Delivery
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                   <!-- <li><a href="<?php echo base_url();?>traffic/add_contracts">Add Contracts</a></li>-->
                    <li class="active"><a href="<?php echo base_url();?>traffic/contract_lines">Contract Lines</a></li>
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
    	 var table = $('#line_contract').DataTable({
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
         	"pageLength": 20,
         
            // Customize the ColVis button text so it's an icon and align the dropdown to the right side
            "colVis": {
              "buttonText": "<i class='fa fa-columns'></i>",
              "sAlign": "right",
              "restore": "<button class='btn-block'>Restore</button>",
              "showAll": "<button class='btn-block'>Show all</button>",
              "showNone": "<button class='btn-block'>Show none</button>"
            }
          });
    });
    </script>
   