<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_pre_multiinclude.tpl.php'));?>

<?php if ($disabled_department === true) : ?>

<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Department is disabled');?></h1>

<?php elseif (isset($department_invalid) && $department_invalid === true) : ?>

    <?php $errors[] =erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Please provide a department');?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<?php else : ?>

<?php if (!isset($start_data_fields['show_operator_profile']) || $start_data_fields['show_operator_profile'] == false) : ?>
<div class="pl10 max-width-180 float-right absolute-language-top-right">
	<?php $rightLanguage = true;?>
	<?php include(erLhcoreClassDesign::designtpl('pagelayouts/parts/switch_language.tpl.php'));?>
</div>
<?php endif;?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/getstatus/widget_geo_adjustment.tpl.php'));?>
<?php if ($exitTemplate == true) return; ?>

<?php $isOnlineGeneral = erLhcoreClassChat::isOnline($department, false, array('ignore_user_status'=> (int)erLhcoreClassModelChatConfig::fetch('ignore_user_status')->current_value, 'online_timeout' => (int)erLhcoreClassModelChatConfig::fetch('sync_sound_settings')->data['online_timeout']))?>

<?php if ($leaveamessage == false || ($forceoffline === false && $isOnlineGeneral === true)) : ?>


<?php if ($isOnlineGeneral === false) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhchat/chat_not_available.tpl.php'));?>
<?php else : ?>

<?php if (isset($start_data_fields['pre_chat_html']) && $start_data_fields['pre_chat_html'] != '') : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/pre_chat_html.tpl.php'));?>
<?php endif?>

<?php $onlyBotOnline = erLhcoreClassChat::isOnlyBotOnline($department); ?>

<?php if (isset($start_data_fields['show_operator_profile']) && $start_data_fields['show_operator_profile'] == true) : ?>
<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/operator_profile_start_chat.tpl.php'));?>
<?php endif;?>

<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_pre_form_multiinclude.tpl.php'));?>

<?php $hasExtraField = false;

if ($theme !== false && $theme->explain_text != '' && $onlyBotOnline == false) : ?>
<p class="start-chat-intro"><?php echo erLhcoreClassBBCode::make_clickable(htmlspecialchars($theme->explain_text))?></p>
<?php endif;?>

<?php if (isset($theme) && $theme !== false && isset($theme->bot_configuration_array['custom_html_widget']) && !empty($theme->bot_configuration_array['custom_html_widget']) && $onlyBotOnline == false) : ?>
       <?php echo $theme->bot_configuration_array['custom_html_widget']?>
<?php elseif (isset($theme) && $theme !== false && isset($theme->bot_configuration_array['custom_html_widget_bot']) && !empty($theme->bot_configuration_array['custom_html_widget_bot']) && $onlyBotOnline == true) : ?>
    <?php echo $theme->bot_configuration_array['custom_html_widget_bot']?>
<?php elseif (isset($theme) && $theme !== false && isset($theme->bot_configuration_array['trigger_id']) && !empty($theme->bot_configuration_array['trigger_id']) && $theme->bot_configuration_array['trigger_id'] > 0) :  ?>
    <?php include(erLhcoreClassDesign::designtpl('lhchat/part/render_intro.tpl.php'));?>
<?php endif;?>

<?php if (isset($theme) && $theme !== false && isset($theme->bot_configuration_array['inject_html']) && !empty($theme->bot_configuration_array['inject_html'])) : ?>
            <script>lhinst.sendHTML(<?php echo $theme->id?>,{'type':'theme','id':0});</script>
<?php endif; ?>

<form method="post" id="form-start-chat" action="<?php echo erLhcoreClassDesign::baseurl('chat/chatwidget')?><?php echo $append_mode?><?php $department !== false ? print '/(department)/'.$department : ''?><?php $input_data->priority !== false ? print '/(priority)/'.$input_data->priority : ''?><?php $input_data->vid !== false ? print '/(vid)/'.htmlspecialchars($input_data->vid) : ''?><?php $input_data->hash_resume !== false ? print '/(hash_resume)/'.htmlspecialchars($input_data->hash_resume) : ''?><?php $leaveamessage == true ? print '/(leaveamessage)/true' : ''?><?php $forceoffline == true ? print '/(offline)/true' : ''?><?php echo $append_mode_theme?>" onsubmit="return <?php if (isset($start_data_fields['message_auto_start']) && $start_data_fields['message_auto_start'] == true) : ?>lhinst.prestartChat('<?php echo time()?>',$(this))<?php else : ?>lhinst.addCaptchaSubmit('<?php echo time()?>',$(this))<?php endif?>">

