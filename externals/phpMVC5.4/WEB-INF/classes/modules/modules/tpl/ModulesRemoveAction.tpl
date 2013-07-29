<script type="text/javascript">
	removeAction = function(moduleName, actionName, onSuccess) {
		$.ajax({
				url: 'Main.php?do=modulesRemoveActionX',
				data: {moduleName: moduleName, actionName: actionName},
				type: 'post',
				success: function(data){
					onSuccess;
					$('#resultDiv').html(data);
				}	
		});		

	}

	function removeTr(action) {
		$("#resultDiv").html("<span class='inProgress'>Eliminando</span>");
		var tr = $('#tr_'+action);
		tr.remove();
		//window.setTimeout(function() {$("#resultDiv").html("<span class='resultSuccess'>Acción Eliminada</span>");},1000);
	}

	function removeFieldset(action) {
		$("#resultDiv").html("<span class='inProgress'>Eliminando</span>");
		var fieldset = $('#fieldset_'+action);
		fieldset.remove()
		//window.setTimeout(function() {$("#resultDiv").html("<span class='resultSuccess'>Acción Eliminada</span>");},1000);
	}

</script>
