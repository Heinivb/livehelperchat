<td ng-repeat="column in lhc.additionalColumns" ng-if="column.cenabl == true && !column.iconm">
    <div class="abbr-list ewew" ng-repeat="val in column.items">
    <i class="material-icons {{chat[val]? 'text-muted' : 'chat-active'}}" style="color: #1d548e;">{{chat[val]? 'whatsapp' : 'chat'}}</i>
    <!-- {{chat[val]}}&nbsp; -->
    </div>
</td>