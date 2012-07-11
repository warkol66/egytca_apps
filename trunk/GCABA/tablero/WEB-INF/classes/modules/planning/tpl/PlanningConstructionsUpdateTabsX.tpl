<ul>
|-if !$planningConstructionVersionsPager->isFirstPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningConstructionsUpdateTabsX", { method: "get", parameters: { id: "|-$planningConstruction->getId()-|", page: "|-$planningConstructionVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
	</li>
|-/if-|
|-foreach from=$planningConstructionVersionsPager item=planningConstructionVersion name=for_planningConstructionVersions-|
	|-if $planningConstruction->getVersion() eq $planningConstructionVersion->getVersion()-|
	<li class="activeTab">
	|-else-|
	<li class="unactiveTab">
	|-/if-|
		<a href="#" id='version_|-$planningConstructionVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_planningConstruction", "Main.php?do=planningConstructionsShowHistoryX", { method: "get", parameters: { id: "|-$planningConstructionVersion->getId()-|", version: "|-$planningConstructionVersion->getVersion()-|"}, evalScripts: true});'>|-$planningConstructionVersion->getUpdatedAt()|change_timezone|dateTime_format-|</a>
	</li>
|-/foreach-|
|-if !$planningConstructionVersionsPager->isLastPage()-|
	<li class="unactiveTab">
		<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningConstructionsUpdateTabsX", { method: "get", parameters: { id: "|-$planningConstruction->getId()-|", page: "|-$planningConstructionVersionsPager->getNextPage()-|"}});'>Siguientes</a>
	</li>
|-/if-|
	<li>
		<span>|-$planningConstructionVersionsPager->getFirstIndex()-| - |-$planningConstructionVersionsPager->getLastIndex()-| de |-$planningConstruction->countPlanningConstructionLogs()-| versiones</span>
	</li>
	<li>
		<span id="status_info" style="display: none" class="inProgress">Cargando...</span>
	</li>
</ul>