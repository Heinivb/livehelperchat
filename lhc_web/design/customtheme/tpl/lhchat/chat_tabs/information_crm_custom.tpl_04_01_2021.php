

<img style="width:100px" src="https://store.suitecrm.com/assets/img/sites/suitecrm/suite_icon.png" />

<?php 

  $userId =  $chat->user_id;
  $cID = $chat->id;

  $curURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
  $getUsers =  $curURL."/getUserdetails.php?user_id=".$userId;
   
// www.designcenter.co.za
// www.learn3d.co.za
// www.conceptinteractive.co.za
// https://www.learnfast.co.za
// https://www.cadco.co.za 
// www.aie.ac  
  $brand_type = array('aie.ac' => 'brand_aie' ,  'designcenter.co.za' => 'brand_gdc'  ,  'cadco.co.za' => 'brand_cadco' ,
                'learnfast.co.za' => 'brand_LF' , 'learn3d.co.za' => 'brand_aie' ,  'conceptinteractive.co.za' => 'brand_aie' );

  $brand = 'brand_aie';

  $referrer = $chat->referrer;


  foreach ($brand_type as $key => $value) {

         

      if (strpos($referrer,  $key ) !== false) {
          $brand = $value ;
          break;
      }
      
   }

  




  $c = curl_init();
  curl_setopt($c, CURLOPT_URL,$getUsers);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);                     
  $response = curl_exec($c);
  $uDtails = json_decode($response);

  $assignEmail = $uDtails->user->email;
  curl_close($c);
 
 $contact_id= '';
 $first_name = "";
 $last_name = "";
 $account_id= '';



 ?>


 <style>
.btn-create-lead { 
background-image: url(<?php echo $curURL ?>/create-lead.jpg) !important; 
background-repeat: no-repeat  !important;  
background-size: 20px  !important;
 background-position: 15px center  !important; 
 text-align: left  !important;  
 padding: 12px 15px 12px 40px  !important; 
 line-height: 1.2  !important;  
 height: inherit  !important; 
 display: inline-block !important; 
 width: auto !important; 
     border: 1px solid #ced4da;
    background-color: #efefef !important;
 }
.btn-create-lead:hover {
    background-color: #ced4da !important;
}
</style>

<ul class="nav nav-tabs suit-crm-tabs-pills" id="myTab" role="tablist">


<?php if ($isexist) { ?>
  <li class="nav-item">
    <a class="nav-link active" id="Search-Records-tab" data-toggle="tab" href="#Search-Records-<?php echo $cID; ?>" role="tab" aria-controls="Search-Records" aria-selected="true">Customer Records</a>
  </li>
<?php } ?>
   <li class="nav-item">
    <a class="nav-link <?php if ( empty($isexist) ) { echo 'active' ; } ?>" id="Create-Records-tab" data-toggle="tab" href="#Create-Records-<?php echo $cID; ?>" role="tab" aria-controls="Create-Records" aria-selected="false">Create Lead</a>
  </li>
  <?php if ($isAcount) { ?>  
   <li class="nav-item">
    <a class="nav-link" id="Create-Opportunity-tab" data-toggle="tab" href="#Create-Opportunity-<?php echo $cID; ?>" role="tab" aria-controls="Create-Opportunity" aria-selected="false">Create Opportunity</a>
  </li> 
  <?php } ?>
 
