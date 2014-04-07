<script type="text/javascript">
function resetChosen(){

	var selected = document.getElementsByClassName('search-choice');
	for(i=0;i<selected.length;i++){
		selected[i].remove();
	}
	var chosen = $$('.chzn-results')[0].children;
	for (var i = 0; i<chosen.length; i++) {
		if(chosen[i].hasClassName('result-selected')){
			chosen[i].removeClassName('result-selected');
			chosen[i].addClassName('active-result');
			chosen[i].style.display ="block";
		}
	}
}
|-if isset($noHeadlines)-|
	$('resultDiv').innerHTML = '<span class="resultFailure">Debe seleccionar al menos un titular</span>';
	resetChosen();
|-else-|
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
		resetChosen();
		|-if !empty($notSaved)-|
			var ul = document.createElement('ul');
			$('resultDiv').innerHTML = '<span class="resultFailure">Los siguientes titulares no pudieron ser procesados:</span>';
		|-foreach from=$notSaved item=headlinens-|
			ns = document.createElement('li');
			ns.innerHTML = '|-$headlinens->getName()-|';
			ul.appendChild(ns);
		|-/foreach-|
			$('resultDiv').appendChild(ul);
		|-else-|
		$('resultDiv').innerHTML = '<span class="resultSuccess">|-if $action eq "tags"-|Etiquetas agregadas|-else-|Asuntos agregados|-/if-| con exito</span>';
		|-/if-|
	|-/if-|
|-/if-|
</script>