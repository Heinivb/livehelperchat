<div class="row">
	<div class="col-sm-7 chat-main-left-column" id="chat-main-column-<?php echo $chat->id;?>">

        <span class="last-user-msg" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/chat','Last visitor message time')?>"><i class="material-icons">access_time</i><span id="last-msg-chat-<?php echo $chat->id?>">...</span></span>

		<a title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/chat','Show/Hide right column')?>" href="#" class="material-icons collapse-right" onclick="lhinst.processCollapse('<?php echo $chat->id;?>')">chevron_right</a>
		<?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_messages_block.tpl.php')); ?>

		<div class="message-block">
            <?php $LastMessageID = 0; $messages = erLhcoreClassChat::getChatMessages($chat->id, erLhcoreClassChat::$limitMessages); ?>

            <?php include(erLhcoreClassDesign::designtpl('lhchat/part/load_previous.tpl.php'));?>

			<div class="msgBlock msgBlock-admin" id="messagesBlock-<?php echo $chat->id?>">
				<?php include(erLhcoreClassDesign::designtpl('lhchat/syncadmin.tpl.php'));?>
				<?php if (isset($msg)) {	$LastMessageID = $msg['id'];} ?>

				<?php if ($chat->user_status == 1) : ?>
				<?php include(erLhcoreClassDesign::designtpl('lhchat/userleftchat.tpl.php')); ?>
				<?php elseif ($chat->user_status == 0) : ?>
				<?php include(erLhcoreClassDesign::designtpl('lhchat/userjoined.tpl.php')); ?>
				<?php endif;?>
			</div>
			
		</div>

		<?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_textarea.tpl.php')); ?>
		
		<div class="user-is-typing" id="user-is-typing-<?php echo $chat->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/chat','User is typing now...')?></div>
		
		<div class="message-container-admin">
            <?php $bbcodeOptions = array('selector' => '#CSChatMessage-' . $chat->id) ?>
            <?php include(erLhcoreClassDesign::designtpl('lhchat/part/toolbar_text_area.tpl.php')); ?>
		<textarea <?php !erLhcoreClassChat::hasAccessToWrite($chat) ? print 'readonly="readonly"' : '' ?> placeholder="<?php if ($chat->user_id != erLhcoreClassUser::instance()->getUserID()) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/chat','You are not chat owner, type with caution')?><?php endif;?>" class="form-control form-control-sm form-group<?php if ($chat->user_id != erLhcoreClassUser::instance()->getUserID()) : ?> form-control-warning<?php endif;?>" rows="2" <?php if ($chat->status == erLhcoreClassModelChat::STATUS_CLOSED_CHAT) : ?>readonly="readonly"<?php endif;?> name="ChatMessage" id="CSChatMessage-<?php echo $chat->id?>"></textarea>
        </div>
        
		<?php include(erLhcoreClassDesign::designtpl('lhchat/part/after_text_area_block.tpl.php')); ?>

	</div>
	<div class="col-sm-5 chat-main-right-column" id="chat-right-column-<?php echo $chat->id;?>">
        <div class="row"> 
            <?php

            $UID = $chat->session_referrer; 
            //$UID = 1393;         

            if ($UID) {
                   $url = "https://www.myaie.ac/cadcocms/API_MOBILE/view_studentDetails2.php?student_id=$UID";
                   $userDetails = json_decode(file_get_contents($url));
                  
                   //echo '<pre>'; print_r($userDetails->sudentDetails);
                   
                   if ($userDetails && isset($userDetails->sudentDetails)) {

                   	     $userDetails = $userDetails->sudentDetails;
                   	     $StudentID =  $userDetails->StudentID; 
                   	     $Email = $userDetails->Email;
                         $name =  $userDetails->FirstName .' '.$userDetails->LastName; 
                         $Mobile = $userDetails->Mobile;
                         
                   	      ?>
                        
                        <table class="table table-sm">
                        	<tr>
						        <td colspan="4">Student Details</td>
						        
						    </tr>

						    <tr>
						        <td>Name</td>
						        <td colspan="3"><a target="_blank" href="https://www.myaie.ac/cadcocms/students_list_edit_new.php?uid=<?php echo $StudentID ;?>&section=general"><?php echo $name; ?> </a></td>
						    </tr>
						  <!--<tr>-->
						  <!--      <td>Profile URL</td>-->
						  <!--      <td> https://www.myaie.ac/cadcocms/students_list_edit_new.php?section=general&uid=<?php echo $StudentID ;?> </td>-->
						  <!--  </tr>-->
						     <tr>
						        <td>Student Number</td>
						        <td><?php echo $StudentID; ?></td>
						        <td>Phone Number </td>
						        <td><?php echo $Mobile; ?></td>
						    </tr>
						     <tr>
						        <td> Student Email</td>
						        <td colspan="3" ><?php echo $Email; ?></td>
						    </tr>
						                               
					</table>


             <?php    }

                   

        } 


    ?> 
     </div>

		<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/chat_tabs_container.tpl.php')); ?>
	</div>
</div>

<script type="text/javascript">lhinst.addAdminChatFinished(<?php echo $chat->id;?>,<?php echo $LastMessageID?>,<?php isset($arg) ? print json_encode($arg) : print 'null'?>);</script>
