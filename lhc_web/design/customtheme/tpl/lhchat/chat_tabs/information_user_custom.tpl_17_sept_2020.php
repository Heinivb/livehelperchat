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

        	<table class="table table-sm">
            <?php

            $UID = $chat->session_referrer; 
           // $UID = 1393;  
            
             
            if ($UID) {
                   // for live
                   //$url = "https://www.myaie.ac/cadcocms/API_MOBILE/view_studentDetails2.php?student_id=$UID";

                    $api = "https://www.myaie.ac";
                  // $api = "https://portaldev.myway.training";

                   $url = $api."/cadcocms/API_MOBILE/view_studentDetails2.php?student_id=$UID";

                   $userDetails = json_decode(file_get_contents($url));
                  
                   //echo '<pre>'; print_r($userDetails->sudentDetails);
                   
                   if ($userDetails && isset($userDetails->sudentDetails)) {

                   	     $userDetails = $userDetails->sudentDetails;
                   	     $StudentID =  $userDetails->StudentID; 
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
						        <td><a target="_blank" href="<?php echo $api; ?>/cadcocms/students_list_edit_new.php?uid=<?php echo $StudentID ;?>&section=general"><?php echo $StudentID; ?> </a> </td>
						        <td>Phone Number </td>
						        <td><?php echo $Mobile; ?></td>
						    </tr>
						     <tr>
						        <td> Student Email</td>
						        <td colspan="3" ><a href="mailto:<?php echo $Email; ?>"><?php echo $Email; ?></a></td>
						    </tr>
						          

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
            <?php if ( $UID && !$ticket  ) { ?>
              <button  id="myBtn" type="button" onclick="createTicket()"  > 
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



    function createTicket() {

     var cont = $("#messagesBlock-<?php echo $chat->id; ?>").html();
     var form = new FormData();
        form.append("chatid", "<?php echo $chat->id; ?>");
        form.append("studentId", "<?php echo $UID ?>");
        form.append("subject_id", "<?php echo $subID ;?>");
        form.append("subjectName", "<?php echo $subValue ?>");
        form.append("dep_id", "<?php echo $chat->dep_id ?>");
        form.append("department", "<?php echo $chat->department ?>");
        form.append("category", "<?php echo $catValue ?>");
        form.append("cat_id", "<?php echo $catID ?>");
        form.append("content", cont);
        form.append("conversationFile",'live helper');     

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
            var ticketLink = "<?php echo $api; ?>/cadcocms/ticket_list_add.php?tid="+ tid +"&uid=<?php echo $UID ; ?>";

            var tMSg = ' This chat was converted into a support ticket with  [html] <a  target="_blank" href="'+ ticketLink + '" > #'+tid +'</a>[/html] and will now be closed.';
            //$("#CSChatMessage-"+<?php //echo $chat->id; ?>).text();
            //var tt = lhinst.addmsgadmin('<?php //echo $chat->id; ?>');
             
            var frm = new FormData();
            frm.append("msg", tMSg);
            var sett = {
              "url": "/index.php/site_admin/chat/addmsgadmin/<?php echo $chat->id; ?>",
              "method": "POST",
              "timeout": 0,
              "processData": false,
              "mimeType": "multipart/form-data",
              "contentType": false,
              "data": frm
              };
            $.ajax(sett).done(function (response) { 
           
              var frm = new FormData();
              frm.append("chatid", "<?php echo $chat->id; ?>");
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