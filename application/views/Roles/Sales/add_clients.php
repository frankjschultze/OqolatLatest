<?php $this->load->helper('url');
if(($role_id!=3) && ($role_id!=2)  && (!$nav))
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
	$('.selectpicker').selectpicker();
		$(document).ready(function() {
			
   //Client Tab
   txt="";
   txt+='<option value="">Choose Type</option>';
   $.each(type_json, function(key,val) {
   txt+='<option value="'+type_json[key].type_id+'">'+type_json[key].type_name+'</option>';
   });
   $('#type').append(txt);
   
   //Advertiser Tab
     txt="";
         	txt="<div class='onoffswitch'><input type='checkbox' name='sts' value='1' class='onoffswitch-checkbox' id='sts'>";
    		txt+="<label class='onoffswitch-label' for='sts'>";
    		txt+="<span class='onoffswitch-inner' ></span>";
    		txt+="<span class='onoffswitch-switch'></span>";
    		txt+="</label></div>";
    		$('#status1').html(txt);
   //Products select box
		var txt="";
		var key="";
		var val="";
		$('#c_product').empty();
		
		
		var len = products_json.length;
		
		if(txt=="")
		{
			txt+="<option value=''>Choose Product</option>";
		}
		
		
		$("#c_product").append(txt);
	
		$.each(products_json,function(key,val) {
			
    	$('#c_product').append('<option value="'+ products_json[key].product_id + '">' + products_json[key].product_name + '</option>');
		});
		//Products select box
		
		
		//Campaign select box
		var txt="";
		var key="";
		var val="";
		$('#c_campaign').empty();
		
		
		
		if(txt=="")
		{
			txt+="<option value=''>Choose Campaign</option>";
		}
		
		
		$("#c_campaign").append(txt);
	
		$.each(campaigns_json,function(key,val) {
			
    	$('#c_campaign').append('<option value="'+ campaigns_json[key].campaign_id + '">' + campaigns_json[key].campaign_name + '</option>');
		});
		//Campaign select box
		
		//Target audience select box
		var txt="";
		var key="";
		var val="";
		var key1="";
		var val1="";
		$('#c_audience').empty();
		
		
		$.each(audience_json,function(key,val) {
			
    	$('#c_audience').append('<option value="'+ audience_json[key].target_audience_id + '">' + audience_json[key].target_audience + '</option>');
		});
		
		$('#c_audience').selectpicker('refresh');
		//Target Audience select box
		
		/*Start Account Tab*/
		
		var txt="";
		var key="";
		var val="";
		$('#c_acm').empty();
		
		
		if(txt=="")
		{
			txt+="<option value=''>Please select</option>";
		}
		
		
		$("#c_acm").append(txt);
	
		$.each(acctmanager_json,function(key,val) {
			
    	$('#c_acm').append('<option value="'+ acctmanager_json[key].acct_manager_id + '">' + acctmanager_json[key].acct_manager + '</option>');
		});
		
		
		/*End Account Tab*/
		
  //Account manager tab
  
  		
	var $tabs = $('.tabbable li');

	$('#next1,#next2').on('click', function() {
	var name=$('#name').val();
	var email=$('#email').val();
	var type=$('#type').val();
	if(name=="")
	{
		$('#alertmsg').modal('toggle');
		$('#req').html('Client Name');
		setTimeout(function() { $('#name').focus() }, 2500);
		return false;
	}
	else if(email=="")
	{
		$('#alertmsg').modal('toggle');
		$('#req').html('Client Email');
		setTimeout(function() { $('#email').focus() }, 2500);
		return false;
	}
	else if(type=="" )
	{
		$('#alertmsg').modal('toggle');
		$('#req').html('Client Type');
		setTimeout(function() { $('#type').focus() }, 2500);
		return false;
	}
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  	emailCheck=emailReg.test( email );
  	if(!emailCheck)
  	{
  		$('#alertmsg').modal('toggle');
		$('#req').html('Valid Client Email address');
		setTimeout(function() { $('#email').focus() }, 2500);
		return false;
  	}
    $tabs.filter('.active')
         .next('li')
         .find('a[data-toggle="tab"]')
         .tab('show');
	});
	$('#prev1,#prev2,#prev3').on('click', function() {
    $tabs.filter('.active')
         .prev('li')
         .find('a[data-toggle="tab"]')
         .tab('show');
	});

		});