<?php if (isset($start_data_fields['message_visible_in_page_widget']) && $start_data_fields['message_visible_in_page_widget'] == true && isset($start_data_fields['show_messages_box']) && $start_data_fields['show_messages_box'] == true) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhchat/startchatformsettings/presend.tpl.php'));?>
<?php endif;?>

<?php $formResubmitId = 'form-start-chat'; ?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/auto_resubmit.tpl.php'));?>

<input type="hidden" name="onlyBotOnline" value="<?php echo $onlyBotOnline == true ? 1 : 0?>">

<div class="row">
    <?php if (isset($start_data_fields['name_visible_in_page_widget']) && $start_data_fields['name_visible_in_page_widget'] == true) : $hasExtraField = true;?>
    
    <?php if (isset($start_data_fields['name_hidden']) && $start_data_fields['name_hidden'] == true) : ?>
	<input type="hidden" name="Username" value="<?php echo htmlspecialchars($input_data->username);?>" />
	<?php else : ?>	
		<?php if (in_array('username', $input_data->hattr)) : ?>
			<input type="hidden" name="Username" value="<?php echo htmlspecialchars($input_data->username);?>" />
		<?php elseif (!($onlyBotOnline == true && isset($start_data_fields['name_hidden_bot']) && $start_data_fields['name_hidden_bot'] == true)) : ?>
		    <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/form_parts/name_hidden.tpl.php'));?>
	    <?php endif; ?>    
    <?php endif; ?>
    
    <?php endif; ?>

    <?php if (isset($start_data_fields['email_visible_in_page_widget']) && $start_data_fields['email_visible_in_page_widget'] == true) : $hasExtraField = true;?>
    
    <?php if (isset($start_data_fields['email_hidden']) && $start_data_fields['email_hidden'] == true) : ?>
	<input type="hidden" name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
	<?php else : ?>
		<?php if (in_array('email', $input_data->hattr)) : ?>
			<input type="hidden" name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
		<?php elseif (!($onlyBotOnline == true && isset($start_data_fields['email_hidden_bot']) && $start_data_fields['email_hidden_bot'] == true)) : ?>
	    <div class="col-6 form-group">
	        <label class="col-form-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','E-mail');?><?php if (isset($start_data_fields['email_require_option']) && $start_data_fields['email_require_option'] == 'required') : ?>*<?php endif;?></label>
	        <input <?php if (!(isset($is_embed_mode) && $is_embed_mode ==true)) :?><?php endif;?> class="form-control form-control-sm<?php if (isset($errors['email'])) : ?> is-invalid<?php endif;?>" aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your email address')?>" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your email address')?>" <?php if (isset($start_data_fields['email_require_option']) && $start_data_fields['email_require_option'] == 'required') : ?>aria-required="true" required<?php endif;?> type="text" id='email_cust' name="Email" value="<?php echo htmlspecialchars($input_data->email);?>" />
	    </div>
	   
	    <?php endif; ?>
    <?php endif; ?>
    
    <?php endif; ?>
</div>

<?php if (isset($start_data_fields['phone_visible_in_page_widget']) && $start_data_fields['phone_visible_in_page_widget'] == true) : $hasExtraField = true;?>
<?php if (isset($start_data_fields['phone_hidden']) && $start_data_fields['phone_hidden'] == true) : ?>
<input type="hidden" name="Phone" value="<?php echo htmlspecialchars($input_data->phone);?>" />
<?php else : ?>
		<?php if (in_array('phone', $input_data->hattr)) : ?>
		<input type="hidden" name="Phone" value="<?php echo htmlspecialchars($input_data->phone);?>" />
		<?php elseif (!($onlyBotOnline == true && isset($start_data_fields['phone_hidden_bot']) && $start_data_fields['phone_hidden_bot'] == true)) : ?>
		<div class="form-group">
		  <label class="col-form-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Phone');?><?php if (isset($start_data_fields['phone_require_option']) && $start_data_fields['phone_require_option'] == 'required') : ?>*<?php endif;?></label>
		  <input <?php if (!(isset($is_embed_mode) && $is_embed_mode ==true)) :?><?php endif;?> <?php if (isset($start_data_fields['phone_require_option']) && $start_data_fields['phone_require_option'] == 'required') : ?>aria-required="true" required<?php endif;?> aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your phone')?>" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your phone')?>" class="form-control form-control-sm<?php if (isset($errors['phone'])) : ?> is-invalid<?php endif;?>" aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your phone')?>" type="text" name="Phone" value="<?php echo htmlspecialchars($input_data->phone);?>" />
		</div>
		<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php $canReopen = erLhcoreClassModelChatConfig::fetch('reopen_chat_enabled')->current_value == 1 && ($reopenData = erLhcoreClassChat::canReopenDirectly(array('reopen_closed' => erLhcoreClassModelChatConfig::fetch('allow_reopen_closed')->current_value))) !== false; ?>



