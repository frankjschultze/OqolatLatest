<?php $this->load->helper('url');
if(($role_id!=5) && ($role_id!=2))
{
	header("location:". base_url()."home/logout");
	exit();
}
?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-md-10 col-sm-push-3 col-md-push-2">
          <ol class="breadcrumb">
            <li><a href="users/dashboard">Dashboard</a></li>
            <li>Analytics</li>
          </ol>
       <!-- *****************  Sales data********************-->
     	Analytics Home 
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
                    <li><a href="<?php echo base_url()."analytics/real_time_audio"?>">Real Time Audio</a></li>
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
   