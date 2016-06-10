<?php
if(($role_id!=3) && ($role_id!=2) && (!$nav))
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
		var client_data = <?php echo json_encode($result); ?>;
		var client_type_json =<?php echo json_encode($type); ?>;
		var products_json =<?php echo json_encode($products); ?>;
		var tableView_json = <?php echo json_encode($table_view);?> 
		var campaign_json =<?php echo json_encode($campaign); ?>;
		var audience_json =<?php echo json_encode($audience); ?>;
		var acctmanager_json =<?php echo json_encode($acctmanager); ?>;
		/*Displaying client types in table*/
		$(document).ready(function() {
		$('#wrapper').show();
		$('#edit_client,#success12,#error12,#del_row').hide();
		$('.selectpicker').selectpicker();
			var leng = client_data.length;
			var lengt = client_type_json.length;
			if(leng > 0){
				for(var j=0;j<leng;j++){
					var user_rid=client_data[j].client_type;
				
					var ids = client_data[j].client_id;
					var status= client_data[j].client_status;
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
					
				for(var k=0; k<lengt; k++)
				{
					if(user_rid == client_type_json[k].type_id)
					{
						$('#t11_'+ids).html(client_type_json[k].type_name);
					}
					if($('#t11_'+ids).is(':empty') ) {
						$('#t11_'+ids).html("<font style='font-style: italic;'>__</font>");
					}
				}
				
			}

			}

		});
		
	function modal_populate(id) {
		$('#wrapper').hide(500);
		$('#edit_client').show(1000);
		$('#client_det').html("Client  : "+client_data[id].name+" ("+client_data[id].client_id+")");
		$('#rowkey').val(id);
		$('#cid').val(client_data[id].client_id);
		$('#name').val(client_data[id].name);
		$('#email').val(client_data[id].email);
		$('#phone').val(client_data[id].phone);
		$('#mob').val(client_data[id].mobile);
		$('#adr1').val(client_data[id].physical_address_1);
		$('#adr2').val(client_data[id].physical_address_2);
		$('#adr3').val(client_data[id].physical_address_3);
		$('#padr1').val(client_data[id].post_address_1);
		$('#padr2').val(client_data[id].post_address_2);
		$('#padr3').val(client_data[id].post_address_3);
		$('#post').val(client_data[id].pcode);
		$('#discount').val(client_data[id].client_discount);
		
		
		var type=client_data[id].client_type;
		var acm=client_data[id].acct_manager;
		var product_list=client_data[id].product_id;
		var campaign_list=client_data[id].campaign_id;
		var audience_list=client_data[id].target_audience_id;
		
		var status=client_data[id].client_status;
		var txt="";
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
	
		//Client type select box
		var txt="";
		var key="";
		var val="";
		$('#type').empty();
		
		
		var len = client_type_json.length;
		 if(len > 0){
                  for(var i=0;i<len;i++){
		
		
			
    	if(client_type_json[i].type_id == type)
    	{
    		txt+="<option value='"+client_type_json[i].type_id +"'>"+client_type_json[i].type_name +"</option>";
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Choose client type</option>";
		}
		
		
		$("#type").append(txt);
	
		$.each(client_type_json,function(key,val) {
			
    	$('#type').append('<option value="'+ client_type_json[key].type_id + '">' + client_type_json[key].type_name + '</option>');
		});
		//End client type select box
		
		
		//Account manager select box
		var txt="";
		var key="";
		var val="";
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
		
		//Products select box
		var txt="";
		var key="";
		var val="";
		$('#product').empty();
		
		
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
		
		
		$("#product").append(txt);
	
		$.each(products_json,function(key,val) {
			
    	$('#product').append('<option value="'+ products_json[key].product_id + '">' + products_json[key].product_name + '</option>');
		});
		//Products select box
		
		
		//Campaign select box
		var txt="";
		var key="";
		var val="";
		$('#campaign').empty();
		
		
		var len = campaign_json.length;
		 if(len > 0){
                  for(var i=0;i<len;i++){
		
		
			
    	if(campaign_json[i].campaign_id == campaign_list)
    	{
    		txt+="<option value='"+campaign_json[i].campaign_id+"'>"+campaign_json[i].campaign_name +"</option>";
			
    	}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#campaign").append(txt);
	
		$.each(campaign_json,function(key,val) {
			
    	$('#campaign').append('<option value="'+ campaign_json[key].campaign_id + '">' + campaign_json[key].campaign_name + '</option>');
		});
		//Campaign select box
		
		//Target audience select box
		var txt="";
		var key="";
		var val="";
		var key1="";
		var val1="";
		$('#audience').empty();
		if(audience_list==null)
			aud_val=[];
		else
		{
			//console.log(client_data[id].target_audience_id);
			var aud_val = audience_list.split(':');
		}
		//console.log(audience_list);
		
		$.each(audience_json,function(key,val) {
			
    	$('#audience').append('<option value="'+ audience_json[key].target_audience_id + '">' + audience_json[key].target_audience + '</option>');
    		
    		if ($.inArray(audience_json[key].target_audience_id, aud_val) !== -1)
    		{
    			//console.log(aud_val);
    			$("#audience option[value='" + audience_json[key].target_audience_id + "']").prop("selected", true);
    		}
    		
		});
		
		$('#audience').selectpicker('refresh');
		//Target Audience select box

	}

	function modal_del_populate(id) {
		$("#deluser").hide();
		$('#rowkey').val(id);
		//$('#userstatus').val(status);
		$('#clientstatus').val(client_data[id].client_status);
		$('#cid').val(client_data[id].client_id);
		var name = client_data[id].name;
		var st=client_data[id].client_status;
		if(st==1)
		{
			$("#deluser").show();
			$("#deluser").html("&nbsp;deactivate&nbsp;" + name);
		}
		else
		{
			$("#deluser").show();
			$("#deluser").html("&nbsp;activate&nbsp;" + name);
		}
	}

	function updatedata() {
		$('#success12').html("Please wait...").show();
		var key = $('#rowkey').val();
		var location="<?php echo base_url();?>sales/client_update";
		$.ajax({
			type : "POST",
			url : location,
			data : {
				client_id : $('#cid').val(),
				name : $('#name').val(),
				email : $('#email').val(),
				phone : $('#phone').val(),
				mobile : $('#mob').val(),
				adr1 : $('#adr1').val(),
				adr2 : $('#adr2').val(),
				adr3 : $('#adr3').val(),
				padr1 : $('#padr1').val(),
				padr2 : $('#padr2').val(),
				padr3 : $('#padr3').val(),
				post : $('#post').val(),
				type_id : $('#type option:selected').val(),
				//acm: $('#acm option:selected').val(),
				discount: $('#discount').val(),
				sts : $('#sts:checked').val()

			}
		}).done(function(msg) {
			if (msg == 1) {
				client_data[key].client_id = $('#cid').val();
				var ad = $('#cid').val();
				var sts=$('#sts:checked').val();
				if(sts!=1)
					sts=2;
				client_data[key].name = $('#name').val();
				client_data[key].email = $('#email').val();
				client_data[key].phone = $('#phone').val();
				client_data[key].mob = $('#mob').val();
				client_data[key].physical_address_1= $('#adr1').val();
				client_data[key].physical_address_2 = $('#adr2').val();
				client_data[key].physical_address_3 = $('#adr3').val();
				client_data[key].post_address_1= $('#padr1').val();
				client_data[key].post_address_2 = $('#padr2').val();
				client_data[key].post_address_3 = $('#padr3').val();
				client_data[key].pcode = $('#post').val();
				client_data[key].client_type = $('#type option:selected').val();
				client_data[key].product_id = $('#product option:selected').val();
				client_data[key].acct_manager = $('#acm option:selected').val();
				client_data[key].client_discount = $('#discount').val();
				client_data[key].client_status = sts;
				$('#success12').html("Client data updated successfully").show();

				$('#t1_' + ad).html($('#cid').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t2_' + ad).html($('#name').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t3_' + ad).html($('#phone').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t4_' + ad).html($('#mob').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t5_' + ad).html($('#email').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t6_' + ad).html($('#adr1').val() + "<br>" + $('#adr2').val() + "<br>" + $('#adr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t7_' + ad).html($('#padr1').val() + "<br>" + $('#padr2').val() + "<br>" + $('#padr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t8_' + ad).html($('#post').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				
				var status= client_data[key].client_status;
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
				
				
				
				
				
				$('#t11_' + ad).html($('#type option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
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
	
	
	
	
	function update_advertiser() {
		$('#success_adv').html("Please wait...").show();
		var j=0;
		var x=document.getElementById("audience");
		aud=[];
  		for (var i = 0; i < x.options.length; i++) {
     	if(x.options[i].selected ==true){
        	aud[j++]=x.options[i].value;
      	}
  	}
		//console.log(aud);
		var key = $('#rowkey').val();
		var location="<?php echo base_url();?>sales/advertiser_update";
		$.ajax({
			type : "POST",
			url : location,
			data : {
				client_id : $('#cid').val(),
				product_id: $('#product option:selected').val(),
				campaign_id: $('#campaign option:selected').val(),
				audience: aud

			}
		}).done(function(msg) {
			if (msg == 1) {
				client_data[key].client_id = $('#cid').val();
				var ad = $('#cid').val();
				client_data[key].product_id = $('#product option:selected').val(),
				client_data[key].campaign_id = $('#campaign option:selected').val();
				upd_audience=$('#audience').val();
				if(upd_audience)
					upd_audience=$('#audience').val().join(":");
				client_data[key].target_audience_id = upd_audience;
				//console.log(upd_audience);
				
				
				$('#success_adv').html("Advertiser data updated successfully").show();

				$('#t1_' + ad).html($('#cid').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t2_' + ad).html($('#name').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t3_' + ad).html($('#phone').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t4_' + ad).html($('#mob').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t5_' + ad).html($('#email').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t6_' + ad).html($('#adr1').val() + "<br>" + $('#adr2').val() + "<br>" + $('#adr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t7_' + ad).html($('#padr1').val() + "<br>" + $('#padr2').val() + "<br>" + $('#padr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t8_' + ad).html($('#post').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t11_' + ad).html($('#type option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				setTimeout(function(){
   						$('#success_adv').fadeOut(500);
						}, 2500);

			}
			else{
				$('#success_adv').hide();
				$('#error_adv').html("No changes were made!").show();
				setTimeout(function(){
   						$('#error_adv').fadeOut(500);
						}, 2500);
			}
		});
	}
	
	
	function update_account() {
		$('#success_acc').html("Please wait...").show();
		
		//console.log(aud);
		var key = $('#rowkey').val();
		var location="<?php echo base_url();?>sales/account_update";
		$.ajax({
			type : "POST",
			url : location,
			data : {
				client_id : $('#cid').val(),
				acm: $('#acm option:selected').val()
			}
		}).done(function(msg) {
			if (msg == 1) {
				client_data[key].client_id = $('#cid').val();
				var ad = $('#cid').val();
				client_data[key].acct_manager = $('#acm option:selected').val(),
				
				//console.log(upd_audience);
				
				
				$('#success_acc').html("Account data updated successfully").show();

				$('#t1_' + ad).html($('#cid').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t2_' + ad).html($('#name').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t3_' + ad).html($('#phone').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t4_' + ad).html($('#mob').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t5_' + ad).html($('#email').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t6_' + ad).html($('#adr1').val() + "<br>" + $('#adr2').val() + "<br>" + $('#adr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t7_' + ad).html($('#padr1').val() + "<br>" + $('#padr2').val() + "<br>" + $('#padr3').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t8_' + ad).html($('#post').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#t11_' + ad).html($('#type option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				setTimeout(function(){
   						$('#success_acc').fadeOut(500);
						}, 2500);

			}
			else{
				$('#success_acc').hide();
				$('#error_acc').html("No changes were made!").show();
				setTimeout(function(){
   						$('#error_acc').fadeOut(500);
						}, 2500);
			}
		});
	}


	function change_status_client() {
		var location="<?php echo base_url();?>sales/client_change_status";
		var key = $('#rowkey').val();
		var status = $('#clientstatus').val();
		if(status==1)
			var ustatus=2;
		else
			var ustatus=1;
		$.ajax({
			type : "POST",
			url : location,
			data : {
				client_id : $('#cid').val(),
				status : status

			}

		}).done(function(msg) {
			if (msg == 1) {

				var ad = $('#cid').val();
				//var status = $('#userstatus').val();
				client_data[key].client_status = ustatus;
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
                 $('#del_row').fadeIn(100);
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
                 $('#del_row').fadeIn(100);
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
                 $('#del_row').fadeIn(100);
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
	var location="<?php echo base_url();?>sales/client_delete_selected";
	// event.preventDefault();
    var searchIDs = $(".datatable input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
  		var ad = searchIDs;
		var data = 'client_id=' + searchIDs;
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
		
		
				$('#del_row').hide();
				$('#modalDelall').modal('toggle');
				//$('#r1_' + ad).html("dleep");
				//$('#dis').show(500);
				//$('#dis').hide(1500).html("<span style='color: green; font-weight: bold;'>Updating  data..</span>");

	}
	});
	}
function cancelTab()
{
	$('#edit_client').hide();
	$('#wrapper').show(20);
	
}
function redir()
{
	window.location.href = "<?php echo base_url();?>sales/add_clients/<?php echo $nav;?>";
}		
</script>
  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>users/dashboard">Dashboard</a></li>
            <li><?php echo $title;?></li>
          </ol>
          <?php
          if($nav=="tfc") { 
          ?>
            <button class="btn btn-info" type="button" onclick="redir();" title="Add new contarct data">
			<i class="glyphicon glyphicon-plus"></i>
			Add Client
			</button>
          <hr>
          <?php }?>
           <span id="success_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-success"></span>
            <span id="warning_tbl" style="left: 35%; margin: 0 auto; position: absolute; top: 23px;" class="label label-warning"></span>
          <!--Start client table-->
          <div id="wrapper">
        <label style="top: 101px; position: absolute;" class="btn btn-sm btn-default" id="del_row" type="button">
		</label>
         <div class="table-responsive">
		 <table class="datatable table table-striped table-bordered">
        <thead>
        	
            <tr>
                <th>
                <input type="checkbox" id="selectall" >
              </th>
                <th>Client Id</th>
                <th>Client Name</th>
                <th>Tel. No</th>
                <th>Mob. No</th>
                <th>Email</th>
                <th>Physical address</th>
                <th>Postal address</th>
                <th>Post code</th>
                <th>Status</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            
        </thead>
 
        <tfoot>
        	
            <tr>
            	<th>
                <input type="checkbox" id="selectall_e">
              </th>
                <th>Client Id</th>
                <th>Client Name</th>
                <th>Tel. No</th>
                <th>Mob. No</th>
                <th>Email</th>
                <th>Physical address</th>
                <th>Postal address</th>
                <th>Post code</th>
                <th>Status</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </tfoot>
 
        <tbody>
        	<?php
         if($result)
		{
		 foreach ($result as $row=>$res)
		 {
			 $cid=$res['client_id'];
			 $client_status=$res['client_status'];
			 if($client_status==2)
			 {
			 	 ?> <tr style="font-style: ; color: #1569C7; " id="r1_<?php echo $cid; ?>"><?php
			 }
			 else {?>
				 <tr id="r1_<?php echo $cid; ?>">
				 	<?php
			 }
			 $stus=$res['client_status'];
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
			 ?>
		 
            
            	<td>
                <input type="checkbox" id="check[]"  value="<?php echo $res['client_id']; ?>" class="checkbox1" name="check[]">
              </td>
            	<td id="t1_<?php echo $cid; ?>"><?php echo $res['client_id']; ?></td>
                <td id="t2_<?php echo $cid; ?>"><?php echo $res['name']; ?></td>
                <td id="t3_<?php echo $cid; ?>"><?php echo $res['phone']; ?></td>
                <td id="t4_<?php echo $cid; ?>"><?php echo $res['mobile']; ?></td>
                <td id="t5_<?php echo $cid; ?>"><?php echo $res['email']; ?></td>
                <td id="t6_<?php echo $cid; ?>"><?php echo $res['physical_address_1'] . '<br>' . $res['physical_address_2'] . '<br>' . $res['physical_address_3']; ?></td>
                <td id="t7_<?php echo $cid; ?>"><?php echo $res['post_address_1'] . '<br>' . $res['post_address_2'] . '<br>' . $res['post_address_3']; ?></td>
                <td id="t8_<?php echo $cid; ?>"><?php echo $res['pcode']; ?></td>
                <td id="t10_<?php echo $cid; ?>">
               <!--
                <label onclick="modal_del_populate(<?php echo $row; ?>)" data-toggle="modal" data-target="#modalDel" title="Change status">
                               <?php echo $status; ?>
                               </label>-->
               
                </td>
                <td id="t11_<?php echo $cid; ?>"></td>
                <td>
                	<a class="edit ml10" href="javascript:void(0)" onclick="modal_populate(<?php echo $row; ?>)" title="Edit client data"><i class="glyphicon glyphicon-edit"></i></a>
                	<!--<a class="remove ml10" href="javascript:void(0)" onclick="modal_del_populate(<?php echo $row; ?>)" data-toggle="modal" data-target="#modalDel" title="Change status"><i class="glyphicon glyphicon-remove"></i></a>-->
                	</td>
               
            </tr>
            <?php } } ?>
        </tbody>
    </table>
	</div>
 </div>
 <!--End client table-->
 
 <!--Edit client data tabs-->
 <div id="edit_client">
 			<span class="label label-info" id="client_det"> </span>
 	<hr>	
 	    <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
    <li><a href="#tab2" data-toggle="tab">Advertiser</a></li>
    <li><a href="#tab3" data-toggle="tab">Account</a></li>
    <li><a href="#tab4" data-toggle="tab">Contact</a></li>
    <li><a href="#tab5" data-toggle="tab">History</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="tab1">
    <p>
    	<input type="hidden" id="cid" value="" />
    	 <span id="success12" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error12" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
<span class="form-horizontal">
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput">Client Name</label>
              <div class="col-md-6">
                <input id="name" name="name" required value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput2">Email Address</label>
              <div class="col-md-6">
                <input id="email" name="email" required value="" class="form-control" type="email">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput3">Tel. Number</label>
              <div class="col-md-6">
                <input id="phone" name="phone" value="" maxlength="15" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label" for="textInput3">Mob. Number</label>
              <div class="col-md-6">
                <input id="mob" name="mob"  value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Physical address 1</label>
              <div class="col-md-6">
                <input id="adr1" name="adr1" value="" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Postal address 1</label>
              <div class="col-md-6">
                <input id="padr1" name="padr1"  value="" class="form-control" type="text">
              </div>
            </div>
            
             
            <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Physical address 2</label>
              <div class="col-md-6">
                <input id="adr2" name="adr2" value="" class="form-control" type="text">
              </div>
            </div>
             
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Postal address 2</label>
              <div class="col-md-6">
                <input id="padr2" name="padr2" value="" class="form-control" type="text">
              </div>
            </div>
             
             
             
             <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Physical address 3</label>
              <div class="col-md-6">
                <input id="adr3" name="adr3"  value="" class="form-control" type="text">
              </div>
            </div>
              <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Postal address 3</label>
              <div class="col-md-6">
                <input id="padr3" name="padr3" value="" class="form-control" type="text">
              </div>
            </div>
          
             <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Post Code</label>
              <div class="col-md-6">
                <input id="post" name="post"  value="" class="form-control" type="text">
              </div>
            </div>
            
            
            
            
           
            <div class="form-group required">
              <label class="col-md-5 control-label" id="control-label" for="textInput4">Client Type</label>
              <div class="col-md-6">
                <select required="required" class="form-control" id="type" name="type" >
               	  
                  
                </select>
              </div>
            </div>
            
            
            <div class="form-group required">
              <label class="col-md-5 control-label" for="textInput4">Client Status</label>
              <div class="col-md-3">
                <div id="status1"></div>
              </div>
            </div>
            
            
            <div class="form-group required">
              <label class="col-md-5 control-label" for="textInput4">Client Discount</label>
              <div class="col-md-6">
                <input id="discount" name="discount" maxlength="5"  value="" class="form-control" type="text">
              </div>
            </div>
            
                  
            <div class="form-group">
              <div class="col-md-10 col-md-offset-8">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="updatedata()" name="sub"  class="btn btn-primary">Save</button>
                <button type="reset" onclick="cancelTab()" class="btn btn-default">Cancel</button>
                <span id="spin" style="position: absolute;"></span>
              </div>
            </div>
		  
		 </span>

	</p>
    </div>
    <!--End tab 1-->
    <!--Start Tab 2-->
    <div class="tab-pane" id="tab2">
    	<span id="success_adv" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error_adv" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
    <p> 	<div class="form-group">
              <label class="col-md-10 control-label" for="boostrapSelect">Product</label>
              <div class="col-md-5">
                <select class="advertise" id="product">
                  
                 </select>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Campaign</label>
              <div class="col-md-5">
                <select class="advertise"  id="campaign">
                 
                </select>
              </div>
               <label class="col-md-10 control-label" for="boostrapSelect">Target Audience</label>
              <div class="col-md-5">
                <select class="selectpicker" name="audience[]" multiple data-selected-text-format="count>3"  id="audience">
                
                </select>
              </div>
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="update_advertiser()" name="sub"  class="btn btn-primary">Save</button>
                <button type="reset" onclick="cancelTab()" class="btn btn-default">Cancel</button>
                <span id="spin" style="position: absolute;"></span>
              </div>
            </div>  
    </p>
    </div>
   <!-- End tab Advertiser2-->
   
   <!-- Start tab-3 Account-->
   
   <div class="tab-pane" id="tab3">
   	<span id="success_acc" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error_acc" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
    <p><div class="form-group">
              <label class="col-md-10 control-label" for="boostrapSelect">Account manager</label>
              <div class="col-md-10">
                <select class="advertise" id="acm">
                  
                 </select>
              </div>
             
        
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button type="button" onclick="update_account()" name="sub"  class="btn btn-primary">Save</button>
                <button type="reset" onclick="cancelTab()" class="btn btn-default">Cancel</button>
                <span id="spin" style="position: absolute;"></span>
              </div>
            </div>  
    </p>
    </div>
   <!-- End tab3-->
   
   <div class="tab-pane" id="tab4">
    <p>Howdy, I'm in Section 4.</p>
    </div>
   <!-- End tab4-->
   
   <div class="tab-pane" id="tab5">
    <p>Howdy, I'm in Section 5.</p>
    </div>
   <!-- End tab5-->
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
                  <h4 class="modal-title" id="myModalLabel">Change Client Status</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="cid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to <label style="font-weight: bold" id="deluser"></label> ? </label>
            
            
                         
            <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
              	<input type="hidden" id="rowkey" />
              	<input type="hidden" id="clientstatus" />
                <button type="button" onclick="change_status_client()" name="sub"  class="btn btn-primary">Yes</button>
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
                  <h4 class="modal-title" id="myModalLabel">Delete client(s)</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="uid" value="" />
            <span class="form-horizontal">
            
              <label class="col-md-14 control-label">Are you sure you want to delete all selected clients from the list? There is NO undo!</label>
             
            
                         
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
                   <!-- <li><a href="<?php echo base_url();?>sales/add_clients/<?php echo $nav;?>">Add Data</a></li>-->
					<?php
					}
				    ?>
                    <li class="active"><a href="<?php echo base_url();?>sales/manage_clients/<?php echo $nav;?>">Clients Data</a></li>
                    
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
          // Initialize Datatables
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
    var table="client_data";
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
        
        
        
        
        
 //Validation
$('#mob').blur(function (e) {
	var a=$('#mob').val();
 var filter = /^[0-9-+]+$/;
	    if (filter.test(a)) {
	        return true;
    }
	    else {
	    	$('#mob').val("");
	        alert('Invalid mobile number');
	    }
});
$('#phone').blur(function (e) {
	var a=$('#phone').val();
 var filter = /^[0-9-+]+$/;
	    if (filter.test(a)) {
	        return true;
    }
	    else {
	    	$('#phone').val("");
	        alert('Invalid phone number');
	    }
});
$('#post').blur(function (e) {
	var a=$('#post').val();
 var filter = /^[0-9-+]+$/;
	    if (filter.test(a)) {
	        return true;
    }
	    else {
	    	$('#post').val("");
	        alert('Invalid postal code');
	    }
});
$('#discount').blur(function (e) {
	var a=$('#discount').val();
 var filter = /^[0-9-+]+$/;
	    if (filter.test(a)) {
	        return true;
    }
	    else {
	    	$('#discount').val("");
	        alert('Invalid number');
	    }
});
//Validation ends
</script>