	<input name="menuItemInfo[|-$languageCode-|][id]" type="hidden" id="menuItemInfo[|-$languageCode-|][id]" value="|-$menuItemInfo->getId()-|" /> 
	<p>  
		<label>Nombre</label>
		<input name="menuItemInfo[|-$languageCode-|][name]" type="text" size="55" maxlength="255" value="|-$menuItemInfo->getName()-|" />
	</p>
	<p>
		<label>Título</label>
		<input name="menuItemInfo[|-$languageCode-|][title]" type="text" size="55" maxlength="255" value="|-$menuItemInfo->getTitle()-|" />
	</p>
	<p>
		<label>Descripción</label>
		<textarea name="menuItemInfo[|-$languageCode-|][description]" cols="70" rows="3" wrap="virtual">|-$menuItemInfo->getDescription()-|</textarea> 
	</p>
