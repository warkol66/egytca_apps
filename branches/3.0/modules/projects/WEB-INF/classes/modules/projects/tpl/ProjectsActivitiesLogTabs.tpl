<script type="text/javascript" language="JavaScript">
	function selectTab(anchorElement) {
		$$('#tabsLogs ul li.activeTab').each(function(e) {
			e.className = 'unactiveTab';
		});
		anchorElement.parentNode.className = 'activeTab';
	}
</script>

<ul>
	<li class="unactiveTab">
		<a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_activity", "Main.php?do=projectsActivitiesShowHistoryX", { method: "get", parameters: { id: "|-$activity->getId()-|"}, evalScripts: true});'>Actual</a>
	</li>
|-if !$projectActivityLogsPager->isFirstPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=projectsActivitiesUpdateTabsX", { method: "get", parameters: { id: "|-$activity->getId()-|", page: "|-$projectActivityLogsPager->getPreviousPage()-|"}});'>Anteriores</a>
	</li>
|-/if-| 
|-foreach from=$projectActivityLogsPager item=projectActivityLog name=for_projectActivitiesLogs-|
	<li class="unactiveTab">
		<a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_activity", "Main.php?do=projectsActivitiesShowHistoryX", { method: "get", parameters: { logId: "|-$projectActivityLog->getId()-|"}, evalScripts: true});'>|-$projectActivityLog->getUpdated()-|</a>
	</li>
|-/foreach-| 
|-if !$projectActivityLogsPager->isLastPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=projectsActivitiesUpdateTabsX", { method: "get", parameters: { id: "|-$activity->getId()-|", page: "|-$projectActivityLogsPager->getNextPage()-|"}});'>Siguientes</a>
	</li>
|-/if-|
<li>
	<span>|-$projectActivityLogsPager->getFirstIndex()-| - |-$projectActivityLogsPager->getLastIndex()-| de |-$activity->getlogCount()-| logs</span>
</li>
<li>
	<span id="status_info" style="display: none">Cargando...</span>
</li>
</ul>