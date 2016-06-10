<?php $this->load->helper('url');
if($role_id!=2)
{
	header("location:". base_url()."home/logout");
	exit();
}
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="admin/dashboard">Dashboard</a></li>
            <li>Admin</li>
          </ol>
          <h3>Sales Graph</h3>
          <!--  content -->
          
           <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    // Load the Visualization API and the piechart package.
   	 google.load('visualization', '1.0', {'packages':['corechart']});
   
     $(document).ready(function(){
        	 $('.selectpicker').selectpicker();
    	     $('#draw').click(function(){
								        	 if($('#month').val()==0)
								             {
								                alert("Select a month");
								             }
								             else if($('#year').val()==0)
								             {
								                alert("Select a year");
								             }               
								             else
								             {    
								               // Set a callback to run when the Google Visualization API is loaded.
								               drawChart($('#month').val(),$('#year').val());
								             }   
                                       }); 
    	     $('#save').click(function(){
								        	 if($('#month').val()==0)
								             {
								                alert("Select a month");
								             }
								             else if($('#year').val()==0)
								             {
								                alert("Select a year");
								             }               
								             else
								             {    
								               // Set a callback to run when the Google Visualization API is loaded.
								               saveChart($('#month').val(),$('#year').val());
								             }   
                                      }); 
    	 
     });  


    

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      
      var t;
      // draws it.
      function drawChart(month, year) {

        // Create the data table.
       t = $.ajax({
  		                  method: "POST",
		                  url: "graph_generator",
		                  dataType: 'json',
		                  async:false,
		                  data: { month: month, year: year}
		              }).responseText;   
		t=JSON.parse(t);
		var data = new google.visualization.arrayToDataTable(t);
	    // Set chart options
	    var months=["January","Febrauary","March","April","May","June","July","August","September","October","November","December"]
        var options = {'title':'Sales chart of all account managers for the month '+months[month-1]+' '+year,
                       'width':800,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
 
      // saves it.
      function saveChart(month, year) 
      {
    	  $.ajax({
	              method: "POST",
	              url: "save_graph",
	              data: { month: month, year: year},	          
	            }).done(function(msg){
		                           alert("Graph saved to dashboard");
		                        });   
      }    
      
           
    </script>
    
    
 <div id='date_Select'>
 <select class='selectpicker' id='month'>                                
         <option value="0">Select a month</option>
         <option value='1'>January</option>
         <option value='2'>February</option>
         <option value='3'>March</option>
         <option value='4'>April</option>
         <option value='5'>May</option>
         <option value='6'>June</option>
         <option value='7'>July</option>
         <option value='8'>August</option>
         <option value='9'>September</option>
         <option value='10'>October</option>
         <option value='11'>November</option>
         <option value='12'>December</option>
 </select>
 
 <select class='selectpicker' id='year'>                                
         <option value="0">Select a year</option>
         <option value='2013'>2013</option>
         <option value='2014'>2014</option>
         <option value='2015'>2015</option>
         <option value='2016'>2016</option>
         <option value='2017'>2017</option>
 </select>
   <button id='draw' class="btn btn-primary" type="button" style='margin-top: -11px'>Generate</button>
   <button id='save' class="btn btn-primary" type="button" style='margin-top: -11px'>Save</button>
 </div>   
    
<div id="chart_div"></div>
    
          
          
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
       
   

   
   
   