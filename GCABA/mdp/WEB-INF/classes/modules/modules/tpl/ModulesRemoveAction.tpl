<script type="text/javascript">
	removeAction = function(moduleName, actionName, onSuccess) {		
		new Ajax.Request(
			'Main.php?do=modulesRemoveActionX',
			{
				method: 'post',
				parameters: {
					moduleName: moduleName,
					actionName: actionName
				},
				evalScripts: true,
				onSuccess: onSuccess
			}
		);
	}

	function removeTr(action) {
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Eliminando</span>";
		var tr = $('tr_'+action);
		tr.parentNode.removeChild(tr);
		window.setTimeout(function() {$("resultDiv").innerHTML = "<span class=\"resultSuccess\">Acción Eliminada</span>";},1000);
	}

	function removeFieldset(action) {
		$("resultDiv").innerHTML = "<span class=\"inProgress\">Eliminando</span>";
		var fieldset = $('fieldset_'+action);
		fieldset.parentNode.removeChild(fieldset);
		window.setTimeout(function() {$("resultDiv").innerHTML = "<span class=\"resultSuccess\">Acción Eliminada</span>";},1000);
	}

</script>