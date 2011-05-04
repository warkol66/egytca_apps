<form name="security" action="Main.php?do=actionDoList" method="POST">
<table border="1" align="center">
  <tr>
    <th scope="col">Actions</th>
    <th scope="col">Activar</th>
  </tr>
  			|-foreach from=$modulos item=modulo name=modulokey key=nombremodulo-|
			   <th>|-$nombremodulo-|</th>
  <tr>
    </tr>
  			|-foreach from=$modulo item=action name=actionf-|

  <tr>
 <td>|-$action-|	<input type=hidden name="action[|-$action-|]" value="|-$action-|">
					<input type=hidden name="modulo[|-$action-|]" value="|-$nombremodulo-|">
	
	
	</td>

	
<td><input type="checkbox" name="activoaction[|-$action-|]" value="|-$action-|"
|-foreach from=$security item=actionsecurity name=act-|
|-if $action eq $actionsecurity->getAction() -|
checked >
<input type=hidden name="access[|-$action-|]" value="|-$actionsecurity->getAccess()-|">
|-/if-| 
|-/foreach-|
</td>
    



  </tr>
 
|-/foreach-|
|-/foreach-|
</table>
<input type="submit" name="submit">
</form>
