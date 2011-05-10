<h2>Asignación de Contratistas</h2>
<h1>Asignar Séxtuples a Contratistas</h1>

<script type="text/javascript" charset="utf-8">
	
	function lausiWorkforcesAssign(advertId,form) {

		var msgbox = 'msgBox' + advertId; 
		$(msgbox).innerHTML = "<span class='inProgress'>actualizando</span>";

		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'ajaxUpdatePlaceholder'},
					url,
					{
						method: 'post',
						postBody: fields,
						evalScripts: true
					});

		return true;
	
	}
	
</script>

<div id="messages">
	|-if $message eq "ok"-|
		<div class="message_ok">Asignación de contratista a sextuple guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="message_ok">Relación de contratista a sextuple eliminada</div>
	|-/if-|	
</div>

<div id="Generalfilters">
	<fieldset>
		<legend>Seleccione una Fecha a administrar</legend>
		<form action="Main.php" method="get" id="workforceAdvertisementFinder">
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
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[searchFromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<input type="hidden" name="do" value="lausiWorkforcesAssign" />
				<input type="submit" name="buscar" value="Buscar avisos sin asignar" id="some_name" />
			</p>
		</form>
	</fieldset>
</div>

|-if $notAssignedAdvertisements neq ''-|

<div id="ajaxUpdatePlaceholder">
	|-include file="LausiWorkforcesAssigmentsInclude.tpl" date=$mysqlFromDate-|
</div>

	<div id="notAssignedAdvertisements">
	<h3><span id="counter">|-$notAssignedAdvertisements|@count-|</span> Séxtuples sin asignar</h3>

			<table id="table-advertisement-not-assigned" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
				<thead>
					<tr>
						<th>Dirección</th>
						<th>Motivo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					|-foreach from=$notAssignedAdvertisements item=advertisement name=for_notassignedadvertisements-|
						<tr>
							|-assign var=billboard value=$advertisement->getBillboard()-|
							|-assign var=theme value=$advertisement->getTheme()-|
							|-assign var=address value=$billboard->getAddress()-|
							<td>|-$address->getName()-|</td>
							<td>|-$theme->getName()-|</td>
							<td>
								<form action="Main.php" method="post" >
									<select name="workforceId" onChange="javascript:lausiWorkforcesAssign(|-$advertisement->getId()-|,this.form);">
											<option value="0">Seleccione Contratista</option>
										|-foreach from=$workforces item=workforce name=for_workforces-|
											<option value="|-$workforce->getId()-|" >|-$workforce->getName()-|</option>
										|-/foreach-|
									</select> <span id="msgBox|-$advertisement->getId()-|"></span>
									<input type="hidden" name="advertisementId" value="|-$advertisement->getId()-|" />
									<input type="hidden" name="ajax" value="1" />
									<input type="hidden" name="do" value="lausiWorkforcesDoAssign" />
								</form>

							</td>
						</tr>
					|-/foreach-|
				</tbody>
			</table>
	</div>

|-/if-|
