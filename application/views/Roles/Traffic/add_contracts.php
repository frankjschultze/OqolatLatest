<?php $this -> load -> helper('url');
if (($role_id != 3) && ($role_id != 2) && (!$nav)) {
	header("location:" . base_url() . "home/logout");
	exit();
}
?>
<script>
	var platform_json =<?php echo json_encode($platform); ?>;
	var len_pfm = platform_json.length;
	var type_json =<?php echo json_encode($type); ?>;
	var linetype_json =type_json;
	var len_type = type_json.length;
	var clients_json = <?php echo json_encode($clients); ?>;
	var len_clients = clients_json.length;
	var contract_json = <?php echo json_encode($contracts); ?>;
	var len_contract = contract_json.length;
	var products_json = <?php echo json_encode($products);?>;
	var acctmanager_json = <?php echo json_encode($acctmanager);?>;
	var tbl=true;
	var no=1;
	var lineTotal=0;
$(document).ready(function() {
	$('#line_sub, #head_contract, #line_table,#spin_line,#spin_line_new,#success_line_new,#error_line_new,#m_spin_line,#m_success_line,#m_error_line,#del_row1,#act_dis').hide();
$('#start_dt, #end_dt').datepicker({format: 'dd-mm-yyyy'}).on('changeDate', function(e){
$(this).datepicker('hide');
});
	//Contracts list select box
	var txt="";
	var key="";
	var val="";
	var new_no="";
	$('#line_cno').empty();

	var len_contracts = contract_json.length;
	$('#line_cno').append('<option value="">Choose Contract</option>');
	if(len_contract > 0){
	$.each(contract_json,function(key,val) {

	$('#line_cno').append('<option value="'+ contract_json[key].id + '">' + contract_json[key].contract_no + '</option>');
	new_no= parseFloat(contract_json[key].id);
	});
	}
	else
	new_no =parseFloat(new_no);
	new_no=(new_no+1001);
	if(!new_no)
	new_no=1000;
	//console.log(new_no);
	$('#contract_no').val(new_no).css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"});
	//$('#new_no').html(new_no);
	//$('#line_contract').val(new_no);
	//End contracts list select box
	$('#line_cno').on('change', function(e){
	$('#line_sub').show();
	})

	//Platform list select box
	var txt="";
	var key="";
	var val="";
	$('#line_platform').empty();

	var len_pfm = platform_json.length;
	$('#line_platform').append('<option value="">Choose Platform</option>');
	if(len_pfm > 0){
	$.each(platform_json,function(key,val) {

	$('#line_platform').append('<option value="'+ platform_json[key].id + '">' + platform_json[key].name + '</option>');
	});
	}

	//End Platform list select box

	//Contract Type list select box
	var txt="";
	var key="";
	var val="";
	$('#line_type').empty();

	var len_type = type_json.length;
	$('#line_type').append('<option value="">Choose Type</option>');
	if(len_type > 0){
	$.each(type_json,function(key,val) {

	$('#line_type').append('<option value="'+ type_json[key].id + '">' + type_json[key].name + '</option>');
	});
	}
	});
	
	
	function modal_line_populate()
	{
		$('#e_start').val('');
		$('#e_end').val('');
		$('#e_duration').val('');
		$('#e_rate').val('');
		$('#e_des').val('');
		$('#e_qnty').val('');
		$('#e_total').val('');
		$('#sub_line_new').show();
		$('#spin_line_new').hide();
		var cno= $('#cno_new').val();
		contract_id=cno;
		//console.log(contract_id);
		$('#cline_id').val(contract_id);
		$('#e_line_no').html(parseFloat(cno)+1000);
		
		//Platform list select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#e_platform').empty();
		
		
		var len = platform_json.length;
		
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
		 
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#e_type").append(txt);
	
		$.each(linetype_json,function(key,val) {
			
    	$('#e_type').append('<option value="'+ linetype_json[key].id + '">' + linetype_json[key].name + '</option>');
		});
		
			
		//End Contract line type select box	
		
	}
	$(function() {  //  In jQuery 1.6+ this is same as $(document).ready(function(){})
	quan="";
	pric="";
	$('#e_qnty, #e_rate')  //  jQuery CSS selector grabs elements with the ID's "quantity" & "item_price"
	.on('keyup', function(e) {  //  jQuery 1.6+ replcement for .live (dynamically asigns event, see jQuery API)
//  in this case, our event is "change" which works on inputs and selects to let us know when a value is changed
//  below i use inline if statements to assure the values i get are "Real"
	var quan = $("#e_qnty").val() != "" ? parseFloat($("#e_qnty").val()) : 1,  //  Get quantity value
	pric = $("#e_rate").val() != "" ? parseFloat($("#e_rate").val()) : 0;  //  Get price value
	$('#e_total').val(pric*quan).css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"}); // show total
	});
	});
	function insert_contract_line()
	{
		line_platform = $('#e_platform option:selected').val();
		line_type = $('#e_type option:selected').val();
		if(!line_platform || !line_type)
		{
			alert('Please select Platform and Line Type');
			return false;
		}
		$('#sub_line_new').hide();
		$('#spin_line_new').show();
		txt="";
		var location="<?php echo base_url();?>traffic/insert_new_contract_line";
		var cno= $('#cline_id').val();
		$.ajax({
			type : "POST",
			url : location,
			data : {
				line_cno : $('#cline_id').val(),
				line_platform : $('#e_platform option:selected').val(),
				line_type : $('#e_type option:selected').val(),
				linestart_dt : $('#e_start').val(),
				lineend_dt : $('#e_end').val(),
				line_duration : $('#e_duration').val(),
				line_rate : $('#e_rate').val(),
				description : $('#e_des').val(),
				line_qnty : $('#e_qnty').val(),
				line_total : $('#e_total').val()

			}
		}).done(function(msg) {
			if (msg) 
			{
				//Add new row 
				//console.log(msg);
				var tot=$('#e_total').val();
				//txt+='<tr class="line_cnt" id="r1_'+ contract_line[key].id + '"><td id="c_'+ contract_line[key].id + '"><input type="checkbox" id="check[]"  value="'+ contract_line[key].id + '" class="checkbox" name="check[]">';
				txt+='<tr class="line_cnt" id="r1_'+ msg + '"><td id="c_'+ msg + '"><input type="checkbox" id="check[]"  value="'+ msg + '" class="checkbox" name="check[]">';
				txt+='<td id="c1_'+ msg + '"> '+ no +'</td>';
				txt+='<td id="c2_'+ msg + '">' + $('#e_platform option:selected').text() + '</td>';
				txt+='<td id="c3_'+ msg + '">' + $('#e_type option:selected').text() + '</td>';
				txt+='<td id="c4_'+ msg + '">' + $('#e_start').val() + '</td>';
				txt+='<td id="c5_'+ msg + '">' + $('#e_end').val() + '</td>';
				txt+='<td id="c6_'+ msg + '">' + $('#e_des').val() + '</td>';
				txt+='<td id="c7_'+ msg + '">' + $('#e_duration').val() + '</td>';
				txt+='<td id="c8_'+ msg + '">' + $('#e_rate').val() + '</td>';
				txt+='<td id="c11_'+ msg + '">'+$('#e_qnty').val() + '</td>';
				txt+='<td id="c9_'+ msg + '">' + $('#e_total').val() + '</td>';
				txt+='<td id="c10_'+ msg + '"><a href="javascript:void(0)"';
				txt+= 'onclick="modal_edit_populate('+msg+','+line_platform+','+line_type+', \''+cno+'\')" data-toggle="modal" data-target="#modalEditLine" title="Edit ContractLine"><i class="glyphicon glyphicon-edit"></i></a></td></tr>';
				no+=1
				$("#line_view").append(txt).removeClass("hidden");
				
				if(!tot)
					tot=0;
				lineTotal+=parseFloat(tot);
				$('#total').html('<label class="label label-primary">Total<span class="badge" style="background: #FFF; color: #1cace9;">'+lineTotal+'</span></label>');
				setTimeout(function(){
						$('#success_line_new').html("Data updated successfully").show();
						$('#modalEditCnt').modal('toggle');
   						$('#success_line_new').fadeOut(4500);
   						$('#spin_line_new').hide();
						}, 500);
			}
			else
			{
				
				setTimeout(function(){
						$('#modalEditCnt').modal('toggle');
						$('#error_line_new').html("Insertion failed!").show();
						$('#error_line_new').fadeOut(4500);
						$('#spin_line_new').hide();
						}, 500);
						
				
			}
			delLine();
			

		});
	}
	
	function modal_edit_populate(lid, pid, ltype, cno)
	{
		$('#m_sub_line').show();
		$('#m_spin_line').hide();
		$('#m_line_no').html(parseFloat(cno)+1000);
		
		//Platform list select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#m_platform').empty();
		
		
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
		
		
		$("#m_platform").append(txt).removeClass("hidden");
	
		$.each(platform_json,function(key,val) {
			
    	$('#m_platform').append('<option value="'+ platform_json[key].id + '">' + platform_json[key].name + '</option>');
		});
		
			
		//End Platform list select box	
		
		//contract line type select box
		var txt="";
		var key="";
		var val="";
		var quan="";
		var pric="";
		len="";
		$('#m_type').empty();
		
		
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
		
		
		$("#m_type").append(txt);
	
		$.each(linetype_json,function(key,val) {
			
    	$('#m_type').append('<option value="'+ linetype_json[key].id + '">' + linetype_json[key].name + '</option>');
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
				$('#m_cline_id').val(contract_line[0].id);
				$('#m_start').val(contract_line[0].start_time);
				$('#m_end').val(contract_line[0].end_time);
				$('#m_duration').val(contract_line[0].duration);
				$('#m_rate').val(contract_line[0].rate);
				$('#m_des').text(contract_line[0].description);
				$('#m_qnty').val(contract_line[0].quantity);
				$('#m_all_tot').val(contract_line[0].line_total);
			}
		});
		//End Contract line type select box	
		
	}
	function update_line()
	{
		$('#m_sub_line').hide();
		$('#m_spin_line').show();
		current_tot=$('#m_all_tot').val();
		var location="<?php echo base_url();?>traffic/update_contract_line";
		var lid= $('#m_cline_id').val();
		$.ajax({
			type : "POST",
			url : location,
			data : {
				line_id : $('#m_cline_id').val(),
				pid : $('#m_platform option:selected').val(),
				type : $('#m_type option:selected').val(),
				start : $('#m_start').val(),
				end : $('#m_end').val(),
				dur : $('#m_duration').val(),
				rate : $('#m_rate').val(),
				des : $('#m_des').val(),
				qnty : $('#m_qnty').val()

			}
		}).done(function(msg) {
			if (msg) 
			{
				quan = $("#m_qnty").val() != "" ? parseFloat($("#m_qnty").val()) : 1,  //  Get quantity value
				pric = $("#m_rate").val() != "" ? parseFloat($("#m_rate").val()) : 0;  //  Get price value
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
				
				$('#c2_' + lid).html($('#m_platform option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c3_' + lid).html($('#m_type option:selected').text()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c4_' + lid).html($('#m_start').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c5_' + lid).html($('#m_end').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c6_' + lid).html($('#m_des').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c7_' + lid).html($('#m_duration').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c8_' + lid).html($('#m_rate').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c9_' + lid).html(line_total).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				$('#c11_' + lid).html($('#m_qnty').val()).css({
					"font-weight" : "bold",
					"color" : "#333"
				});
				
				setTimeout(function(){
						$('#m_success_line').html("Data updated successfully").show();
						$('#modalEditLine').modal('toggle');
   						$('#m_success_line').fadeOut(4500);
   						$('#m_spin_line').hide();
						}, 500);
			}
			else
			{
				
				setTimeout(function(){
					$('#modalEditLine').modal('toggle');
						$('#m_error_line').html("No changes were made!").show();
						$('#m_error_line').fadeOut(4500);
						$('#m_spin_line').hide();
						}, 500);
						
				
			}
		});
	}
	function deletedata_cnt() {
		del_tot=0;
	var location="<?php echo base_url();?>traffic/contractline_delete_update_total";
	// event.preventDefault();
    var searchIDs = $("#line_view input:checkbox:checked").map(function(){
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
			if (msg) {
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

	}
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
//Client Tab- Clients, Account listing
$(document).ready(function() {
var txt="";
var key="";
var val="";
$('#nm_client').empty();

var len_clients = clients_json.length;
$('#nm_client').append('<option value="">Choose client</option>');
if(len_clients > 0){
$.each(clients_json,function(key,val) {
$('#nm_client').append('<option value="'+ clients_json[key].client_id + '">' + clients_json[key].name + '</option>');
});
}

$('#nm_client').on('change', function(e) {
var client_id =$(this).val();
var txt="";
var location="<?php echo base_url(); ?>traffic/get_client_type";
	$.ajax({
	dataType : "JSON",
	type : "POST",
	url : location,
	data : {
	client_id : client_id
	}
	}).done(function(msg){
	if(msg) {
		$('#act_dis,#acc').show();
	var client_type_json=msg;
	if(client_type_json[0].type_id==3)
	{
	$('#acc').html("<input id='account1'  name='nm_account' type='hidden' value='"+client_type_json[0].type_id+"'><input id='acnt' readonly='readonly' name='acnt' value='"+client_type_json[0].type_name+"' class='advertise' type='text'>");
	$('#acc input').css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"});
	//$('#account').val(client_type_json[0].type_name);
	}
	else if(client_type_json[0].type_id==1)
	{
	txt="";
	txt+="<select name='nm_account' class='advertise' id='account1'>";
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
	//Products select box
		var txt="";
		var key="";
		var val="";
		len="";
		$('#nm_product').empty();
		
		var len = products_json.length;
		 if(len > 0){
         	for(var i=0;i<len;i++){
    		if(products_json[i].product_id == client_type_json[0].product_id)
    		{
    			txt+="<option value='"+products_json[i].product_id+"'>"+products_json[i].product_name +"</option>";
    		}
		}
		}
		if(txt=="")
		{
			txt+="<option value=''>Change product</option>";
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
		
    	if(acctmanager_json[i].acct_manager_id == client_type_json[0].acct_manager)
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
		$("#nm_discount").val(client_type_json[0].client_discount);
		
		//End discount text box
		//End Clients Tab
	}
	else
	{
	$('#acc').html("--");
	}
	});
	});
});
//End Client Tab Account Listing  
function redir()
{
	window.location.href = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
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
	webshims.setOptions('forms-ext', {
		types : 'date'
	});
	webshims.polyfill('forms forms-ext'); 
</script>
<div class="container-fluid">

	<div class="row">

		<div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>users/dashboard">Dashboard</a>
				</li>
				<li>
					Add contracts
				</li>
			</ol>
			<hr>
			<button class="btn btn-info" type="button" onclick="redir();" title="Back To Contracts data View">
				<i class="glyphicon glyphicon-step-backward"></i>
				Back
			</button>
			<hr>
			<!--*****************  Sales data ********************-->

			<div class="tabbable">
				<!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
					<li id="active"><a href="#tab2" data-toggle="tab">Client</a></li>
					<li><a href="#tab3" data-toggle="tab">Contract Lines</a></li>
				</ul>
				<span id="success" style="left: 35%; margin: 0 auto; position: absolute; top: ;" class="label label-success"></span>
				<span id="error_msg" style="left: 35%; margin: 0 auto; position: absolute; top:;" class="label label-warning"></span>
				<div class="tab-content" style="margin-top: 20px;">
					
					<!-- Start tab-1 Add Contracts-->
					
					<div class="tab-pane active" id="tab1">
					<form name="f1" id="contractform" method="post">	
					
								<span class="form-horizontal">
									<div class="form-group required">
										<label class="col-md-5 control-label" id="control-label" for="textInput">Contract No.</label>
										<div class="col-md-6">
											<input id="contract_no" name="contract_no" required value="" class="form-control" type="text">
										</div>
									</div>
									
									<div class="form-group required">
										<label class="col-md-5 control-label" for="textInput3">Order No.</label>
										<div class="col-md-6">
											<input id="order_no" name="order_no"  value="" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group required">
										<label class="col-md-5 control-label"  for="textInput4">Start Date</label>
										<div class="col-md-6">
											<div class="input-append date"  >
												<input type="text" id="start_dt" name="start_dt" readonly="readonly" class="form-control">
												<span class="add-on"><i class="icon-th"></i></span>
											</div>
										</div>
									</div>
									<div class="form-group required">
										<label class="col-md-5 control-label"  for="textInput4">End Date</label>
										<div class="col-md-6">
											<div class="input-append date"  >
												<input type="text" id="end_dt" name="end_dt" readonly="readonly" class="form-control">
												<span class="add-on"><i class="icon-th" style=""></i></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" for="textInput4">Discount</label>
										<div class="col-md-6">
											<input id="discount" name="discount" value="" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" for="textInput4">Account Discount</label>
										<div class="col-md-6">
											<input id="acct_discount" name="acct_discount" value="" class="form-control" type="text">
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
               

											<div class="contract_sub" style="margin-top: 15px;">
												<button id="next" href="#tab2" data-toggle="tab" type="button" name="sub"  class="btn btn-default">
												Next <i class="glyphicon glyphicon-forward"></i>
												</button>
												
												<span id="spin" style="position: absolute;"></span>
											</div>
										</div>

									</div> </span>
							
						
					</div>
					<!-- End tab-1 Add clients-->
					<!-- Start tab-2 Clients-->
		<div class="tab-pane" id="tab2">
		
    	<div class="form-group required">
             
              <label class="col-md-10 control-label" id="control-label" for="boostrapSelect">Client</label>
              <div class="col-md-5">
                <select class="advertise" required="required" name="nm_client" id="nm_client">
             
                 </select>
              </div>
             
              <label id="act_dis" class="col-md-10 control-label" for="boostrapSelect">Account</label>
              <div class="col-md-5">
              	
               <div id="acc"></div>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Product</label>
              <div class="col-md-5">
                <select class="advertise" id="nm_product" name="nm_product">
                  
                 </select>
              </div>
               <label class="col-md-10 control-label" for="boostrapSelect">Account Manager</label>
              <div class="col-md-5">
                 <select class="advertise" id="acm" name="nm_acm">
                  
                 </select>
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Client Discount</label>
              <div class="col-md-5">
                
              <input type="text" name="nm_discount" id="nm_discount" value="" class="advertise" />
                 
              </div>
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
              	<button id="prev" href="#tab1" data-toggle="tab" type="button" name="sub"  class="btn btn-default">
				Prev <i class="glyphicon glyphicon-backward"></i>
				</button>
                <button type="submit" name="sub"  class="btn btn-primary">
				<i class="glyphicon glyphicon-saved"></i>Save</button>
				
				<span id="spin" style="position: absolute;"></span>
              </div>
          </div>  
          
    
    </form>
	</div>
	
					<!-- End tab-2 Clients-->
					<!-- Start tab-3 Contract Lines-->
					<div class="tab-pane" id="tab3">
						
							<div id="head_contract">
								
								<span class="label label-success" id=""><i class="glyphicon glyphicon-eye-open"></i>Active Contract No.<label id="new_no"></label></span>
								<button class="btn btn-sm btn-info" type="button" id="add_line" onclick="modal_line_populate()" data-toggle="modal" data-target="#modalEditCnt" title="Add new Line">
								<i class="glyphicon glyphicon-plus"></i>
								New Line
								</button>
								<span id="success_contractline" style="left: 35%; margin: 0 auto; position: absolute; top: " class="label label-success"></span>
								<span id="error_contractline" style="left: 35%; margin: 0 auto; position: absolute; top: " class="label label-warning"></span>
								<span id="spin_line" class="label label-warning" style="left: 35%; margin: 0 auto; position: absolute; top: "></span>
								<span id="success_line_new" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: ;" class="label label-success"></span>
    	 						<span id="error_line_new" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: ;" class="label label-warning"></span>
								<span id="m_success_line" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: ;" class="label label-success"></span>
    	 						<span id="m_error_line" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: ;" class="label label-warning"></span>
								<hr>
							</div>
							<label style="top: 225px; position: absolute;" class="btn btn-sm btn-default" id="del_row1" type="button">
							</label>
						
							<form name="f2" id="contractlineform" method="post">
								
								<div id="head_cno" style="margin-left: 6%">

									<label  id="control-label"  for="textInput1">Contract No.&emsp;&emsp;&emsp;&nbsp;</label>
									<select class="advertise" style="width: 17%; display: inline-block;" id="line_cno" name="line_cno" ></select>

								</div>
								<input type="hidden" name="line_contract" id="line_contract" />
								<input type="hidden" name="cno_new" id="cno_new" />
								<span class="form-horizontal">
									<div class="form-group required">
										<label class="col-md-5 control-label" id="control-label" for="textInput2">Platform</label>
										<div class="col-md-6">
											<select required="required" class="form-control" id="line_platform" name="line_platform" ></select>
										</div>
									</div>
									<div class="form-group required">
										<label class="col-md-5 control-label" id="control-label"  for="textInput3">Type</label>
										<div class="col-md-6">
											<select required="required" class="form-control" id="line_type" name="line_type" ></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" for="textInput4">Rate</label>
										<div class="col-md-6">
											<input id="line_rate" name="line_rate" value="" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" for="textInput4">Quantity</label>
										<div class="col-md-6">
											<input id="line_qnty" name="line_qnty" value="" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group required">
										<label class="col-md-5 control-label"  for="textInput4">Start Time</label>
										<div class="col-md-6">
											<div class="input-append date"  >
												<input class="form-control" type="time" id="linestart_dt" name="linestart_dt"  >
											</div>
										</div>
									</div>
									<div class="form-group required">
										<label class="col-md-5 control-label"  for="textInput4">End Time</label>
										<div class="col-md-6">
											<div class="input-append date"  >
												<input class="form-control" type="time" id="lineend_dt" name="lineend_dt">
											</div>
										</div>
									</div>
									<div class="form-group required">
										<label class="col-md-5 control-label"  for="textInput4">Description</label>
										<div class="col-md-6">
											<textarea class="form-control" id="line_des" name="line_des" rows="3"></textarea>
											<input type="hidden" id="rowkey" />
											<div class="contract_sub" id="line_sub" style="margin-top: 25px;">
												<button type="submit" name="sub1" id="sub_once"  class="btn btn-primary">
													<i class="glyphicon glyphicon-saved"></i> Save
												</button>
												<button type="reset" class="btn btn-default">
													Cancel
												</button>
												<span id="spin_contractline" style="position: absolute;"></span>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" for="textInput4">Duration</label>
										<div class="col-md-6">
											<input id="line_duration" name="line_duration" value="" class="form-control" type="text">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" for="textInput4">Line Total</label>
										<div class="col-md-6">
											<input id="line_total" readonly="readonly" name="line_total" value="" class="form-control" type="text">

										</div>
									</div> </span>
							</form>
								
							<div id="line_table" class="table-responsive">
								<table id="line_view" class="datatable table table-striped table-bordered">
									<thead>

										<tr>
											<th><span class="pficon pficon-delete"></span><!-- <input type="checkbox" id="selectall_1" value="0" >--></th>
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
											<th><!--<input type="checkbox" value="0" id="selectall_e1">--><a href="javascript:void(0)"> <span class="pficon pficon-delete"></span></a></th>
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
										<button type="reset" onclick="cancelLine()" class="btn btn-default">
											Cancel
										</button>
									</div>
								</div>
							</div>
						
					</div>
					<!-- End tab-2 Contract Lines-->

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
						<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" > Clients </a></h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								
								<li>
									<a href="<?php echo base_url(); ?>sales/manage_clients/<?php echo $nav; ?>">Clients Data</a>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" > Contracts </a></h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse in">
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<!--<li><a href="<?php echo base_url(); ?>traffic/add_contracts">Add Contracts</a></li>-->
								<li class="active">
									<a href="<?php echo base_url(); ?>traffic/manage_contracts">Edit Contracts</a>
								</li>

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
         
         <div class="modal fade" id="modalEditCnt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Contract No. <span id="e_line_no"></span></h4>
                </div>
                <div class="modal-body">
             <p>
             	<input type="hidden" name="cline_id" id="cline_id" />
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
               <label class="col-md-10 control-label" for="boostrapSelect">Line Total </label>
             <div class="col-md-6">
                <input id="e_total" name="e_total" readonly="readonly" value="" class="form-control" type="text">
              </div>
              <label class="col-md-10 control-label" for="boostrapSelect">Description </label>
             <div class="col-md-6">
               <textarea class="form-control" id="e_des" name="e_des" rows="3"></textarea>
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
       
       
       <!--Modal edit contrctLine-->
         
         <div class="modal fade" id="modalEditLine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Edit ContractLine No. <span id="m_line_no"></span></h4>
                </div>
                <div class="modal-body">
             <p>
             	<input type="hidden" name="m_cline_id" id="m_cline_id" />
             	<input type="hidden" name="m_all_tot" id="m_all_tot" />
             <div class="form-group">
              <label class="col-md-10 control-label" for="textInput">Platform</label>
             <div class="col-md-6">
               <select required="required" class="form-control" id="m_platform" name="client" >
               	  
                  
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
              <label class="col-md-10 control-label" for="boostrapSelect">Description </label>
             <div class="col-md-6">
               <textarea class="form-control" id="m_des" name="m_des" rows="3"></textarea>
              </div>             
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button id="m_sub_line" type="button" onclick="return update_line()" name="m_sub"  class="btn btn-lg btn-success" ><i class='glyphicon glyphicon-saved'></i> Update</button>
                <span id="m_spin_line" class="spinner" style="position: absolute;"></span>
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

<script>
	$('#success').hide();
$('#spin').hide();

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
$(document).ready(function() {

//attach keypress to input
$('#account, #line_duration, #line_rate, #line_qnty,#e_duration,#e_rate,#e_qnty').on('keydown',function(event) {
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
//Validation ends
//Line total calculation
$(function() {  //  In jQuery 1.6+ this is same as $(document).ready(function(){})
$('#line_qnty, #line_rate')  //  jQuery CSS selector grabs elements with the ID's "quantity" & "item_price"
.on('keyup', function(e) {  //  jQuery 1.6+ replcement for .live (dynamically asigns event, see jQuery API)
//  in this case, our event is "change" which works on inputs and selects to let us know when a value is changed
//  below i use inline if statements to assure the values i get are "Real"
var quan = $("#line_qnty").val() != "" ? parseFloat($("#line_qnty").val()) : 1,  //  Get quantity value
pric = $("#line_rate").val() != "" ? parseFloat($("#line_rate").val()) : 0;  //  Get price value
$('#line_total').val(pric*quan).css({"color": "#fff", "font-weight" : "bold", "background": "#a2d246"}); // show total
});
});

$(document).ready(function () {
$( "#contractform").submit(function( event ) {
// Stop form from submitting normally
event.preventDefault();
var cnrt_no= $('#contract_no').val();
var new_no="";
//console.log(cnrt_no);
$('#spin').html("Please wait..").show();
// Get some values from elements on the page:
var location="<?php echo base_url(); ?>traffic/create_contract";
	$.ajax({
	type : "POST",
	url : location,
	//data : $("#contractform").serialize(),$('#account').val()
	data:
	{
		contract_no : $('#contract_no').val(),
		nm_client : $('#nm_client').val(),
		account : $('#account1').val(),
		order_no : $('#order_no').val(),
		contact : $('#contact').val(),
		contract_des : $('#contract_des').val(),
		start_dt : $('#start_dt').val(),
		end_dt : $('#end_dt').val(),
		discount : $('#discount').val(),
		acct_discount : $('#acct_discount').val(),
		notes : $('#notes').val(),
		nm_product : $('#nm_product').val(),
		nm_acm : $('#acm').val(),
		nm_discount : $('#nm_discount').val()
	}
		
	}).done(function(msg) {
	if (msg > 0 ) {
	$('#spin').hide();
	$("#contractform").css({"opacity": "0.5"});
	$("#tab2").css({"opacity": "0.5"});
	$('#success').html("Contract saved. Proceeding to Contract Line").show(500);
	id_val=parseFloat(msg)+1;
	new_no=id_val+1000;
	new_no_active=new_no-1;
	//Pushing new data to json
	len_contract+=1;
	if(contract_json)
	contract_json.push({id:msg, contract_no:cnrt_no});
	else
	{
	//Creating new json
	contract_json=[];
	item = {}
	item ["id"] = msg;
	item ["contract_no"] = cnrt_no;
	contract_json.push(item);
	len_contract=1;
	}
	key=len_contract-1;
	$('#line_cno').append('<option value="'+ contract_json[key].id + '">' + contract_json[key].contract_no + '</option>');
	
	var $tabs = $('.tabbable li');
    
	setTimeout(function(){
	$('#success').fadeOut(500);
	$('#contractform').css({"opacity": "1"});
	$('#tab2').css({"opacity": "1"});
	$('#contractform')[0].reset();
	$('#contract_no').val(new_no);
	$('#line_contract').val(msg);
	$tabs.filter('.active')
         .next('li')
         .find('a[data-toggle="tab"]')
         .tab('show');
	}, 3000);
	//$("#r1_" + rid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	//.animate({ opacity: "hide" }, "slow");
	//$('#roleDel').modal('toggle');
	$('#new_no').html(new_no_active);
	}
	else
	{
	$('#spin').hide();
	$('#error_msg').html(msg).show(500);
	setTimeout(function(){
	$('#error_msg').fadeOut(500);
	}, 3000);
	}
	$('#contractlineform,#line_sub,#head_contract').show();
	$('#line_table,#head_cno,#add_line,#act_dis,#acc').hide();
	});
	});

	$( "#contractlineform").submit(function( event ) {
		
	// Stop form from submitting normally
	event.preventDefault();

	$('#spin_line').html("Please wait..").show();
	// Get some values from elements on the page:
	var location="<?php echo base_url(); ?>traffic/create_contractline";
	$.ajax({
	type : "POST",
	url : location,
	data : $("#contractlineform").serialize()

	}).done(function(msg) {
	if (msg >= 1 ) {
	$('#spin_contractline').hide();
	$("#contractlineform").css({"opacity": "0.5"});
	$('#success_contractline').html("New Contract Line Added").show();
	setTimeout(function(){
	$('#success_contractline').fadeOut(500);
	$("#contractlineform").css({"opacity": "1"});
	$("#contractlineform").clearForm();
	//$('#nm_client').text("");
	$('#line_sub').hide();
	//$('#head_contract').hide();
	$('#head_cno').show();
	}, 2500);
	//$("#r1_" + rid).animate({ backgroundColor: "#fbc7c7" }, "fast")
	//.animate({ opacity: "hide" }, "slow");
	//$('#roleDel').modal('toggle');

	var cno= $('#line_cno').val();
	if(!cno)
	cno= $('#line_contract').val();
	$('#contractlineform').hide();
	$('#line_table').show();

	//Start Contract Lines
	var contract_id = cno;
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
	var lenp= "";
	var lent="";
	temp= false ;
	lineTotal=0;
	//console.log(contract_id);
	var location="<?php echo base_url(); ?>traffic/get_contract_line";
	$.ajax({
	type : "POST",
	dataType : "json",
	url : location,
	data : {
	contract_id : contract_id

	}
	}).done(function(contract_line) {
	contract_line_json=contract_line;
	if (contract_line==false) {
	$('#line_table').hide();
	$('#line_msg ').show().html("<label class='label label-warning'> No contractLines found</label>");
	console.log('No contractLines');
	}
	else
	{
	$('#line_msg ').hide();
	no=1;
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

	txt+='<tr class="line_cnt" id="r1_'+ contract_line[key].id + '"><td id="c_'+ contract_line[key].id + '"><input type="checkbox" id="check[]"  value="'+ contract_line[key].id + '" class="checkbox" name="check[]">';
	txt+='<td id="c1_'+ contract_line[key].id + '"> '+no+'</td>';
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
	txt+= 'onclick="modal_edit_populate('+line_id+','+pid+','+ltype+', \''+cno+'\')" data-toggle="modal" data-target="#modalEditLine" title="Edit ContractLine"><i class="glyphicon glyphicon-edit"></i></a></td></tr>';
	no+=1
	});
	
	$('#total').html('<label class="label label-primary">Total<span class="badge" style="background: #FFF; color: #1cace9;">'+lineTotal+'</span></label>');
	//jQuery("#line_contract tbody").append(txt).removeClass("hidden");;
	
	
	$("#line_view").append(txt).removeClass("hidden");
	
	 if(tbl) {
		 	var table="";
          // Initialize Datatables
          var table = $('#line_view').DataTable({
            // Customize the header and footer
            "dom": 'R<"dataTables_header"fCi>t<"dataTables_footer"p>',
			
            // Customize the ColVis button text so it's an icon and align the dropdown to the right side
            "colVis": {
              "buttonText": "<i class='fa fa-columns'></i>",
              "sAlign": "right"
              /*
              "showAll": "<button class='btn-block'>Show all</button>",
                            "showNone": "<button class='btn-block'>Show none</button>"*/
              
			   //exclude: [ 0 ]
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
		  
		  
		  tbl=false;
			  }
	/*End data table*/
	delLine();
	}
	});
	//End Contract Lines

	}
	else
	{
		alert('Insertion failed!');
		$( "#contractlineform").clearForm();
	}
	$('#spin_line').hide();
	$('#new_no').html((parseFloat(cno)+1000));
	$('#head_contract,#add_line').show();
	$('#cno_new').val(cno); //Checvk here important error
	});
	});

	//Reset from
	$.fn.clearForm = function() {
	return this.each(function() {
	var type = this.type, tag = this.tagName.toLowerCase();
	if (tag == 'form')
	return $(':input',this).clearForm();
	if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'email')
	this.value = '';
	else if (type == 'checkbox' || type == 'radio')
	this.checked = false;
	else if (tag == 'select')
	this.selectedIndex = -1;
	//$('#nm_discount').val("");
	//$('#nm_client').$('#nm_client option:selected').text("FDGd")
	});
	};
	var $tabs = $('.tabbable li');

$('#next').on('click', function() {
    $tabs.filter('.active')
         .next('li')
         .find('a[data-toggle="tab"]')
         .tab('show');
});
$('#prev').on('click', function() {
    $tabs.filter('.active')
         .prev('li')
         .find('a[data-toggle="tab"]')
         .tab('show');
});


});
	
//Delete contractLines
//End contrctLine delete
function cancelLine()
{
	$('#line_table,#head_contract').hide();
	$('#contractlineform').show();
}

</script>