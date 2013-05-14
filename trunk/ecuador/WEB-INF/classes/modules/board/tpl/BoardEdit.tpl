|-if !is_object($boardChallenge)-|
<div>Consigna no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal de consignas haciendo click <a href="Main.php?do=boardList">aquí</a></div>
|-else-|
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
		});
		$( ".datepickerStart" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerEnd").datepicker("option", "minDate", selectedDate);
            }
		});
		$(".datepickerEnd").datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerStart").datepicker("option", "maxDate", selectedDate);
            }
		});

	});//fin docready
 
</script>
<script src="Main.php?do=js&name=js&module=board&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-include file='BoardEditTinyMceInclude.tpl' elements="params_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-| 
<h2>##board,1,Consignas##</h2>
<h1>|-if !$boardChallenge->isNew()-|##board,23,Editar entrada##|-else-|##board,24,Crear entrada##|-/if-| </h1>
|-if $message eq "ok"-|
	<div class="successMessage">Consigna guardada correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">##board,25,Ha ocurrido un error al intentar guardar la entrada##</div>
|-/if-|
<div id="divMsgBox"></div>
<div id="div_boardChallenge">
	<p><div id="validate"></div></p>
	<form name="form_edit_boardChallenge" id="form_edit_boardChallenge" action="Main.php" method="post">
		<p>##board,26,Ingrese los datos de la entrada##</p>
		<fieldset title="##board,27,Formulario de edición de datos de un noticia##">
		<legend>##board,28,Formulario de Consigna##</legend>
			<p>
				<label for="params_title">##board,10,Título##</label>
				<input name="params[title]" type="text" id="params_title" title="title" value="|-$boardChallenge->gettitle()|escape-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="params_body">##board,32,Texto de la entrada##</label>
				<textarea name="params[body]" cols="60" rows="15" wrap="VIRTUAL"  id="params_body">|-$boardChallenge->getbody()|htmlentities-|</textarea>
			</p>
			<p>
				<label for="params_creationDate">##board,35,Fecha de Creación##</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="datepicker" title="creationDate" value="|-$boardChallenge->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="params_startDate">##board,35,Fecha de Creación##</label>
				<input name="params[startDate]" type="date" id="params_startDate" class="datepickerStart" title="startDate" value="|-$boardChallenge->getstartDate()|date_format:"%d-%m-%Y"-|" size="12" />
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="params_endDate">##board,35,Fecha de Creación##</label>
				<input name="params[endDate]" type="date" id="params_endDate" class="datepickerEnd" title="endDate" value="|-$boardChallenge->getendDate()|date_format:"%d-%m-%Y"-|" size="12" />
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			|-assign var=boardChallengeId value=$boardChallenge->getId()-|
			|-if not empty($boardChallengeId)-|
			<p>
				<label for="params_status">##board,13,Estado##</label>
				<select name="params[status]" id="params_status">
					|-foreach from=$boardChallengeStatus key=key item=name-|
						<option value="|-$key-|" |-if ($boardChallenge->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			|-/if-|
				|-if $boardChallenge neq ''-|
|-if $boardConfig.bodyOnArticlesShow.value eq "NO"-|<p>
				<label>Vistas</label> |-$boardChallenge->getViews()-| veces
			</p>|-/if-|
				|-/if-|
				|-if !$boardChallenge->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$boardChallenge->getid()-|" />
				<input type="hidden" name="params[url]" id="params_url" value="|-$boardChallenge->getUrl()-|" />
				|-/if-|
				
			<p>	
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					
				<input type="hidden" name="action" id="action" value=|-if !$boardChallenge->isNew()-|"edit"|-else-|"create"|-/if-| />
				
				<input type="button" id="button_edit_boardChallenge" name="button_edit_boardChallenge" title="##board,40,Guardar##" value="##board,40,Guardar##" onClick="javascript:validateInternal('form_edit_boardChallenge');"  /> <input type="button" id="button_return_project" name="button_return_project" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=boardList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
				|-if !$boardChallenge->isNew()-|
				<input type="button" id="button_edit_boardChallenge" name="button_edit_boardChallenge" title="##board,42,Vista previa en listado##" value="##board,42,Vista previa en listado##" onClick="javascript:submitPreviewOnHome(this.form)"/>
				|-/if-|
	|-if $boardConfig.bodyOnArticlesShow.value eq "NO"-|<input type="button" id="button_edit_boardChallenge" name="button_edit_boardChallenge" title="##board,41,Vista previa del detalle##" value="##board,41,Vista previa del detalle##" onClick="javascript:submitPreviewDetailed(this.form)"  />|-/if-|
			</p>
			<p>
			</p>
		</fieldset>
	</form>
</div>

<script type="text/javascript">
	function validateInternal(form){
		$.ajax({
			url: 'Main.php?do=boardDatesValidateX',
			data: $('#' + form).serialize(),
			type: 'post',
			success: function(data){
				$('#divMsgBox').html(data);
			}
		});
	}
	
</script>
|-if $boardConfig.useCommets.value eq "YES" && !$boardChallenge->isNew()-|	<div>
		<fieldset>
			<form action="Main.php" method="get">
				<input type="hidden" name="entryId" value="|-$boardChallenge->getId()-|" id="entryId" />
				<input type="hidden" name="do" value="boardCommentsList" />
				<input type="submit" value="Ver comentarios asociados a este artículo" />
			</form>
		</fieldset>
	</div>
|-/if-|
|-/if-|
