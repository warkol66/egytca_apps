<form method="post" action="Main.php?do=campaignsCorremeYBorrame">
	<input type="hidden" name="correr" value="true">
	<input type="submit" value="Correr" onclick="return confirm('Estás a punto de modificar las palabras claves de todas las campañas. Seguro?')">
</form>
<p>|-$results|count-| campañas procesadas</p>
<ol>
	|-foreach $results as $result-|
		<li>
			id=|-$result.id-|:&nbsp;
			|-if $result.error-|
				error: |-$result.error-|
			|-else-|
				|-$result.old-| -> |-$result.new-|
			|-/if-|
		</li>
	|-/foreach-|
</ol>