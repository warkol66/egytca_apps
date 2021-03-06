<script>
	$('#messageMod').html("");
	|-if !empty($error)-|
	$('#messageResult').html("<span class='resultFailure'>Ocurrió un error al |-$error-|</span>");
	|-else-|
	$('#messageResult').html("<span class='resultSuccess'>El módulo fue verificado</span>");
	|-/if-|
	$('#|-$verifiedModule-|_hash').html('<span class="|-if $oldHash eq $directoryHash-|validHash|-else-|invalidHash|-/if-|">|-$directoryHash-|</span>');
	$('#directories_|-$verifiedModule-|').show();
	
	|-if isset($updateModule) && (!empty($newFiles) || !empty($changedFiles))-|
		$('#|-$verifiedModule-|_update')
			.children('[name="hash"]')
			.val('|-$allHashes-|')
			.show();
		$('#|-$verifiedModule-|_update').show();
	|-/if-|
	
</script>
|-if empty($newFiles) && empty($changedFiles)-|
	<div class="verifyResultMessage">No hay archivos nuevos ni modificados en el directorio</div>
|-/if-|
|-if !empty($newFiles)-|
	<ul class="verifyNested">
		<li>Archivos nuevos:
			<ul>
				|-foreach from=$newFiles key=file item=newHash name=foreachNewFile-|
				<li>|-$file-|</li>
				|-/foreach-|
			</ul>
		</li>
	</ul>
|-/if-|
|-if !empty($changedFiles)-|
	<ul class="verifyNested">
		<li>Archivos modificados:
			<ul>
				|-foreach from=$changedFiles key=changed item=changedHash name=foreachChangedFile-|
				<li>|-$changed-|</li>
				|-/foreach-|
			</ul>
		</li>
	</ul>
|-/if-|
