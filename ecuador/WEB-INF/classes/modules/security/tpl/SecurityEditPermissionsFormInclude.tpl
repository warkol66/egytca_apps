&nbsp;<fieldset class="noMargin">
	<legend>Permisos de Acciones</legend>
	<p>El permiso general del módulo maneja el acceso a las acciones del mismo, siempre que no tengan permisos definidos en forma individual en la parte inferior.<br>
		Asigne los permisos correspondientes y haga click en "Guardar Permisos" para guardar los cambios.</p> 
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<th scope="col">Módulo</th>
		<th scope="col">No verifica login</th>
		<th scope="col">Usuarios</th> 
	|-if !empty($affiliateLevels)-|<th scope="col">Usuarios Por Afiliado</th>|-/if-|
	|-if class_exists("RegistrationUser")-|<th scope="col">Usuarios Por Registro</th>|-/if-|
	</tr> 
	<tr> 
		<td>|-$moduleName|multilang_get_translation:"common"-|</td>
		<td>
			<input type="checkbox" name="noCheckLoginModule" value="1" |-$moduleSelected->getNoCheckLogin()|checked:1-|/></td>
			<td nowrap>
				|-foreach from=$levels item=groupbit name=bitlevelgroup-|
					<input type="checkbox" name="permissionGeneral[access][]" value="|-$groupbit->getBitLevel()-|" |-if $moduleSelected->getAccess() gte $levelsave-||-else-||-$groupbit->getBitLevel()|checked_if_has_access:$moduleSelected->getAccess()-||-/if-| />
					|-$groupbit->getName()-|<br />
				|-/foreach-|		
				<input type="checkbox" name="permissionGeneral[all]" value="true" |-$levelsave|checked:$moduleSelected->getAccess()-| /> Todos</td>
		|-if !empty($affiliateLevels)-|<td nowrap>
			|-foreach from=$affiliateLevels item=groupbit name=bitlevelgroup-|
				<input type="checkbox" name="permissionAffiliateGeneral[access][]" value="|-$groupbit->getBitLevel()-|" |-if $moduleSelected->getAccessAffiliateUser() gte $levelsave-||-else-||-$groupbit->getBitLevel()|checked_if_has_access:$moduleSelected->getAccessAffiliateUser()-||-/if-| />
				|-$groupbit->getName()-|<br />
			|-/foreach-|					
			<input type="checkbox" name="permissionAffiliateGeneral[all]" value="true" |-$levelsave|checked:$moduleSelected->getAccessAffiliateUser()-| /> Todos
		</td> |-/if-|
		|-if class_exists("RegistrationUser")-|<td>
			<input type="checkbox" name="permissionRegistrationGeneral" value="1" |-$generalAccess.permissionRegistrationGeneral|checked:1-|/>
		</td>|-/if-|
	</tr> 
</table>
<p>&nbsp;</p>
<p><input type="submit" value="Guardar Permisos" />	</p>
</fieldset>

<fieldset class="noMargin">
	<legend>Permisos de Acciones</legend>
