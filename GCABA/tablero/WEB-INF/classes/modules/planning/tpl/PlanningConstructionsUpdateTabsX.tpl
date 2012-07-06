<ul>
|-if !$planningConstructionVersionsPager->isFirstPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningConstructionsUpdateTabsX", { method: "get", parameters: { id: "|-$planningConstruction->getId()-|", page: "|-$planningConstructionVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
    </li>
|-/if-|
|-foreach from=$planningConstructionVersionsPager item=projectVersion name=for_projectVersions-|
    <li class="unactiveTab">
            <a href="#" id='version_|-$projectVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_project", "Main.php?do=planningConstructionsShowHistoryX", { method: "get", parameters: { id: "|-$projectVersion->getId()-|", version: "|-$projectVersion->getVersion()-|"}, evalScripts: true});'>|-$projectVersion->getUpdatedAt()-|</a>
    </li>
|-/foreach-|
|-if !$planningConstructionVersionsPager->isLastPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningConstructionsUpdateTabsX", { method: "get", parameters: { id: "|-$planningConstruction->getId()-|", page: "|-$planningConstructionVersionsPager->getNextPage()-|"}});'>Siguientes</a>
    </li>
|-/if-|

    <li>
        <span>|-$planningConstructionVersionsPager->getFirstIndex()-| - |-$planningConstructionVersionsPager->getLastIndex()-| de |-$planningConstruction->countPlanningProjectLogs()-| versiones</span>
    </li>
    <li>
      <span id="status_info" style="display: none" class="inProgress">Cargando...</span>
    </li>
</ul>