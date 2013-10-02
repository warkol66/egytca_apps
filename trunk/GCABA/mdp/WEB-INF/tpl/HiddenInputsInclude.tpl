|-if $filters neq ''-|
	|-foreach from=$filters key=key item=value-|
		<input type="hidden" name="filters[|-$key-|]" value="|-$value-|" />
	|-/foreach-|
|-/if-|
|-if $page gt 1-|
	<input type="hidden" name="page" id="page" value="|-$page-|" />
|-/if-|
|-if $action-|<input type="hidden" name="action" id="action" value="|-$action-|" />|-/if-|
