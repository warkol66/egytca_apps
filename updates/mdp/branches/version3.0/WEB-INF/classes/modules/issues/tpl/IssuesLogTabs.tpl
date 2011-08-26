<script type="text/javascript" language="JavaScript">
    function selectTab(anchorElement) {
        $$('#tabsLogs ul li.activeTab').each(function(e) {
            e.className = 'unactiveTab';
        });
        anchorElement.parentNode.className = 'activeTab';
    }
</script>

<script type='text/javascript'>
    new Ajax.Updater("tabsLogs", "Main.php?do=issuesUpdateTabsX", { method: "get", parameters: { id: "|-$id-|", page: "1"}});
</script>

<div id='tabsLogs'></div>
<div id='div_issue'></div>