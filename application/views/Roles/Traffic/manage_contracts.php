<?php
if(($role_id!=4) && ($role_id!=2) && (!$nav))
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
		var contracts_data = <?php echo json_encode($contracts); ?>;
		var clients_json =<?php echo json_encode($clients); ?>;
		var products_json =<?php echo json_encode($products); ?>;
		var tableView_json = <?php echo json_encode($table_view);?> 
		var linetype_json =<?php echo json_encode($linetype); ?>;
		var platform_json =<?php echo json_encode($platform); ?>;
		var acctmanager_json =<?php echo json_encode($acctmanager);?>;
		var tbl=1;
		var no=1;
		var lineTotal=0;
		$('#spin_line').hide();
		/*Displaying client types in table*/
		$(document).ready(function() {
		$('#wrapper').show();
		$('#edit_contract,#success12,#error12,#success_line,#error_line,#del_row,#line_contract').hide();
		$('.selectpicker').selectpicker();
		
		$('#start_dt, #end_dt').datepicker({format: 'dd-mm-yyyy'}).on('changeDate', function(e){
		$(this).datepicker('hide');
		});	
			var leng = contracts_data.length;
			var lengt = linetype_json.length;
			var lengp = products_json.length;
			var lengc = clients_json.length;
			if(leng > 0){
				for(var j=0;j<leng;j++){
					var client_pid = contracts_data[j].product_id;
					//console.log(client_pid);
					var ids = contracts_data[j].id;
					var status = contracts_data[j].status;
					var client = contracts_data[j].client;
					txt="";
					if(status==1)
					{
						txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='"+ids+"' checked>";
    					txt+="<label class='onoffswitch-label' for='"+ids+"'>";
    					txt+="<span class='onoffswitch-inner' ></span>";
    					txt+="<span class='onoffswitch-switch' ></span>";
    					txt+="</label></div>";
    				}
    				else
					{
						txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='"+ids+"'>";
    					txt+="<label class='onoffswitch-label' for='"+ids+"'>";
    					txt+="<span class='onoffswitch-inner'></span>";
    					txt+="<span class='onoffswitch-switch' ></span>";
    					txt+="</label></div>";
    				}
    				$('#t10_'+ids).html("<label onclick='modal_del_populate("+j+")' data-toggle='modal' data-target='#modalDel' title='Change status'>"+txt+"</label>");
					
				for(var m=0; m<lengc; m++)
				{
					if(client == clients_json[m].client_id)
					{
						$('#t3_'+ids).html(clients_json[m].name);
					}
					if($('#t3_'+ids).is(':empty') ) {
						$('#t3_'+ids).html("<font style='font-style: italic;'>__</font>");
					}
				}
				for(var k=0; k<lengp; k++)
				{
					if(client_pid == products_json[k].product_id)
					{
						$('#t4_'+ids).html(products_json[k].product_name);
					}
					if($('#t4_'+ids).is(':empty') ) {
						$('#t4_'+ids).html("<font style='font-style: italic;'>__</font>");
					}
				}
				
				
			}
			
			}
			

		});
		
