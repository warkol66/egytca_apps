  <ul id="partiesList" class="iconOptionsList">
     |-foreach from=$campaign->getCampaignParticipants() item=party name=for_parties-|
    <li id="partyListItem|-$party->getId()-|">
      <form  method="post" id="partyListItemForm|-$party->getId()-|"> 
        <input type="hidden" name="do" id="do" value="campaignsDoDeleteParticipantX" /> 
        <input type="hidden" name="campaignId"  value="|-$campaign->getId()-|" /> 
        <input type="hidden" name="partyId"  value="|-$party->getId()-|" /> 
				<input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar al participante de la campaña?')){deleteParticipantFromCampaign(this.form)}; return false" class="icon iconDelete" /></form> 
     <span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-if $party->getObject() != NULL-||-assign var=partyObject value=$party->getObject()-||-$partyObject->getName()-| |-$partyObject->getSurname()-||-if $party->getObjectType() eq 'Actor' && $partyObject->getInstitution() ne ''-| (|-$partyObject->getInstitution()-|)|-/if-||-/if-|</span>
    </li> 
    |-/foreach-|
  </ul> 