</ul>
<div class="tab-content suit-crm-tabs-conent" id="myTabContent">
  <?php if ($isexist) { ?>
  <div class="tab-pane fade show active" id="Search-Records-<?php echo $cID; ?>" role="tabpanel" aria-labelledby="Search-Records">
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

                                 $leadURL =  $CRMapi.'/index.php?module=Leads&return_module=Leads&action=DetailView&record='.$value[0];    ?>
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

                                if (empty($account_id) ) {

                                  $account_id = $value[0] ;

                                 }  

                                 $accURL =  $CRMapi.'/index.php?module=Accounts&return_module=Accounts&action=DetailView&record='.$value[0];    ?>
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

                                if (empty($contact_id) ) {

                                  $contact_id = $value[0] ;
                                  $first_name = $value[1] ;
                                  $last_name = $value[2] ;

                                 } 

                                 $contURL =  $CRMapi.'/index.php?module=Contacts&return_module=Contacts&action=DetailView&record='.$value[0];    ?>
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

                                 $oppURL =  $CRMapi.'/index.php?module=Opportunities&return_module=Opportunities&action=DetailView&record='.$value[0];    ?>
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
  <?php } ?>
  <div class="tab-pane fade <?php if ( empty($isexist) ) { echo 'show active' ; } ?>" id="Create-Records-<?php echo $cID; ?>" role="tabpanel" aria-labelledby="Create-Records">
		<div class="suit-crm-tabs-conent-inr p-3 row">	
		  
					<div class="form-group col-sm-6 ">
						<label>First Name</label>
            <?php if (empty($first_name)) { $first_name = $chat->nick;  } ?>
						<input class="form-control" required type="text" id="first_name_<?= $chat->id ?>" value="<?php  echo $first_name ?>">
					</div>
					
					<div class="form-group col-sm-6">
						<label>Last Name</label>
						<input class="form-control" required  type="text" value="<?php  echo $last_name ?>" id="last_name_<?= $chat->id ?>">
					</div>
					<div class="form-group col-sm-6 ">
						<label for="">Email</label>
						<input class="form-control" required type="text" id="lead_email_<?= $chat->id ?>" value="<?php  echo $chat->email ?>"> 
					</div>
					<div class="form-group col-sm-6">
						<label>Phone</label>
						<input class="form-control" required type="text" value = "<?php  echo $chat->phone ?>" id="phone_number_<?= $chat->id ?>">
					</div>
					<div class="form-group col-sm-12">
						<label>Description</label>
						<textarea class="form-control" cols="4" type="text" id="description_<?= $chat->id ?>"> </textarea>
					</div>

            <div class="form-group col-sm-12">    
           
              <input type="button" class="form-control btn btn-create-lead"  value= " Create Lead "onclick="createLead('<?= $chat->id ?>')" /> 
                
            
          </div>
					
		</div>
	</div>
  <div class="tab-pane fade" id="Create-Opportunity-<?php echo $cID; ?>" role="tabpanel" aria-labelledby="Create-Opportunity">
    <div class="suit-crm-tabs-conent-inr p-3">  
         
          <div class="form-group">
            <label> Name</label>
            <input class="form-control"  type="text" id="name_<?= $chat->id ?>" value="<?php  echo $chat->nick ?>">
          </div>
          
          
          <div class="form-group">
            <label for="">Email</label>
            <input class="form-control"  type="text" id="opp_email_<?= $chat->id ?>" value="<?php  echo $chat->email ?>"> 
          </div>
       
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" cols="4" type="text" id="opp_description_<?= $chat->id ?>"> </textarea>
          </div>

            <div class="form-group">    
                  
              <input type="button" class="form-control btn"  value= " Create Opportunity "onclick="createOpp('<?= $chat->id ?>')" /> 
          </div>

          <input type="hidden" value="<?php echo $chat->id ?>" id="chat-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $chat->referrer ?>" id="referrer-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $chat->email ?>" id="oldemail-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $curURL ?>" id="curURL-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $assignEmail ?>" id="assignEmail-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $account_id ?>" id="account_id-<?= $chat->id ?>" />          
          <input type="hidden" value="<?php echo $contact_id ?>" id="contact_id-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $brand ?>" id="brand-<?= $chat->id ?>" />
          
    </div>
  </div>
