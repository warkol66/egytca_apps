<script>
	$('#messageMod').html("");
	|-if !empty($error)-|
	$('#messageResult').html("<span class='resultFailure'>Ocurrió un error al |-$error-|</span>");
	|-else-|
	$('#messageResult').html("<span class='resultSuccess'>El módulo fue verificado y actualizado</span>");
	|-/if-|
</script>
<td>
	<p>Hash del directorio: |-$directoryHash-|</p>
|-if !empty($newFiles)-|
	<ul class="verifyNested">
		<li>Archivos nuevos:
			<ul>
				|-foreach from=$newFiles key=file item=newHash name=foreachNewFile-|
				<li>|-$file-|</li>
				|-/foreach-|
			</ul>
		</li>
	
|-/if-|
|-if !empty($changedFiles)-|
	<p>Los siguientes archivos fueron modificados: </p>
	<ul>
		|-foreach from=$changedFiles key=changed item=changedHash name=foreachChangedFile-|
		<li>|-$changed-|</li>
		|-/foreach-|
	</ul>
|-/if-|
</td>
