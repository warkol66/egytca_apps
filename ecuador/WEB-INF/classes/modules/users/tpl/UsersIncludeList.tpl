<div id="logedUsers"><a href="javascript:void(null);" onClick="switch_vis('logedUsersList')">Ver usuarios conectados</a><div id="logedUsersList" style="display:none">
<p>Los usuarios marcados con (*)  no han tenido actividad en las últimas 2 horas, puede que no se encuentren conectados</p>
<ul>|-foreach from=$result item=user-|
	|-if $user->isLoged()-|
		<li>|-$user->getName()-| |-$user->getSurname()-||-if !$user->hasRecentlyAction()-|*|-/if-|</li>|-if $user@last-|.|-else-|,|-/if-|
	|-/if-|
|-/foreach-|</ul>
</div>
</div>