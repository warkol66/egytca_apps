<script>
	$('#messageMod').html("");
	|-if !empty($error)-|
	$('#messageResult').html("<span class='resultFailure'>Ocurrió un error al |-$error-|</span>");
	|-else-|
	$('#messageResult').html("<span class='resultSuccess'>El módulo fue verificado y actualizado</span>");
	|-/if-|
	$('#|-$verifiedModule-|_hash').html('<span style="color: #0099CC;">|-$directoryHash-|</span>');
	$('#directories_|-$verifiedModule-|').show();
	
	|-if !empty($newFiles) || !empty($changedFiles)-|
		var newForm = $('#|-$verifiedModule-|_update');
		
		newForm.append($('<input>', {'name': 'do','value': 'modulesVerifyUpdateX','type': 'hidden'}))
		.append($('<input>', {'name': 'moduleName','value': '|-$verifiedModule-|','type': 'hidden'}))
		.append($('<input>', {'name': 'hashes','value': '|-$allHashes-|','type': 'hidden'}))
		.append($('<input>', {'name': 'submit_go_update_module','value': 'Actualizar módulo','class': 'icon editor_ok_button','onClick':'javascript:updateModule("|-$verifiedModule-|")','type': 'button'}));
	|-/if-|
	
</script>
|-if empty($newFiles) && empty($changedFiles)-|
	<p style="color: #FFFF00;">No hay archivos nuevos ni modificados en el directorio</p>
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