<?php $adminCustomFieldsMode = 'on';?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/admin_form_variables.tpl.php'));?>



 <div class="col-12 form-group custom_fields">

             <div class="inptTickt fields1">
               
                 <?php if ($department === false) : ?>
                <?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/department.tpl.php'));?>
              <?php endif;?>

            </div>
            
            <?php 

           
            $userD = @$_REQUEST['userD'];
            $userD = explode('_', $userD);
            $UID = $userD[2];
           // $UID = 6917;         
            $sublist = array();
            if ($UID) {

                  
                  $api = "https://www.myaie.ac";

                  if (  strpos( $_SERVER['HTTP_REFERER'] , "portaldev.myway.training" ) !== false )    { 

                        $api = "https://portaldev.myway.training";

                  }

                 
                 
                   $link = $api.'/cadcocms/API_MOBILE/getStudentSubject.php?studentId='.$UID;
                   //$link = 'https://www.myaie.ac/cadcocms/API_MOBILE/getStudentSubject.php?studentId='.$UID;

                    
                   //$sublist = json_decode(file_get_contents($link));

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$link);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                     
                    $response = curl_exec($ch);
                    $sublist = json_decode($response);

                    $sublist = $sublist->subjectList[0];
                    
                   
                    
               }
                   
                   

            ?>

            <?php if ($UID) { ?> 
            <div class="inptTickt fields2">
                <!-- <label class="ticktLable">Category<span>*</span></label> -->
                <div class="inptflid">
                  <select onchange="myCat()" name="value_items_admin[0]" id="category" class="form-control" required>
                    <option value="">Choose Category</option>
                  </select>
                  <select  name="value_items_admin[1]" id="category_id" style="display:none"></select>
                </div>
            </div> 
          <?php  }?>

             <?php if ($UID) { ?> 
                <div class="inptTickt fields3">
                    <label class="ticktLable">Subject<span>*</span></label>
                    <div class="inptflid">
    					<select onchange="mySub()" name="value_items_admin[2]" id="Subject" class="form-control" required>
    						<option value="">Choose </option>
    						<?php foreach ($sublist as $key => $v) { ?>
    						
                                <option value="<?php echo $v->courseName ?>">
                                 <?php echo $v->courseName ?> </option>
    						<?php } ?>
    					</select>


             <select name="value_items_admin[3]" id="SubjectId" style="display:none">
                <option value=""></option>
                <?php foreach ($sublist as $key => $v) { ?>
                                
                                <option value="<?php echo $v->intakeID ?>">
                                 <?php echo $v->intakeID ?> </option>
                <?php } ?>
              </select>
             
                   </div>
            </div>
             <?php }  ?> 
	</div>

  <?php   $ishold = 0;  
  if ( strpos( $_SERVER['HTTP_REFERER'] , "-student-login.html" ) !== false  )    { $ishold = 1; } ?>
 
  <?php if ($ishold) { ?> 

     <style type="text/css"> 
           #id_DepartamentID option[value='3'],#id_DepartamentID option[value='4'],#id_DepartamentID option[value=''] {display: none;}
    </style>

  <?php } else { ?>
  
   <style type="text/css"> 
    #id_DepartamentID option[value='5'] {display: none;}
  </style>

  <?php } ?>
  
 
  <script type="text/javascript">


        var ishold = '<?php echo $ishold ?>';
        var api ="<?php echo $api; ?>";
        var link =api+'/cadcocms/API_MOBILE/getDepartmentCategories.php?dep_id=';

        if (ishold=='1') { 

            setTimeout (function(){
              document.getElementById('id_DepartamentID').selectedIndex = 1 ;
              myFunction();
            },50)
            


         }

        function mySub() {
          var subject = document.getElementById('Subject');
          var x = subject.selectedIndex;
          document.getElementById("SubjectId").selectedIndex = x;
        }
         
        function myCat() {
          var category = document.getElementById('category');
          var y = category.selectedIndex;         
          document.getElementById("category_id").selectedIndex = y;
        }

        document.getElementById("id_DepartamentID").onchange = function() { myFunction();
        };

        var department = document.getElementById('id_DepartamentID');
        var opt = document.createElement('option');
        opt.value = '';
        opt.innerHTML = 'Choose Department';        
        department.insertBefore(opt, department.childNodes[0]); 
        department.selectedIndex = 0; 
        department.setAttribute("required", "required");
        
        //myFunction();

        function myFunction() {

          var department = document.getElementById('id_DepartamentID');
          var x = department.value;
          var ajaxlink = link+x;
         

          var settings = {
              "url": ajaxlink,
              "method": "GET"            
              };
          select = document.getElementById('category');  
          selectId = document.getElementById('category_id');  
          var length = select.options.length;
          for (i = length-1; i >= 0; i--) {
               select.options[i] = null;
               selectId.options[i] = null;
            }  

            var opt = document.createElement('option');
            opt.value = '';
            opt.innerHTML = 'Choose Category';
            select.appendChild(opt); 

            var optId = document.createElement('option');
            optId.value = '';
            optId.innerHTML = '';
            selectId.appendChild(optId); 
           
           $.ajax(settings).done(function (response) {

                  var obj =  response.categoryList;
                  
                      for (var i = 0; i<= (obj.length-1); i++){
                          var opt = document.createElement('option');
                          opt.value = obj[i].title;
                          opt.innerHTML = obj[i].title;
                          select.appendChild(opt);

                          var optId = document.createElement('option');
                          optId.value = obj[i].id;
                          optId.innerHTML = obj[i].id;
                          selectId.appendChild(optId);
                      } 

                  if (ishold=='1') { 

                      setTimeout (function(){
                        document.getElementById('category').selectedIndex = 3 ; 
                        myCat();                       
                      },50)
                      


                   }

             });

      } 
         

  </script>
  <style>
    .widget-chat  li:nth-child(even) {
        display: none;
      }
  </style>

