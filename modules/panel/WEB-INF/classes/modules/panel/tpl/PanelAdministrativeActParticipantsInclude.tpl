  <ul id="partiesList" class="optionDelete">
     |-foreach from=$administrativeAct->getAdminActParticipants() item=party name=for_parties-|
    <li id="partyListItem|-$party->getId()-|">
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="panelAdministrativeActsDoDeleteParticipantX" /> 
        <input type="hidden" name="administrativeActId"  value="|-$administrativeAct->getId()-|" /> 
        <input type="hidden" name="partyId"  value="|-$party->getId()-|" /> 
				<input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar al participante del acto administrativo?')){deleteParticipantToAdminAct(this.form)}; return false" class="iconDelete" /></form> 
     <span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$party->getSurname()-|, |-$party->getName()-| |-if $party->getInstitution() ne ''-|(|-$party->getInstitution()-|)|-/if-|</span>
    </li> 
    |-/foreach-|
  </ul> 