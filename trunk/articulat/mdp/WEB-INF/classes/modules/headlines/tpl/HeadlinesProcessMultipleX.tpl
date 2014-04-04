<script type="text/javascript">
|-if $action eq 'delete'-|
	|-foreach from=$headlinesIds item=headlineId-|
		$('headline' + |-$headlineId-|).remove();
	|-/foreach-|
|-elseif $action eq 'tags' or $action eq 'issues'-|
	var checks = document.getElementsByName('selected[]');
	for (i=0;i<checks.length;i++) {
		if(checks[i].checked)
			checks[i].checked = false;
	}
	var selected = document.getElementsByClassName('search-choice');
	for(i=0;i<selected.length;i++){
		selected[i].remove();
	}
	var chosen = $$('.chzn-results')[0].children;
	for (var i = 0; i<chosen.length; i++) {
		console.log(chosen[i]);
		if(chosen[i].hasClassName('result-selected')){
			chosen[i].removeClassName('result-selected');
			chosen[i].addClassName('active-result');
			chosen[i].style.display ="block";
		}
	}
	$('resultDiv').innerHTML = '<span class="resultSuccess">|-if $action eq "tags"-|Etiquetas agregadas|-else-|Asuntos agregados|-/if-| con exito</span>';
|-/if-|
</script>