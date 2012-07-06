<ul>
|-if !$operativeObjectiveVersionsPager->isFirstPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningOperativeObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$operativeObjective->getId()-|", page: "|-$operativeObjectiveVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
    </li>
|-/if-|
|-foreach from=$operativeObjectiveVersionsPager item=operativeObjectiveVersion name=for_operativeObjectiveVersions-|
        |-if $operativeObjective->getVersion() eq $operativeObjectiveVersion->getVersion()-|
        <li class="activeTab">
        |-else-|
        <li class="unactiveTab">
        |-/if-|
            <a href="#" id='version_|-$operativeObjectiveVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_operativeObjective", "Main.php?do=planningOperativeObjectivesShowHistoryX", { method: "get", parameters: { id: "|-$operativeObjectiveVersion->getId()-|", version: "|-$operativeObjectiveVersion->getVersion()-|"}, evalScripts: true});'>|-$operativeObjectiveVersion->getUpdatedAt()|change_timezone|dateTime_format-|</a>
        </li>
|-/foreach-|
|-if !$operativeObjectiveVersionsPager->isLastPage()-|
    <li class="unactiveTab">
        <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningOperativeObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$operativeObjective->getId()-|", page: "|-$operativeObjectiveVersionsPager->getNextPage()-|"}});'>Siguientes</a>
    </li>
|-/if-|

    <li>
        <span>|-$operativeObjectiveVersionsPager->getFirstIndex()-| - |-$operativeObjectiveVersionsPager->getLastIndex()-| de |-$operativeObjective->countOperativeObjectiveLogs()-| versiones</span>
    </li>
    <li>
        <span id="status_info" style="display: none" class="inProgress">Cargando...</span>
    </li>
</ul>