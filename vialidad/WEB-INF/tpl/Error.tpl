|-if $errorTagId-|
<script type="text/javascript" language="javascript" >
	$('|-$errorTagId-|').innerHTML = '<span class="resultFailure">Error|-if isset($message)-|- |-$message-||-/if-|</span>';
</script>
|-else-|
	<span class="resultFailure">|-$message|multilang_get_translation:$module-|</span>
	<input type="button" onClick="location.href='|-$url-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'" value="Regresar">
|-/if-|
<script type="text/javascript" language="javascript" >
	msgs = $$('.inProgress');
	for (var i=0; i<msgs.length; i++)
		msgs[i].hide();
</script>
