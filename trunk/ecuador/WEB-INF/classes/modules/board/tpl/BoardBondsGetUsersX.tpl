<ul>
|-foreach from=$users item=user-|
<li><a class="iframe link fbox_user" id="fancybox_user|-$user->getId()-|" href="Main.php?do=commonInternalMailsEdit&iframe=true&userId=|-$user->getId()-|&userType=|-get_class($user)-|">|-$user->getName()-|</a>
</li>
|-/foreach-|
<ul>
<script type="text/javascript">
	$('.fbox_user').fancybox({	'autoScale': false,
									'width' : 800,
									'height' :420,
									'hideOnContentClick': false
								});
	
</script>
