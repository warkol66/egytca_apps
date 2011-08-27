<div id='tabsLogs'>
    <ul>
    |-if !$issueVersionsPager->isFirstPage()-|
        <li class="unactiveTab">
            <a href="#" onClick='new Ajax.Updater("tabsLogs", "Main.php?do=issuesUpdateTabsX", { method: "get", parameters: { id: "|-$issue->getId()-|", page: "|-$issueVersionsPager->getPreviousPage()-|"}});'>Anteriores</a>
        </li>
    |-/if-|
    |-foreach from=$issueVersionsPager item=issueVersion name=for_issueVersions-|
        <li class="unactiveTab">
            <a href="#"  onClick='selectTab(this);$("status_info").show(); new Ajax.Updater("div_issue", "Main.php?do=issuesShowHistoryX", { method: "get", parameters: { id: "|-$issueVersion->getId()-|", version: "|-$issueVersion->getVersion()-|"}, evalScripts: true});'>|-$issueVersion->getUpdatedAt()-|</a>
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
            <span id="status_info" style="display: none">Cargando...</span>
        </li>
    </ul>
</div>