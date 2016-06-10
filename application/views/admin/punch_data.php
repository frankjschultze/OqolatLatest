<?php $this->load->helper('url');
if($role_id!=2)
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
	var products_json = <?php echo json_encode($products); ?>;
	var len = products_json.length;
	
	var accounts_json = <?php echo json_encode($accounts); ?>;
	var acctmanager_json=accounts_json;
	var len_acnt = accounts_json.length;
	
	var campaigns_json = <?php echo json_encode($campaigns); ?>;
	var len_cmpgn = campaigns_json.length;
	
	var audience_json = <?php echo json_encode($audience); ?>;
	var len_adns = audience_json.length;
	
	var type_json = <?php echo json_encode($type); ?>;
	var len_type = type_json.length;
		$(document).ready(function() {
			$('#load').html("Loading Table...").show();
			var len = products_json.length;
			if(!len)
			{
				$('#load').hide();	
			}
			 var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        if(products_json[i].product_id && products_json[i].product_name){
                            txt+= "<tr id='r1_"+products_json[i].product_id+"'><td>"+(i+1)+"</td><td>"+products_json[i].product_name+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='product_del_populate("+i+")'  data-toggle='modal' data-target='#productDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load').hide();
                        $("#pdct").append(txt).removeClass("hidden");
                    }
                }
   
		
  //Account manager tab
  
  		$('#load_acnt').html("Loading Table...").show();
			var len_acnt = accounts_json.length;
			if(!len_acnt)
			{
				$('#load_acnt').hide();	
			}
			 var txt = "";
                if(len_acnt > 0){
                    for(var i=0;i<len_acnt;i++){
                        if(accounts_json[i].acct_manager_id && accounts_json[i].acct_manager){
                            txt+= "<tr id='r1_"+accounts_json[i].acct_manager_id+"'><td>"+(i+1)+"</td><td>"+accounts_json[i].acct_manager+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='account_del_populate("+i+")'  data-toggle='modal' data-target='#acntDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load_acnt').hide();
                        $("#acnt").append(txt).removeClass("hidden");
                    }
                }
          
        //Campaigns tab
  
  		$('#load_cmpgn').html("Loading Table...").show();
			var len_cmpgn = campaigns_json.length;
			if(!len_cmpgn)
			{
				$('#load_acnt').hide();	
			}
			 var txt = "";
                if(len_cmpgn > 0){
                    for(var i=0;i<len_cmpgn;i++){
                        if(campaigns_json[i].campaign_id && campaigns_json[i].campaign_name){
                            txt+= "<tr id='r1_"+campaigns_json[i].campaign_id+"'><td>"+(i+1)+"</td><td>"+campaigns_json[i].campaign_name+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='campaign_del_populate("+i+")'  data-toggle='modal' data-target='#cmpgnDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load_cmpgn').hide();
                        $("#cmpgn").append(txt).removeClass("hidden");
                    }
                }
                
        //Audience tab
  
  		$('#load_adns').html("Loading Table...").show();
			var len_adns = audience_json.length;
			if(!len_adns)
			{
				$('#load_adns').hide();	
			}
			 var txt = "";
                if(len_adns > 0){
                    for(var i=0;i<len_adns;i++){
                        if(audience_json[i].target_audience_id && audience_json[i].target_audience){
                            txt+= "<tr id='r1_"+audience_json[i].target_audience_id+"'><td>"+(i+1)+"</td><td>"+audience_json[i].target_audience+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='audience_del_populate("+i+")'  data-toggle='modal' data-target='#adnsDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load_adns').hide();
                        $("#adns").append(txt).removeClass("hidden");
                    }
                }
                
		//Client Type Tab
  
  		$('#load_type').html("Loading Table...").show();
			if(!len_type)
			{
				$('#load_type').hide();	
			}
			else
			{
			 	var txt = "";
                if(len_type > 0){
                    for(var i=0;i<len_type;i++){
                        if(type_json[i].type_id && type_json[i].type_name){
                            txt+= "<tr id='r1_"+type_json[i].type_id+"'><td>"+(i+1)+"</td><td>"+type_json[i].type_name+"</td>";
                            //txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+i+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
                            txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='type_del_populate("+i+")'  data-toggle='modal' data-target='#typeDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
                        }
                    }
                    if(txt != ""){
                    	$('#load_type').hide();
                        $("#type_list").append(txt).removeClass("hidden");
                    }
                }
             }
	
		});
