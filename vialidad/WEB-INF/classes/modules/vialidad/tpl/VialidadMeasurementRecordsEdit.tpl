<h2>Actas de Medición</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del acta ingresado no es válido. Seleccione un acta del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadMeasurementRecordsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Actas"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl" -|

<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Acta de Medición</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Acta de Medición</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Acta de Medición</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_record" id="form_edit_record" onsubmit="return validateForm()" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Acta de Medición">
			<legend>Formulario de Administración de Actas de Medición</legend>
			<p>
				|-assign var=construction value=$record->getConstruction()-|
				|-if $action eq "create"-|
				<div style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadConstructionsAutocompleteListX" hiddenName="params[constructionId]" disableSubmit="button_edit_record" label="Obra"-|
				</div>
				|-else-|
				<label for="params[constructionId]">Obra</label>
				<span name="params[constructionId]">|-$construction->getName()-|</span>
				|-/if-|
			</p>
			<p>
				<label for="params[measurementDate]">Período</label>
				<input type="text" id="params[measurementDate]" name="params[measurementDate]" size="12" value="|-$record->getMeasurementDate()|date_format-|" title="Período" /><img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[measurementDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$record->getid()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadMeasurementRecordsDoEdit" />
				<input type="submit" id="button_edit_record" name="button_edit_record" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadMeasurementRecordsList'"/>
			|-if $action eq 'edit'-|
				<a href="#lightbox_comments" rel="lightbox_comments" class="lbOn"><input type="button" title="Comentarios" value="Comentarios" /></a>
			|-/if-|
			<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
	
	|-if $action eq 'edit'-|
	<div id=div_itemsRecords>
	<table id="table_itemsRecords" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="55%">Item</th> 
			<th width="15%">Cantidad</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Verificado</th>
			<th width="10%">Documento</th>
		</tr>
		</thead>
		<tbody>
		|-if $itemRecords->count() eq 0-|
		<tr>
			<td colspan="4">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$itemRecords item=itemRecord name=for_items-|
		<tr>
			|-assign var=item value=$itemRecord->getConstructionItem()-|
			<td>|-$item->getName()-|</td>
			<td align="right"><span id="quantity|-$itemRecord->getId()-|" class="inPlaceEditable">|-$itemRecord->getQuantity()|system_numeric_format-|</span></td>
			<td align="center">|-$item->getUnit()-|</td>
			<td align="center">
			  <input type="checkbox" |-$itemRecord->getVerified()|checked_bool-| onchange="updateVerified('|-$itemRecord->getId()-|', this.checked)" /></td>
			<td align="center">
				<a |-if $itemRecord->getDocumentid() neq ''-|style="display:none"|-/if-| href="#lightbox|-$itemRecord->getId()-|" rel="lightbox|-$itemRecord->getId()-|" class="lbOn"><img src="images/clear.png" class="icon iconAttach" /></a>
				<input |-if $itemRecord->getDocumentid() eq ''-|style="display:none"|-/if-| onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$itemRecord->getDocumentid()-|')" type="button" class="icon iconView" />
				<form action="Main.php?do=vialidadMeasurementRecordRelationsDoDeleteDocument" method="post">
					<input type="hidden" name="id" value="|-$itemRecord->getId()-|" />
					<input type="submit" |-if $itemRecord->getDocumentid() eq ''-|style="display:none"|-/if-| onclick="return confirm('Seguro que desea eliminar el documento definitivamente?')" class="icon iconDelete" />
				</form>
			</td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>

<script type="text/javascript" src="scripts/lightbox.js"></script>

|-if $action eq 'edit'-|
	
|-foreach from=$itemRecords item=itemRecord-|
<div id="lightbox|-$itemRecord->getId()-|" class="leightbox">
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p>
	
	<form method="post" action="Main.php?do=vialidadMeasurementRecordRelationsDoAddDocument" enctype="multipart/form-data" id="documentsAdderForm|-$itemRecord->getId()-|">
	<input type="hidden" name="id" value="|-$itemRecord->getId()-|" />
	<fieldset title="Formulario para agregar nuevo Documento">
		<legend>Anexar Documento</legend>
		<p>Ingrese los datos correspondientes al Documento que desea anexar.</p>
		<p>
			<label for="document_file">Archivo</label>
			<input type="file" id="document_file|-$itemRecord->getId()-|" name="document_file" title="Seleccione el archivo" size="45"/>
		</p>
		<p>
			<label for="date">Fecha</label>
			<input name="date" type="text" value="|-$smarty.now|date_format:'%d-%m-%Y'-|" size="10" title="Fecha del documento (Formato: dd-mm-yyyy)"/>
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="title">Título</label>
			<textarea name="title" cols="55" rows="2" wrap="virtual" title="Título"></textarea>
		</p>
		<p>
			<label for="description">Descripción</label>
			<textarea name="description" cols="55" rows="6" wrap="VIRTUAL" title="Descripción"></textarea>
		</p>
		<div id="upload_info|-$itemRecord->getId()-|"></div>
		<p>
			<input type="submit" name="uploadButton" value="Agregar Documento" ><span id="msgBoxUploader|-$itemRecord->getId()-|"></span>
		</p>
	</fieldset>
	</form>
</div>
|-/foreach-|

<div id="lightbox_comments" class="leightbox">
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a></p>
	
	<div id="comments" style="height:300px; overflow-y:scroll; width:300px;">
	|-if $comments|@count gt 0-|
		|-foreach from=$comments item=comment-|
		<div class="comment">
			|-assign var=commentUser value=$comment->getUser()-|
			<div class="commentUser"><h3>|-$commentUser->getUsername()-| (|-$comment->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y a las %R"-|)</h3></div>
			<div class="commentContent">|-$comment->getContent()-|</div>
		</div>
		|-/foreach-|
	|-else-|
		<div class="comment">
			<div class="commentContent">No hay comentarios asociados</div>
		</div>
		|-/if-|
	</div>
		<br />
		<form id="newComment">
			<input type="hidden" name="params[measurementRecordId]" value="|-$record->getId()-|" />
			<textarea name="params[content]" rows="3" wrap="VIRTUAL" style="width:55%;"></textarea>
		<br />
			<input type="button" onclick="addComment(this.form);" value="Agregar comentario" />
		</form>
</div>
			
|-/if-|

<script type="text/javascript">

Event.observe(
	window,
	'load',
	function() {
		|-if $action eq 'edit'-|
		attachInPlaceEditors();
		|-/if-|
		setCommentsDimensions();
	}
);

function setCommentsDimensions() {
	
	var width = 0.9 * $('comments').parentNode.getWidth();
	var height = 0.3 * $('comments').parentNode.getWidth();
	$('comments').style.width = width+'px';
	$('comments').style.height = height+'px';
}

function addComment(form) {
	var fields = Form.serialize(form);
	
	// si no se escribio un nuevo comentario termino aca
	if (form.elements['params[content]'].value == '')
		return;
	
	// limpio la textarea para un nuevo comentario
	form.elements['params[content]'].value = '';

	new Ajax.Updater(
		'comments',
		'Main.php?do=vialidadMeasurementRecordsDoAddCommentX',
		{
			method: 'post',
			postBody: fields,
			insertion: 'top'
		}
	);
}
	
function validateForm() {
	var submit = true;
	var params = ['constructionId', 'measurementDate'];
	
	for (var i=0; i<params.length; i++) {
		if (!($('form_edit_record').elements['params['+params[i]+']'].value)) {
			submit = false;
			$('div_form_error').show();
		}
	}
	
	return submit;
}

function updateVerified(itemRecordId, checkedValue) {
	new Ajax.Request(
		'Main.php?do=vialidadMeasurementRecordRelationsEditFieldX',
		{
			method: 'post',
			parameters: {
				id: itemRecordId,
				paramName: 'verified',
				paramValue: checkedValue
			}
		}
	);
}

function attachInPlaceEditors() {
	|-foreach from=$itemRecords item=itemRecord-|
	new Ajax.InPlaceEditor(
		'quantity|-$itemRecord->getId()-|',
		'Main.php?do=vialidadMeasurementRecordRelationsEditFieldX',
		{
			rows: 1,
			cols: 12,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'id=|-$itemRecord->getId()-|&paramName=quantity&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				element.innerHTML = element.innerHTML.replace(/(\n|\r)+$/, '');
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			}
		}
	);
	|-/foreach-|
}

</script>

|-/if-|
