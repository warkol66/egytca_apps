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
		<a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_objective", "Main.php?do=objectivesStrategicObjectivesShowHistoryX", { method: "get", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true});'>Actual</a>
	</li>
|-if !$objectiveLogsPager->isFirstPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=objectivesStrategicObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$objective->getId()-|", page: "|-$objectiveLogsPager->getPreviousPage()-|"}});'>Anteriores</a>
	</li>
|-/if-| 
|-foreach from=$objectiveLogsPager item=objectiveLog name=for_objectiveLogs-|
	<li class="unactiveTab">
		<a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_objective", "Main.php?do=objectivesStrategicObjectivesShowHistoryX", { method: "get", parameters: { logId: "|-$objectiveLog->getId()-|"}, evalScripts: true});'>|-$objectiveLog->getUpdated()-|</a>
	</li>
|-/foreach-| 
|-if !$objectiveLogsPager->isLastPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=objectivesStrategicObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$objective->getId()-|", page: "|-$objectiveLogsPager->getNextPage()-|"}});'>Siguientes</a>
	</li>
|-/if-|
<li>
	<span>|-$objectiveLogsPager->getFirstIndex()-| - |-$objectiveLogsPager->getLastIndex()-| de |-$objective->getlogCount()-| logs</span>
</li>
<li>
	<span id="status_info" style="display: none">Cargando...</span>
</li>
</ul>