$(document).ready(function() {
    $('#selectall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row').fadeIn(100);
			     $('#del_row').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal" data-target="#modalDelall" title="Remove"><span style="color: #800; font-weight: bold;" colspan="2">Delete selected: </span><span class="pficon pficon-delete"></span></a>');       
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
                 $('#del_row').fadeIn(100);
			     $('#del_row').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal" data-target="#modalDelall" title="Remove"><span style="color: #800; font-weight: bold;" colspan="2">Delete selected: </span><span class="pficon pficon-delete"></span></a>');       
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
                 $('#del_row').fadeIn(100);
			     $('#del_row').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal" data-target="#modalDelall" title="Remove"><span style="color: #800; font-weight: bold;">Delete selected: </span><span class="pficon pficon-delete"></span></a>');       
           
           
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
	var location="<?php echo base_url();?>traffic/contract_delete_selected";
	// event.preventDefault();
    var searchIDs = $("#contract_data input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
  		var ad = searchIDs;
		var data = 'contract_id=' + searchIDs;
		$.ajax({
			type : "POST",
			url : location,
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
	
	function modal_del_populate(id) {
		$("#contract_st").hide();
		$('#rowkey').val(id);
		//$('#userstatus').val(status);
		$('#contractstatus').val(contracts_data[id].status);
		$('#cid').val(contracts_data[id].id);
		var name = contracts_data[id].contract_no;
		var st=contracts_data[id].status;
		if(st==1)
		{
			$("#contract_st").show();
			$("#contract_st").html("&nbsp;deactivate&nbsp;" + name);
		}
		else
		{
			$("#contract_st").show();
			$("#contract_st").html("&nbsp;activate&nbsp;" + name);
		}
	}
	function change_status_contract() {
		var location="<?php echo base_url();?>traffic/contract_change_status";
		var key = $('#rowkey').val();
		var status = $('#contractstatus').val();
		if(status==1)
			var ustatus=2;
		else
			var ustatus=1;
		$.ajax({
			type : "POST",
			url : location,
			data : {
				contract_id : $('#cid').val(),
				status : status

			}

		}).done(function(msg) {
			if (msg == 1) {

				var ad = $('#cid').val();
				//var status = $('#userstatus').val();
				contracts_data[key].status = ustatus;
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
	
/*Action Tab*/
function modal_populate(id) {
	
		$('#wrapper').hide(500);
		$('#edit_contract').show(1000);
		$('#del_row1').hide();
		$('#contract_det').html("<i class='glyphicon glyphicon-eye-open'></i> Active Contract No. : "+contracts_data[id].contract_no);
		$('#rowkey').val(id);
		$('#cid').val(contracts_data[id].id);
		$('#client_id').val(contracts_data[id].client);
		$('#contract_no').val(contracts_data[id].contract_no);
		$('#order_no').val(contracts_data[id].order_no);
		$('#account').val(contracts_data[id].account);
		$('#discount').val(contracts_data[id].discount);
		$('#start_dt').val(contracts_data[id].start);
		$('#end_dt').val(contracts_data[id].end);
		$('#contact').val(contracts_data[id].contact);
		$('#contract_des').val(contracts_data[id].description);
		$('#notes').val(contracts_data[id].notes);
		$('#cno_new').val(contracts_data[id].id);
		var contract_client=contracts_data[id].client;
		//console.log(contract_client);
		var status=contracts_data[id].status;
		var ac_discount=contracts_data[id].acct_discount;
		var txt="";
		no=1;
		if(status==1)
		{
			//var radioBtn = $('<input type="radio" name="rbtnCount" />');
			txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='sts' checked>";
    		txt+="<label class='onoffswitch-label' for='sts'>";
    		txt+="<span class='onoffswitch-inner' ></span>";
    		txt+="<span class='onoffswitch-switch'></span>";
    		txt+="</label></div>";
    	}
    	else
		{
			txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='sts'>";
    		txt+="<label class='onoffswitch-label' for='sts'>";
    		txt+="<span class='onoffswitch-inner'></span>";
    		txt+="<span class='onoffswitch-switch'></span>";
    		txt+="</label></div>";
    	}
    	$('#status1').html(txt);
    	
    	//Clients select box
		var txt="";
		var key="";
		var val="";
		$('#nm_client').empty();
		
		
		var lenc = clients_json.length;
		if(lenc > 0){
        for(var i=0;i<lenc;i++){
		if(clients_json[i].client_id == contract_client)
		{
			var product_list = clients_json[i].product_id;
			var acm = clients_json[i].acct_manager;
			var nm_discount = clients_json[i].client_discount;
			var client_type=clients_json[i].client_type;
			txt+="<option value='"+clients_json[i].client_id +"'>"+ clients_json[i].name +"</option>";

		}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Choose client</option>";
		}
		
		
		$("#nm_client").append(txt);
	
		$.each(clients_json,function(key,val) {
    	$('#nm_client').append('<option value="'+ clients_json[key].client_id + '">' + clients_json[key].name + '</option>');
		});
		//End clients select box
		txt="";
		txt1="";
		if(client_type==3)
				{
					$('#acc').html("<input id='account1' name='account' type='hidden' value='3'><input id='acnt' readonly='readonly' name='acnt' value='Client Account' class='advertise' type='text'>");
					$('#acc input').css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"});
					//$('#account').val(client_type_json[0].type_name);
				}
				else if(client_type==1)
				{
					txt+="<select name='account' class='advertise'  id='account1'>";
					txt+="</select>";
					$('#acc').html(txt);
					$('#account1').empty();
		
					var len_clients = clients_json.length;
					
					if(len_clients > 0){
						$.each(clients_json,function(key,val) {
							if(clients_json[key].client_type==2)
							{
								if(clients_json[key].client_id==contracts_data[id].account)
								{
									txt1+='<option value="'+ clients_json[key].client_id + '">' + clients_json[key].name + '</option>';
									
								}
							}
							
							
						});
						if(txt1!="")
						{
							$('#account1').append(txt1);
						}
						else
						{
							$('#account1').append('<option value="">Choose client</option>');
						}
					$.each(clients_json,function(key,val) {
						
						if(clients_json[key].client_type==2)
						{
			    			$('#account1').append('<option value="'+ clients_json[key].client_id + '">' + clients_json[key].name + '</option>');
			    		}
					});
					}	
				}
				else
				{
					$('#acc').html("--");
				}
	$('#nm_client').on('change', function(e) {
			var client_id =$(this).val();
			var txt="";
			var location="<?php echo base_url();?>traffic/get_client_type";
			$.ajax({
				dataType : "JSON",
				type : "POST",
				url : location,
				data : {
					client_id : client_id
			}
			}).done(function(msg){
				if(msg) {
				var client_type_json=msg;
				if(client_type_json[0].type_id==3)
				{
					$('#acc').html("<input id='account1' name='account' type='hidden' value='"+client_type_json[0].type_id+"'><input id='acnt' readonly='readonly' name='acnt' value='"+client_type_json[0].type_name+"' class='advertise' type='text'>");
					
					//$('#acc').html("<input id='account' name='account1' type='hidden' value='"+client_type_json[0].type_id+"'><input id='acnt' readonly='readonly' name='acnt' value='"+client_type_json[0].type_name+"' class='form-control' type='text'>");
					$('#acc input').css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"});
					//$('#account').val(client_type_json[0].type_name);
				}
				else if(client_type_json[0].type_id==1)
				{
					txt+="<select name='account' class='advertise'  id='account1'>";
					txt+="</select>";
					$('#acc').html(txt);
					$('#account1').empty();
		
					var len_clients = clients_json.length;
					$('#account1').append('<option value="">Clients list</option>');
					if(len_clients > 0){
					$.each(clients_json,function(key,val) {
						if(clients_json[key].client_type==2)
			    			$('#account1').append('<option value="'+ clients_json[key].client_id + '">' + clients_json[key].name + '</option>');
					});
					}	
				}
				else
				{
					$('#acc').html("---");
				}
			}
			else
			{
				$('#acc').html("--");
			}
		});
	});	
		//Products select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#nm_product').empty();
		
		var len = products_json.length;
		 if(len > 0){
                  for(var i=0;i<len;i++){
    	if(products_json[i].product_id == product_list)
    	{
    		txt+="<option value='"+products_json[i].product_id+"'>"+products_json[i].product_name +"</option>";
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#nm_product").append(txt);
	
		$.each(products_json,function(key,val) {
			
    	$('#nm_product').append('<option value="'+ products_json[key].product_id + '">' + products_json[key].product_name + '</option>');
		});
		//End products select box
		
		//Account manager select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#acm').empty();
		
		
		var len = acctmanager_json.length;
		 if(len > 0){
                  for(var i=0;i<len;i++){
		
		
			
    	if(acctmanager_json[i].acct_manager_id == acm)
    	{
    		txt+="<option value='"+acctmanager_json[i].acct_manager_id+"'>"+acctmanager_json[i].acct_manager +"</option>";
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#acm").append(txt);
	
		$.each(acctmanager_json,function(key,val) {
			
    	$('#acm').append('<option value="'+ acctmanager_json[key].acct_manager_id + '">' + acctmanager_json[key].acct_manager + '</option>');
		});
		//End account manager select box
		
		//Client discount text box
		var txt="";
		var key="";
		var val="";
		lenc="";
		$('#nm_discount').empty();
		
		
		var lenc = clients_json.length;
		if(lenc > 0){
			txt+=nm_discount;
		}
		
		
		$("#nm_discount").val(txt);
	
		
		//End client discount text box
		//Account discount text box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#ac_discount').empty();
		
		
		var len = contracts_data.length;
		if(len > 0){
			txt+=ac_discount;
		}
		
		
		$("#ac_discount").val(txt);
		//End account discount text box
		//End Clients Tab
		//Start Contract Lines
		var contract_id = contracts_data[id].id;
		var contract_no = contracts_data[id].contract_no;
		//$('#line_contract').hide();
		$(".line_cnt").empty();
		var txt="";
		var plt="";
		var pid="";
		var ltype="";
		var st="";
		var et="";
		var duration="";
		var rate="";
		var des ="";
		lineTotal=0;
		$('#line_contract').show();
		//console.log(contract_id);
		var location="<?php echo base_url();?>traffic/get_contract_line";
		$.ajax({
			type : "POST",
			dataType : "json",
			url : location,
			data : {
				contract_id : contract_id

			}
		}).done(function(contract_line) {
			if (contract_line==false) {
				$('#line_msg ').show().html("<label class='label label-warning'> No contractLines found</label>");
				console.log('No contractLines');
				$('#line_contract').hide();
			}
			else
			{
				$('#line_msg ').hide();
				
				
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
			if( contract_line[key].line_total==null)
				var total =0;
			else
				var total=contract_line[key].line_total;
			lineTotal+=parseFloat(total);
			var line_id=contract_line[key].id;
			var st=contract_line[key].start_time;
			var et=contract_line[key].end_time;
			var duration=contract_line[key].duration;
			var rate = contract_line[key].rate;
			var des = contract_line[key].description;
				txt+='<tr class="line_cnt" id="r1_'+ contract_line[key].id + '"><td id="c_'+ contract_line[key].id + '"><input type="checkbox" id="check1[]"  value="'+ contract_line[key].id + '" class="checkbox2" name="check1[]"></td>';
				txt+='<td id="c1_'+ contract_line[key].id + '">' + no + '</td>';
				txt+='<td id="c2_'+ contract_line[key].id + '">' + plt + '</td>';
    			txt+='<td id="c3_'+ contract_line[key].id + '">' + type + '</td>';
				txt+='<td id="c4_'+ contract_line[key].id + '">' + contract_line[key].start_time + '</td>';
				txt+='<td id="c5_'+ contract_line[key].id + '">' + contract_line[key].end_time + '</td>';
				txt+='<td id="c6_'+ contract_line[key].id + '">' + contract_line[key].description + '</td>';
				txt+='<td id="c7_'+ contract_line[key].id + '">' + contract_line[key].duration + '</td>';
				txt+='<td id="c8_'+ contract_line[key].id + '">' + contract_line[key].rate + '</td>';
				txt+='<td id="c11_'+ contract_line[key].id + '">' + contract_line[key].quantity + '</td>';
				txt+='<td id="c9_'+ contract_line[key].id + '">' + total + '</td>';
				txt+='<td id="c10_'+ contract_line[key].id + '"><a href="javascript:void(0)"';
				txt+= 'onclick="modal_line_populate('+line_id+','+pid+','+ltype+', \''+contract_no+'\')" data-toggle="modal" data-target="#modalEditCnt" title="Edit ContractLine"><i class="glyphicon glyphicon-edit"></i></a></td></tr>';
				no+=1;
			});
			$('#total').html('<label class="label label-primary">Total<span class="badge" style="background: #FFF; color: #1cace9;">'+lineTotal+'</span></label>');
			//jQuery("#line_contract tbody").append(txt).removeClass("hidden");;
			 $("#line_contract").append(txt).removeClass("hidden");
			  if(tbl==1) {
		 	var table="";
          // Initialize Datatables
          var table = $('#line_contract').DataTable({
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
			
            // Customize the ColVis button text so it's an icon and align the dropdown to the right side
            "colVis": {
              "buttonText": "<i class='fa fa-columns'></i>",
              "sAlign": "right",
              "showAll": "<button class='btn-block'>Show all</button>",
              "showNone": "<button class='btn-block'>Show none</button>",
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
		  
		  
		  tbl+=1;
			  }
  //Delete contractLines
	$(document).ready(function() {
    $('#selectall_1').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row1').fadeIn(100);
			     $('#del_row1').slideDown().html('<td style="color: #800; font-weight: bold;">Delete selected: </td><td><a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelCnt" title="Remove"><span class="pficon pficon-delete"></span></a></td>');       
            });
           $("#selectall_e1").prop("checked", true);
        }else{
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"      
                 $('#del_row1').fadeOut(500);                    
            });  
           $("#selectall_e1").prop("checked", false);    
        }
    });
    
    $('#selectall_e1').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row1').fadeIn(100);
			     $('#del_row1').slideDown().html('<td style="color: #800; font-weight: bold;" colspan="2">Delete selected: </td><td colspan="9"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelCnt" title="Remove"><span class="pficon pficon-delete"></span></a></td>');       
            });
           $("#selectall_1").prop("checked", true);
        }else{
            $('.checkbox2').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"      
                $('#del_row1').fadeOut(500);                  
            });  
           $("#selectall_1").prop("checked", false);    
        }
    });
    var f=0;
    $('.checkbox2').click(function(event) {  //on click
        if(this.checked) { // check select status
           
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row1').fadeIn(100);
			     $('#del_row1').slideDown().html('<a style="text-decoration:none;" href="javascript:void(0)" data-toggle="modal" data-target="#modalDelCnt" title="Remove"><span style="color: #800; font-weight: bold;">Delete selected: <span class="pficon pficon-delete"></span></a>');       
           
           
        }else{
            
            $('.checkbox2').each(function() { //loop through each checkbox
               if(this.checked == true)
               { 
               		var f=1;   
                exit();
               }
                   
            }); 
            if(f==0)
            {
            	 $('#del_row1').fadeOut(500);
            }    
        }
          
    });
    
});
//End contrctLine delete
			//$('#line_contract').append(txt);
			}
		});
		//End Contract Lines

	}
	function updatedata() {
		$('#success12').html("Please wait...").show();
		var key = $('#rowkey').val();
		var location="<?php echo base_url();?>traffic/contract_update";
		$.ajax({
			type : "POST",
			url : location,
			data : {
				contract_id : $('#cid').val(),
				contract_no : $('#contract_no').val(),
				order_no : $('#order_no').val(),
				account : $('#account').val(),
				discount : $('#discount').val(),
				start_dt : $('#start_dt').val(),
				end_dt : $('#end_dt').val(),
				contact : $('#contact').val(),
				contract_des : $('#contract_des').val(),
				notes : $('#notes').val(),
				
				status : $('#sts:checked').val()

			}
		}).done(function(msg) {
			if (msg == 1) {
				contracts_data[key].id = $('#cid').val();
				var ad = $('#cid').val();
				var sts=$('#sts:checked').val();
				if(sts!=1)
					sts=2;
				contracts_data[key].contract_no = $('#contract_no').val();
				contracts_data[key].order_no = $('#order_no').val();
				contracts_data[key].account = $('#account').val();
				contracts_data[key].discount = $('#discount').val();
				contracts_data[key].start= $('#start_dt').val();
				contracts_data[key].end = $('#end_dt').val();
				contracts_data[key].contact = $('#contact').val();
				contracts_data[key].description= $('#contract_des').val();
				contracts_data[key].notes = $('#notes').val();
				contracts_data[key].status = sts;
				
				$('#success12').html("Contract data updated successfully").show();

				$('#t1_' + ad).html($('#cid').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t2_' + ad).html($('#contract_no').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				
				
				$('#t5_' + ad).html($('#order_no').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t6_' + ad).html($('#start_dt').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t7_' + ad).html($('#end_dt').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t8_' + ad).html($('#contact').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t9_' + ad).html($('#contract_des').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t12_' + ad).html($('#notes').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				
				var status= contracts_data[key].status;
				if(status==1)
				{
					txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='"+ad+"' checked>";
    				txt+="<label class='onoffswitch-label' for='"+ad+"'>";
    				txt+="<span class='onoffswitch-inner' ></span>";
    				txt+="<span class='onoffswitch-switch'></span>";
    				txt+="</label></div>";
    			}
    			else
				{
					txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='"+ad+"'>";
    				txt+="<label class='onoffswitch-label' for='"+ad+"'>";
    				txt+="<span class='onoffswitch-inner'></span>";
    				txt+="<span class='onoffswitch-switch'></span>";
    				txt+="</label></div>";
    			}
    			$('#t10_'+ad).html("<label onclick='modal_del_populate("+key+")' data-toggle='modal' data-target='#modalDel' title='Change status'>"+txt+"</label>");
				
				
				
				setTimeout(function(){
   						$('#success12').fadeOut(500);
						}, 2500);

			}
			else{
				$('#success12').hide();
				$('#error12').html("No changes were made!").show();
				setTimeout(function(){
   						$('#error12').fadeOut(500);
						}, 2500);
			}
		});
	}
function update_client() {
		$('#success_client').html("Please wait...").show();
		//console.log($('#nm_client option:selected').val());
		var key = $('#rowkey').val();
		
		var location="<?php echo base_url();?>traffic/client_update";
		$.ajax({
			type : "POST",
			url : location,
			data : {
				contract_id : $('#cid').val(),
				new_client : $('#nm_client option:selected').val(),
				account1 : $('#account1').val(),
				old_client : $('#client_id').val(),
				acm : $('#acm option:selected').val(),
				nm_product : $('#nm_product option:selected').val(),
				nm_discount : $('#nm_discount').val(),
				ac_discount : $('#ac_discount').val()
			}
		}).done(function(msg) {
			if (msg==1) {
				contracts_data[key].id = $('#cid').val();
				var ad = $('#cid').val();
				$('#client_id').val($('#nm_client option:selected').val());
				contracts_data[key].product_id = $('#nm_product option:selected').val();
				contracts_data[key].acct_discount = $('#ac_discount').val();
				contracts_data[key].client=$('#nm_client option:selected').val();
				contracts_data[key].account = $('#account1').val();
				var client_no = $('#client_id').val();
				//console.log($('#nm_client option:selected').val());
				var lenc = clients_json.length;
				if(lenc > 0){
        		for(var i=0;i<lenc;i++){
				if(clients_json[i].client_id == client_no)
				{
					clients_json[i].client_id= $('#nm_client option:selected').val();
					clients_json[i].product_id=$('#nm_product option:selected').val();
					clients_json[i].acct_manager=$('#acm option:selected').val();
					clients_json[i].client_discount=$('#nm_discount').val();
				}
				}
			}
				//console.log(upd_audience);
				
				
				$('#success_client').html("Data updated successfully").show();

				$('#t1_' + ad).html($('#cid').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t2_' + ad).html($('#contract_no').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t3_' + ad).html($('#nm_client option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t4_' + ad).html($('#nm_product option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				$('#t5_' + ad).html($('#order_no').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t6_' + ad).html($('#start').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t7_' + ad).html($('#end').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t8_' + ad).html($('#contact').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t9_' + ad).html($('#contract_des').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t12_' + ad).html($('#notes').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				
				var status= contracts_data[key].status;
				if(status==1)
				{
					txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='"+ad+"' checked>";
    				txt+="<label class='onoffswitch-label' for='"+ad+"'>";
    				txt+="<span class='onoffswitch-inner' ></span>";
    				txt+="<span class='onoffswitch-switch'></span>";
    				txt+="</label></div>";
    			}
    			else
				{
					txt="<div class='onoffswitch'><input type='checkbox' name='onoffswitch' value='1' class='onoffswitch-checkbox' id='"+ad+"'>";
    				txt+="<label class='onoffswitch-label' for='"+ad+"'>";
    				txt+="<span class='onoffswitch-inner'></span>";
    				txt+="<span class='onoffswitch-switch'></span>";
    				txt+="</label></div>";
    			}
    			$('#t10_'+ad).html("<label onclick='modal_del_populate("+key+")' data-toggle='modal' data-target='#modalDel' title='Change status'>"+txt+"</label>");
				setTimeout(function(){
   						$('#success_client').fadeOut(500);
						}, 2500);

			}
			else{
				$('#success_client').hide();
				$('#error_client').html("No changes were made!").show();
				setTimeout(function(){
   						$('#error_client').fadeOut(500);
						}, 2500);
			}
		});
	}
	function deletedata_cnt() {
		del_tot=0;
	var location="<?php echo base_url();?>traffic/contractline_delete_update_total";
	// event.preventDefault();
    var searchIDs = $("#line_contract input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
  		var ad = searchIDs;
		var data = 'line_id=' + searchIDs;
		$.ajax({
			dataType: "JSON",
			type : "POST",
			url : location,
			data : data
		}).done(function(msg) {
			
			msg_json=msg;
			$.each(msg_json, function(key, val){
				del_tot+=parseFloat(msg_json[key].line_total);
			});
			//console.log(del_tot);
			lineTotal-=del_tot;	
			$('#total').html('<label class="label label-primary">Total<span class="badge" style="background: #FFF; color: #1cace9;">'+lineTotal+'</span></label>');
			
				// var myaddr= ad.split(',');
				//var array = JSON.parse("[" + ad + "]");
				 $.each(ad, function(i,element){
                   	$("#r1_"+element).animate({ backgroundColor: "#fbc7c7" }, "fast")
					.animate({ opacity: "hide" }, "slow");
					
                });
		//$("#r1_"+ad).animate({ backgroundColor: "#fbc7c7" }, "fast")
//.animate({ opacity: "hide" }, "slow");
				$('#del_row1').hide();
				$('#modalDelCnt').modal('toggle');
				//$('#r1_' + ad).html("dleep");
				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	
	});
	}
	
	function modal_line_populate(lid, pid, ltype, cno)
	{
		$('#sub_line').show();
		$('#spin_line').hide();
		$('#e_line_no').html(cno);
		
		//Platform list select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#e_platform').empty();
		
		
		var len = platform_json.length;
		 if(len > 0){
                  for(var i=0;i<len;i++){
		
		
			
    	if(platform_json[i].id ==  pid)
    	{
    		txt+="<option value='"+ platform_json[i].id +"'>"+platform_json[i].name +"</option>";
			break;
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#e_platform").append(txt).removeClass("hidden");
	
		$.each(platform_json,function(key,val) {
			
    	$('#e_platform').append('<option value="'+ platform_json[key].id + '">' + platform_json[key].name + '</option>');
		});
		
			
		//End Platform list select box	
		
		//contract line type select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#e_type').empty();
		
		
		var len = linetype_json.length;
		 if(len > 0){
                  for(var i=0;i<len;i++){
		
		
			
    	if(linetype_json[i].id ==  ltype)
    	{
    		txt+="<option value='"+ linetype_json[i].id +"'>"+linetype_json[i].name +"</option>";
			break;
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#e_type").append(txt);
	
		$.each(linetype_json,function(key,val) {
			
    	$('#e_type').append('<option value="'+ linetype_json[key].id + '">' + linetype_json[key].name + '</option>');
		});
		
			var location="<?php echo base_url();?>traffic/get_contract_line_unique";
		$.ajax({
			type : "POST",
			dataType : "json",
			url : location,
			data : {
				line_id : lid

			}
		}).done(function(contract_line) {
			if (contract_line==false) {
				console.log('No contractLines');
			}
			else
			{
				$('#cline_id').val(contract_line[0].id);
				$('#e_start').val(contract_line[0].start_time);
				$('#e_end').val(contract_line[0].end_time);
				$('#e_duration').val(contract_line[0].duration);
				$('#e_rate').val(contract_line[0].rate);
				$('#e_des').text(contract_line[0].description);
				$('#e_qnty').val(contract_line[0].quantity);
				$('#e_all_tot').val(contract_line[0].line_total);
			}
		});
		//End Contract line type select box	
		
	}
	function update_contract_line()
	{
		$('#sub_line').hide();
		$('#spin_line').show();
		current_tot=$('#e_all_tot').val();
		var location="<?php echo base_url();?>traffic/update_contract_line";
		var lid= $('#cline_id').val();
		$.ajax({
			type : "POST",
			url : location,
			data : {
				line_id : $('#cline_id').val(),
				pid : $('#e_platform option:selected').val(),
				type : $('#e_type option:selected').val(),
				start : $('#e_start').val(),
				end : $('#e_end').val(),
				dur : $('#e_duration').val(),
				rate : $('#e_rate').val(),
				des : $('#e_des').val(),
				qnty : $('#e_qnty').val()

			}
		}).done(function(msg) {
			if (msg) 
			{
				quan = $("#e_qnty").val() != "" ? parseFloat($("#e_qnty").val()) : 1,  //  Get quantity value
				pric = $("#e_rate").val() != "" ? parseFloat($("#e_rate").val()) : 0;  //  Get price value
				var line_total=quan *pric;
				//console.log(current_tot);
				//Update Line Total
					lineTotal-=current_tot;
				
				lineTotal+=parseFloat(line_total);	
				$('#total').html('<label class="label label-primary">Total<span class="badge" style="background: #FFF; color: #1cace9;">'+lineTotal+'</span></label>');
				
				$('#c_' + lid).html($('#lid').val());
				
				$('#c1_' + lid).css({
									"font-weight" : "bold",
									"color" : "#333"
								});
				
				$('#c2_' + lid).html($('#e_platform option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c3_' + lid).html($('#e_type option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c4_' + lid).html($('#e_start').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c5_' + lid).html($('#e_end').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c6_' + lid).html($('#e_des').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c7_' + lid).html($('#e_duration').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c8_' + lid).html($('#e_rate').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c9_' + lid).html(line_total).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c11_' + lid).html($('#e_qnty').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				setTimeout(function(){
						$('#success_line').html("Data updated successfully").show();
						$('#modalEditCnt').modal('toggle');
   						$('#success_line').fadeOut(4500);
   						$('#spin_line').hide();
						}, 500);
			}
			else
			{
				
				setTimeout(function(){
					$('#modalEditCnt').modal('toggle');
						$('#error_line').html("No changes were made!").show();
						$('#error_line').fadeOut(4500);
						$('#spin_line').hide();
						}, 500);
						
				
			}
		});
	}
function modal_insert_line()
	{
		$('#m_start').val('');
		$('#m_end').val('');
		$('#m_duration').val('');
		$('#m_rate').val('');
		$('#m_des').val('');
		$('#m_qnty').val('');
		$('#m_total').val('');
		$('#sub_line_new').show();
		$('#spin_line_new').hide();
		var cno= $('#cno_new').val();
		//console.log(cno);
		contract_id=cno;
		//console.log(contract_id);
		$('#m_cline_id').val(contract_id);
		$('#m_line_no').html(parseFloat(cno)+1000);
		
		//Platform list select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#m_platform').empty();
		
		
		var len = platform_json.length;
		
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#m_platform").append(txt).removeClass("hidden");
	
		$.each(platform_json,function(key,val) {
			
    	$('#m_platform').append('<option value="'+ platform_json[key].id + '">' + platform_json[key].name + '</option>');
		});
		
			
		//End Platform list select box	
		
		//contract line type select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#m_type').empty();
		
		
		var len = linetype_json.length;
		 
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#m_type").append(txt);
	
		$.each(linetype_json,function(key,val) {
			
    	$('#m_type').append('<option value="'+ linetype_json[key].id + '">' + linetype_json[key].name + '</option>');
		});
		
			
		//End Contract line type select box	
		
	}
function insert_contract_line()
	{
		line_platform = $('#m_platform option:selected').val();
		line_type = $('#m_type option:selected').val();
		if(!line_platform || !line_type)
		{
			alert('Please select Platform and Line Type');
			return false;
		}
		$('#sub_line_new').hide();
		$('#spin_line_new').show();
		txt="";
		var location="<?php echo base_url();?>traffic/insert_new_contract_line";
		var cno= $('#m_cline_id').val();
		$.ajax({
			type : "POST",
			url : location,
			data : {
				line_cno : $('#m_cline_id').val(),
				line_platform : $('#m_platform option:selected').val(),
				line_type : $('#m_type option:selected').val(),
				linestart_dt : $('#m_start').val(),
				lineend_dt : $('#m_end').val(),
				line_duration : $('#m_duration').val(),
				line_rate : $('#m_rate').val(),
				description : $('#m_des').val(),
				line_qnty : $('#m_qnty').val(),
				line_total : $('#m_total').val()

			}
		}).done(function(msg) {
			if (msg) 
			{
				//Add new row 
				//console.log(msg);
				$('#line_contract').show();
				$('#line_msg').hide();
				var tot=$('#m_total').val();
				pid=$('#m_platform option:selected').val();
				ltype= $('#m_type option:selected').val();
				//txt+='<tr class="line_cnt" id="r1_'+ contract_line[key].id + '"><td id="c_'+ contract_line[key].id + '"><input type="checkbox" id="check[]"  value="'+ contract_line[key].id + '" class="checkbox" name="check[]">';
				txt+='<tr class="line_cnt" id="r1_'+ msg + '"><td id="c_'+ msg + '"><input type="checkbox" id="check[]"  value="'+ msg + '" class="checkbox" name="check[]">';
				txt+='<td id="c1_'+ msg + '"> '+ no +'</td>';
				txt+='<td id="c2_'+ msg + '">' + $('#m_platform option:selected').text() + '</td>';
				txt+='<td id="c3_'+ msg + '">' + $('#m_type option:selected').text() + '</td>';
				txt+='<td id="c4_'+ msg + '">' + $('#m_start').val() + '</td>';
				txt+='<td id="c5_'+ msg + '">' + $('#m_end').val() + '</td>';
				txt+='<td id="c6_'+ msg + '">' + $('#m_des').val() + '</td>';
				txt+='<td id="c7_'+ msg + '">' + $('#m_duration').val() + '</td>';
				txt+='<td id="c8_'+ msg + '">' + $('#m_rate').val() + '</td>';
				txt+='<td id="c11_'+ msg + '">'+$('#m_qnty').val() + '</td>';
				txt+='<td id="c9_'+ msg + '">' + $('#m_total').val() + '</td>';
				txt+='<td id="c10_'+ msg + '"><a href="javascript:void(0)"';
				txt+= 'onclick="modal_line_populate('+msg+','+pid+','+ltype+', '+(parseFloat(cno)+1000)+')" data-toggle="modal" data-target="#modalEditCnt" title="Edit ContractLine"><i class="glyphicon glyphicon-edit"></i></a></td></tr>';
				no+=1
				$("#line_contract").append(txt).removeClass("hidden");
				if(tbl==1) {
		 	var table="";
          // Initialize Datatables
          var table = $('#line_contract').DataTable({
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
			
            // Customize the ColVis button text so it's an icon and align the dropdown to the right side
            "colVis": {
              "buttonText": "<i class='fa fa-columns'></i>",
              "sAlign": "right",
              "showAll": "<button class='btn-block'>Show all</button>",
              "showNone": "<button class='btn-block'>Show none</button>",
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
		  
		  
		  tbl+=1;
			  }
				if(!tot)
					tot=0;
				lineTotal+=parseFloat(tot);
				$('#total').html('<label class="label label-primary">Total<span class="badge" style="background: #FFF; color: #1cace9;">'+lineTotal+'</span></label>');
				setTimeout(function(){
						$('#success_line_new').html("Data inserted successfully").show();
						$('#modalInsertLine').modal('toggle');
   						$('#success_line_new').fadeOut(4500);
   						$('#spin_line_new').hide();
						}, 500);
			}
			else
			{
				
				setTimeout(function(){
						$('#modalInsertLine').modal('toggle');
						$('#error_line_new').html("Insertion failed!").show();
						$('#error_line_new').fadeOut(4500);
						$('#spin_line_new').hide();
						}, 500);
						
				
			}
			delLine();
			

		});
	}
	function delLine(){
    $('#selectall_1').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row1').fadeIn(100);
			     $('#del_row1').slideDown().html('<td style="color: #800; font-weight: bold;">Delete selected: </td><td><a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelCnt" title="Remove"><span class="pficon pficon-delete"></span></a></td>');       
            });
           $("#selectall_e1").prop("checked", true);
        }else{
            $('.checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"      
                 $('#del_row1').fadeOut(500);                    
            });  
           $("#selectall_e1").prop("checked", false);    
        }
    });
    
    $('#selectall_e1').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row1').fadeIn(100);
			     $('#del_row1').slideDown().html('<td style="color: #800; font-weight: bold;" colspan="2">Delete selected: </td><td colspan="9"><a href="javascript:void(0)" data-toggle="modal" data-target="#modalDelCnt" title="Remove"><span class="pficon pficon-delete"></span></a></td>');       
            });
           $("#selectall_1").prop("checked", true);
        }else{
            $('.checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"      
                $('#del_row1').fadeOut(500);                  
            });  
           $("#selectall_1").prop("checked", false);    
        }
    });
    var f=0;
    $('.checkbox').click(function(event) {  //on click
        if(this.checked) { // check select status
           
                this.checked = true;  //select all checkboxes with class "checkbox1"     
                 $('#del_row1').fadeIn(100);
			     $('#del_row1').slideDown().html('<a style="text-decoration: none;" href="javascript:void(0)" data-toggle="modal"  data-target="#modalDelCnt" title="Remove"><span style="color: #800; font-weight: bold;" >Delete selected: <span class="pficon pficon-delete"></span></a>');       
           
           
        }else{
            
            $('.checkbox').each(function() { //loop through each checkbox
               if(this.checked == true)
               { 
               		var f=1;   
                	exit();
               }
                   
            }); 
            if(f==0)
            {
            	 $('#del_row1').fadeOut(500);
            }    
        }
          
    });
    }
//End contrctLine delete	
$(function() {  //  In jQuery 1.6+ this is same as $(document).ready(function(){})
$('#m_qnty, #m_rate')  //  jQuery CSS selector grabs elements with the ID's "quantity" & "item_price"
.on('keyup', function(e) {  //  jQuery 1.6+ replcement for .live (dynamically asigns event, see jQuery API)
//  in this case, our event is "change" which works on inputs and selects to let us know when a value is changed
//  below i use inline if statements to assure the values i get are "Real"
var quan = $("#m_qnty").val() != "" ? parseFloat($("#m_qnty").val()) : 1,  //  Get quantity value
pric = $("#m_rate").val() != "" ? parseFloat($("#m_rate").val()) : 0;  //  Get price value
$('#m_total').val(pric*quan).css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"}); // show total
});
});
function cancelTab()
{
	$('#edit_contract').hide();
	$('#wrapper').show(20);
	
}
function redir()
{
	window.location.href = "<?php echo base_url();?>traffic/add_contracts";
}	
</script>
<!-- cdn for modernizr, if you haven't included it already -->
<!--<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>-->
<script src="<?php echo base_url(); ?>system/assets/js/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<!--<script src="<?php echo base_url(); ?>system/assets/js/polyfiller.js"></script>-->
<script>
  webshims.setOptions('waitReady', false);
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
</script>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>users/dashboard">Dashboard</a></li>
            <li>Active Contracts</li>
          </ol>
          
          <button class="btn btn-info" type="button" onclick="redir();" title="Add new contarct data">
<i class="glyphicon glyphicon-plus"></i>
Add New Contract
</button>
          <hr>
          
           <span id="success_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-success"></span>
            <span id="warning_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-warning"></span>
          <!--Start contract table-->
          <div id="wrapper">
          <label style="top: 90px; position: absolute;" class="btn btn-sm btn-default" id="del_row" type="button">
							</label>
         <div class="table-responsive">
		 <table id="contract_data" class="datatable table table-striped table-bordered">
        <thead>
        	
            <tr>
                <th>
                <input type="checkbox" id="selectall" value="0" >
              </th>
                <th>No.</th>
                <th>Contract No.</th>
                <th>Client</th>
                <th>Product</th>
                <th>Order No.</th>
                <th>Start Date.</th>
                <th>End Date</th>
                <th>Contact</th>
                <th>Description</th>
                <th>Notes</th>
                <th>Status</th>
                
                <th>Action</th>
            </tr>
            
        </thead>
 
        <tfoot>
        	
            <tr>
            	<th>
                <input type="checkbox" value="0" id="selectall_e">
              </th>
                <th>No.</th>
                <th>Contract No.</th>
                <th>Client</th>
                <th>Product</th>
                <th>Order No.</th>
                <th>Start Date.</th>
                <th>End Date</th>
                <th>Contact</th>
                <th>Description</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
 
        <tbody>
        <?php
        $i=1;
        if($contracts)
		{
		 foreach ($contracts as $row=>$res)
		 {
			 $cid=$res['id'];
			 $contract_status=$res['status'];
			 if($contract_status==2)
			 {
			 	 ?> <tr style="font-style: ; color: #1569C7; " id="r1_<?php echo $cid; ?>"><?php
			 }
			 else {?>
				 <tr id="r1_<?php echo $cid; ?>">
				 	<?php
			 }
			 $stus=$res['status'];
			 if($stus==1)
			 {
			 	$status=" <div class='onoffswitch'>
    						<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='".$cid."1' checked>
    <label class='onoffswitch-label' for='".$cid."1'>
    <span class='onoffswitch-inner'></span>
    <span class='onoffswitch-switch'></span>
    </label>
    </div> ";
			 }
			 else {
				 $status="<div class='onoffswitch'>
    						<input type='checkbox' name='onoffswitch' class='onoffswitch-checkbox' id='".$cid."1'>
    <label class='onoffswitch-label' for='".$cid."1'>
    <span class='onoffswitch-inner'></span>
    <span class='onoffswitch-switch'></span>
    </label>
    </div>";
			 }
			 $start_dt=date('d-m-y', strtotime($res['start']));
			 $end_dt=date('d-m-y', strtotime($res['end']));
			 if($start_dt=="01-01-70")
			 	$start_dt="-";
			 if($end_dt=="01-01-70")
			 	$end_dt="-";
			 ?>
		 
            
            	<td>
                <input type="checkbox" id="check[]"  value="<?php echo $res['id']; ?>" class="checkbox1" name="check[]">
              </td>
            	<td id="t1_<?php echo $cid; ?>"><?php echo $i; ?></td>
                <td id="t2_<?php echo $cid; ?>"><?php echo $res['contract_no']; ?></td>
                <td id="t3_<?php echo $cid; ?>"></td>
                <td id="t4_<?php echo $cid; ?>"></td>
                <td id="t5_<?php echo $cid; ?>"><?php echo $res['order_no']; ?></td>
                <td id="t6_<?php echo $cid; ?>"><?php echo $start_dt; ?></td>
                <td id="t7_<?php echo $cid; ?>"><?php echo $end_dt; ?></td>
                <td id="t8_<?php echo $cid; ?>"><?php echo $res['contact']; ?></td>
                <td id="t9_<?php echo $cid; ?>"><?php echo $res['description']; ?></td>
                <td id="t12_<?php echo $cid; ?>"><?php echo $res['notes']; ?></td>
                <td id="t10_<?php echo $cid; ?>">
             
               
                </td>
                
                <td>
                	<a class="edit ml10" href="javascript:void(0)" onclick="modal_populate(<?php echo $row; ?>)" title="Edit client data"><i class="glyphicon glyphicon-edit"></i></a>
                	
                	</td>
               
            </tr>
            <?php $i+=1; } } ?>
        </tbody>
    </table>
	</div>
 </div>
 <!--End contract table-->
 
 <!--Edit contract tabs-->
 <div id="edit_contract">
 	
 			
 	    <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
    <li><a href="#tab2" data-toggle="tab">Client</a></li>
    <li><a href="#tab3" data-toggle="tab">Contract Lines</a></li>
   
    </ul>
    <div class="tab-content">
    	<br>
    	<span class="label label-success" id="contract_det"> </span>
 			<button class="btn btn-sm btn-info" type="button" id="add_line" onclick="modal_insert_line()" data-toggle="modal" data-target="#modalInsertLine" title="Add new Line">
			<i class="glyphicon glyphicon-plus"></i>
			New Line
			</button>
			<span id="spin_line1" class="label label-warning" style="left: 35%; margin: 0 auto; position: absolute; top: "></span>
			<span id="success_line_new" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: ;" class="label label-success"></span>
    	 	<span id="error_line_new" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: ;" class="label label-warning"></span>
 		<hr>
    <div class="tab-pane active" id="tab1">
    <p>
    	<input type="hidden" id="cid" value="" />
    	<input type="hidden" id="cno_new" value="" />
    	<input type="hidden" id="client_id"  name="client_id" value="" />
    	 <span id="success12" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	<span id="error12" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
		<span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput">Contract No.</label>
              <div class="col-md-6">
                <input id="contract_no" name="contract_no" required value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">Order No.</label>
              <div class="col-md-6">
                <input id="order_no" name="order_no" required value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label" for="textInput4">Contract Status</label>
              <div class="col-md-3">
                <div id="status1"></div>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Discount</label>
              <div class="col-md-6">
                <input id="discount" name="discount"  value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label" for="textInput3">Start Date</label>
              <div class="col-md-6">
               <div class="input-append date">
                    <input type="text" id="start_dt" name="start_dt" readonly="readonly" class="form-control"><span class="add-on"><i class="icon-th"></i></span>
                </div>
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">End Date</label>
              <div class="col-md-6">
               <div class="input-append date">
                    <input type="text" id="end_dt" name="end_dt" readonly="readonly" class="form-control"><span class="add-on"><i class="icon-th" style=""></i></span>
                </div>
              </div>
            </div>
            
            
             
            <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Contact</label>
              <div class="col-md-6">
                <textarea class="form-control" id="contact" name="contact" rows="3"></textarea>
              </div>
            </div>
             
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Description</label>
              <div class="col-md-6">
                <textarea class="form-control" id="contract_des" name="contract_des" rows="3"></textarea>
              </div>
            </div>
             
           
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Notes</label>
              <div class="col-md-6">
               <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
               <input type="hidden" id="rowkey" />
              	<div style="margin-top: 20px;">
                <button type="button" onclick="updatedata()" name="sub"  class="btn btn-primary"><i class='glyphicon glyphicon-saved'></i>Save</button>
                <button type="reset" onclick="cancelTab()" class="btn btn-default">Cancel</button>
                <span id="spin" style="position: absolute;"></span>
               </div>
              </div>
            </div>
            
		 </span>

	</p>
    </div>
    <!--End contract tab 1-->
     <!--start contract/client tab 2-->
    <div class="tab-pane" id="tab2">
    	<span id="success_client" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error_client" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
    	<p> 	
    	<div class="form-group">
              <label class="col-md-10 control-label" for="boostrapSelect">Client</label>
              <div class="col-md-5">
                <select class="advertise" id="nm_client">
                  
                 </select>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Account</label>
              <div class="col-md-5">
               <div id="acc"></div>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Product</label>
              <div class="col-md-5">
                <select class="advertise" id="nm_product">
                  
                 </select>
              </div>
               <label class="col-md-10 control-label" for="boostrapSelect">Account Manager</label>
              <div class="col-md-5">
                 <select class="advertise" id="acm">
                  
                 </select>
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Client Discount</label>
              <div class="col-md-5">
                
              <input type="text" name="nm_discount" id="nm_discount" value="" class="advertise" />
                 
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Account Discount</label>
              <div class="col-md-5">
                <input type="text" name="ac_discount" id="ac_discount" value="" class="advertise" />
              </div>
              
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="update_client()" name="sub"  class="btn btn-primary" ><i class='glyphicon glyphicon-saved'></i> Save</button>
                <button type="reset" onclick="cancelTab()" class="btn btn-default">Cancel</button>
                <span id="spin" style="position: absolute;"></span>
              </div>
            </div>  
    </p>
    </div>
   <!-- End contract/client tab2-->
   
   <!-- Start tab-3 Contract Lines-->
   
   <div class="tab-pane" id="tab3">
   	<span id="success_line" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error_line" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
         
    <p> <div id="line_table" class="table-responsive">
    <span id="line_msg"></span>
   <label style="top: 215px; position: absolute;" class="btn btn-sm btn-default" id="del_row1" type="button">
   </label>
		 <table id="line_contract" class="datatable table table-striped table-bordered">
        <thead>
        	
            <tr>
                <th><span class="pficon pficon-delete"></span>
               <!-- <input type="checkbox" id="selectall_1" value="0" >-->
              </th>
                <th>No.</th>
                <th>Platfrom</th>
                <th>Type</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            
        </thead>
 
        <tfoot>
        	
            <tr>
            	<th>
                <!--<input type="checkbox" value="0" id="selectall_e1">-->
               <a href="javascript:void(0)"> <span class="pficon pficon-delete"></span></a>
              </th>
                <th>No.</th>
                <th>Platfrom</th>
                <th>Type</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th><span id="total"></span></th>
                <th>Action</th>
            </tr>
        </tfoot>
 		<tbody>
       
        </tbody>
      </table>
      <br>
      <div class="form-group">
              <div class="col-md-10 col-md-offset-10">
                <button type="reset" onclick="cancelTab()" class="btn btn-default">Cancel</button>
              </div>
            </div>  
      </div>
    </p>
    </div>
   <!-- End tab3 Contract Lines-->
   
  
    </div>
    </div>
 	
 </div>
 <!--End client data edit tabs-->
 
 
          
         <!--Modal Delete-->
         
         <div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" onclick="location.reload(); " data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Change Contract Status</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="cid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to <label style="font-weight: bold" id="contract_st"></label> ? </label>
            
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="contractstatus" />
                <button type="button" onclick="change_status_contract()" name="sub"  class="btn btn-primary">Yes</button>
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
                  <h4 class="modal-title" id="myModalLabel">Delete contract(s)</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="uid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to delete all selected contracts from the list? There is NO undo!</label>
             
            
                         
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
       
        <!--Modal DeletecontrctLine-->
         
         <div class="modal fade" id="modalDelCnt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete contractLine(s)</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="uid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to delete all selected contractLines from the list? There is NO undo!</label>
             
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="deletedata_cnt()" name="sub"  class="btn btn-primary">Delete</button>
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
       <!-- End modal contrctLine -->
       
       
       <!--Modal edit contrctLine-->
         
         <div class="modal fade" id="modalEditCnt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Edit ContractLine No. <span id="e_line_no"></span></h4>
                </div>
                <div class="modal-body">
             <p>
             	<input type="hidden" name="cline_id" id="cline_id" />
             	<input type="hidden" name="e_all_tot" id="e_all_tot" />
             <div class="form-group">
              <label class="col-md-10 control-label" for="textInput">Platform</label>
             <div class="col-md-6">
               <select required="required" class="form-control" id="e_platform" name="client" >
               	  
                  
                </select>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Contract Line Type </label>
              <div class="col-md-6">
               <select required="required" class="form-control" id="e_type" name="client" >
               	  
                  
                </select>
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Start Time </label>
              <div class="col-md-6">
              	<div class="input-append date"  >
                <input id="e_start" name="e_start" value="" class="form-control" type="time">
               </div>
              </div>

			<label class="col-md-10 control-label" for="boostrapSelect">End Time </label>
             <div class="col-md-6">
             	<div class="input-append date"  >
                <input id="e_end" name="e_end" value="" class="form-control" type="time">
               </div>
              </div> 
              
              <label class="col-md-10 control-label" for="boostrapSelect">Duration </label>
              <div class="col-md-6">
                <input id="e_duration" name="e_duration" value="" class="form-control" type="text">
              </div>

			<label class="col-md-10 control-label" for="boostrapSelect">Rate </label>
             <div class="col-md-6">
                <input id="e_rate" name="e_rate" value="" class="form-control" type="text">
              </div> 
            <label class="col-md-10 control-label" for="boostrapSelect">Quantity </label>
             <div class="col-md-6">
                <input id="e_qnty" name="e_qnty" value="" class="form-control" type="text">
              </div> 
              <label class="col-md-10 control-label" for="boostrapSelect">Description </label>
             <div class="col-md-6">
               <textarea class="form-control" id="e_des" name="e_des" rows="3"></textarea>
              </div>             
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button id="sub_line" type="button" onclick="return update_contract_line()" name="sub"  class="btn btn-lg btn-success" ><i class='glyphicon glyphicon-saved'></i> Save</button>
                <span id="spin_line" class="spinner" style="position: absolute;"></span>
              </div>
            </div>      
          </p>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!-- End modal edit cntline -->
      
        
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
                   
                    <li><a href="<?php echo base_url();?>sales/manage_clients/<?php echo $nav;?>">Clients Data</a></li>
                   
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
                    <!--<li><a href="<?php echo base_url();?>traffic/add_contracts">Add Contracts</a></li>-->
                    <li class="active"><a href="<?php echo base_url();?>traffic/manage_contracts">Edit Contracts</a></li>
                    
                  </ul>
                </div>
              </div>
            </div>
            
             <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                    Delivery
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                   <!-- <li><a href="<?php echo base_url();?>traffic/add_contracts">Add Contracts</a></li>-->
                    <li><a href="<?php echo base_url();?>traffic/contract_lines">Contract Lines</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /col -->
      </div><!-- /row -->
    </div><!-- /container -->
   
<!--Modal Add contrctLine-->
         
         <div class="modal fade" id="modalInsertLine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Contract No. <span id="m_line_no"></span></h4>
                </div>
                <div class="modal-body">
             <p>
             	<input type="hidden" name="m_cline_id" id="m_cline_id" />
             <div class="form-group">
              <label class="col-md-10 control-label" for="textInput">Platform</label>
             <div class="col-md-6">
               <select required="required" class="form-control" id="m_platform" name="" >
               	  
                  
                </select>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Contract Line Type </label>
              <div class="col-md-6">
               <select required="required" class="form-control" id="m_type" name="client" >
               	  
                  
                </select>
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Start Time </label>
              <div class="col-md-6">
              	<div class="input-append date"  >
                <input id="m_start" name="m_start" value="" class="form-control" type="time">
               </div>
              </div>

			<label class="col-md-10 control-label" for="boostrapSelect">End Time </label>
             <div class="col-md-6">
             	<div class="input-append date"  >
                <input id="m_end" name="m_end" value="" class="form-control" type="time">
               </div>
              </div> 
              
              <label class="col-md-10 control-label" for="boostrapSelect">Duration </label>
              <div class="col-md-6">
                <input id="m_duration" name="m_duration" value="" class="form-control" type="text">
              </div>

			<label class="col-md-10 control-label" for="boostrapSelect">Rate </label>
             <div class="col-md-6">
                <input id="m_rate" name="m_rate" value="" class="form-control" type="text">
              </div> 
            <label class="col-md-10 control-label" for="boostrapSelect">Quantity </label>
             <div class="col-md-6">
                <input id="m_qnty" name="m_qnty" value="" class="form-control" type="text">
              </div> 
               <label class="col-md-10 control-label" for="boostrapSelect">Line Total </label>
             <div class="col-md-6">
                <input id="m_total" name="m_total" readonly="readonly" value="" class="form-control" type="text">
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Description </label>
             <div class="col-md-6">
               <textarea class="form-control" id="m_des" name="m_des" rows="3"></textarea>
              </div>             
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button id="sub_line_new" type="button" onclick="return insert_contract_line()" name="sub"  class="btn btn-lg btn-success" ><i class='glyphicon glyphicon-saved'></i> Save</button>
                <span id="spin_line_new" class="spinner" style="position: absolute;"></span>
              </div>
            </div>      
          </p>
                  
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>
       <!-- End modal Add cntline -->		
<script>
 $(document).ready(function() {
            
            //attach keypress to input
            $('#account,#m_duration,#m_rate,#m_qnty').keydown(function(event) {
                // Allow special chars + arrows 
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) 
                    || (event.keyCode >= 35 && event.keyCode <= 39)){
                        return;
                }else {
                    // If it's not a number stop the keypress
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
            });
            
            
        });
	$(document).ready(function() {
	 	
	 	if(tableView_json)
	 	{
	 		var userTable=tableView_json[0].table_order;
	 		if(userTable==null)
	 			table_val=[];	
	 		else
	 		{
	 			var table_val = userTable.split(',').map(Number);
	 			//console.log(table_val);
	 		}
	 	}
	 	else
	 		table_val=[];
          // Initialize Datatables
          var table = $('#contract_data').DataTable({
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
         	"pageLength": 20,
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
              "preserve": "<button class='btn-block' onclick='visible();'>Preserve</button>",
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
        
        
        // custom function DLP : Get selected datatable columns     
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
    var table="contracts_data";
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