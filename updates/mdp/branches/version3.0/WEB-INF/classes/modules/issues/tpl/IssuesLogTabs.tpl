<script type="text/javascript" language="JavaScript">
    function selectTab(anchorElement) {
        $$('#tabsLogs ul li.activeTab').each(function(e) {
            e.className = 'unactiveTab';
        });
        anchorElement.parentNode.className = 'activeTab';
    }      
</script>

<script type='text/javascript'>
    new Ajax.Updater("tabsLogs", "Main.php?do=issuesUpdateTabsX", { method: "get", parameters: { id: "|-$issue->getId()-|", page: "1"}});
</script>

<div id='tabsLogs' ></div>
<div id='div_issue'></div>

<script>
    window.onload=function() {
        selectTab(document.getElementById('version_|-$issue->getVersion()-|_tab'));
        new Ajax.Updater("div_issue", "Main.php?do=issuesShowHistoryX", { method: "get", parameters: { id: "|-$issue->getId()-|", version: "|-$issue->getVersion()-|"}, evalScripts: true});
    }
</script>