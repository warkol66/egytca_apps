<div id="logedUsers">Ver usuarios logueados<div id="logedUsersList">
<ul>|-foreach from=$result item=user-|
	|-if $user->isLoged()-|
		<li>|-$user->getName()-| |-$user->getSurname()-||-if !$user->hasRecentlyAction()-|*|-/if-|</li>
	|-/if-|
|-/foreach-|</ul>
<p>Los usuarios marcados con (*)  no han tenido actividad en las últimas 2 horas, puede que no se encuentren conectados</p></div>
</div>