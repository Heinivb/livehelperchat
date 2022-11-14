<?php


$getSett  = include("settings/settings.ini.php"); 
    
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
<table class="table table-sm mb-0 table-small table-fixed list-chat-table">
    <thead>
    <tr>
        <th width="32%">
            <i title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface','Visitor');?>" class="material-icons">face</i>
        </th>
        <?php include(erLhcoreClassDesign::designtpl('lhchat/lists/additional_column_header.tpl.php'));?>
        <th width="23%">
            <i title="Time ago" class="material-icons">access_time</i>
        </th>
        <th width="15%">
            <i title="Department" class="material-icons">home</i>
        </th>
        <th width="9%">Total Score</th>
        <th width="9%">Session Score</th>
    </tr>
    </thead>
    <tr ng-repeat="chat in bot_chats.list track by chat.id" ng-click="lhc.startChat(chat.id,chat.nick)" ng-class="{'user-away-row': chat.user_status_front == 2, 'user-online-row': !chat.user_status_front}">
        <td>
            <div class="abbr-list"><span ng-if="chat.country_code != undefined"><img ng-src="<?php echo erLhcoreClassDesign::design('images/flags');?>/{{chat.country_code}}.png" alt="{{chat.country_name}}" title="{{chat.country_name}}" />&nbsp;</span><a title="[{{chat.id}}] {{chat.time_created_front}}" ng-click="lhc.previewChat(chat.id, $event)" class="material-icons">info_outline</a><i class="material-icons" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface','Offline request');?>" ng-show="chat.status_sub == 7">mail</i><?php include(erLhcoreClassDesign::designtpl('lhfront/dashboard/panels/bodies/custom_title_multiinclude.tpl.php'));?><span title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface','Number of messages by user');?>">[{{chat.msg_v || 0}}]</span>&nbsp;<i title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface','More than');?> {{lhc.bot_st.msg_nm}} <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface','user messages');?>" ng-show="chat.msg_v > lhc.bot_st.msg_nm" class="material-icons text-warning">whatshot</i><?php include(erLhcoreClassDesign::designtpl('lhchat/lists/icon.tpl.php'));?>{{chat.nick}}</div>
        </td>
        <?php include(erLhcoreClassDesign::designtpl('lhchat/lists/additional_column_body.tpl.php'));?>
        <td>
            <div class="abbr-list" title="{{chat.time_created_front}}">{{chat.time_created_front}}</div>
        </td>

        <td>
            <div class="abbr-list" title="{{chat.department_name}}{{chat.product_name ? ' | '+chat.product_name : ''}}">{{chat.department_name}}{{chat.product_name ? ' | '+chat.product_name : ''}}</div>
        </td>
        <td>
            <?php 
              $sql = "SELECT * FROM `lh_msg` where chat_id = '{{chat.id}}' and user_id != 0 and msg like '{1}' ORDER BY `lh_msg`.`id` DESC";

               // $raw_results = mysqli_query($conn,$sql);
                    // echo mysqli_num_rows($raw_results);
              ?>
              {{chat.score}}
        </td>
        <td>{{chat.session_score}}</td>
    </tr>
</table>
<?php $conn->close();?>