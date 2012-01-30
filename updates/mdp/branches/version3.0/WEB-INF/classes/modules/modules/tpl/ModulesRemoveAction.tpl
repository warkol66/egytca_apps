<script type="text/javascript">
removeAction = function(moduleName, actionName, onSuccess) {
	
	new Ajax.Request(
		'Main.php?do=modulesInstallRemoveActionX',
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

</script>