<script type="text/javascript" language="JavaScript">
    function selectTab(anchorElement) {
        $$('#tabsLogs ul li.activeTab').each(function(e) {
            e.className = 'unactiveTab';
        });
        anchorElement.parentNode.className = 'activeTab';
    }      
</script>

<div id='tabsLogs' >
	|-include file="PlanningMinistryObjectivesUpdateTabsX.tpl"-|
</div>
<div id='div_ministryObjective'>
|-include file="PlanningMinistryObjectivesForm.tpl" readonly="readonly"-|
</div>