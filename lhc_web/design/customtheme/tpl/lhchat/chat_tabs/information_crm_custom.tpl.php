
<!-- <img style="width:100px" src="https://store.suitecrm.com/assets/img/sites/suitecrm/suite_icon.png" /> -->
<?php

include_once("settings/global.php");


 class Conn  
 {
    function getSett(){
        return include("settings/settings.ini.php"); 
    }
 }

$Cust = new Conn();
$getSett = $Cust->getSett();
$db = $getSett['settings']['db'];


$servername = "localhost";
$username = $db['user'];
$password = $db['password'];
$database = $db['database'];

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 ?>


<?php 

  $userId =  $chat->user_id;
  $cID = $chat->id;

  // $chatEmail = $chat->email;

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


// netsuite get created leads by live chat


    //    class callNetsuiteApi{
        
    //      // PRODUCTION CREDENTIALS
    //   // const NETSUITE_CONSUMER_KEY = 'e00faa4f8a8e7779f3961a455ebb3716b5677909a511808778daa2635c4e56a4';
    //   //   const NETSUITE_ACCOUNT = '7535324';
    //   //   const NETSUITE_CONSUMER_SECRET = 'b9df982be1c133a82b5b9b673e7b18f2d546fc0b7c249fa4433c406fcc929e82';
    //   //   const NETSUITE_TOKEN_ID = 'c21568cdaf6a94f2f4caf525d8e72906c6327b42b08419adeaddb082f9d2c3b5';
    //   //   const NETSUITE_TOKEN_SECRET = '7d3d46a63b6680da15ef80fca0c35e7b6d436e32b70b5e4534994ca1beef0faf'; 
    //      // Sandbox CREDENTIALS
    //     const NETSUITE_CONSUMER_KEY = '47ddaa51979b1856bd10a4ddd4aa7469a27e0d4a1759ea5521e842b26033d0b5';
    //     const NETSUITE_ACCOUNT = '7535324_SB1';
    //     const NETSUITE_CONSUMER_SECRET = '2c3b0346791e6f8f1bf88780ca55d078aee0bab2eb0cb62a60eebc3a8e666691';
    //     const NETSUITE_TOKEN_ID = '7b6890c0de62deb7798fd9a90503320b9baa401eabcf1c2166ce2a012ae18794';
    //     const NETSUITE_TOKEN_SECRET = '76081bf5c20961987e22ab00b8f0691e568d9c3c154f44806d48abd867c3c173'; 
        
    //     public function callRestApi($url,$arr){
  
    //     $oauth_nonce = md5(mt_rand());
    //     $oauth_timestamp = time();
    //     $oauth_signature_method = 'HMAC-SHA256';
    //     $oauth_version = "1.0";
        
    //     // generate Signature 
    //     $baseString = $this->restletBaseString("POST",
    //     $url,
    //     self::NETSUITE_CONSUMER_KEY,
    //     self::NETSUITE_TOKEN_ID,
    //     $oauth_nonce,
    //     $oauth_timestamp,
    //     $oauth_version,
    //     $oauth_signature_method,null);
        
    //     $key = rawurlencode(self::NETSUITE_CONSUMER_SECRET) .'&'. rawurlencode(self::NETSUITE_TOKEN_SECRET);
    
    
    //      $signature = base64_encode(hash_hmac('sha256', $baseString, $key, true)); 
         
    //      // GENERATE HEADER TO PASS IN CURL
    //      $header = 'Authorization: OAuth '
    //              .'realm="' .rawurlencode(self::NETSUITE_ACCOUNT) .'", '
    //              .'oauth_consumer_key="' .rawurlencode(self::NETSUITE_CONSUMER_KEY) .'", '
    //              .'oauth_token="' .rawurlencode(self::NETSUITE_TOKEN_ID) .'", '
    //              .'oauth_nonce="' .rawurlencode($oauth_nonce) .'", '
    //              .'oauth_timestamp="' .rawurlencode($oauth_timestamp) .'", '
    //              .'oauth_signature_method="' .rawurlencode($oauth_signature_method) .'", '
    //              .'oauth_version="' .rawurlencode($oauth_version) .'", '
    //              .'oauth_signature="' .rawurlencode($signature) .'"';
             
    //     // echo $header;
    //     return  $this->callCurl($header,$url,$arr);
    
    //     }
    //     public function callCurl($header,$url,$arr){

    //         $data_string=json_encode($arr);
             


    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //           CURLOPT_URL => $url,
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => '',
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 0,
    //           CURLOPT_FOLLOWLOCATION => true,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => 'POST',
    //           CURLOPT_POSTFIELDS =>$data_string,
    //           CURLOPT_HTTPHEADER => array(
    //             'prefer: transient',
    //             'Content-Type: application/json',
    //             $header
    //           ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);

    //         $product = json_decode($response, true);
    //         return $product; 
    //         // echo $response;
    
    //     }
    //     public function restletBaseString($httpMethod, $url, $consumerKey, $tokenKey, $nonce, $timestamp, $version, $signatureMethod, $postParams){
    //           //http method must be upper case
    //           $baseString = strtoupper($httpMethod) .'&';
              
    //           //include url without parameters, schema and hostname must be lower case
    //           if (strpos($url, '?')){
    //             $baseUrl = substr($url, 0, strpos($url, '?'));
    //             $getParams = substr($url, strpos($url, '?') + 1);
    //           } else {
    //            $baseUrl = $url;
    //            $getParams = "";
    //           }
    //           $hostname = strtolower(substr($baseUrl, 0,  strpos($baseUrl, '/', 10)));
    //           $path = substr($baseUrl, strpos($baseUrl, '/', 10));
    //           $baseUrl = $hostname . $path;
    //           $baseString .= rawurlencode($baseUrl) .'&';
              
    //           //all oauth and get params. First they are decoded, next alphabetically sorted, next each key and values is encoded and finally whole parameters are encoded
    //           $params = array();
    //           $params['oauth_consumer_key'] = array($consumerKey);
    //           $params['oauth_token'] = array($tokenKey);
    //           $params['oauth_nonce'] = array($nonce);
    //           $params['oauth_timestamp'] = array($timestamp);
    //           $params['oauth_signature_method'] = array($signatureMethod);
    //           $params['oauth_version'] = array($version);
               
    //           foreach (explode('&', $getParams ."&". $postParams) as $param) {
    //             $parsed = explode('=', $param);
    //             if ($parsed[0] != "") {
    //               $value = isset($parsed[1]) ? urldecode($parsed[1]): "";
    //               if (isset($params[urldecode($parsed[0])])) {
    //                 array_push($params[urldecode($parsed[0])], $value);
    //               } else {
    //                 $params[urldecode($parsed[0])] = array($value);
    //               }
    //             }
    //           }
               
    //           //all parameters must be alphabetically sorted
    //           ksort($params);
               
    //           $paramString = "";
    //           foreach ($params as $key => $valueArray){
    //             //all values must be alphabetically sorted
    //             sort($valueArray);
    //             foreach ($valueArray as $value){
    //               $paramString .= rawurlencode($key) . '='. rawurlencode($value) .'&';
    //             }
    //           }
    //           $paramString = substr($paramString, 0, -1);
    //            $baseString .= rawurlencode($paramString);
              
    //           return $baseString;
    //         }
    // }

    $obj = new callNetsuiteApiNew();
    $url = NETSUITE_URL_SUITETALK.'/services/rest/query/v1/suiteql';
    $mobileNumber = $chat->phone;
    if ($mobileNumber)
    {
      $mobileNumber = '+'.$mobileNumber;
    }
    $arr = array('q' => "SELECT id,firstname,lastname,companyName,lastmodifieddate FROM customer Where phone = '".$mobileNumber."' OR email = '".$chat->email."'");
    $response = $obj->callRestApi($url,$arr);
    $netSuiteLeads=$response;
    if($response && $response['count'])
      $leadsCount=$response['count'];
  
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
/*background-image: url(<?php echo $curURL ?>/create-lead.jpg) !important; */
background-repeat: no-repeat  !important;  
background-size: 20px  !important;
 background-position: 15px center  !important; 
 text-align: left  !important;  
 padding: 12px 15px 12px 15px  !important; 
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

