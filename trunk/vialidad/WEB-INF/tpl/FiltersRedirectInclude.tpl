|-if $filters neq ''-|
	|-foreach from=$filters key=key item=value-|
		<input type="hidden" name="filters[|-$key-|]" value="|-$value-|" />
	|-/foreach-|
|-/if-|