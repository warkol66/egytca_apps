<h2>Chat</h2>
<h1>Comunicación en línea</h1>

|-entity_include entity="Content" template="ContentBodyInclude.tpl" filters=['id' => '17']-|
|-if $loggedUser-|
<form action="ajax-chat/" method="POST" target="_blank">
	<input type="hidden" name="userName" value="|-$loggedUser->getUsername()-|">
	<input type="hidden" name="password" value="|-$loggedUser->getPassword()-|">
	<input type="hidden" name="submit" value="Login">
	<input type="hidden" name="redirect" value="">
	<input type="hidden" name="login" value="login">
	<input type="hidden" name="login" value="login">
	<input type="hidden" name="lang" value="es">
	<input type="hidden" name="channelName" value="public">
	<input type="submit" value="Ingresar al chat">
</form>
|-/if-|