<!-- <ul class="nav nav-tabs suit-crm-tabs-pills" id="myTab" role="tablist"> -->


<!-- <?php if ($isexist) { ?>
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
 
</ul> -->
<div class="tab-content suit-crm-tabs-conent" id="myTabContent">
  <div class="tab-pane fade <?php if ( empty($isexist) ) { echo 'show active' ; } ?>" id="Create-Records-<?php echo $cID; ?>" role="tabpanel" aria-labelledby="Create-Records" style="display: block;opacity: 1;">
    <div class="suit-crm-tabs-conent-inr p-3 row" style="padding-top: 0px !important;">  
           <table class="table table-sm table-new">
            <tr>
              <td style="border-top: none;">Total Score</td>
              <td style="border-top: none;">
                <?php 
                  $sql = "SELECT * FROM `lh_msg` where chat_id = $chat->id and user_id != 0 and msg like '{1}' ORDER BY `lh_msg`.`id` DESC";

                   $raw_results = mysqli_query($conn,$sql);
                        // echo mysqli_num_rows($raw_results);
                   echo $chat->score;
                  ?>
              </td>
            </tr>
            <tr>
              <td>Session Score</td>
              <td>
                <?php 
                   echo $chat->session_score;
                  ?>
              </td>
            </tr>
            <tr>
              <td>Brand *</td>
              <td> <select class="form-control form-control-sm col-sm-8" required id="brand-<?= $chat->id ?>" onclick="selectBrand('<?= $chat->id ?>')">
              <option value="">---</option>
              <option value="brand_aie" <?php if($brand == 'brand_aie'){echo 'selected';}?>>AIE</option>
              <option value="brand_gdc" <?php if($brand == 'brand_gdc'){echo 'selected';}?>>GDC</option>
              <option value="brand_lf"  <?php if($brand == 'brand_lf'){echo 'selected';}?>>Learnfast</option>
              <option value="brand_cadco" <?php if($brand == 'brand_cadco'){echo 'selected';}?>>Cadco</option>
            </select></td>
            </tr>
            <tr>
              <?php 
                if($brand == 'brand_gdc'){
                  $schooldata = [
                      ['value' => 20,'label' => 'Greenside Design Center'],
                  ];
                }elseif($brand == 'brand_aie'){
                  $schooldata = [
                      ['value' => 15,'label' => 'School of Architecture & The Built Environment'],
                      ['value' => 16,'label' => 'School of Business, Entrepreneurship & Finance'],
                      ['value' => 17,'label' => 'School of Draughting & Technical Design'],
                      ['value' => 18,'label' => 'School of Engineering & Science'],
                      ['value' => 19,'label' => 'School of Information Technology & Data Science'],
                      ['value' => 20,'label' => 'School of Visual Design, Marketing & Branding'],
                  ];
                }else{
                  $schooldata = [
                      ['value' => 15,'label' => 'School of Architecture & The Built Environment'],
                      ['value' => 16,'label' => 'School of Business, Entrepreneurship & Finance'],
                      ['value' => 17,'label' => 'School of Draughting & Technical Design'],
                      ['value' => 18,'label' => 'School of Engineering & Science'],
                      ['value' => 19,'label' => 'School of Information Technology & Data Science'],
                      ['value' => 20,'label' => 'School of Visual Design, Marketing & Branding'],
                      ['value' => 20,'label' => 'Greenside Design Center'],
                  ];
                }
                ?>
              <td>Schools</td>
              <td><select class="form-control form-control-sm col-sm-8" required id="school-<?= $chat->id ?>" onclick="selectschool('<?= $chat->id ?>')">
              <option value="">---</option>
              <?php foreach ($schooldata as $value) {?>
              <option value="<?php echo $value['value'];?>"><?php echo $value['label'];?></option>
              <?php }?>
            </select></td>
            </tr>
            <tr>
              <td>Qualification</td>
              <td><select name="netsuite_dropdown_value" class="form-control form-control-sm col-sm-8"  id="netsuite_dropdown-<?= $chat->id ?>" onclick="schoolcheck('<?= $chat->id ?>')">
            <option value="">---</option>
            </select></td>
            </tr>
            <tr>
              <td>Learning Method*</td>
              <td>
                <select class="form-control form-control-sm col-sm-8" required id="learning_method-<?= $chat->id ?>">
                  <option value="">---</option>
                  <option value="1">Full Time, Contact</option>
                  <option value="2">Full Time, Online</option>
                  <option value="3">Part Time, Online</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Intake *</td>
              <td>
                <select name="netsuite_intake" id="netsuite_intake-<?= $chat->id ?>" class="form-control form-control-sm col-sm-8" >
                  <option value="">---</option>
                  <?php 
                  $netsuite_Intake = array('q' => "SELECT id, fullname FROM classification");
                  
                  $objs = new callNetsuiteApiNew();
                  $netsuite_Intake_list = $objs->callRestApi($url,$netsuite_Intake);

                  if($netsuite_Intake_list['count'] > 0){
                    for ($i = 0; $i <$netsuite_Intake_list['count']; $i++) { 
                      $yearname = $netsuite_Intake_list['items'][$i]['fullname'];
                      if($yearname !== '2022 Intake 1' && $yearname !== '2022 Intake 2' && $yearname !== '2022 Intake 3'){
                      ?>   

                    <option value="<?php echo $netsuite_Intake_list['items'][$i]['id']; ?>"><?php echo $netsuite_Intake_list['items'][$i]['fullname']; ?></option>
                    <?php }}


                  }else{
                    echo "no data found";
                  }

                   ?>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Campus *</td>
              <td>
                <select name="netsuite_campus" id="netsuite_campus-<?= $chat->id ?>" class="form-control form-control-sm col-sm-8" >
                  <option value="">---</option>
                  <?php 
                  $netsuite_campus = array('q' => "SELECT name,id FROM CUSTOMRECORD_CSEG_AIE_CAMPUS");
                  
                  $objs = new callNetsuiteApiNew();
                  $netsuite_campus_list = $objs->callRestApi($url,$netsuite_campus);

                  if($netsuite_campus_list['count'] > 0){
                    for ($i = 0; $i <$netsuite_campus_list['count']; $i++) { ?>                    
                    <option value="<?php echo $netsuite_campus_list['items'][$i]['id']; ?>"><?php echo $netsuite_campus_list['items'][$i]['name']; ?></option>
                    <?php }
                  }else{
                    echo "no data found";
                  }

                   ?>
                  </select>
              </td>
            </tr>
             <tr>
              <td>Description</td>
              <td><textarea class="form-control col-sm-10" cols="4" type="text" id="description_<?= $chat->id ?>"> </textarea></td>
            </tr>
           </table>
         <?php if ($isAcount) { ?>    
          <div class="form-group col-sm-7" style="text-align: right;">  
            <input type="button" class="form-control btn btn-create-lead "  value= " Create Opportunity "onclick="createOpp('<?= $chat->id ?>')" /> 
          </div>
          <?php }?>
          <div class="form-group col-sm-5" style="text-align: left;">    
            <input type="button" class="form-control btn btn-create-lead"  value= " Create Lead "onclick="createLead('<?= $chat->id ?>')" /> 
          </div>

          
    </div>
  </div>
  <div class="tab-pane fade" id="Create-Opportunity-<?php echo $cID; ?>" role="tabpanel" aria-labelledby="Create-Opportunity">
    <div class="suit-crm-tabs-conent-inr p-3">  
         
          <div class="form-group">
            <label> Name</label>
            <?php $oppName = $first_name .' '. $last_name .' ('.date("dmyHis").')'; ?>
            <input class="form-control form-control-sm"  type="text" id="name_<?= $chat->id ?>" value="<?php  echo $oppName ?>">
          </div>
          
          
           <div class="form-group">
           <!--  <label for="">Email</label> -->
            <input class="form-control"  type="hidden" id="opp_email_<?= $chat->id ?>" value="<?php  echo $chat->email ?>"> 
          </div> 
       
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control col-sm-10" cols="4" type="text" id="opp_description_<?= $chat->id ?>"> </textarea>
          </div>

            <div class="form-group">    
                  
              <input type="button" class="form-control btn btn-create-lead "  value= " Create Opportunity "onclick="createOpp('<?= $chat->id ?>')" /> 
          </div>
          <?php 
          if(!empty($chat->chat_variables_array)){
            $chat_variables_array = $chat->chat_variables_array;
            $chat_variables = $chat_variables_array['iwh_id'];
          }else{
            $chat_variables = "";
          }
          ?>

          <input type="hidden" value="<?php echo $chat->id ?>" id="chat-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $chat->referrer ?>" id="referrer-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $chat->email ?>" id="oldemail-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $curURL ?>" id="curURL-<?= $chat->id ?>" />
          <?php 
            $arr = array('number' => $chat->phone);
            $urlsalesrep = NETSUITE_URL.'/app/site/hosting/restlet.nl?script=customscriptfindalllinkedtonumber&deploy=1';
            $obj = new callNetsuiteApiNew();
            $netsuite_list = $obj->callRestApi($urlsalesrep,$arr);

            $salesrep = '';

            if(!empty($netsuite_list)){
                if(!empty($netsuite_list['customers'])){
                  foreach($netsuite_list['customers'] as $val){
                    if(!empty($val['salesRepEmail'])){
                      $salesrep = $val['salesRepEmail'];
                      break;
                    }
                  }
                }
            }


          ?>

          <input type="hidden" value="<?php echo (!empty($salesrep))?$salesrep:$assignEmail; ?>" id="assignEmail-<?= $chat->id ?>"/>



          <input type="hidden" value="<?php echo $account_id ?>" id="account_id-<?= $chat->id ?>" />          
          <input type="hidden" value="<?php echo $contact_id ?>" id="contact_id-<?= $chat->id ?>" />
          <input type="hidden" value="<?php echo $chat_variables ?>" id="chat_variables-<?= $chat->id ?>" />
          <!-- <input type="hidden" value="<?php echo $brand ?>" id="brand-<?= $chat->id ?>" /> -->
          
    </div>
  </div>
  <?php if ($isexist || $leadsCount > 0) { ?>
  <div class="tab-pane fade show active" id="Search-Records-<?php echo $cID; ?>" role="tabpanel" aria-labelledby="Search-Records">
    <div class="suit-crm-tabs-conent-inr p-3">  
    <div id="accordion" class="accordion">
        <div class="card mb-0">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                <a class="card-title">
                    Leads (<?php 

                      $suiteCrmLeads=count($detail->results->leads); 
                      $totalLeads=$suiteCrmLeads+$leadsCount;
                      echo $totalLeads;

                    ?>)
                </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion" >
                <div class="card-body">

                   <?php 

                      if($leadsCount > 0 || count($detail->results->leads) >0 ){

                      if($leadsCount > 0){

                        foreach ($netSuiteLeads['items'] as $key => $value) { 
                        
                                  // $leadURLs =  'https://7535324.app.netsuite.com/app/common/entity/custjob.nl?id='.$value['id'].'&e=T';
                                 $leadURLs = NETSUITE_URL_LEAD.'/app/common/entity/custjob.nl?id='.$value['id'];
                                 ?>
                                  <div class="row ">
                                   <a  target="_blank"  href="<?php echo $leadURLs ?> ">Netsuite lead <?php  echo $value['companyname'].' '.$value['lastmodifieddate']; ?></a>
                                 </div>
                               
                                
                       <?php  }

                      }
                      if($detail->results->leads) {  
                              foreach ($detail->results->leads as $key => $value) { 

                                 $leadURL =  $CRMapi.'/index.php?module=Leads&return_module=Leads&action=DetailView&record='.$value[0];    ?>
                                 <div class="row ">
                                   <a  target="_blank"  href="<?php echo $leadURL ?> "><?php  echo $value[1]. ' '.$value[2] ?></a>
                                  <!--  <span> ( <?php echo $value[3] ?> )</span> -->
                                 </div>
                                
                            <?php   } ?>
                                 

                  <?php }} else {
                      echo "No Leads";
                  } ?>
                </div>
            </div>
            
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <a class="card-title">
                  Accounts (<?php if($detail->results->accounts_by_contact) {echo count($detail->results->accounts_by_contact);}else{echo 0;} ?>)
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
                                   <a  target="_blank"  href="<?php echo $accURL ?>"><?php  echo $value[1] ?></a>
                                  
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
                <a class="card-title">Opportunities (<?php if($detail->results->opportunity_by_contact) { echo count($detail->results->opportunity_by_contact);}; ?>)</a>
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
 <!--  <div class="form-group mb-0">  
     <label class="mb-0">Tag</label>  
  </div>
  <div class="form-group list-tab" id="list-tab-<?= $chat->id ?>">    
      <span><input type="text" class="form-control form-control-sm" name="tag" value= "" id="tags-<?= $chat->id ?>" autocomplete="off" onkeyup="tagcheck('<?= $chat->id ?>')"/> </span>
       <div class="list-group" id="show-list-<?= $chat->id ?>">
         
      </div>
  </div> -->
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
     var chat_variables = $("#chat_variables-"+id).val();
     var brand = $("#brand-"+id).val(); 
     var netsuite_dropdown = $("#netsuite_dropdown-"+id).val(); 
     var learning_method = $("#learning_method-"+id).val(); 
     var netsuite_intake = $("#netsuite_intake-"+id).val(); 
     var netsuite_campus = $("#netsuite_campus-"+id).val();
     var department = $("#school-"+id).val(); 
     var chatURL = curURL+ "/index.php/site_admin/chat/single/"+id;

     
     
     var form = new FormData();
     var first_name  = $("#first_name_"+id).val();
     var last_name  = $("#last_name_"+id).val();
     var phone_number = $("#phonenumber_"+id).val();
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

      if (brand == "") {
        errors = errors + "Brand must be filled out \n" ;        
      }

      if (phone_number == "") {
        errors = errors + "phone number must be filled out \n" ;        
      }

      if (netsuite_campus == "") {
        errors = errors + "Campus must be filled out \n" ;        
      }

      if (netsuite_intake == "") {
        errors = errors + "Intake must be filled out \n" ;        
      }

      if (learning_method == "") {
        errors = errors + "Learning Method must be filled out \n" ;        
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
      form.append("chat_variables",chat_variables);
      form.append("brand",brand);
      form.append("custentity_bb1_course",netsuite_dropdown);
      form.append("cseg_aie_del_method",learning_method);
      form.append("custentity_bb1_cust_intake",netsuite_intake);
      form.append("cseg_aie_campus",netsuite_campus);
      form.append("custentity_bb1_cust_department",department);
         
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

    function getNetsuiteLeads(id){
      console.log(id);
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
     var first_name  = $("#first_name_"+id).val();        
     var email = $("#opp_email_"+id).val();
     var cont = $("#messagesBlock-"+id).html(); 
     var description = $("#description_"+id).val();
     var chatURL = curURL+ "/index.php/site_admin/chat/single/"+id;
     
     description = description + ' \r\n ' + referrer + '\r\n' + chatURL ;
      
     var errors = '';

      if (first_name == "") {
        errors = "Name must be filled out \n" ;        
      }
     

      // if (email == "") {
      //   errors = errors + "Email must be filled out \n" ;        
      // }


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


    function selectschool(id) {
      $('#netsuite_dropdown-'+id).html('');
      var department_id = $("#school-"+id).val(); 
      var forms = new FormData();
      forms.append("department_id", department_id);
      
      var settings = {
         "url":  "/createLead.php",
         "method": "POST",            
         "data": forms,
         "action":  'makeBooking',
         processData: false,
         contentType: false
        };

        $.ajax(settings).done(function (response) {
          // console.log(response);
          // alert(response.count);

          const obj = JSON.parse(response);
          // console.log(obj);
            if(obj.count > 0){
              var data = '<option value="">---</option>';
              for (var i = 0; i <= obj.count; i++) {  
               data+='<option value="'+obj.items[i]['id']+'" >'+obj.items[i]['displayname']+'</option>'; 
                
                $('#netsuite_dropdown-'+id).html(data);
              }
             
            } else{
              var data = "<option>No data found<option>";
              $('#netsuite_dropdown-'+id).html(data);
            }

        });

    }

    function schoolcheck(id) {

      var department_id = $("#school-"+id).val();
      if(!department_id){
        alert('Please select first school');
      }


    }

    function selectBrand(id){
      var brand_id = $("#brand-"+id).val();
      var data = '<option>---</option>';
        if(brand_id == 'brand_gdc'){
          data += "<option value = '20'>Greenside Design Center</option>";
        } else if(brand_id == 'brand_aie'){
          data += "<option value = '15'>School of Architecture & The Built Environment</option>";
          data += "<option value = '16'>School of Business, Entrepreneurship & Finance</option>";
          data += "<option value = '17'>School of Draughting & Technical Design</option>";
          data += "<option value = '18'>School of Engineering & Science</option>";
          data += "<option value = '19'>School of Information Technology & Data Science</option>";
          data += "<option value = '20'>School of Visual Design, Marketing & Branding</option>";

        } else{
          data += "<option value = '15'>School of Architecture & The Built Environment</option>";
          data += "<option value = '16'>School of Business, Entrepreneurship & Finance</option>";
          data += "<option value = '17'>School of Draughting & Technical Design</option>";
          data += "<option value = '18'>School of Engineering & Science</option>";
          data += "<option value = '19'>School of Information Technology & Data Science</option>";
          data += "<option value = '20'>School of Visual Design, Marketing & Branding</option>";
          data += "<option value = '20'>Greenside Design Center</option>";
        }
        $('#school-'+id).html(data);
    }

    function tagcheck(id) {
      let searchtag = $("#tags-"+id).val();

      if (searchtag != "") {
        $.ajax({
          url: "/createLead.php",
          method: "post",
          data: {
            searchtag: searchtag,
          },
          success: function (response) {
            if(response !== 'No results'){
               $("#show-list-"+id).html(response).show();
               $("#show-list-"+id+" ul li").addClass('list-data-'+id);
            }else{
              $("#show-list-"+id).html("").hide();
            }
          },
        });
      } else {
        $("#show-list-"+id).html("").hide();
      }
    }
    var quotations = [];
   
    $("body").delegate(".list-data-"+<?= $chat->id ?>+"", "click", function(){
      
        if($(this).html()){
            if($.inArray($(this).html(), quotations) == -1){
              quotations.push($(this).html());
              $("#show-list-"+<?= $chat->id ?>).html("").hide();
              $("#tags-"+<?= $chat->id ?>).val('');
              $("#list-tab-"+<?= $chat->id ?>).prepend("<span class='tag-select'>"+$(this).html()+"<b class='remove-"+<?= $chat->id ?>+"' data-tag="+$(this).html()+">X</b></span>");
            }else{
              $("#show-list-"+<?= $chat->id ?>).html("").hide();
              $("#tags-"+<?= $chat->id ?>).val('');
            }
        }
      
    });

    $("body").delegate(".remove-"+<?= $chat->id ?>+"", "click", function(){
      quotations.splice($.inArray($(this).attr('data-tag'), quotations), 1);
      $(this).closest("span").remove();
    });
 
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
.table-new tr td:nth-child(2) {
    padding-left: 0px;
    width: 69%;
    float: left;
}
.table-new tr td:nth-child(1) {
    width: 31%;
    float: left;
}
.list-tab{position: relative;background-color: #fff;border: 1px solid #ccc;box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);display: inline-block;color: #555;vertical-align: middle;border-radius: 4px;max-width: 100%;line-height: 22px;cursor: text;width: 100%;display: grid;grid-template-columns: repeat(4, 100px);}
.list-tab .list-group{position: absolute;top: 100%;left: 0;z-index: 1000;display: none;float: left;min-width: 200px;padding: 5px 0;margin: 2px 0 0;list-style: none;font-size: 14px;background-color: #ffffff;border: 1px solid rgba(0, 0, 0, 0.15);border-radius: 4px;box-shadow: 0 6px 12px rgb(0 0 0 / 18%);background-clip: padding-box;cursor: auto;}
.list-tab .list-group ul li {list-style: none; padding-left: 10px;}
.list-tab .list-group ul {
    padding-left: 0px;margin-bottom: 0px;}
.list-tab .list-group ul li:hover {
    background-color: #ff7938;color: #fff;}
.list-tab span.tag-select{background: #ced4da;padding: 2px 5px;color: #000;border-radius: 4px;font-size: 13px;height: 20px;margin: 6px 5px;line-height: 14px;overflow: hidden;position: relative;}
.list-tab span.tag-select b {color: #000;font-size: 13px;padding: 0px 3px 0px 5px;position: absolute;right: 0px;background: #ced4da;z-index: 999;top: 3px;cursor: pointer;}
.list-tab input{border: none;width: 300px;}
.list-tab input:focus {border-color: initial;box-shadow: none;}
 </style>




 


