|-$bonds[$filters.type]-|
<ul>
|-if $users|@count gt 0-|
|-foreach from=$users item=user-|
<li><a class="iframe link fbox_user" id="fancybox_user|-$user->getId()-|" href="Main.php?do=commonInternalMailsEdit&iframe=true&userId=|-$user->getId()-|&userType=|-get_class($user)-|" title="Haga click en el nombre para enviarle un mensaje">|-$user->getName()-| |-$user->getSurname()-|</a></li>
|-/foreach-|
|-else-|
<p>No hay participantes que hayan seleccionado esa opción</p>
|-/if-|
<ul>
<p>&nbsp;</p>
<script type="text/javascript">
	$('.fbox_user').fancybox({	'autoScale': false,
									'width' : 720,
									'height' :450,
									'hideOnContentClick': false
								});
	
</script>
