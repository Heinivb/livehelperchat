 
<img style="width:100px" src="https://store.suitecrm.com/assets/img/sites/suitecrm/suite_icon.png" />

<!-- <ul class="nav nav-tabs suit-crm-tabs-pills" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="Search-Records-tab" data-toggle="tab" href="#Search-Records" role="tab" aria-controls="Search-Records" aria-selected="true">Search Records</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" id="Create-Records-tab" data-toggle="tab" href="#Create-Records" role="tab" aria-controls="Create-Records" aria-selected="false">Create Records</a>
  </li>  
</ul> -->
<div class="tab-content suit-crm-tabs-conent" id="myTabContent">
  <div class="tab-pane fade show active" id="Search-Records" role="tabpanel" aria-labelledby="Search-Records">
		<div class="suit-crm-tabs-conent-inr p-3">	
    <div id="accordion" class="accordion">
        <div class="card mb-0">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                <a class="card-title">
										Leads (<?php echo count($detail->results->leads); ?>)
                </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion" >
                <div class="card-body">

                   <?php   if($detail->results->leads) {  
                              foreach ($detail->results->leads as $key => $value) { 

                                 $leadURL =  $api.'/index.php?module=Leads&return_module=Leads&action=DetailView&record='.$value[0];    ?>
                                 <div class="row ">
                                   <a  target="_blank"  href="<?php echo $leadURL ?> "><?php  echo $value[1]. ' '.$value[2] ?></a>
                                  <!--  <span> ( <?php echo $value[3] ?> )</span> -->
                                 </div>
                                
                            <?php   } ?>
                                 

                  <?php } else {
                      echo "No Leads";
                  } ?>
								</div>
            </div>
						
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <a class="card-title">
                  Accounts (<?php echo count($detail->results->accounts_by_contact); ?>)
                </a>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion" >
               <div class="card-body">
								   
                    <?php   if($detail->results->accounts_by_contact) {  
                              foreach ($detail->results->accounts_by_contact as $key => $value) { 

                                 $accURL =  $api.'/index.php?module=Accounts&return_module=Accounts&action=DetailView&record='.$value[0];    ?>
                                 <div class="row ">
                                   <a  target="_blank"  href="<?php echo $accURL ?> "><?php  echo $value[1] ?></a>
                                  
                                 </div>
                                
                            <?php   } ?>
                                 

                  <?php } else {
                      echo "No Accounts";
                  } ?>

							 </div>
            </div>
						
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                <a class="card-title">Contacts (<?php echo count($detail->results->contacts); ?>)</a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion" >
									<div class="card-body">
								      <?php   if($detail->results->contacts) {  
                              foreach ($detail->results->contacts as $key => $value) { 

                                 $contURL =  $api.'/index.php?module=Contacts&return_module=Contacts&action=DetailView&record='.$value[0];    ?>
                                 <div class="row ">
                                   <a  target="_blank"  href="<?php echo $contURL ?> "><?php  echo $value[1]. ' '.$value[2] ?></a>
                                <!--    <span> ( <?php echo $value[3] ?> )</span> -->
                                 </div>
                                
                            <?php   } ?>
                                 

                  <?php } else {
                      echo "No Contacts";
                  } ?> 
									</div>
            </div>
           
             <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                <a class="card-title">Opportunities (<?php echo count($detail->results->opportunity_by_contact); ?>)</a>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#accordion" >
                  <div class="card-body">
                      <?php   if($detail->results->opportunity_by_contact) {  
                              foreach ($detail->results->opportunity_by_contact as $key => $value) { 

                                 $oppURL =  $api.'/index.php?module=Opportunities&return_module=Opportunities&action=DetailView&record='.$value[0];    ?>
                                 <div class="row ">
                                   <a  target="_blank"  href="<?php echo $oppURL ?> "><?php  echo $value[1] ?></a>
                                
                                 </div>
                                
                            <?php   } ?>
                                 

                  <?php } else {
                      echo "No Opportunities";
                  } ?> 
                  </div>
            </div>

        </div>
			</div>
		</div>
	</div>
  <div class="tab-pane fade" id="Create-Records" role="tabpanel" aria-labelledby="Create-Records">
		<div class="suit-crm-tabs-conent-inr p-3">	
					<h5 class="mt-0">Add Lead</h5>				
					<div class="form-group">
						<label>First Name</label>
						<input class="form-control" type="text" id="first_name" value="<?php  echo $chat->nick ?>">
					</div>
					
					<div class="form-group">
						<label>Last Name</label>
						<input class="form-control" type="text" id="last_name">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" type="text" id="lead_email" value="<?php  echo $chat->email ?>"> 
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input class="form-control" type="text" id="phone_number">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" cols="4" type="text" id="Description"> </textarea>
					</div>
					
		</div>
	</div>
</div> 
 
 
 
 
 
 <style>
 .accordion .card-header:after {

    content: "\2212";
    float:left;
		font-weight:bold;
		margin-right: 5px;
}
.accordion .card-header.collapsed:after {
    /* symbol for "collapsed" panels */
    content: '\002B';
}
#myTabContent .p-3  {
  padding:4px 0px !important
}

#myTabContent  .card-title , #myTabContent .card-body { font-size:14px;  }
#myTabContent  .card-header { padding: 6px 4px;  }
#myTabContent .card-body {
    padding: 6px 22px;
}
#myTabContent .card-body .row {
    margin: 0;
}
 </style>


 


