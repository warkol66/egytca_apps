|-include file="CommonAutocompleterInclude.tpl"-|

<script type="text/javascript" src="scripts/lightbox.js"></script>

<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="buttonImageDelete" /></a> 
	</p> 
	|-include file="ActorsEditInclude.tpl"-|
</div> 

<form name="form_edit_position" id="form_edit_position" action="Main.php" method="post">
	<fieldset title="Formulario de edición de datos de un cargo">
    	<legend>Ingrese los datos del cargo</legend>
		<p>
			<label>Cargo ocupado por:</label>
			<input type="radio" name="positionTenureData[objectType]" value="Actor" onclick="showTenureType(this.value)" |-$positionTenure->getObjectType()|checked:"Actor"-| />##actors,2,Actor##
			<a class="tooltipWide" href="#"><span>Sólo podrá agregar ##actors,1,Actores## que estén cargados en el sistema.</span><img src="images/icon_info.gif"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#lightbox1" rel="lightbox1" class="lbOn addNew">Crear nuevo ##actors,2,Actor##</a> <br />
			<input type="radio" name="positionTenureData[objectType]" value="User" onclick="showTenureType(this.value)" |-if $positionTenure->getid() neq ""-||-$positionTenure->getObjectType()|checked:"User"-||-else-| checked="checked"|-/if-| />Usuario
		</p>

		<div id="tenureActor"|-if $positionTenure->getid() eq "" || $positionTenure->getObjectType() eq "User"-| style="display:none; position: relative;"|-/if-| style="position: relative;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_actors" label="##actors,2,Actor## que ocupa el cargo" url="Main.php?do=actorsAutocompleteListX" hiddenName="positionTenureData[actorId]" defaultHiddenValue=$actor->getId() disableSubmit="button_edit_position_tenure"-|
		</div>
	
		<div id="tenureUser"|-if $positionTenure->getObjectType() eq "Actor"-| style="display:none; position: relative;"|-/if-| style="position: relative;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_users" label="Usuario que ocupa el cargo" url="Main.php?do=usersAutocompleteListX" hiddenName="positionTenureData[userId]" defaultHiddenValue=$user->getId() disableSubmit="button_edit_position_tenure"-|
		</div>	
		
		|-if ($configModule->get("positions","useFemale") eq true && $position->getOwnerNameFemale() ne "" && $position->getOwnerNameFemale() ne $position->getOwnerName())-|			
		<p><label for="positionTenureData[ownerName]">Nombre del Cargo</label>
					<input name="positionTenureData[ownerName]" type="radio" |-if $positionTenure->getid() neq ""-||-$positionTenure->getOwnerName()|checked:$position->getOwnerName()-||-else-| checked="checked"|-/if-| value="|-$position->getOwnerName()|escape-|" />|-$position->getOwnerName()-|
					<input name="positionTenureData[ownerName]" type="radio" |-$positionTenure->getOwnerName()|checked:$position->getOwnerNameFemale()-| value="|-$position->getOwnerNameFemale()|escape-|" />|-$position->getOwnerNameFemale()-|
		</p>
		|-else-|
		<input type="hidden" name="positionTenureData[ownerName]" value="|-$positionTenure->getOwnerName()|escape-|" />	
		|-/if-| 
		<p>
			<label for="positionTenureData[dateFrom]">Fecha desde la cual ocupa el cargo</label>
			<input name="positionTenureData[dateFrom]" type="text" id="positionTenureData_dateFrom" value="|-$positionTenure->getDateFrom()|date_format:"%d-%m-%Y"-|" size="12" maxlength="20" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('positionTenureData[dateFrom]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha (Formato: dd-mm-yyyy)">					
		</p>	
	
		<p>
			<label for="positionTenureData[dateTo]">Fecha hasta la cual ocupa el cargo</label>
			<input name="positionTenureData[dateTo]" type="text" id="positionTenureData[dateTo]" value="|-$positionTenure->getDateTo()|date_format:"%d-%m-%Y"-|" size="12" maxlength="20" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('positionTenureData[dateTo]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha (Formato: dd-mm-yyyy)">
		</p>
		<p>
		|-if $positionTenure->getId() ne ""-|
			<input type="hidden" name="id" id="id" value="|-$positionTenure->getId()-|" />
		|-/if-|
			<input type="hidden" name="positionTenureData[positionCode]" id="positionCode" value="|-$position->getCode()-|" />
			<input type="hidden" name="do" id="do" value="positionsTenuresDoEdit" />
			<br />
			<input type="submit" id="button_edit_position_tenure" name="button_edit_position_tenure" title="Aceptar" disabled value="Aceptar" />
		</p>

	</fieldset>
</form>	