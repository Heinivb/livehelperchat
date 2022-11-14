 <div class="row cst"> 
           
          <div>
               <a class="material-icons mr-0" onclick="lhinst.closeActiveChatDialog('<?php echo $chat->id; ?>' ,$('#tabs'),true)" title="Close chat">close</a>
              <a class="material-icons mr-0" onclick="lhinst.deleteChat('<?php echo $chat->id; ?> ',$('#tabs'),true)" title="Delete chat">delete
              </a> 
              <a class="material-icons mr-0" onclick="lhc.revealModal({'url':WWW_DIR_JAVASCRIPT +'chat/transferchat/<?php echo $chat->id; ?>'})" title="Transfer chat">supervisor_account
              </a>
              <a class="material-icons mr-0 " onclick="lhc.revealModal({'url':WWW_DIR_JAVASCRIPT +'chat/sendmail/<?php echo $chat->id; ?>'})" title="Send mail">mail
              </a>
              <a class="material-icons mr-0" title="Redirect user to contact form." onclick="lhinst.redirectContact('<?php echo $chat->id; ?>','Are you sure?')">reply
              </a>
              <a title="Screen sharing" class="material-icons text-dark" href="#" onclick="return lhinst.startCoBrowse('<?php echo $chat->id; ?>')">visibility
              </a>
          </div>

        	<table class="table table-sm ">
            <?php

            $UID = (int) $chat->session_referrer; 
             
            

            if (empty($UID)) {

                             
              ?>


               <tr>
                    <td>Name</td>
                    <td colspan="3"> <?php  echo $chat->nick ?> </td>
                </tr>
          
               
                 <tr>
                    <td>Email</td>
                    <td colspan="3" ><a href="mailto:<?php echo $chat->email; ?>"><?php  echo $chat->email ?></a></td>
                </tr>

                <tr>
                    <td>Page</td>
                    <td colspan="3" ><a href="<?php echo $chat->referrer ?>"><?php  echo $chat->referrer ?></a></td>
                </tr>


                <tr>
                    <td>Phone Number</td>
                    <td colspan="3" ><input type="text" class="form-control col-sm-8" name="phonenumber" onchange="savePhone(<?php  echo $chat->id ?>)" id="phonenumber_<?php  echo $chat->id ?>" value="<?php  echo $chat->phone ?>" placeholder="Enter Phone number"></td>
                </tr>
             


             <?php }
             
            if ($UID) {
                   
                   //$url = https://portaldev.myway.training/cadcocms/API_MOBILE/view_studentDetails2.php?student_id=6917;

                   $api = "https://www.myaie.ac"; 
                   $Capi = "https://www.crm.aie.ac";  

                  if( $_SERVER['HTTP_HOST'] =='www.livehelper.conceptinteractive.co.za' ) {

                           $api = 'https://portaldev.myway.training';
                           $Capi = 'http://crm1.myway.training';
                  }

               //   $api = "https://www.myaie.ac";
                  //$api = "https://portaldev.myway.training";

                  $url = $api."/cadcocms/API_MOBILE/view_studentDetails2.php?student_id=$UID";

                  // $userDetails = json_decode(file_get_contents($url));

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                     
                    $response = curl_exec($ch);
                    $userDetails = json_decode($response);
                        curl_close($ch);

                     
                   
                   if ($userDetails && isset($userDetails->sudentDetails)) {

                   	     $userDetails = $userDetails->sudentDetails;
                   	     $StudentID =  $userDetails->StudentID;
                         $Student_crm_id =  $userDetails->Student_crm_id; 
                   	     $Email = $userDetails->Email;
                         $name =  $userDetails->FirstName .' '.$userDetails->LastName; 
                         $Mobile = $userDetails->Mobile;
                         
                   	      ?>
                        
                        
               <tr>
						        <td colspan="4">Student Details</td>
						        
						    </tr>

						    <tr>
						        <td>Name</td>
						        <td colspan="3"><a target="_blank" href="<?php echo $api; ?>/cadcocms/students_list_edit_new.php?uid=<?php echo $StudentID ;?>&section=general"><?php echo $name; ?> </a></td>
						    </tr>
					
						     <tr>
						        <td>Student Number</td>
						        <td><a target="_blank" href="<?php echo $api; ?>/cadcocms/students_list_edit_new.php?uid=<?php echo $StudentID ;?>&section=general"><?php echo $Student_crm_id; ?> </a> </td>
						        <td>Phone Number </td>
						        <td><?php echo $Mobile; ?></td>
						    </tr>
						     <tr>
						        <td> Student Email</td>
						        <td colspan="3" ><a href="mailto:<?php echo $Email; ?>"><?php echo $Email; ?></a></td>
						    </tr>
						          
                <?php
                    $getxeroLInk = $Capi."/portalApi/getXeroIDByCRMID.php?authCRM=crmAdmin002&c_id=".$Student_crm_id;
                    $c = curl_init();
                    curl_setopt($c, CURLOPT_URL,$getxeroLInk);
                    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);                     
                    $response = curl_exec($c);
                    $xeroDtails = json_decode($response);
                    curl_close($c);
                    if ($xeroDtails->results) { ?>

                       <tr>
                          <td>Student Xero link</td>
                          <td colspan="3"><a target="_blank" href="<?php echo $xeroDtails->results->xero_link_c ?>"><?php echo $xeroDtails->results->xero_link_c; ?> </a></td>
                      </tr>


                  <?php   }
                ?>

             <?php 

                }
        } ?>
    
        <?php $addData = json_decode($chat->additional_data);
        // echo "<pre>";   
        // $identifier = array_column($addData, 'identifier');
        // $keys = array_column($addData, 'key');
        // $values = array_column($addData, 'value');
      
        
           if ($addData) {

            $catkey = $addData[0]->key;
            $catValue = $addData[0]->value;
            $catID = $addData[1]->value;
            

            $subkey = $addData[2]->key;
            $subValue = $addData[2]->value;
            $subID = $addData[3]->value;
            $ticket = $addData[4];
        ?>
      
       <tr>
         	 	<td>Department </td>
         	 	<td colspan="3" ><?php echo $chat->department; ?></td>
			 </tr> 


       <tr>
            <td><?php echo $catkey; ?> </td>
            <td colspan="3" ><?php echo $catValue; ?></td>
       </tr> 
			  
			 <tr>
         	 	<td> <?php echo $subkey ; ?></td>
         	 	<td colspan="3" >
                    <a target="_blank" href="<?php echo $api; ?>/cadcocms/intakes_list_edit.php?uid=<?php echo $subID ;?>"><?php echo $subValue ?> </a>
         	 		</td>
			 </tr>
      <?php } ?>

      <tr>
            
            <td colspan="4" style=" text-align: center;" >
            <?php if ( $UID && !$ticket ) { ?>

              <input id = "uid_<?= $chat->id ?>" type="hidden" value="<?= $UID ?>" >
              <input id = "subID_<?= $chat->id ?>" type="hidden" value="<?= $subID ?>" >
              <input id = "subValue_<?= $chat->id ?>" type="hidden" value="<?= $subValue ?>" >
              <input id = "dep_id_<?= $chat->id ?>" type="hidden" value="<?= $chat->dep_id ?>" >
              <input id = "department_<?= $chat->id ?>" type="hidden" value="<?= $chat->department ?>" >
              <input id = "catValue_<?= $chat->id ?>" type="hidden" value="<?= $catValue ?>" >
              <input id = "catID_<?= $chat->id ?>" type="hidden" value="<?= $catID ?>" >


              <button  id="myBtn" type="button" onclick="createTicket('<?= $chat->id ?>')"  > 
                      <i class="fal fa-ticket "></i> Convert to Ticket
              </button> 
              <?php } 
              if ($ticket) {

               ?>
               
             <p class="ticketMessage"> 
              Chat has been logged as a ticket number  <a target="_blank" href="<?php echo $api; ?>/cadcocms/ticket_list_add.php?tid=<?php echo $ticket->ticket?>&uid=<?php echo $UID ; ?>" >  <?php echo $ticket->ticket?> </a>.</p>
             
             <?php } ?>
             </td>
       </tr>

       
    </table>


   
     </div>
 