Asigne los permisos correspondientes y haga click en "Guardar Permisos" para guardar los cambios.<br>
Dejar vacios aquella acciones que hereden permisos del módulo.</p>
<p>	<input type="submit" value="Guardar Permisos" />	</p>
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<th scope="col">Action</th>
		<th scope="col">No verifica login</th>
		<th scope="col">Usuarios</th> 
	|-if !empty($affiliateLevels)-|<th scope="col">Usuarios Por Afiliado</th>|-/if-|
	|-if class_exists("RegistrationUser")-|<th scope="col">Usuarios Por Registro</th>|-/if-|
	</tr> 
	|-foreach from=$withoutPair item=action name=modulef-|
	<tr> 
		<td><h3>|-$action|multilang_get_actionLabel_translation-|</h3>
      |-$action|multilang_get_action_description-| <em>(|-$action-|)</em></td> 
		<td><input type="checkbox" name="noCheckLogin[|-$action-|]" value="1" |-$withoutPairAccess.$action.noCheckLogin|checked:1-| /></td>
		<td nowrap>
			|-foreach from=$levels item=groupbit name=bitlevelgroup-|
				<input type="checkbox" name="permission[|-$action-|][access][]" value="|-$groupbit->getBitLevel()-|" |-$groupbit->getBitLevel()|checked_if_has_access:$withoutPairAccess.$action.bitLevel-| /> 
			|-$groupbit->getName()-|<br />
			|-/foreach-|		
			<input type="checkbox" name="permission[|-$action-|][all]" value="true" |-$withoutPairAccess.$action.all|checked:1-| /> 
			Todos</td>
		|-if !empty($affiliateLevels)-|<td nowrap>
			|-foreach from=$affiliateLevels item=groupbit name=bitlevelgroup-|
				<input type="checkbox" name="permissionAffiliate[|-$action-|][access][]" value="|-$groupbit->getBitLevel()-|" |-$groupbit->getBitLevel()|checked_if_has_access:$withoutPairAccess.$action.bitLevelAffiliate-| />
				|-$groupbit->getName()-| <br />
			|-/foreach-|		
			<input type="checkbox" name="permissionAffiliate[|-$action-|][all]" value="true" |-$withoutPairAccess.$action.affiliateAll|checked:1-|> Todos</td> |-/if-|
		|-if class_exists("RegistrationUser")-|<td>
			<input type="checkbox" name="permissionRegistration[|-$action-|]" value="1" |-$withoutPairAccess.$action.permissionRegistration|checked:1-|/></td>|-/if-|
	</tr> 
	|-/foreach-|
	|-foreach from=$withPair item=action name=modulef-|
	<tr> 
		<td><h3>|-$action|multilang_get_actionLabel_translation-|</h3>
      |-$action|multilang_get_action_description-| <em>(|-$action-|)</em></td> 
		<td><input type="checkbox" name="noCheckLogin[|-$action-|]" value="1" |-$withPairAccess.$action.noCheckLogin|checked:1-|/></td>
		<td nowrap>
			|-foreach from=$levels item=groupbit name=bitlevelgroup-|
				<input type="checkbox" name="permission[|-$action-|][access][]" value="|-$groupbit->getBitLevel()-|" |-$groupbit->getBitLevel()|checked_if_has_access:$withPairAccess.$action.bitLevel-| /> |-$groupbit->getName()-|<br />
			|-/foreach-|		
			<input type="checkbox" name="permission[|-$action-|][all]" value="true" |-$withPairAccess.$action.all|checked:1-|> Todos
			<input type="hidden" name="pair[|-$action-|][pair]" value="|-$pairActions[$action]-|" />
	  </td>
		|-if !empty($affiliateLevels)-|<td nowrap>
			|-foreach from=$affiliateLevels item=groupbit name=bitlevelgroup-|
				<input type="checkbox" name="permissionAffiliate[|-$action-|][access][]" value="|-$groupbit->getBitLevel()-|" |-$groupbit->getBitLevel()|checked_if_has_access:$withPairAccess.$action.bitLevelAffiliate-| />
				|-$groupbit->getName()-| <br />
			|-/foreach-|		
			<input type="checkbox" name="permissionAffiliate[|-$action-|][all]" value="true" |-$withoutPairAccess.$action.affiliateAll|checked:1-|> Todos
			<input type="hidden" name="permissionAffiliate[|-$action-|][access][]" value="0" /></td> |-/if-|
		|-if class_exists("RegistrationUser")-|<td>
			<input type="checkbox" name="permissionRegistration[|-$action-|]" value="1" |-$withPairAccess.$action.permissionRegistration|checked:1-|/></td>	 |-/if-|	
	</tr> 
	|-/foreach-|
</table>
<p>&nbsp;</p>
<p><input type="submit" value="Guardar Permisos" />	</p>
</fieldset>
