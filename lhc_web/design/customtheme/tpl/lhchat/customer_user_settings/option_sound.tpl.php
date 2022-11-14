<a href="#" onclick="return lhinst.disableChatSoundUser($(this))" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/user_settings','Enable/Disable sound about new messages from the operator');?>">
	<i class="chat-setting-item fal <?php $soundMessageEnabled == 0 ? print ' fa-volume-mute ' : print ' fa-volume-up ' ?>"> </i>
</a>