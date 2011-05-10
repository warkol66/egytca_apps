<h2>Segmentación</h2>
<h1>Vista previa de Grupos de Usuarios "|-$cluster->getName()-|"</h1>
	<fieldset>
		<legend>Usuarios que conforman el grupo "|-$cluster->getName()-|"</legend>
		|-if $users|@count eq 0-|
			<p>Este grupo no tiene como resultado ningún usuario</p>
			<input name="back" type="button" value="Regresar" onclick="javascript:history.back()"/>
		|-else-|
		<ul>
			<p>Este grupo tiene |-$users|@count-| usuarios</p>
			<input name="back" type="button" value="Regresar" onclick="javascript:history.back()"/>
		|-foreach from=$users item=user name=for_users-|
			<li>|-$user->getUsername()-|</li>
		|-/foreach-|
		</ul>
		|-/if-|
	</fieldset>