function product_del_populate(id) 
{
   var product_nm=products_json[id].product_name;
   var pid=products_json[id].product_id;
   $('#pid').val(pid);
   $('#delproduct').html("&nbsp;"+product_nm+"&nbsp;");
}
function account_del_populate(id) 
{
   var manager_nm=accounts_json[id].acct_manager;
   var mid=accounts_json[id].acct_manager_id;
   $('#mid').val(mid);
   $('#delaccount').html("&nbsp;"+manager_nm+"&nbsp;");
}
function campaign_del_populate(id) 
{
   var campaign_nm=campaigns_json[id].campaign_name;
   var cid=campaigns_json[id].campaign_id;
   $('#cid').val(cid);
   $('#delcmpgn').html("&nbsp;"+campaign_nm+"&nbsp;");
}
function audience_del_populate(id) 
{
   var audience_nm=audience_json[id].target_audience;
   var aid=audience_json[id].target_audience_id;
   $('#aid').val(aid);
   $('#deladns').html("&nbsp;"+audience_nm+"&nbsp;");
}
function delete_product()
{
	var location="<?php echo base_url(); ?>sales/delete_product";
	var pid=$('#pid').val();
	var val = 'pid=' + pid;
	$.ajax({
	type : "POST",
	url : location,
	data : val

	}).done(function(msg) {
	if (msg == 1 ) {

	//Hide  a row

	$("#r1_" + pid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	$('#productDel').modal('toggle');
	}
	else
	{
	$('#err_product').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this type</button>").css({
	"font-weight" : "bold",
	"color" : "#800"
	});
	setTimeout(function(){
	$('#productDel').modal('toggle');
	$('#err_product').hide();
	}, 1500);
	}
	});
	}
	
	
	function delete_manager()
	{
	var location="<?php echo base_url(); ?>sales/delete_manager";
	var mid=$('#mid').val();
	var val = 'mid=' + mid;
	$.ajax({
	type : "POST",
	url : location,
	data : val

	}).done(function(msg) {
	if (msg == 1 ) {

	//Hide  a row

	$("#r1_" + mid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	$('#acntDel').modal('toggle');
	}
	else
	{
	$('#err_acnt').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this data</button>").css({
	"font-weight" : "bold",
	"color" : "#800"
	});
	setTimeout(function(){
	$('#acntDel').modal('toggle');
	$('#err_acnt').hide();
	}, 1500);
	}
	});
	}
	
function delete_campaign()
{
	var location="<?php echo base_url(); ?>sales/delete_campaign";
	var cid=$('#cid').val();
	var val = 'cid=' + cid;
	$.ajax({
	type : "POST",
	url : location,
	data : val

	}).done(function(msg) {
	if (msg == 1 ) {

	//Hide  a row

	$("#r1_" + cid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	$('#cmpgnDel').modal('toggle');
	}
	else
	{
	$('#err_cmpgn').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this type</button>").css({
	"font-weight" : "bold",
	"color" : "#800"
	});
	setTimeout(function(){
	$('#cmpgnDel').modal('toggle');
	$('#err_cmpgn').hide();
	}, 1500);
	}
	});
	}
	
