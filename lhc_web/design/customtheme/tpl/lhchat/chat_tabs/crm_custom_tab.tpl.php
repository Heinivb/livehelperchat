<li role="presentation" class="nav-item">
	<a class="nav-link suitecrm_custom_tab <?php if ($chatTabsOrderDefault == 'crm_custom_tab') print ' active';?>"  href="#main-crm-cust-<?php echo $chat->id?>" aria-controls="main-crm-cust-<?php echo $chat->id?>" role="tab" data-toggle="tab" title="Visitor"  ><!-- <img src="/air-colored-white.png" /> --> <img src="https://store.suitecrm.com/assets/img/sites/suitecrm/suite_icon.png" /> </a>
</li>

<style>
.suitecrm_custom_tab {
    padding: 8px;
}

.suitecrm_custom_tab > img {
    width: 80px;
}
.suitecrm_custom_tab.active {
    background: #fff !important;
    border-color: #007bff;
}
</style>



