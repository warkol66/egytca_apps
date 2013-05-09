<script src="Main.php?do=js&name=js&module=common&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script>
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
        $( ".datepickerFrom" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerTo").datepicker("option", "minDate", selectedDate);
            }
		});
		$(".datepickerTo").datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
            }
		});
    });
</script>
<h2>Histórico de Operaciones</h2>
<h1>Consultar Histórico de Operaciones</h1>
|-if $message eq "purged"-|
	<div class='successMessage'>Registros históricos eliminados correctamente</div>
|-/if-|
<fieldset>
	<legend><a href="javascript:void(null);" onClick='switch_vis("searchOptions");' class="tdTitSearch">Opciones de búsqueda</a></legend>
		<form name="form1" method="get" action="Main.php">
		<div id="searchOptions" style="display:|-if !isset($actionLogColl) || ($filters|@count gt 0)-|inline|-else-|none|-/if-|">
		<input type='hidden' name='do' value='commonActionLogsList' />
				<p><label for="filters[userId]">Usuario</label>
					<select name="filters[userId]" id="filters_userid">
						<option value="">Todos</option>
						|-foreach from=$users item=user name=eachuser-|
						|-if $user->getId() neq -1-|
						<option value="|-$user->getId()-|" |-$user->getId()|selected:$filters.userId-|>|-if $user->getId() lt 3-||-$user->getUsername()-||-else-||-$user->getSurname()-|,|-$user->getName()-| (|-$user->getUsername()-|)|-/if-|</option> 
						|-/if-|
						|-/foreach-|
					</select>
				  </p>
				<p> 
					<label for="fromDate">Fecha Desde</label>
					<input name="filters[dateRange][datetime][min]" type="text" id="filters_dateRange_datetime_min" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.datetime.min|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0"  title="Seleccione la fecha">
				</p>
				<p> 
					<label for="toDate">Fecha Hasta</label>
					<input name="filters[dateRange][datetime][max]" type="text" id="filters_dateRange_datetime_max" class="datepickerTo" title="toDate" value="|-$filters.dateRange.datetime.max|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
				</p>
					<p>
					<label for="filters[module]">Módulo</label>
						<select name="filters[module]" id="filters_module">
						  <option value="0">Todos</option>
							|-foreach from=$modules item=moduleObj name=foreachModule-|
						  <option value="|-$moduleObj->getName()-|" |-$moduleObj->getName()|selected:$filters.module-|>|-$moduleObj->getName()|multilang_get_translation:"common"-|</option>
						  |-/foreach-|
						</select>
					</p>
				|-if count ($affiliates) gt 0-|
				<p> 
					<label for="filters[affiliateId]">Afiliado</label>
						<select name="filters[affiliateId]" id="filters[affiliateId]">
						  <option value="">Todos</option>
						  |-foreach from=$affiliates item=affiliateItem name=foreachaff-|
						  <option value="|-$affiliateItem->getId()-|" |-$affiliateItem->getId()|selected:$filters.affiliateId-|>|-$affiliateItem->getName()|truncate:95:"..."-|</option>
						  |-/foreach-|
						</select>
					</p>
				|-/if-|
			 </div>
				<p>
					<input name="listButton" type="submit" id="listButton" value="Listar">
					<input name="listLogs" type="hidden" id="listLogs" value="listLogs">
			 </p>
			</form>
			 </fieldset>
|-if !isset($actionLogColl) && $loginUser->isSupervisor()-| 
	<h4>Administración del Archivo Histórico</h4>
	<p>Puede eliminar registros históricos en 
	  <input name="btnPurgarLogs" type="submit" value="Purga de Datos" onClick="location.href='Main.php?do=commonActionLogsPurge'" /> 
	</p>
|-else-|
	<h4>Resultado de su consulta al histórico de operaciones del Sistema |-if $affiliateId gt 0-| del afiliado |-$affiliate->getName()-||-/if-|</h4>
		<table width="100%"  border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
			<tr> 
				<th width="10%" nowrap scope="col">Fecha y Hora</th>
				<th width="10%" scope="col">Usuario</th>
				<th width="20%" scope="col">Acción</th>
				<th width="60%" scope="col">Resultado</th>
			</tr>
			|-if count($actionLogColl) eq 0-|  
			<tr> 
				<td colspan='4' scope="col">No hay registros que coincidan con su consulta.</td>
			</tr>
			|-else-| 
			|-foreach from=$actionLogColl item=log name=eachlog-|
			<tr> 
			  <td nowrap scope="col">|-$log->getDatetime()|change_timezone-|</td>
			  <td nowrap scope="col">|-assign var="user" value=$log->getUserObject()-||-if $user ne ''-||-$user->getUsername()-||-/if-|</td>
			  <td scope="col" >|-assign var="actionLabel" value=$log->getActionLabel()-||-if $actionLabel ne ''-||-$actionLabel->getLabel()-||-else-||-$log->getAction()-||-/if-|</td>
			  <td scope="col" >|-assign var="label" value=$log->getLabel()-||-if $label ne ''-||-$label->getLabel()-|: |-/if-||-if $log->getMessage() ne ''-||-$log->getMessage()-||-/if-|</td>
			</tr>
			|-/foreach-|
			|-/if-|
  <tr>
		<td colspan="4"><input name="btnRegresar" type="button" id="regresar" value="Regresar" onClick="location.href='Main.php?do=commonActionLogsList'" />
	</td>
  </tr>
</table>
            
   |-/if-|