function delete_audience()
{
	var location="<?php echo base_url(); ?>sales/delete_audience";
	var aid=$('#aid').val();
	var val = 'aid=' + aid;
	$.ajax({
	type : "POST",
	url : location,
	data : val

	}).done(function(msg) {
	if (msg == 1 ) {

	//Hide  a row

	$("#r1_" + aid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	$('#adnsDel').modal('toggle');
	}
	else
	{
	$('#err_adns').show().html("<button type='button' class='btn btn-warning'>Insufficient privilage to delete this type</button>").css({
	"font-weight" : "bold",
	"color" : "#800"
	});
	setTimeout(function(){
	$('#adnsDel').modal('toggle');
	$('#err_adns').hide();
	}, 1500);
	}
	});
	}
	
function add_new_product()
{
	var product = $("#product").val();
	$(".product_nm").val(product);
	if(product=="")
	{
		$('#errmsg_pdct').show(500).html("Please input valid product!!").css({
		"font-weight" : "",
		"color" : "red"
		});

	}	
	else
	{
		var txt = "";
		var location="<?php echo base_url(); ?>sales/add_new_product";
		var val = 'product=' + product;
		$.ajax({
		type : "POST",
		url : location,
		data : val

		}).done(function(msg) {
		if (msg) {
			len=len+1;
		
	//Pushing new data to json
		if(products_json)
			products_json.push({product_id:msg, product_name:product});
		else
		{account
			//Creating new json
			products_json=[];
			item = {}
       	 	item ["product_id"] = msg;
       	 	item ["product_name"] = product;
			len=1;
       	 	products_json.push(item);
		}
	id=len-1;
	txt+="<tr id='r1_"+msg+"'><td>"+len+"</td><td>"+product+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
	txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='product_del_populate("+id+")'  data-toggle='modal' data-target='#productDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
	$("#pdct").append(txt).removeClass("hidden");
	$("#product").val("");

	$('#newPdct').modal('toggle');

	//$('#dis').show(500);
	//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
}
}

function add_new_manager()
{
	var manager = $("#manager").val();
	$(".acnt_nm").val(manager);
	if(manager=="")
	{
		$('#errmsg_acnt').show(500).html("Please input valid name!!").css({
		"font-weight" : "",
		"color" : "red"
		});

	}	
	else
	{
		var txt = "";
		var location="<?php echo base_url(); ?>sales/add_new_manager";
		var val = 'acnt=' + manager;
		$.ajax({
		type : "POST",
		url : location,
		data : val

		}).done(function(msg) {
		if (msg) {
			len_acnt=len_acnt+1;
		
	//Pushing new data to json
		if(accounts_json)
			accounts_json.push({acct_manager_id:msg, acct_manager:manager});
		else
		{
			//Creating new json
			accounts_json=[];
			item = {}
       	 	item ["acct_manager_id"] = msg;
       	 	item ["acct_manager"] = manager;
			len_acnt=1;
       	 	accounts_json.push(item);
		}
	id=len_acnt-1;
	txt+="<tr id='r1_"+msg+"'><td>"+len_acnt+"</td><td>"+manager+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
	txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='account_del_populate("+id+")'  data-toggle='modal' data-target='#acntDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
	$("#acnt").append(txt).removeClass("hidden");
	$("#manager").val("");

	$('#newAcnt').modal('toggle');

	//$('#dis').show(500);
	//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
}
}
function add_new_campaign()
{
	var campaign = $("#campaign").val();
	$(".cmpgn_nm").val(campaign);
	if(campaign=="")
	{
		$('#errmsg_cmpgn').show(500).html("Please input valid name!!").css({
		"font-weight" : "",
		"color" : "red"
		});

	}	
	else
	{
		var txt = "";
		var location="<?php echo base_url(); ?>sales/add_new_campaign";
		var val = 'cmpgn=' + campaign;
		$.ajax({
		type : "POST",
		url : location,
		data : val

		}).done(function(msg) {
		if (msg) {
			len_cmpgn=len_cmpgn+1;
		
	//Pushing new data to json
		if(campaigns_json)
			campaigns_json.push({campaign_id:msg, campaign_name:campaign});
		else
		{
			//Creating new json
			campaigns_json[id]=[];
			item = {}
       	 	item ["campaign_id"] = msg;
       	 	item ["campaign_name"] = campaign;
			len_cmpgn=1;
       	 	campaigns_json.push(item);
		}
	id=len_cmpgn-1;
	txt+="<tr id='r1_"+msg+"'><td>"+len_cmpgn+"</td><td>"+campaign+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
	txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='campaign_del_populate("+id+")'  data-toggle='modal' data-target='#cmpgnDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
	$("#cmpgn").append(txt).removeClass("hidden");
	$("#campaign").val("");

	$('#newCmpgn').modal('toggle');

	//$('#dis').show(500);
	//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
}
}

function add_new_audience()
{
	var audience = $("#audience").val();
	$(".audience_nm").val(audience);
	if(audience=="")
	{
		$('#errmsg_adns').show(500).html("Please input valid name!!").css({
		"font-weight" : "",
		"color" : "red"
		});

	}	
	else
	{
		var txt = "";
		var location="<?php echo base_url(); ?>sales/add_new_audience";
		var val = 'adns=' + audience;
		$.ajax({
		type : "POST",
		url : location,
		data : val

		}).done(function(msg) {
		if (msg) {
			len_adns=len_adns+1;
		
	//Pushing new data to json
		if(audience_json)
			audience_json.push({target_audience_id:msg, target_audience:audience});
		else
		{
			//Creating new json
			audience_json[id]=[];
			item = {}
       	 	item ["target_audience_id"] = msg;
       	 	item ["target_audience"] = audience;
			len_adns=1;
       	 	audience_json.push(item);
		}
	id=len_adns-1;
	txt+="<tr id='r1_"+msg+"'><td>"+len_adns+"</td><td>"+audience+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
	txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='audience_del_populate("+id+")'  data-toggle='modal' data-target='#adnsDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
	$("#adns").append(txt).removeClass("hidden");
	$("#audience").val("");

	$('#newAdns').modal('toggle');
	

	//$('#dis').show(500);
	//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
}
}
function add_new_type()
{
	id="";
	var type = $("#new_type").val();
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
			if(!len_type) 
				{
					len_type=0;
					location.reload();
				}
				else
					len_type=len_type+1;
		//Pushing new data to json
		if(type_json)
			type_json.push({type_id:msg, type_name:type});
		else
		{
			//Creating new json
			type_json[id]=[];
			item = {}
       	 	item ["type_id"] = msg;
       	 	item ["type_name"] = type;
			len_type=1;
       	 	type_json.push(item);
		}
	id=len_type-1;
	txt+="<tr id='r1_"+msg+"'><td>"+len_type+"</td><td>"+type+"</td>";
	//txt+= "<td><a class='edit ml10' href='javascript:void(0)' onclick='modal_populate("+len+")' data-toggle='modal' data-target='#myModalupd' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>";
	txt+= "<td><a class='remove ml10' href='javascript:void(0)' onclick='type_del_populate("+id+")'  data-toggle='modal' data-target='#typeDel' title='Remove'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";
	$("#type_list").append(txt).removeClass("hidden");
	$('#type').append('<option value='+msg+'>'+type+'</option>');
	$("#new_type").val("");

	$('#newType').modal('toggle');
	
				}
			});
         }
	}
		function type_del_populate(id) 
        {
        	var type_nm=type_json[id].type_name;
        	var rid=type_json[id].type_id;
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
				$("#r1_"+rid).animate({ backgroundColor: "#fbc7c7" }, "fast")
				.animate({ opacity: "hide" }, "slow");
				$('#typeDel').modal('toggle');
				$("#type option[value='"+rid+"']").remove();
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
          
       <!-- *****************  Sales data********************-->
     	
     	
    <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
    
    <li class="active"><a href="#tab1" data-toggle="tab">Products</a></li>
    <li><a href="#tab2" data-toggle="tab">Account Managers</a></li>
    <li><a href="#tab3" data-toggle="tab">Campaigns</a></li>
    <li><a href="#tab4" data-toggle="tab">Audience</a></li>
    <li><a href="#tab5" data-toggle="tab">Client Type</a></li>
    </ul>
    <div class="tab-content" style="margin-top: 20px;">
    	 
    	
     <!-- Start tab-2 -->
      <div class="tab-pane active" id="tab1">
    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#newPdct" title="Add new product">
    	<i class="glyphicon glyphicon-plus"></i>
    	Add new Product</button>
           <hr>
           <p id="load"></p>
          
				<div class="table-responsive">
             <table id="pdct" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>	

    </div>
     <!-- End tab-2 -->
     <!-- Start tab-3 -->
     <div class="tab-pane" id="tab2">
   <button class="btn btn-info" type="button" data-toggle="modal" data-target="#newAcnt" title="Add new Account Manager">
   	<i class="glyphicon glyphicon-plus"></i>
   	Add new Account Manager</button>
           <hr>
           <p id="load_acnt"></p>
          
				<div class="table-responsive">
             <table id="acnt" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>	

    </div>
     <!-- End tab-3 -->
      <!-- Start tab-4 -->
     <div class="tab-pane" id="tab3">
    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#newCmpgn" title="Add new Campaign">
    	<i class="glyphicon glyphicon-plus"></i>
    	Add new Campaign</button>
           <hr>
           <p id="load_cmpgn"></p>
          
				<div class="table-responsive">
             <table id="cmpgn" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Id</th>
                  <th>Campaign Name</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>	
    </div>
     <!-- End tab-4 -->
     <!-- Start tab-5 -->
     <div class="tab-pane" id="tab4">
     <button class="btn btn-info" type="button" data-toggle="modal" data-target="#newAdns" title="Add Target Audience">
    	<i class="glyphicon glyphicon-plus"></i>
    	Add Target Audience</button>
           <hr>
           <p id="load_adns"></p>
          
				<div class="table-responsive">
             <table id="adns" class="datatable table table-striped table-bordered" >
              <thead>
              	
                <tr>
                  <th>Id</th>
                  <th>Target Audience</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>	
    </div>
     <!-- End tab-5 -->
     
      <!-- Start tab-6 Client Type-->
     <div class="tab-pane" id="tab5">
     <button class="btn btn-info" type="button" data-toggle="modal" data-target="#newType" title="Add Target Audience">
    	<i class="glyphicon glyphicon-plus"></i>
    	Add Client Type</button>
           <hr>
           <p id="load_type"></p>
          
				<div class="table-responsive">
             <table id="type_list" class="datatable table table-striped table-bordered" >
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
    </div>
     <!-- End tab-6 client Type -->
    
    <!-- End tab-content -->
    </div>
    <!-- end tabable -->
   </div>	
     
      <!-- *****************  End Sales data********************-->
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
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" >
                    Clients
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="<?php echo base_url();?>admin/punch_data">Add Data</a></li>
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
  
  <!--Delete product modal-->
 
		<div class="modal fade" id="productDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete product</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="pid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="delproduct"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_product()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;">
              	  
                
                <label  id="err_product"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete product modal-->
       
        <!--Add new product modal-->
 
		<div class="modal fade" id="newPdct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new product</h4>
                </div>
                <div class="modal-body">
                 
         
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput">Product Name</label>
              <div class="col-md-6">
              	  <input class="product_nm"  type="hidden">
                <input id="product" name="product" required  type="text">
                <p id="errmsg_pdct" style="display: none;"></p>
              </div>
              
            </div>
            
            
                        
            <div class="form-group">
            	 <br>
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_product()" name="sub"  class="btn btn-lg btn-success">Save new product</button>
                
              </div>
            </div>
		  
		 </span>
                 
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add new product modal-->    
       
       
<!--Add new Account  manager modal-->
 
		<div class="modal fade" id="newAcnt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new Account Manager</h4>
                </div>
                <div class="modal-body">
                 
         
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput">Acc. Manager Name</label>
              <div class="col-md-6">
              	  <input class="manager_nm"  type="hidden">
                <input id="manager" name="manager" required  type="text">
                <p id="errmsg_acnt" style="display: none;"></p>
              </div>
              
            </div>
                   
            <div class="form-group">
            	 <br>
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_manager()" name="sub"  class="btn btn-lg btn-success">Save</button>
                
              </div>
            </div>
		  
		 </span>
                 
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add new Account Manager modal-->    
       
       
      <!--Delete account modal-->
 
		<div class="modal fade" id="acntDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete Account Manager</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="mid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="delaccount"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_manager()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;" >
              	  
                
                <label  id="err_acnt"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete account modal-->
       <!--Add new Campaign modal-->
 
		<div class="modal fade" id="newCmpgn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add new Campaign</h4>
                </div>
                <div class="modal-body">
                 
         
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput">Campaign Name</label>
              <div class="col-md-6">
              	  <input class="manager_nm"  type="hidden">
                <input id="campaign" name="campaign" required  type="text">
                <p id="errmsg_cmpgn" style="display: none;"></p>
              </div>
              
            </div>
                   
            <div class="form-group">
            	 <br>
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_campaign()" name="sub"  class="btn btn-lg btn-success">Save New Campaign</button>
                
              </div>
            </div>
		  
		 </span>
                 
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add new Campaign modal--> 
       
       
         <!--Delete campaign modal-->
 
		<div class="modal fade" id="cmpgnDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete Campaigns</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="cid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="delcmpgn"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_campaign()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;" >
              	  
                
                <label  id="err_cmpgn"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete account modal--> 
       
       
       <!--Add new Target Audience modal-->
 
		<div class="modal fade" id="newAdns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Add Target Audience</h4>
                </div>
                <div class="modal-body">
                 
         
            <span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput">Target Audience</label>
              <div class="col-md-6">
              	  <input class="audience_nm"  type="hidden">
                <input id="audience" name="audience" required  type="text">
                <p id="errmsg_adns" style="display: none;"></p>
              </div>
              
            </div>
                   
            <div class="form-group">
            	 <br>
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="return add_new_audience()" name="sub"  class="btn btn-lg btn-success">Save Target Audience</button>
                
              </div>
            </div>
		  
		 </span>
                 
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End add Target Audience modal-->  
       
        <!--Delete campaign modal-->
 
		<div class="modal fade" id="adnsDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete Target Audience</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="aid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Are you sure you want to delete<label style="font-weight: bold" id="deladns"></label> ? </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="userstatus" />
                <button type="button" onclick="delete_audience()" name="sub"  class="btn btn-primary">Yes</button>
                
                
              </div><br><br>
              <div class="col-md-13" style=" float: right;" >
              	  
                
                <label  id="err_adns"></label>
              </div>
              
            </div>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!--End delete account modal--> 

 <!--Add new Type modal-->
 
		<div class="modal fade" id="newType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <input id="new_type" name="new_type" required  type="text">
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
       
       
       
<script>
$('#success').hide();
$('#spin').hide();


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