<script type="text/javascript">



    function createTicket(id) {


     var cont = $("#messagesBlock-"+id).html();
     var form = new FormData();
     var uid  = $("#uid_"+id).val();
     var subID = $("#subID_"+id).val();
     var subValue = $("#subValue_"+id).val();
     var dep_id = $("#dep_id_"+id).val();
     var department = $("#department_"+id).val();
     var catValue = $("#catValue_"+id).val();
     var catID = $("#catID_"+id).val();
     
        form.append("chatid", id);
        form.append("studentId", uid);
        form.append("subject_id", subID);
        form.append("subjectName", subValue);
        form.append("dep_id", dep_id);
        form.append("department",department);
        form.append("category", catValue);
        form.append("cat_id", catID);
        form.append("content", cont);
        form.append("conversationFile",'live helper');  

        //console.log(id,uid,subID,subValue,dep_id,department,catValue,catID);
       

        var settings = {
        "url": "/createTicket.php",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
        };

        

        document.getElementById("myBtn").disabled = true;
    
        $.ajax(settings).done(function (response) {
            var obj =  JSON.parse(response);
            var tid = obj.data.ticket_Id;
            var ticketLink = "<?php echo $api; ?>/cadcocms/ticket_list_add.php?tid="+ tid +"&uid="+uid;

            var tMSg = ' This chat was converted into a support ticket with  [html] <a  target="_blank" href="'+ ticketLink + '" > #'+tid +'</a>[/html] and will now be closed.';
            //$("#CSChatMessage-"+<?php //echo $chat->id; ?>).text();
            //var tt = lhinst.addmsgadmin('<?php //echo $chat->id; ?>');
             
            var frm = new FormData();
            frm.append("msg", tMSg);
            var sett = {
              "url": "/index.php/site_admin/chat/addmsgadmin/"+id,
              "method": "POST",
              "timeout": 0,
              "processData": false,
              "mimeType": "multipart/form-data",
              "contentType": false,
              "data": frm
              };
            $.ajax(sett).done(function (response) { 
           
              var frm = new FormData();
              frm.append("chatid", id);
              var sett = {
                    "url": "/closeChat.php",
                    "method": "POST",
                    "timeout": 0,
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": frm
                    };
               setTimeout(function(){ 
                  
                  $.ajax(sett).done(function (response) { location.reload(); });

               }, 5000);
                 
                 
       
            });

        });
	       

    }
       

   function savePhone(id) {


          var phonenumber = $("#phonenumber_"+id).val();
         
          var frm = new FormData();
              frm.append("id", id);
              frm.append("phonenumber", phonenumber);
          var sett = {
              "url": "/savePhone.php",
              "method": "POST",
              "timeout": 0,
              "processData": false,
              "mimeType": "multipart/form-data",
              "contentType": false,
              "data": frm
              };
          $.ajax(sett).done(function (response) {

             });

         }    

</script>

<style type="text/css">
  #myBtn { color: #484644; border: 1px solid #d7dee8; text-align: center; font-size: 22px; font-weight: 600; border-radius: 2px; -webkit-box-shadow: 0px 2px 2.97px 0.03px rgba(125, 125, 125, 0.13); box-shadow: 0px 2px 2.97px 0.03px rgba(125, 125, 125, 0.13); cursor: pointer; padding: 10px 20px; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; margin: 10px auto; text-transform: uppercase; }
  #myBtn i { font-size: 28px; margin-right: 10px; }
  #myBtn:hover { background: #e6ecf2; }
  #myBtn:focus, #myBtn:active { background: #d3dee9; -webkit-box-shadow: none; box-shadow: none; outline: none; }
 div.message-admin div.msg-body a {
    color: #fff;
    text-decoration: underline;
}

.cst a.mr-0 {
    font-size: 21px;   
    width: auto;
    padding: 2px 2px 6px 2px;
}
 
</style>