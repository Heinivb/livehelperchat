<span class="usr-tit<?php echo $msg['user_id'] == 0 ? ' vis-tit' : ' op-tit'?>"<?php if ($msg['user_id'] == 0) : ?> title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncuser','Edit nick');?>" <?php if (!isset($react)) : ?>onclick="lhinst.eNick()"<?php endif;?> role="button"<?php endif;?>>
    <i title="<?php echo htmlspecialchars($chat->nick)?>" class="fal fa-user chat-operators mi-fs15 mr-0 blb90"></i>
    <span class="user-nick-title"><?php echo htmlspecialchars($chat->nick)?></span>
</span>