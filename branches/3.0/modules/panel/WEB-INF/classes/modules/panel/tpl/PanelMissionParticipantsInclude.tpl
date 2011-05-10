  <ul id="partiesList" class="optionDelete">
     |-foreach from=$mission->getMissionParticipants() item=party name=for_parties-|
    <li id="partyListItem|-$party->getId()-|">
      <form  method="post" id="partyListItemForm|-$party->getId()-|"> 
        <input type="hidden" name="do" id="do" value="panelMissionDoDeleteParticipantX" /> 
        <input type="hidden" name="missionId"  value="|-$mission->getId()-|" /> 
        <input type="hidden" name="partyId"  value="|-$party->getId()-|" /> 
				<input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar al participante de la misión?')){deleteParticipantFromMission(this.form)}; return false" class="iconDelete" /></form> 
     <span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-if $party->getObject() != NULL-||-assign var=partyObject value=$party->getObject()-||-$partyObject->getName()-| |-$partyObject->getSurname()-||-if $party->getObjectType() eq 'Actor' && $partyObject->getInstitution() ne ''-| (|-$partyObject->getInstitution()-|)|-/if-||-/if-|</span>
    </li> 
    |-/foreach-|
  </ul> 