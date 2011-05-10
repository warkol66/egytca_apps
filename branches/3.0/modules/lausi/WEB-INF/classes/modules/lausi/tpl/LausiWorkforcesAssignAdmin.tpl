<h2>Asignación de Séxtuples</h2>
<h1>Administrar Asignación a Contratistas</h1>

<script type="text/javascript" charset="utf-8">
	function submitWorkforceAdvertisementFinder() {
		$('workforceAdvertisementFinder').submit();
	}
</script>

<div id="messages">
	|-if $message eq "ok"-|
		<div class="message_ok">Asignación de contratista guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="message_ok">Asignación de contratista eliminada</div>
	|-/if-|	
</div>

<div id="Generalfilters">
	<fieldset>
		<legend>Seleccione un Contratista</legend>
		<form action="Main.php" method="get" id="workforceAdvertisementFinder">
			<p>
				<label for="filters[searchWorkforceId]">Contratista</label>
				<select name="filters[searchWorkforceId]">
						<option value="">Seleccione Contratista</option>
					|-foreach from=$workforces item=workforce name=for_workforces-|
						<option value="|-$workforce->getId()-|" |-$workforce->getId()|selected:$filters.searchWorkforceId-|>|-$workforce->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="filters[searchThemeId]">Motivo</label>
				<select name="filters[searchThemeId]">
						<option value="">Seleccione un Motivo</option>
					|-foreach from=$themes item=theme name=for_themes-|
						<option value="|-$theme->getId()-|" |-$theme->getId()|selected:$filters.searchThemeId-|>|-$theme->getName()-| - |-$theme->getShortName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="filters[searchFromDate]">Fecha inicio</label>
				<input name="filters[searchFromDate]" type="text" id="fromDate" title="fromDate" value="|-if $filters.searchFromDate neq ''-||-$filters.searchFromDate|date_format:"%d-%m-%Y"-||-else-||-$smarty.now|date_format:"%d-%m-%Y"-||-/if-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('fromDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<input type="hidden" name="do" value="lausiWorkforcesAssignAdmin" />
				<input type="submit" name="buscar" value="Buscar avisos sextuples asignadas" id="some_name" />
			</p>
		</form>
	</fieldset>
</div>
|-if $assignedWorkforce neq ''-|

<h3>Administrar asignaciones del contratista: |-$assignedWorkforce->getName()-|</h3>

<div id="Advertisementfilters">
	<fieldset>
		<legend>Filtros</legend>
		<form action="Main.php" method="get">
			<p>
				<label for="filters[searchCircuitId]">Circuito</label>
				<select name="filters[searchCircuitId]">
						<option value="">Seleccione un Circuito</option>
					|-foreach from=$circuits item=circuit name=for_circuit-|
						<option value="|-$circuit->getId()-|" |-$circuit->getId()|selected:$filters.searchCircuitId-|>|-$circuit->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<input type="hidden" name="workforceId" value="|-$assignedWorkforce->getId()-|" />
				|-if $themeId neq ''-|
					<input type="hidden" name="themeId" value="|-$themeId-|"/>
				|-/if-|
				|-if $fromDate neq ''-|
					<input type="hidden" name="fromDate" value="|-$fromDate-|"/>
				|-/if-|
				<input type="hidden" name="do" value="lausiWorkforcesAssignAdmin" />
				<input type="submit" name="buscar" value="Aplicar Filtro" id="some_name" />
				<input type="button" name="quitar_filtros" value="Quitar Filtros" onClick="javascript:submitWorkforceAdvertisementFinder();"/>
				
			</p>					
		</form>
	</fieldset>
</div>

	<div id="workforcesByAdvertisement">
	<h3>Séxtuples |-if $assignedCircuit neq ''-|en circuito |-$assignedCircuit->getName()-| |-/if-|asignados  a: |-$assignedWorkforce->getName()-|</h1>

		<form action="Main.php?do=lausiWorkforcesAssignDelete" method="post">
			<table id="tabla-advertisements-assigned" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
				<thead>
					<tr>
						<th></th>
						<th>Dirección</th>
						<th>Motivo</th>
					</tr>
				</thead>
				<tbody>
					|-foreach from=$assignedAdvertisements item=advertisement name=for_advertisements-|
						<tr>
							|-assign var=billboard value=$advertisement->getBillboard()-|
							|-assign var=theme value=$advertisement->getTheme()-|
							|-assign var=address value=$billboard->getAddress()-|
							<td><input type="checkbox" name="toDelete[]" value="|-$advertisement->getId()-|" id="some_name"></td>
							<td>|-$address->getName()-|</td>
							<td>|-$theme->getName()-|</td>
						</tr>
					|-/foreach-|
				<tr>
					 <th colspan="4" class="thFillTitle">
						<div class="rightLink">
							<input type="submit" name="delete" value="Eliminar Seleccionados a |-$assignedWorkforce->getName()-|" />
							<input type="hidden" name="workforceId" value="|-$assignedWorkforce->getId()-|" />
							|-if $assignedCircuit neq ''-|
							<input type="hidden" name="circuitId" value="|-$assignedCircuit->getId()-|" />
							|-/if-|
							|-if $themeId neq ''-|
								<input type="hidden" name="themeId" value="|-$themeId-|"/>
							|-/if-|
							|-if $fromDate neq ''-|
								<input type="hidden" name="fromDate" value="|-$fromDate-|"/>
							|-/if-|
						</div>
					 </th>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
<br />

	<div id="notAssignedAdvertisements">
	<h3>Séxtuples |-if $assignedCircuit neq ''-|en circuito |-$assignedCircuit->getName()-| |-/if-|sin asignar a: |-$assignedWorkforce->getName()-|</h1>

		<form action="Main.php?do=lausiWorkforcesDoAssign" method="post">
			<table id="table-advertisement-not-assigned" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
				<thead>
					<tr>
						<th></th>
						<th>Dirección</th>
						<th>Motivo</th>
					</tr>
				</thead>
				<tbody>
					|-foreach from=$notAssignedAdvertisements item=advertisement name=for_notassignedadvertisements-|
						<tr>
							|-assign var=billboard value=$advertisement->getBillboard()-|
							|-assign var=theme value=$advertisement->getTheme()-|
							|-assign var=address value=$billboard->getAddress()-|
							<td><input type="checkbox" name="toAssign[]" value="|-$advertisement->getId()-|" id="some_name"></td>
							<td>|-$address->getName()-|</td>
							<td>|-$theme->getName()-|</td>
						</tr>
					|-/foreach-|						
				<tr>
					 <th colspan="4" class="thFillTitle">
						<div class="rightLink">
							<input type="submit" name="delete" value="Asignar Seleccionados  a |-$assignedWorkforce->getName()-|" />
							<input type="hidden" name="workforceId" value="|-$assignedWorkforce->getId()-|" />
							|-if $assignedCircuit neq ''-|
							<input type="hidden" name="circuitId" value="|-$assignedCircuit->getId()-|" />
							|-/if-|
							|-if $themeId neq ''-|
								<input type="hidden" name="themeId" value="|-$themeId-|"/>
							|-/if-|
							|-if $fromDate neq ''-|
								<input type="hidden" name="fromDate" value="|-$fromDate-|"/>
							|-/if-|
						</div>
					 </th>
				</tr>
				</tbody>
			</table>
		</form>
	</div>

|-/if-|
