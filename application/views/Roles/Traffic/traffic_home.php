<?php $this->load->helper('url');
if(($role_id!=4) && ($role_id!=2) )
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
            <li>Traffic</li>
          </ol>
       <!-- *****************  Sales data********************-->
     	Traffic Home 
      <!-- *****************  End Sales data********************-->
        </div><!-- /col -->
        <div class="col-sm-3 col-md-2 col-sm-pull-9 col-md-pull-10 sidebar-pf sidebar-pf-left">
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
   