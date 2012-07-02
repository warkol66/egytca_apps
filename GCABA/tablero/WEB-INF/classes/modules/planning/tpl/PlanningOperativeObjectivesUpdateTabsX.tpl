<ul>
|-if !$operativeObjectiveVersionsPager->isFirstPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=operativeObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$operativeObjective->getId()-|", page: "|-$operativeObjectiveVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
    </li>
|-/if-|
|-foreach from=$operativeObjectiveVersionsPager item=projectVersion name=for_projectVersions-|
    <li class="unactiveTab">
            <a href="#" id='version_|-$projectVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_project", "Main.php?do=operativeObjectivesShowHistoryX", { method: "get", parameters: { id: "|-$projectVersion->getId()-|", version: "|-$projectVersion->getVersion()-|"}, evalScripts: true});'>|-$projectVersion->getUpdatedAt()-|</a>
    </li>
|-/foreach-|
|-if !$operativeObjectiveVersionsPager->isLastPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=operativeObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$operativeObjective->getId()-|", page: "|-$operativeObjectiveVersionsPager->getNextPage()-|"}});'>Siguientes</a>
    </li>
|-/if-|

    <li>
        <span>|-$operativeObjectiveVersionsPager->getFirstIndex()-| - |-$operativeObjectiveVersionsPager->getLastIndex()-| de |-$operativeObjective->countOperativeObjectiveLogs()-| versiones</span>
    </li>
    <li>
        <span id="status_info" style="display: none">Cargando...</span>
    </li>
</ul>