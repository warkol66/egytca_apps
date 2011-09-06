<script type="text/javascript" language="javascript" >
	$('actorMsgField').innerHTML = '<span class="resultSuccess">Actor agregado</span>';
</script>

<li id="actorListItem|-$actor->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="headlinesDoRemoveActorX" />
		<input type="hidden" name="headlineId"  value="|-$headline->getId()-|" />
		<input type="hidden" name="actorId"  value="|-$actor->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:removeActorFromHeadline(this.form)" class="icon iconDelete" />
	</form>	|-$actor-|
	|-foreach from=$headline->getHeadlineActors() item=headlineActor-|
		|-if $headlineActor->getActorId() eq $actor->getId()-|
			|-assign var=role value=$headlineActor->getRole()-|
		|-/if-|
	|-/foreach-|
	|-if $role neq ''-||-assign var=actorRoleAction value='show'-||-else-||-assign var=actorRoleAction value=''-||-/if-|
	|-assign var=headlinePeer value=$headline->getPeer()-|
	<span id='span_role_for_|-$actor->getId()-|'>
	|-include file='HeadlinesSelectActorRole.tpl' action=$actorRoleAction actorId=$actor->getId() headlineId=$headline->getId() role=$role roles=$headlinePeer->getHeadlineRoles()-|
	</span>
</li>
