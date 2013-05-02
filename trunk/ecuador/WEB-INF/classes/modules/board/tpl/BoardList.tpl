<script src="Main.php?do=js&name=js&module=board&code=|-$currentLanguageCode-|" type="text/javascript"></script>
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
<h2>##board,1,board##</h2>
<h1>##board,2,Lista de Desafíos##</h1>
<p>##board,3,A continuación se muestra el listado de desafíos disponibles en el sistema, ud. podrá agregar nuevos o eliminar los existentes, así como publicar o archivar un desafío.##</p>
<div id="boardFilters">
<form action="Main.php" method="get">
	<fieldset title="##board,7,Formulario de Opciones de búsqueda de desafíos##">
		<legend>##board,4,Opciones de Búsqueda##</legend>
		<p>
			<label for="fromDate">##board,5,Fecha Desde##</label>
			<input name="filters[dateRange][creationdate][min]" type="text" id="filters_dateRange_min" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.creationdate.min|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0"  title="Seleccione la fecha">
		</p>
		<p>
			<label for="toDate">##board,6,Fecha Hasta##</label>
			<input name="filters[dateRange][creationdate][max]" type="text" id="filters_dateRange_max" class="datepickerTo" title="toDate" value="|-$filters.dateRange.creationdate.max|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
		</p>
		<p>
			<input type="hidden" name="do" value="boardList" />
			<input type="submit" value="##board,8,Buscar##">
		</p>
	</fieldset>
</form>
</div>
<div id="divMsgBox"></div>
	|-if $message eq "ok"-|
		<div class="successMessage">##board,19,Consigna guardado correctamente##</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##board,20,Consigna eliminada correctamente##</div>
	|-elseif $message eq "changed"-|
	<div class="successMessage">##board,21,Estados modificados correctamente##</div>
	|-elseif $message eq "not_edited"-|
	<div class="errorMessage">##board,22,Error al modificar la consigna. Verifique que la consigna que está intentando editar existe##</div>
	|-/if-|
	|-if $notValidId-|
	<div class="errorMessage">|-$message-|</div>
	|-/if-|
|-assign var="colSpan" value=5-|
|-if $boardConfig.useCategories.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
<div id="div_boardChallenges">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-boardChallenges">
		<thead>
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=boardEdit" class="addLink">##board,9,Agregar Consigna##</a></div></th>
			</tr>
			<tr>
				<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" />
				</th>
				<th width="40%">##board,10,Título##</th>
				<th width="8%">##board,11,Fecha##</th>
				<th width="15%">##board,13,Estado##</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$boardChallengeColl item=boardChallenge name=for_boardChallenges-|
			<tr>
				<td><input type="checkbox" name="selected[]" value="|-$boardChallenge->getId()-|"></td>
				<td>|-$boardChallenge->gettitle()-|</td>
				<td>|-$boardChallenge->getcreationDate()|date_format:"%d-%m-%Y"-|</td>
			<td>|-if "boardChangeStatusX"|security_user_has_access-|	
						<form action="Main.php" method="post" id="formStatusChallenges|-$boardChallenge->getId()-|">
							<select name="params[status]" id="selectChallengeStatus|-$boardChallenge->getId()-|" onChange="javascript:submitChallengesChangeFormX('formStatusChallenges|-$boardChallenge->getId()-|')">
								|-foreach from=$boardChallengeStatus key=key item=name-|
									<option value="|-$key-|" |-if ($boardChallenge->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
								|-/foreach-|
							</select>											
							<input type="hidden" name="id" id="id" value="|-$boardChallenge->getid()-|" />
							<input type="hidden" name="do" value="boardChangeStatusX" id="do">
						</form>
				|-else-|
					|-assign var=articleStatus value=$boardChallenge->getStatus()-|
					|-$boardChallengeStatus[$articleStatus]-|
				|-/if-|
				</td>								
				<td nowrap>|-if "boardChangeStatusX"|security_user_has_access || "boardChangeStatuses"|security_user_has_access || $articleStatus eq 1-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="boardEdit" />
						<input type="hidden" name="id" value="|-$boardChallenge->getid()-|" />
						<input type="submit" name="submit_go_edit_boardEntry" value="##common,1,Editar##" title="##common,1,Editar##" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="boardDoDelete" />
						<input type="hidden" name="id" value="|-$boardChallenge->getid()-|" />
						<input type="submit" name="submit_go_delete_boardEntry" value="##common,2,Eliminar##" title="##common,2,Eliminar##" onclick="return confirm('##board,22,Seguro que desea eliminar la Consigna?##')" class="icon iconDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if $boardChallengeColl|@count neq 0 && "boardChangeStatuses"|security_user_has_access-|
			<tr>
				<td colspan="|-$colSpan-|">
					<form action="Main.php" method="post" id='multipleChallengesChangeForm'>
						<p>##board,16,Cambiar las Consignas seleccionados al estado##
							<select name="status" id="selectEntryStatus|-$boardChallenge->getId()-|">
							|-foreach from=$boardChallengeStatus key=key item=name-|
								<option value="|-$key-|" |-if ($boardChallenge->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
							|-/foreach-|
							</select>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
							<input type="hidden" name="do" value="boardChangeStatuses" id="do">
							<input type="button" onClick="javascript:submitMultipleChallengesChangeFormX('multipleChallengesChangeForm')" value="##board,17,Cambiar Estado##" title="##board,17,Cambiar Estado##" class="button">
						</p>
					</form>
				</td>
			</tr>
		|-/if-|
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
			<tr> 
				<td colspan="|-$colSpan-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=boardEdit" class="addLink">##board,9,Agregar Consigna##</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
