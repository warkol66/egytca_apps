<form method="get" action="Main.php" style="display:inline;" >
	<input type="hidden" name="do" value="|-$do-|" />
	|-if $relation eq 1-|
	<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
	<input type="hidden" name="actor2" value="|-$actor2->getId()-|" />
	|-else-|
	<input type="hidden" name="actor" value="|-$actor->getId()-|" />
	|-/if-|
	<select name="form" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" >
		|-foreach from=$forms item=formItem-|
		<option value="|-$formItem->getId()-|">|-$formItem->getName()-|</option>
		|-/foreach-|
		<option value="" selected="selected">Seleccione otro formulario</option>
	</select>
</form>
