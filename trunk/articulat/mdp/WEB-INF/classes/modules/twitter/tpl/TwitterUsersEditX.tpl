|-if !is_object($twitterUser)-|
	<div id="resultFailure">El usuario que está buscando no existe</div>
|-else-|
<fieldset title="Datos del usuario">
<legend>Datos del Usuario</legend>
	<p><label for="params[usernameDisabled]">Nombre</label>
		<input id='params[usernameDisabled]' name='params[usernameDisabled]' type='text' value='|-$twitterUser->getName()-|' size="30" disabled="disabled" />
	<p><label for="params[screennameDisabled]">Usuario</label>
		<input id='params[screennameDisabled]' name='params[screennameDisabled]' type='text' value='|-$twitterUser->getScreenname()|escape-|' size="50" disabled="disabled"/>
	</p>
	<p><label for="params[locationDisabled]">Ubicación</label>
		<input id='params[locationDisabled]' name='params[locationDisabled]' type='text' value='|-$twitterUser->getLocation()|escape-|' size="50" disabled="disabled" />
	</p>
	<p><label for="params[descriptionDisabled]">Descripción</label>
		<input id='params[descriptionDisabled]' name='params[descriptionDisabled]' type='text' value='|-$twitterUser->getDescription()|escape-|' size="50" disabled="disabled" />
	</p>
	<p><label for="params[urlDisabled]">URL</label>
		<input id='params[urlDisabled]' name='params[urlDisabled]' type='text' value='|-$twitterUser->getUrl()|escape-|' size="50" disabled="disabled" />
	</p>
	<p><label for="params[followersDisabled]">Seguidores</label>
		<input id='params[followersDisabled]' name='params[followersDisabled]' type='text' value='|-$twitterUser->getFollowers()-|' size="10" disabled="disabled" />
	</p>
	<p>	
		<label for="params[friendsDisabled]">Amigos</label>
		<input id='params[friendsDisabled]' name='params[friendsDisabled]' type='text' value='|-$twitterUser->getFriends()-|' size="10" disabled="disabled" />
	</p>
</fieldset>
|-/if-|
