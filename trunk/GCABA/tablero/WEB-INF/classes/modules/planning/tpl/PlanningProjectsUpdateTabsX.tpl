<ul>
|-if !$planningProjectVersionsPager->isFirstPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningProjectsUpdateTabsX", { method: "get", parameters: { id: "|-$planningProject->getId()-|", page: "|-$planningProjectVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
    </li>
|-/if-|
|-foreach from=$planningProjectVersionsPager item=projectVersion name=for_projectVersions-|
    <li class="unactiveTab">
            <a href="#" id='version_|-$projectVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_project", "Main.php?do=planningProjectsShowHistoryX", { method: "get", parameters: { id: "|-$projectVersion->getId()-|", version: "|-$projectVersion->getVersion()-|"}, evalScripts: true});'>|-$projectVersion->getUpdatedAt()-|</a>
    </li>
|-/foreach-|
|-if !$planningProjectVersionsPager->isLastPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningProjectsUpdateTabsX", { method: "get", parameters: { id: "|-$planningProject->getId()-|", page: "|-$planningProjectVersionsPager->getNextPage()-|"}});'>Siguientes</a>
    </li>
|-/if-|

    <li>
        <span>|-$planningProjectVersionsPager->getFirstIndex()-| - |-$planningProjectVersionsPager->getLastIndex()-| de |-$planningProject->countPlanningProjectLogs()-| versiones</span>
    </li>
    <li>
      <span id="status_info" style="display: none" class="inProgress">Cargando...</span>
    </li>
</ul>