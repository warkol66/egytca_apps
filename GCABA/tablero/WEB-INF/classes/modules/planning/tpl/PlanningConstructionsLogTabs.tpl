<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script>
	jQuery.noConflict();
</script>
|-assign var="jqueryAndNoConflictAdded" value=1-|

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
