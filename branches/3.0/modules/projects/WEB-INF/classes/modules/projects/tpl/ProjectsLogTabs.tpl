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
		<a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_project", "Main.php?do=projectsShowHistoryX", { method: "get", parameters: { id: "|-$project->getId()-|"}, evalScripts: true});'>Actual</a>
	</li>
|-if !$projectLogsPager->isFirstPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=projectsUpdateTabsX", { method: "get", parameters: { id: "|-$project->getId()-|", page: "|-$projectLogsPager->getPreviousPage()-|"}});'>Anteriores</a>
	</li>
|-/if-| 
|-foreach from=$projectLogsPager item=projectLog name=for_projectLogs-|
	<li class="unactiveTab">
		<a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_project", "Main.php?do=projectsShowHistoryX", { method: "get", parameters: { logId: "|-$projectLog->getId()-|"}, evalScripts: true});'>|-$projectLog->getUpdated()-|</a>
	</li>
|-/foreach-| 
|-if !$projectLogsPager->isLastPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=projectsUpdateTabsX", { method: "get", parameters: { id: "|-$project->getId()-|", page: "|-$projectLogsPager->getNextPage()-|"}});'>Siguientes</a>
	</li>
|-/if-|
<li>
	<span>|-$projectLogsPager->getFirstIndex()-| - |-$projectLogsPager->getLastIndex()-| de |-$project->getlogCount()-| logs</span>
</li>
<li>
	<span id="status_info" style="display: none">Cargando...</span>
</li>
</ul>