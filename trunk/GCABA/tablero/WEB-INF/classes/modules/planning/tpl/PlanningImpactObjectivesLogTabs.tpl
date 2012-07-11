<script type="text/javascript" language="JavaScript">
	function selectTab(anchorElement) {
		$$('#tabsLogs ul li.activeTab').each(function(e) {
			e.className = 'unactiveTab';
		});
		anchorElement.parentNode.className = 'activeTab';
	}      
</script>
<div id='tabsLogs'>
	|-include file="PlanningImpactObjectivesUpdateTabsX.tpl"-|
</div>
<div id='div_impactObjective'>
	|-include file="PlanningImpactObjectivesForm.tpl" readonly="readonly"-|
</div>