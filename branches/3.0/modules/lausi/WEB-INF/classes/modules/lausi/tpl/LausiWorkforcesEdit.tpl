<h2>Configuración del Sistema</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Contratista</h1>
<div id="div_workforce">
	<form name="form_edit_workforce" id="form_edit_workforce" action="Main.php" method="post">
	|-if $message eq "error"-|
		<div class="failuremMessage">Ha ocurrido un error al intentar guardar la Contratista</div>
	|-/if-|
		<p>Este formulario le permite |-if $action eq "edit"-|editar|-else-|crear|-/if-| un contratista y asociarlo a uno o varios circuitos para ser incluído en la distribución de la hoja de ruta</p>
		<fieldset title="Formulario de edición de datos de un Contratista">
		<legend>Contratistas</legend>
		<p>Ingrese los datos del Contratista</p>
			<p>
				<label for="name">Nombre</label>
				<input name="name" type="text" id="name" title="name" value="|-$workforce->getname()-|" size="45" maxlength="100" />
			</p>
			<p>
				<label for="telephone">Tel&eacute;fono</label>
				<input name="telephone" type="text" id="telephone" title="telephone" value="|-$workforce->gettelephone()-|" size="30" maxlength="100" />
			</p>																						
			<p>
				<label for="workInHeight">Trabaja en altura</label>
				<input type="checkbox" id="workInHeight" name="workInHeight" value="1"|-if $workforce->getworkInHeight() eq '1'-| checked="checked"|-/if-| />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-if $action eq "edit"-||-$workforce->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiWorkforcesDoEdit" />
				<input type="submit" id="button_edit_workforce" name="button_edit_workforce" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>

|-if $action eq "create"-|
<div >
	<p><span id="msgbox"></span></p>
</div>

<div id="workforceCircuit">
<fieldset title="Circuitos donde trabaja">
<legend>Circuitos</legend>
<p>Indique en que circuitos trabaja</p>
	<form id='circuitAdder' method="post">				
		<p>
			<select name="circuitId">
			|-foreach from=$circuits item=circuit name=for_circuit-|
				<option value="|-$circuit->getId()-|">|-$circuit->getName()-|</option>
			|-/foreach-|
			</select>
			<input type="button" value="Agregar circuito" onClick="javascript:lausiAddCircuitToWorkforceAtCreate()"/>
		</p>
	</form>
	<p>
		<ul id="currentCircuitsList">
		</ul>
	</p>
</fieldset>				
</div>
|-/if-|

|-if $action eq "edit"-|				

<div >
	<p><span id="msgbox"></span></p>
</div>

<div id="workforceCircuit">
<fieldset title="Circuitos donde trabaja">
<legend>Circuitos</legend>
<p>Indique en que circuitos trabaja</p>
	<form id='circuitAdder' method="post">				
		<p>
			<select name="circuitId">
			|-foreach from=$circuits item=circuit name=for_circuit-|
				<option value="|-$circuit->getId()-|">|-$circuit->getName()-|</option>
			|-/foreach-|
			</select>
			<input type="hidden" name="do" value="lausiWorkforcesDoAddCircuitX" />
			<input type="hidden" name="workforceId"  value="|-$workforce->getId()-|" />
			<input type="button" value="Agregar circuito" onClick="javascript:lausiAddCircuitToWorkforce(this.form)"/>
		</p>
	</form>
	<p>
		<ul id="currentCircuitsList">
		 |-foreach from=$currentCircuits item=circuit name=for_current_circuits-| 
		<li id="currentCircuitListItem|-$circuit->getId()-|">|-$circuit->getName()-|
			<form  method="post"> 
			<input type="hidden" name="do" id="do" value="lausiWorkforcesDoDeleteCircuitX" /> 
			<input type="hidden" name="circuitId"  value="|-$circuit->getId()-|" /> 
			<input type="hidden" name="workforceId"  value="|-$workforce->getId()-|" /> 
			<input type="button" value="Eliminar" onClick="javascript:lausiDeleteWorkforceFromCircuit(this.form)" class="iconDelete" /> 
			</form> 
		</li> 
		|-/foreach-|
		</ul>
	</p>

	</fieldset>
</div>				
|-/if-|
