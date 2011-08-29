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
    |-foreach from=$issueVersionsPager item=issueVersion name=for_issueVersions-|
        |-if $issue->getVersion() eq $issueVersion->getVersion()-|
        <li class="activeTab">
        |-else-|
        <li class="unactiveTab">
        |-/if-|
            <a href="#" id='version_|-$issueVersion->getVersion()-|_tab' onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_issue", "Main.php?do=issuesShowHistoryX", { method: "get", parameters: { id: "|-$issueVersion->getId()-|", version: "|-$issueVersion->getVersion()-|"}, evalScripts: true});'>|-$issueVersion->getUpdatedAt()-|</a>
        </li>
    |-/foreach-|
    |-if !$issueVersionsPager->isLastPage()-|
        <li class="unactiveTab">
            <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=issuesUpdateTabsX", { method: "get", parameters: { id: "|-$issue->getId()-|", page: "|-$issueVersionsPager->getNextPage()-|"}});'>Siguientes</a>
        </li>
    |-/if-|

        <li>
            <span>|-$issueVersionsPager->getFirstIndex()-| - |-$issueVersionsPager->getLastIndex()-| de |-$issue->countIssueVersions()-| versiones</span>
        </li>
        <li>
            <span id="status_info" style="display: none" class="inProgress">Cargando...</span>
        </li>
    </ul>
</div>
<div id='div_issue'></div>
<script>
    new Ajax.Updater("div_issue", "Main.php?do=issuesShowHistoryX", { method: "get", parameters: { id: "|-$issue->getId()-|", version: "|-$issue->getVersion()-|"}, evalScripts: true});
</script>