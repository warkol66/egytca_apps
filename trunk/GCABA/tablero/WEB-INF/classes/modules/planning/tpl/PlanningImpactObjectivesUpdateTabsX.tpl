<ul>
|-if !$impactObjectiveVersionsPager->isFirstPage()-|
	<li class="unactiveTab">
			<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningImpactObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$impactObjective->getId()-|", page: "|-$impactObjectiveVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
	</li>
|-/if-|
|-foreach from=$impactObjectiveVersionsPager item=impactObjectiveVersion name=for_impactObjectiveVersions-|
	|-if $impactObjective->getVersion() eq $impactObjectiveVersion->getVersion()-|
	<li class="activeTab">
	|-else-|
	<li class="unactiveTab">
	|-/if-|
			<a href="#" id='version_|-$impactObjectiveVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_impactObjective", "Main.php?do=planningImpactObjectivesShowHistoryX", { method: "get", parameters: { id: "|-$impactObjectiveVersion->getId()-|", version: "|-$impactObjectiveVersion->getVersion()-|"}, evalScripts: true});'>|-$impactObjectiveVersion->getUpdatedAt()|change_timezone|dateTime_format-|</a>
	</li>
|-/foreach-|
|-if !$impactObjectiveVersionsPager->isLastPage()-|
	<li class="unactiveTab">
			<a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningImpactObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$impactObjective->getId()-|", page: "|-$impactObjectiveVersionsPager->getNextPage()-|"}});'>Siguientes</a>
    </li>
|-/if-|
	<li>
		<span>|-$impactObjectiveVersionsPager->getFirstIndex()-| - |-$impactObjectiveVersionsPager->getLastIndex()-| de |-$impactObjective->countImpactObjectiveLogs()-| versiones</span>
	</li>
	<li>
		<span id="status_info" style="display: none" class="inProgress">Cargando...</span>
	</li>
</ul>
