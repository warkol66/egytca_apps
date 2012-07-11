<script type="text/javascript" language="JavaScript">
	function selectTab(anchorElement) {
		$$('#tabsLogs ul li.activeTab').each(function(e) {
			e.className = 'unactiveTab';
		});
		anchorElement.parentNode.className = 'activeTab';
	}      
</script>
<div id='tabsLogs'>
	|-include file="PlanningConstructionsUpdateTabsX.tpl"-|
</div>
<div id='div_planningConstruction'>
	|-include file="PlanningConstructionsForm.tpl" readonly="readonly"-|
</div>
