  <ul id="partiesList" class="optionDelete">
     |-foreach from=$alertSubscription->getUsers() item=party name=for_parties-|
    <li id="partyListItem|-$party->getId()-|">
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="commonAlertsSubscriptionsDoDeleteUserX" /> 
        <input type="hidden" name="alertSubscriptionId"  value="|-$alertSubscription->getId()-|" /> 
        <input type="hidden" name="partyId"  value="|-$party->getId()-|" /> 
				<input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar al destinatario de la suscripción?')){deleteUserFromAlertSubscription(this.form)}; return false" class="icon iconDelete" /></form> 
     <span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$party->getSurname()-|, |-$party->getName()-|</span>
    </li> 
    |-/foreach-|
  </ul> 