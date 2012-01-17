|-extends file="CommonSearchEntityListX.tpl"-|
|-block name=entityName-|Titulares|-/block-|
|-block name=filters-|
	<p>
		<label for="filters[bulletindate][min]">desde</label>
		<input name="filters[bulletindate][min]" type='text' value='|-if isset($filters.bulletindate.min)-||-$filters.bulletindate.min|date_format-||-/if-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[bulletindate][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
	</p>
	<p>
		<label for="filters[bulletindate][max]">hasta</label>
		<input name="filters[bulletindate][max]" type='text' value='|-if isset($filters.bulletindate.max)-||-$filters.bulletindate.max|date_format-||-/if-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[bulletindate][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
	</p>
|-/block-|
|-block name=entity-|
	<p>|-$entity-| <a href="Main.php?do=headlinesEdit&id=|-$entity->getId()-|" class="icon iconView inlineTable" target="_blank"></a></p>
|-/block-|