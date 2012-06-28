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
    |-foreach from=$planningProjectVersionsPager item=projectVersion name=for_projectVersions-|
        |-if $planningProject->getVersion() eq $projectVersion->getVersion()-|
        <li class="activeTab">
        |-else-|
        <li class="unactiveTab">
        |-/if-|
            <a href="#" id='version_|-$projectVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_issue", "Main.php?do=planningProjectsShowHistoryX", { method: "get", parameters: { id: "|-$projectVersion->getId()-|", version: "|-$projectVersion->getVersion()-|"}, evalScripts: true});'>|-$projectVersion->getUpdatedAt()-|</a>
        </li>
    |-/foreach-|
    |-if !$planningProjectVersionsPager->isLastPage()-|
        <li class="unactiveTab">
            <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=planningProjectsUpdateTabsX", { method: "get", parameters: { id: "|-$project->getId()-|", page: "|-$planningProjectVersionsPager->getNextPage()-|"}});'>Siguientes</a>
        </li>
    |-/if-|

        <li>
            <span>|-$planningProjectVersionsPager->getFirstIndex()-| - |-$planningProjectVersionsPager->getLastIndex()-| de |-$planningProject->countPlanningProjectLogs()-| versiones</span>
        </li>
        <li>
            <span id="status_info" style="display: none" class="inProgress">Cargando...</span>
        </li>
    </ul>
</div>
<div id='div_issue'>
    |-include file='PlanningProjectsForm.tpl'-|
</div>