<?php if (isset($start_data_fields['message_visible_in_page_widget']) && $start_data_fields['message_visible_in_page_widget'] == true) : ?>
<?php if (isset($start_data_fields['message_hidden']) && $start_data_fields['message_hidden'] == true) : $hasExtraField = true; ?>



<div id="ChatMessageContainer">
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_text_area_send_button.tpl.php'));?>
<textarea class="hide" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your message');?>" name="Question"><?php echo htmlspecialchars($input_data->question);?></textarea>
</div>

<?php elseif (!($onlyBotOnline == true && isset($start_data_fields['message_hidden_bot']) && $start_data_fields['message_hidden_bot'] == true)) : ?>
<div class="<?php if (isset($errors['question'])) : ?> is-invalid<?php endif;?>">
<?php if (!isset($start_data_fields['hide_message_label']) || $start_data_fields['hide_message_label'] == false) : ?><label class="col-form-label"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Your question');?><?php if (isset($start_data_fields['message_require_option']) && $start_data_fields['message_require_option'] == 'required') : ?>*<?php endif;?></label><?php endif;?>
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_text_area_user_start_chat.tpl.php'));?>

<div id="ChatMessageContainer">
<?php include(erLhcoreClassDesign::designtpl('lhchat/part/above_text_area_send_button.tpl.php'));?>
<textarea <?php if (!(isset($is_embed_mode) && $is_embed_mode ==true)) :?><?php endif;?> class="form-control form-control-sm form-group <?php if ($hasExtraField !== true && $canReopen !== true) : ?>btrad-reset<?php endif;?>" <?php if (isset($start_data_fields['user_msg_height']) && $start_data_fields['user_msg_height'] > 0) : ?>style="height: <?php echo $start_data_fields['user_msg_height']?>px"<?php endif;?> aria-label="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Enter your message');?>" placeholder="<?php if (isset($theme) && $theme !== false && isset($theme->bot_configuration_array['placeholder_message']) && !empty($theme->bot_configuration_array['placeholder_message'])) : ?><?php echo htmlspecialchars($theme->bot_configuration_array['placeholder_message']); else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/startchat','Type your message here and hit enter to send...');?><?php endif;?>" <?php if (isset($start_data_fields['message_require_option']) && $start_data_fields['message_require_option'] == 'required') : ?>aria-required="true" required<?php endif;?> id="id_Question" name="Question"><?php echo htmlspecialchars($input_data->question);?></textarea>
</div>

<?php include(erLhcoreClassDesign::designtpl('lhchat/part/below_text_area_user_start_chat.tpl.php'));?>
</div>
<?php else : $hasExtraField = true; endif; ?>
<?php else : $hasExtraField = true; endif; ?>

<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/user_variables.tpl.php'));?>

