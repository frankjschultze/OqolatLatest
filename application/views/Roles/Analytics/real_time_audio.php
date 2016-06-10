<?php $this->load->helper('url');
if(($role_id!=5) && ($role_id!=2))
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
<script>
function dp_append(id,val)
{
  val= JSON.parse(val);
  $('#'+id).empty();
  $('#'+id).append($('<option></option>').val("").html("Select a "+id));
  for(var i=0;i<val.length;i++)
  {
	$('#'+id).append($('<option></option>').val(val[i]).html(val[i]));
  }	
  $('.selectpicker').selectpicker('refresh');	    
}

function file_gen(station,month,day,val)
{
	val= JSON.parse(val);
	for(var i=0;i<val.length;i++)
	{
		$('#audio_content').append("<a href='audio_download/"+station+"/"+month+"/"+day+"/"+val[i]+"'>"+val[i]+"<br>");
	}	
}


$(document).ready(function() {
      $('.selectpicker').selectpicker();

      /* Station drop down */
      $('#station').on("change",function(){
      $('#month').empty();
	  $('#month').append($('<option></option>').val("").html("Please wait..."));
	  $('.selectpicker').selectpicker('refresh');    
      $.ajax({
    		  method: "POST",
    		  url: "audio_generator",
    		  data: { station: $(this).val()}
    		  })
    		  .done(function( msg ) {
                            dp_append('month',msg);
    			   });
    	});

      /* Month drop down */
      $('#month').on("change",function(){
          $('#day').empty();
    	  $('#day').append($('<option></option>').val("").html("Please wait..."));
    	  $('.selectpicker').selectpicker('refresh'); 	 
          $.ajax({
        		  method: "POST",
        		  url: "audio_generator",
        		  data: { station: $('#station').val(), month: $(this).val()}
        		  })
        		  .done(function( msg ) {
        			  dp_append('day',msg);
  			             
        			   });
        	});


      /* Month drop down */
      $('#day').on("change",function(){
          $('#audio_content').html("");
          $('#audio_content').hide();
    	  $('#loading').show();
          $.ajax({
        		  method: "POST",
        		  url: "audio_generator",
        		  data: { station: $('#station').val(), month: $('#month').val(), day: $(this).val()}
        		  })
        		  .done(function( msg ) {
        			        $('#loading').hide();
  			                $('#audio_content').show();
        	    	        file_gen($('#station').val(),$('#month').val(),$('#day').val(),msg);
        			   });
        	});
      
});

</script>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="users/dashboard">Dashboard</a></li>
            <li><a href="analytics">Analytics</a></li>
            <li>Post Campaign Analysis</li>
            <li>Real Time Audio</li>
          </ol>
       <!-- *****************  Sales data********************-->
     	     <select class="selectpicker" id='station'>
                                <option>Select a radio station</option>
                                <?php foreach ($radio as $station){
                                	    if($station['user_id'])echo "<option value='".$station['id']."'>".$station['name']."</option>";
                                 } ?>
             </select>
               <select class="selectpicker" id='month'>
                                <option>Select a month</option>
               </select>
               <select class="selectpicker" id='day'>
                                <option>Select a date</option>
               </select>
               
               
               <!-- Audio files will be displayed here -->
               <div id='audio_files'>
               <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Audio files</h3>
                </div>
                <div class="panel-body">
                <div id='loading' class="spinner spinner-sm" style='display:none'></div>
                <div id='audio_content'>Please select a channel, month and day...</div>
                </div>
                </div>               
               </div>
               
                      
      <!-- *****************  End Sales data********************-->
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" >
                    Analytics link
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">active link</a></li>
                    <li><a href="#">sub link 1</a></li>
                    <li><a href="#">sub link 2</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                   Post Campaign Analysis
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li class='active'><a href="analytics/real_time_audio">Real Time Audio</a></li>
                    <li><a href="#">sublink 2</a></li>
                    <li><a href="#">sublink 3</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
                    Link 3
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">sub link 1</a></li>
                    <li><a href="#">sublink 2</a></li>
                    <li><a href="#">sublink 3</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /col -->
      </div><!-- /row -->
    </div><!-- /container -->
   