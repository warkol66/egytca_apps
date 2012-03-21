|-foreach from=$languages item=langItem-|
	<h3>|-$langItem->getName()|multilang_get_translation:"multilang"-|</h3>
	 	|-assign var=languageCode value=$langItem->getCode()-|
	<div id="edit_section_|-$languageCode-|">
		|-include file="CommonMenuItemsLanguageInfoInclude.tpl" menuItemInfo=$menuItem->getMenuInfoFromSecurityActionLabel($action, $languageCode)-|
	</div>
|-/foreach-|

<script type="text/javascript">
	$('indicator2').hide();
</script>