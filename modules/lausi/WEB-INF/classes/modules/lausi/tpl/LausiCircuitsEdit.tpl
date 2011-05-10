<h2>Configuración del Sisitema</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Circuito</h1>
	<div id="div_circuit">
		<form name="form_edit_circuit" id="form_edit_circuit" action="Main.php" method="post">
			|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el circuito</span>|-/if-|
			<p>
				Ingrese los datos del circuito.
			</p>
			<fieldset title="Formulario de edición de datos de un circuito">
				<p>
					<label for="name">Nombre</label>
					<input name="circuit[name]" type="text" id="name" title="name" value="|-$circuit->getname()-|" size="30" maxlength="100" />
				</p>
			<p><script type="text/javascript" src="scripts/jscolor.js"></script>
					<label for="color">Color</label>
					<input name="circuit[color]" type="text" id="color" title="name" value="|-$circuit->getColor()-|" size="10" maxlength="7" class="color {hash:true, pickerPosition:'top'}" />
				<p>
					<label for="description">Descripción</label>
					<textarea name="circuit[description]" cols="65" rows="3" wrap="VIRTUAL" id="description">|-$circuit->getdescription()-|</textarea>
				</p>
				<p>
					<label for="limitsDescription">Límites</label>
					<textarea name="circuit[limitsDescription]" cols="65" rows="3" wrap="VIRTUAL" id="limitsDescription">|-$circuit->getlimitsDescription()-|</textarea>
				</p>
				
				<div id="points_container" style="display:none;">
					|-foreach from=$circuitPoints key=key item=point-|
					<div id="point_|-$key-|">
						<input type="hidden" id="point_|-$key-|_latitude" name="circuitPoints[point_|-$key-|][params][latitude]" value="|-$point->getLatitude()-|" />
						<input type="hidden" id="point_|-$key-|_longitude" name="circuitPoints[point_|-$key-|][params][longitude]" value="|-$point->getLongitude()-|" />
						<input type="hidden" id="point_|-$key-|_circuitId" name="circuitPoints[point_|-$key-|][params][circuitId]" value="|-$point->getCircuitId()-|" />
					</div>
					|-/foreach-|
				</div>
				<p>
					|-if $action eq "edit"-|
					<input type="hidden" name="id" id="id" value="|-$circuit->getid()-|" />
					|-/if-|
					<input type="hidden" name="action" id="action" value="|-$action-|" />
					<input type="hidden" name="do" id="do" value="lausiCircuitsDoEdit" />
					<input type="submit" id="button_edit_circuit" name="button_edit_circuit" title="Aceptar" value="Aceptar" />
				</p>
					</fieldset>
		</form>					
	</div>

|-if $action eq "edit"-|
	<div >
		<p><span id="msgbox"></span></p>
	</div>
	<div id="workforceCircuit">
<fieldset><legend>Contratistas</legend>	
		<form id='workforceAdder' method="post">				
			<p>
				<select name="workforceId">
				|-foreach from=$workforces item=workforce name=for_workforce-|
					<option value="|-$workforce->getId()-|">|-$workforce->getName()-|</option>
				|-/foreach-|
				</select>
				<input type="hidden" name="do" value="lausiCircuitsDoAddWorkforceX" />
				<input type="hidden" name="circuitId"  value="|-$circuit->getId()-|" />
				<input type="button" value="Agregar Contratista" onClick="javascript:lausiAddWorkforceToCircuit(this.form)"/>
			</p>
		</form>
		<p>
			<ul id="currentWorkforcesList">
			 |-foreach from=$currentWorkforces item=workforce name=for_current_workforces-| 
			<li id="currentWorkforceListItem|-$workforce->getId()-|">|-$workforce->getName()-|
				<form  method="post"> 
				<input type="hidden" name="do" id="do" value="lausiCircuitsDoDeleteWorkforceX" /> 
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

|-include file="LausiCircuitsEditMapInclude.tpl"-|