</div> 
 
 
<script type="text/javascript">

    // var id = '<?= $chat->id ?>';
     var curURL = '<?= $curURL ?>';
    // var chatURL = curURL+ "/index.php/site_admin/chat/single/"+id;
     

     setTimeout(function(){
           // $("#description_"+id).val(cont);
     },100)  
     
   function createLead(id) {

     var API_URL = '<?php echo $CRMapi ?>';  
     var referrer = $("#referrer-"+id).val();
     var oldemail = $("#oldemail-"+id).val();
     var assignEmail = $("#assignEmail-"+id).val();
     var account_id = $("#account_id-"+id).val();
     var contact_id = $("#contact_id-"+id).val();
     var brand = $("#brand-"+id).val(); 
     var chatURL = curURL+ "/index.php/site_admin/chat/single/"+id;

     
     
     var form = new FormData();
     var first_name  = $("#first_name_"+id).val();
     var last_name  = $("#last_name_"+id).val();
     var phone_number = $("#phone_number_"+id).val();
     var email = $("#lead_email_"+id).val();

     var cont = $("#messagesBlock-"+id).html(); 
     var description = $("#description_"+id).val();

     description = description + ' \r\n ' + referrer + '\r\n' + chatURL ;
      
     var errors = '';

      if (first_name == "") {
        errors = "First Name must be filled out \n" ;        
      }


      if (last_name == "") {
        errors = errors + "Last Name must be filled out \n" ;        
      }

      if (email == "") {
        errors = errors + "Email must be filled out \n" ;        
      }


      if (errors != "") {
         alert(errors);
         return false;
      }
      
     
      form.append("id", id);
      form.append("first_name", first_name);
      form.append("last_name", last_name);
      form.append("phone_number", phone_number);
      form.append("email", email);
      form.append("description",description);
      form.append("referrer",referrer);
      form.append("API_URL",API_URL);
      form.append("oldemail",oldemail);
      form.append("assignEmail",assignEmail);
      form.append("account_id",account_id);
      form.append("contact_id",contact_id);
      form.append("brand",brand);
      
   
      var settings = {
         "url":  "/createLead.php",
         "method": "POST",            
         "data": form,
         processData: false,
         contentType: false
        };

         
            
        $.ajax(settings).done(function (response) {


            alert('Lead has been added.');

            location.reload();


        });
         

    }


    function createOpp(id) {

   
     var API_URL = '<?php echo $CRMapi ?>';  
     var referrer = $("#referrer-"+id).val();
     var oldemail = $("#oldemail-"+id).val();
     var assignEmail = $("#assignEmail-"+id).val();
     var account_id = $("#account_id-"+id).val();
     var contact_id = $("#contact_id-"+id).val();
     var brand = $("#brand-"+id).val(); 
    

     
     
     var form = new FormData();
     var first_name  = $("#name_"+id).val();        
     var email = $("#Create-Opportunity #opp_email_"+id).val();
     var cont = $("#messagesBlock-"+id).html(); 
     var description = $("#opp_description_"+id).val();

     description = description + ' \r\n ' + referrer ;
      
     var errors = '';

      if (first_name == "") {
        errors = "Name must be filled out \n" ;        
      }
     

      if (email == "") {
        errors = errors + "Email must be filled out \n" ;        
      }


      if (errors != "") {
         alert(errors);
         return false;
      }
      
     
      form.append("id", id);
      form.append("first_name", first_name);     
     // form.append("phone_number", phone_number);
      form.append("email", email);
      form.append("description",description);
      form.append("referrer",referrer);
      form.append("API_URL",API_URL);
      form.append("oldemail",oldemail);
      form.append("assignEmail",assignEmail);
      form.append("account_id",account_id);
      form.append("contact_id",contact_id);
      form.append("brand",brand);
      
   
      var settings = {
         "url":  "/createOpp.php",
         "method": "POST",            
         "data": form,
         processData: false,
         contentType: false
        };

         
            
        $.ajax(settings).done(function (response) {


            alert('Opportunity has been added.');

            location.reload();


        });
         

    }
</script>
 
 
 <style>

element {
}
 
.form-control.btn {

    background : #dfdada;
}
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


 


