<h2>Chat</h2>
<h1>Comunicación en línea</h1>

<p>El sitio Lideresparroquiales le brinda una herramienta para interactuar con otros líderes mediante salas de chat.</p>
<p>Para ingresar la chat haga click en el bot&oacute;n &quot;Ingresar al chat&quot;, recuerde que una vez dentro del chat lo que escriba ser&aacute; visto pro otros usuarios. Por favor, mantenga un correcto vocabulario mientras est&eacute; en la sala de chat.  </p>
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
