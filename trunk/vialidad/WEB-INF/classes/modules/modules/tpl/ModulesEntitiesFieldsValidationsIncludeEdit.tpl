				<label for="entityFieldValidationData[name]">Nombre</label>
				<select name="entityFieldValidationData[name][]">
					|-foreach from=$validationNames item=name-|
					<option value="|-$name-|"|-if $validation->getName() eq $name-| selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>					
				<label for="entityFieldValidationData[value]">Valor</label>
				<input name="entityFieldValidationData[value][]" type="text" value="|-$validation->getValue()-|" maxlength="50" />					
				<label for="entityFieldValidationData[message]">Mensaje</label>
				<input name="entityFieldValidationData[message][]" type="text" value="|-$validation->getMessage()-|" maxlength="255" />
				<a href="#" onclick="this.parentNode.remove();return false;">Eliminar</a>									
