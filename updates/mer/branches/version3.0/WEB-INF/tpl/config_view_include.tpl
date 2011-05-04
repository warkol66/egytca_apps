|-foreach from=$elements item=element key=element_name-|
|-if $element|is_array-|
<li>|-$element_name-|
	<ul>|-include file=config_view_include.tpl elements=$element-|</ul>
</li>
|-else-|
<li>|-$element_name-|: |-$element-|</li>
|-/if-|
|-/foreach-|
