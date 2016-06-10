<?php $this->load->helper('url');

?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
           
          </ol>
       <!-- *****************  Sales data********************-->
     	Dashboard 
     	
     	 <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    // Load the Visualization API and the piechart package.
   	 google.load('visualization', '1.0', {'packages':['corechart']});
   
     $(document).ready(function(){
        	 drawChart();    	 
     });  


    

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      
      var t;
      // draws it.
      function drawChart() {

        // Create the data table.
       t = $.ajax({
  		                  method: "POST",
		                  url: "dashboard_graph_generator",
		                  dataType: 'json',
		                  async:false
		              }).responseText;   
		t=JSON.parse(t);
		var data = new google.visualization.arrayToDataTable(t['sales']);
	    // Set chart options
	    var months=["January","Febrauary","March","April","May","June","July","August","September","October","November","December"]
        var options = {'title':'Sales chart of all account managers for the month '+months[t['time']['month']-1]+' '+t['time']['year'],
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
    
    
  
    
<div id="chart_div"></div>
    
     	
     	
     	
      <!-- *****************  End Sales data********************-->
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" >
                    Dashboard Link 
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
   