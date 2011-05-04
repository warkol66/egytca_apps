<form method="get" action="Main.php" style="display:inline;" >
	<input type="hidden" name="do" value="|-$do-|" />
	|-foreach from=$actors item=actor-|
	<input type="hidden" name="actors[]" value="|-$actor->getId()-|" />
	|-/foreach-|
	|-if $categoryId ne ""-|
	<input type="hidden" name="categoryId" value="|-$categoryId-|" />
	|-/if-|
	<select name="form" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" >
		|-foreach from=$forms item=formItem-|
		<option value="|-$formItem->getId()-|">|-$formItem->getName()-|</option>
		|-/foreach-|
		<option value="" selected="selected">Seleccione otro formulario</option>
	</select>
</form>