<!-- <?php //if ($department === false) : ?>
	<?php //include_once(erLhcoreClassDesign::designtpl('lhchat/part/department.tpl.php'));?>
<?php //endif;?> -->

<?php include(erLhcoreClassDesign::designtpl('lhchat/part/product.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/part/user_timezone.tpl.php'));?>

<?php $tosVariable = 'tos_visible_in_page_widget';$tosCheckedVariable = 'tos_checked_online';?>
<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/accept_tos.tpl.php'));?>

<?php if ($hasExtraField == true || $canReopen == true) : ?>
<div class="btn-group" role="group" aria-label="...">  
  <?php if ($hasExtraField === true) : ?>
  <?php include(erLhcoreClassDesign::designtpl('lhchat/part/buttons/start_chat_button_widget.tpl.php'));?>
  <?php endif;?>
  
  <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget_button_multiinclude.tpl.php'));?>
  
  <?php if ( $canReopen == true ) : ?>
  <?php include(erLhcoreClassDesign::designtpl('lhchat/part/buttons/reopen_button_widget.tpl.php'));?>
  <?php endif; ?>
</div>
<?php endif;?>

<input type="hidden" value="<?php echo htmlspecialchars($referer);?>" name="URLRefer" />
<input type="hidden" id='r_cust' value="<?php echo htmlspecialchars($referer_site);?>" name="r" />
<input type="hidden" value="<?php echo htmlspecialchars($input_data->operator);?>" name="operator" />
<input type="hidden" value="1" name="StartChat"/>
<?php if ($hasExtraField === true) : ?>
    <input type="hidden" value="1" id="hasFormExtraField"/>
<?php endif;?>
</form>

<?php if (isset($start_data_fields['pre_chat_html']) && $start_data_fields['pre_chat_html'] != '') : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/post_chat_html.tpl.php'));?>
<?php endif?>

<?php include_once(erLhcoreClassDesign::designtpl('lhchat/part/switch_to_offline.tpl.php'));?>

<?php if ($hasExtraField === false) : ?>
<script>
<?php if ($canReopen == false) : ?>
jQuery('#id_Question').addClass('mb-0');
<?php endif;?>

<?php if ($hasExtraField == false && isset($start_data_fields['message_auto_start']) && $start_data_fields['message_auto_start'] == true && isset($start_data_fields['message_auto_start_key_press']) && $start_data_fields['message_auto_start_key_press'] == true) : ?>
$('#id_Question').on('keydown', function (e) {
	if ($( "#form-start-chat").attr("key-up-started") != 1) {
    	$( "#form-start-chat").attr("key-up-started",1);
    	$( "#form-start-chat").submit();	
	}
});
<?php endif;?>

var formSubmitted = false;
jQuery('#id_Question').bind('keydown', 'return', function (evt){
	if (formSubmitted == false) {
		$( "#form-start-chat" ).submit();	
		<?php if (!isset($start_data_fields['message_auto_start']) || $start_data_fields['message_auto_start'] == false) : ?>
		formSubmitted = true;
		jQuery('#id_Question').attr('readonly','readonly');		
		<?php endif;?>
	};
	return false;	
});
</script>
<?php endif;?>

<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_post_multiinclude.tpl.php'));?>

<?php endif;?>

<?php else : ?>

    <?php if (isset($start_data_fields['pre_offline_chat_html']) && $start_data_fields['pre_offline_chat_html'] != '') : ?>
        <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/pre_offline_chat_html.tpl.php'));?>
    <?php endif?>

	<?php if (isset($start_data_fields['show_operator_profile']) && $start_data_fields['show_operator_profile'] == true) : ?>
	
		<div class="pl10 position-relative float-right">
		<?php $rightLanguage = true;?>
		<?php include(erLhcoreClassDesign::designtpl('pagelayouts/parts/switch_language.tpl.php'));?>
		</div>
	
	<?php endif;?>

	<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
	<?php endif; ?>
	
	<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_pre_offline_form_multiinclude.tpl.php'));?>

	<?php include(erLhcoreClassDesign::designtpl('lhchat/offline_form.tpl.php'));?>

    <?php if (isset($start_data_fields['pre_offline_chat_html']) && $start_data_fields['pre_offline_chat_html'] != '') : ?>
        <?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/post_offline_chat_html.tpl.php'));?>
    <?php endif?>

	<?php include(erLhcoreClassDesign::designtpl('lhchat/chatwidget/chatwidget_post_offline_form_multiinclude.tpl.php'));?>

<?php endif;?>



<?php endif;?>