function redir()
{
	window.location.href = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
}
</script>
    <div class="container-fluid">
    	
      <div class="row">
      	
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>users/dashboard">Dashboard</a></li>
            <li>Add clients</li>
          </ol>
          
			<button class="btn btn-info" type="button" onclick="redir();" title="Back To Clients data View">
				<i class="glyphicon glyphicon-step-backward"></i>
				Back
			</button>
			<hr>
       <!-- *****************  Sales data********************-->
     	
     	
    <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Clients</a></li>
    <li><a href="#tab7" data-toggle="tab">Advertiser</a></li>
    <li><a href="#tab8" data-toggle="tab">Account</a></li>
     <li><a href="#tab2" data-toggle="tab">Contact</a></li>
    <li><a href="#tab3" data-toggle="tab">History</a></li>
    </ul>
    <div class="tab-content" style="margin-top: 20px;">
    	 
    	 <!-- Start tab-1 Add clients-->
    	 <span id="success" style="left: 35%; margin: 0 auto; position: absolute;" class="label label-success"></span>
    <div class="tab-pane active" id="tab1">
    	
          <form name="f1" id="clientform" method="post">
          
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
                <input id="phone" name="phone" value="" class="form-control" type="text">
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
            <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Physical address 2</label>
              <div class="col-md-6">
                <input id="adr2" name="adr2" value="" class="form-control" type="text">
              </div>
            </div>
            
             
             <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Physical address 3</label>
              <div class="col-md-6">
                <input id="adr3" name="adr3"  value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group required">
              <label class="col-md-5 control-label"  for="textInput4">Postal address 1</label>
              <div class="col-md-6">
                <input id="padr1" name="padr1"  value="" class="form-control" type="text">
              </div>
            </div>
             <div class="form-group">
              <label class="col-md-5 control-label" for="textInput4">Postal address 2</label>
              <div class="col-md-6">
                <input id="padr2" name="padr2" value="" class="form-control" type="text">
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
              	<button id="next1" href="#tab7" data-toggle="tab" type="button" name="sub"  class="btn btn-default">
				Next <i class="glyphicon glyphicon-forward"></i>
				</button>
               
              </div>
            </div>
		  
		 </span>
         </form>

    </div>
     <!-- End tab-1 Add clients-->
     
    <!--Start Tab 7 Advertiser-->
    <div class="tab-pane" id="tab7">
    	<span id="success_adv" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error_adv" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
    	 <form id="advertiser" name="advertiser" method="post">
    	<div class="form-group">
              <label class="col-md-10 control-label" for="boostrapSelect">Product</label>
              <div class="col-md-5">
                <select class="advertise" id="c_product" name="c_product">
                 
                 </select>
              </div>
              
              <label class="col-md-10 control-label" for="boostrapSelect">Campaign</label>
              <div class="col-md-5">
                <select class="advertise"  id="c_campaign" name="c_campaign">
                 
                </select>
              </div>
               <label class="col-md-10 control-label" for="boostrapSelect">Target Audience</label>
              <div class="col-md-5">
                <select class="selectpicker" name="c_audience[]" multiple data-selected-text-format="count>3"  id="c_audience">
                
                </select>
              </div>
            </div>
          <div class="form-group">
              <div class="col-md-10 col-md-offset-5">
              	<input type="hidden" id="rowkey" />
                <button id="prev1" href="#tab1" data-toggle="tab" type="button" name="sub"  class="btn btn-default">
				Prev <i class="glyphicon glyphicon-backward"></i>
				</button>
				<button id="next2" href="#tab8" data-toggle="tab" type="button" name="sub"  class="btn btn-default">
				Next <i class="glyphicon glyphicon-forward"></i>
				</button>
               
              </div>
            </div>  
    </form>
    </div>
   <!-- End tab Advertiser7-->
   
   <!-- Start tab-8 Account-->
   
   <div class="tab-pane" id="tab8">
   	<span id="success_acc" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-success"></span>
    	 <span id="error_acc" style="left: 35%; margin: 0 auto; padding: 5px; position: absolute; top: 23px;" class="label label-warning"></span>
   <form id="account" name="account" method="post">
    <div class="form-group">
              <label class="col-md-10 control-label" for="boostrapSelect">Account manager</label>
              <div class="col-md-10">
                <select class="advertise" id="c_acm" name="c_acm">
                  
                 </select>
              </div>
    </div>
     <div class="col-md-10 col-md-offset-1">
     <input type="hidden" id="rowkey" />
     <button id="prev" href="#tab7" data-toggle="tab" type="button" name="sub"  class="btn btn-default">
	 Prev <i class="glyphicon glyphicon-backward"></i>
	 </button>
	 <button type="button" id="sub" name="sub"  class="btn btn-primary"><i class="glyphicon glyphicon-saved"></i>Save</button>
      <span id="spin" style="position: absolute;"></span>
    </div>  
    </form>
    </div>
   <!-- End tab 8 Account-->
    <div class="tab-pane" id="tab2">
    <p>Howdy, I'm in Section 4.</p>
    </div>
   <!-- End tab2-->
   
   <div class="tab-pane" id="tab3">
    <p>Howdy, I'm in Section 5.</p>
    </div>
   <!-- End tab3-->
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
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                    Clients
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                   
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
                    <li><a href="<?php echo base_url();?>traffic/manage_contracts">Edit contracts</a></li>
                    
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
  
 
       
       
        <!--Alert msg modal-->
 
		<div class="modal fade" id="alertmsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background: red;">
                  <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                    <span class="pficon pficon-close"></span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Warning !</h4>
                </div>
                <div class="modal-body">
                 
          <input type="hidden" id="rid" value="" />
            <span class="form-horizontal">
            <div>
              <label class="col-md-14 control-label">Please input <label style="font-weight: bold" id="req"></label>  </label>
            
            </div>
                         
             <div class="form-group">
              <div class="col-md-10 col-md-offset-7">
                <button type="button" data-dismiss="modal" aria-hidden="true" name="sub"  class="btn btn-primary">Ok</button>
              </div>
            </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
       <!--End alert msg modal-->  
   
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
//Validation ends


