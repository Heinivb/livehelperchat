<li role="presentation" class="nav-item">
	<a class="nav-link user_custom_tab <?php if ($chatTabsOrderDefault == 'user_custom_tab') print ' active';?>"  href="#main-user-cust-<?php echo $chat->id?>" aria-controls="main-user-cust-<?php echo $chat->id?>" role="tab" data-toggle="tab" title="Visitor"  ><img src="/air-colored-white.png" /></a>
</li>
<style type="text/css">
.user_custom_tab { padding: 0; width: 45px; height: 42px; overflow: hidden; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; }
.user_custom_tab img { width: 100%; max-width: 36px; margin-top: 36px; }
.user_custom_tab.active img { margin-top: -36px; }
</style>