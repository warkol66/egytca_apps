<script>
	$('#messageMod').html("");
</script>
|-if !empty($error)-|
	<span class="resultFailure">Ocurrió un error al intentar verificar el módulo</span>
|-else-|
	<span class="resultSuccess">El módulo fue verificado y actualizado</span>
|-/if-|
|-if !empty($newFiles)-|
<div>
	Se encontraron los siguientes archivos nuevos: 
	<ul>
		|-foreach from=$newFiles key=file item=newHash name=foreachNewFile-|
		<li>|-$file-|</li>
		|-/foreach-|
	</ul>
</div>
|-/if-|
|-if !empty($changedFiles)-|
<div>
	Los siguientes archivos fueron modificados: 
	<ul>
		|-foreach from=$changedFiles key=changed item=changedHash name=foreachChangedFile-|
		<li>|-$changed-|</li>
		|-/foreach-|
	</ul>
</div>
|-/if-|