$(document).ready(function () {
$( "#sub").on('click',function( event ) {
	var $tabs = $('.tabbable li');
// Stop form from submitting normally
event.preventDefault();
var name=$('#name').val();
	var email=$('#email').val();
	var type=$('#type').val();
	if(name=="")
	{
		$('#alertmsg').modal('toggle');
		$('#req').html('Client Name');
		$tabs.filter('.active')
         				.prev('li')
         				.prev('li')
         				.find('a[data-toggle="tab"]')
         				.tab('show');
		setTimeout(function() { $('#name').focus() }, 2500);
		return false;
	}
	else if(email=="")
	{
		$('#alertmsg').modal('toggle');
		$('#req').html('Client Email');
		$tabs.filter('.active')
         				.prev('li')
         				.prev('li')
         				.find('a[data-toggle="tab"]')
         				.tab('show');
		setTimeout(function() { $('#email').focus() }, 2500);
		return false;
	}
	else if(type=="" )
	{
		$('#alertmsg').modal('toggle');
		$('#req').html('Client Type');
		$tabs.filter('.active')
         				.prev('li')
         				.prev('li')
         				.find('a[data-toggle="tab"]')
         				.tab('show');
		setTimeout(function() { $('#type').focus() }, 2500);
		return false;
	}
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  	emailCheck=emailReg.test( email );
  	if(!emailCheck)
  	{
  		$('#alertmsg').modal('toggle');
		$('#req').html('Valid Client Email address');
		$tabs.filter('.active')
         				.prev('li')
         				.prev('li')
         				.find('a[data-toggle="tab"]')
         				.tab('show');
		setTimeout(function() { $('#email').focus() }, 2500);
		return false;
  	}
$('#spin').html("Please wait..").show();
// Get some values from elements on the page:
var location="<?php echo base_url();?>sales/create_client";
var dataString=$('#clientform,#advertiser,#account').serialize();
$.ajax({
			type : "POST",
			url : location,
			data : dataString

		}).done(function(msg) {
			if (msg == 1 ) {
				$('#spin').hide();
				 
				
				$( "#clientform,#advertiser,#account").css({"opacity": "0.5"});
				$('#success').html("<i class='glyphicon glyphicon-saved'></i> Client data saved").show(500);
				setTimeout(function(){
   						$('#success').hide(500);
   						$( "#clientform,#advertiser,#account").css({"opacity": "1"});
   						$( "#clientform,#advertiser,#account").clearForm();
   						$tabs.filter('.active')
         				.prev('li')
         				.prev('li')
         				.find('a[data-toggle="tab"]')
         				.tab('show');
						}, 3000);
				//$("#r1_" + rid).animate({ backgroundColor: "#fbc7c7" }, "fast")
				//.animate({ opacity: "hide" }, "slow");
				//$('#roleDel').modal('toggle');
				
				}
				else
				{
					alert('Insertion failed!');
				}
				
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
  });
};
});

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