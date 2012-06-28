<script type="text/javascript" language="JavaScript">
    function selectTab(anchorElement) {
        $$('#tabsLogs ul li.activeTab').each(function(e) {
            e.className = 'unactiveTab';
        });
        anchorElement.parentNode.className = 'activeTab';
    }      
</script>

<div id='tabsLogs' >
    <ul>
    |-foreach from=$ministryObjectiveVersionsPager item=ministryObjectiveVersion name=for_ministryObjectiveVersions-|
        |-if $ministryObjective->getVersion() eq $ministryObjectiveVersion->getVersion()-|
        <li class="activeTab">
        |-else-|
        <li class="unactiveTab">
        |-/if-|
            <a href="#" id='version_|-$ministryObjectiveVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_issue", "Main.php?do=planningMinistryObjectivesShowHistoryX", { method: "get", parameters: { id: "|-$ministryObjectiveVersion->getId()-|", version: "|-$ministryObjectiveVersion->getVersion()-|"}, evalScripts: true});'>|-$ministryObjectiveVersion->getUpdatedAt()-|</a>
        </li>
    |-/foreach-|
    |-if !$ministryObjectiveVersionsPager->isLastPage()-|
        <li class="unactiveTab">
            <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningMinistryObjectivesUpdateTabsX", { method: "get", parameters: { id: "|-$ministryObjective->getId()-|", page: "|-$ministryObjectiveVersionsPager->getNextPage()-|"}});'>Siguientes</a>
        </li>
    |-/if-|

        <li>
            <span>|-$ministryObjectiveVersionsPager->getFirstIndex()-| - |-$ministryObjectiveVersionsPager->getLastIndex()-| de |-$ministryObjective->countMinistryObjectiveLogs()-| versiones</span>
        </li>
        <li>
            <span id="status_info" style="display: none" class="inProgress">Cargando...</span>
        </li>
    </ul>
</div>
<div id='div_issue'>
    |-include file='PlanningMinistryObjectivesForm.tpl'-|
</div>