|-foreach from=$elements item=element key=element_name-|
|-if $element|is_array-|
<li>|-$element_name|multilang_get_translation:"common"-|
	<ul>|-include file="CommonConfigViewInclude.tpl" elements=$element-|</ul>
</li>
|-else-|
<li>|-$element_name|multilang_get_translation:"common"-|: |-if $element_name|substr:-8|lower eq 'password'-|**********|-else-||-$element-||-/if-|</li>
|-/if-|
|-/foreach-|
