<h2>Actas de Medición</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del acta ingresado no es válido. Seleccione un acta del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadMeasurementRecordsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Actas"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

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
				|-if $action eq "create"-|
				<input type="text" id="params[measurementDate]" name="params[measurementDate]" size="12" value="|-$record->getMeasurementDate()|date_format-|" title="Período" /><img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[measurementDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
				|-else-|
				<span>|-$record->getMeasurementDate()|date_format-|</span>
				|-/if-|
			</p>
		 <p>
		   <label for="params[code]">Número</label>
				|-if $action eq "create"-|
				<input name="params[code]" type="text" value="|-$record->getCode()|escape-|" size="8"> 
				|-else-|
				<span>|-$record->getCode()-|</span>
				|-/if-|
		</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$record->getid()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadMeasurementRecordsDoEdit" />
				|-if $action eq "create"-|<input type="submit" id="button_edit_record" name="button_edit_record" disabled="disabled" title="Aceptar" value="Guardar" />|-/if-|
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadMeasurementRecordsList'"/>
			|-if $action eq 'edit'-|
				<a href="#lightbox_comments" rel="lightbox_comments" class="lbOn"><input type="button" title="Comentarios" value="Comentarios" /></a>
			|-/if-|
			<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
	
	|-if $action eq 'edit'-|
	
	<h3>Items</h3>
	<div id=div_itemsRecords>
	<table id="table_itemsRecords" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="5%">Código</th> 
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
			<td colspan="6">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$itemRecords item=itemRecord name=for_items-|
		<tr>
			|-assign var=item value=$itemRecord->getConstructionItem()-|
			<td nowrap="nowrap">|-$item->getCode()-|</td>
			<td>|-$item->getName()-|</td>
			<td align="right"><span id="quantity|-$itemRecord->getId()-|" class="inPlaceEditable">|-$itemRecord->getQuantity()|system_numeric_format-|</span></td>
			<td align="center">|-$item->getMeasureUnit()-|</td>
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



<p>&nbsp;</p>
<h1>Agregar items al acta de medición &nbsp; <img src="image/clear.png" height="16" width="16" class="expandLink" id="iconViewAddItems" onClick="$('addItems').toggle(); $('iconViewAddItems').toggleClassName('collapseLink');" /></h1>	
<div id="addItems" style="display:none;">
|-include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$fines
	extraType="fine"
	extraName="Multas"
	deleteText="Seguro que desea eliminar la Multa?"
	createAction="vialidadFineDoEditX"
	editAction="vialidadFineDoEditFieldX"
	deleteAction="vialidadFineDoDeleteX"
-|

|-include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$dailyWorks
	extraType="dailyWork"
	extraName="Trabajos por Día"
	deleteText="Seguro que desea eliminar el Trabajo por Día?"
	createAction="vialidadDailyWorkDoEditX"
	editAction="vialidadDailyWorkDoEditFieldX"
	deleteAction="vialidadDailyWorkDoDeleteX"
-|

|-include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$adjustments
	extraType="adjustment"
	extraName="Ajustes"
	deleteText="Seguro que desea eliminar el Ajuste?"
	createAction="vialidadAdjustmentDoEditX"
	editAction="vialidadAdjustmentDoEditFieldX"
	deleteAction="vialidadAdjustmentDoDeleteX"
-|

|-include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$others
	extraType="other"
	extraName="Otros bienes y servicios"
	deleteText="Seguro que desea eliminar el el bien o servicio?"
	createAction="vialidadOtherDoEditX"
	editAction="vialidadOtherDoEditFieldX"
	deleteAction="vialidadOtherDoDeleteX"
-|	
</div>	
	
<p>&nbsp;</p>
<h1>Verificar y documentar &nbsp; <img src="image/clear.png" height="16" width="16" class="expandLink" id="iconViewVerifyItems" onClick="$('verifyItems').toggle(); $('iconViewVerifyItems').toggleClassName('collapseLink');" /></h1>	
<div id="verifyItems" style="display:none;">
		|-if $fines->count() gt 0-|
	<h3>Multas</h3>
	<div id=div_fines>
	<table id="table_fines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="65%">Descripción</th> 
			<th width="15%">Precio</th>
			<th width="10%">Verificado</th>
			<th width="10%">Documento</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$fines item=fine-|
		<tr>
			<td>|-$fine->getDescription()-|</td>
			<td align="right">|-$fine->getPrice()|system_numeric_format-|</td>
			|-assign var=itemRecord value=$fine->getMeasurementRecordRelation()-|
			<td align="center">
				<input type="checkbox" |-$itemRecord->getVerified()|checked_bool-| onchange="updateVerified('|-$itemRecord->getId()-|', this.checked)" />
			</td>
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
		</tbody>
	</table>
	</div>
		|-/if-|
	
		|-if $dailyWorks->count() gt 0-|
	<h3>Trabajos por Día</h3>
	<div id=div_dailyWorks>
	<table id="table_dailyWorks" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="65%">Descripción</th> 
			<th width="15%">Precio</th>
			<th width="10%">Verificado</th>
			<th width="10%">Documento</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$dailyWorks item=dailyWork-|
		<tr>
			<td>|-$dailyWork->getDescription()-|</td>
			<td align="right">|-$dailyWork->getPrice()|system_numeric_format-|</td>
			|-assign var=itemRecord value=$dailyWork->getMeasurementRecordRelation()-|
			<td align="center">
				<input type="checkbox" |-$itemRecord->getVerified()|checked_bool-| onchange="updateVerified('|-$itemRecord->getId()-|', this.checked)" />
			</td>
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
		</tbody>
	</table>
	</div>
		|-/if-|
	
		|-if $adjustments->count() gt 0-|
	<h3>Ajustes</h3>
	<div id=div_adjustments>
	<table id="table_adjustments" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="65%">Descripción</th> 
			<th width="15%">Precio</th>
			<th width="10%">Verificado</th>
			<th width="10%">Documento</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$adjustments item=adjustment-|
		<tr>
			<td>|-$adjustment->getDescription()-|</td>
			<td align="right">|-$adjustment->getPrice()|system_numeric_format-|</td>
			|-assign var=itemRecord value=$adjustment->getMeasurementRecordRelation()-|
			<td align="center">
				<input type="checkbox" |-$itemRecord->getVerified()|checked_bool-| onchange="updateVerified('|-$itemRecord->getId()-|', this.checked)" />
			</td>
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
		</tbody>
	</table>
	</div>
		|-/if-|

		|-if $others->count() gt 0-|
	<h3>Otros bienes y servicios</h3>
	<div id=div_others>
	<table id="table_others" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="65%">Descripción</th> 
			<th width="15%">Precio</th>
			<th width="10%">Verificado</th>
			<th width="10%">Documento</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$others item=other-|
		<tr>
			<td>|-$other->getDescription()-|</td>
			<td align="right">|-$other->getPrice()|system_numeric_format-|</td>
			|-assign var=itemRecord value=$other->getMeasurementRecordRelation()-|
			<td align="center">
				<input type="checkbox" |-$itemRecord->getVerified()|checked_bool-| onchange="updateVerified('|-$itemRecord->getId()-|', this.checked)" />
			</td>
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
		</tbody>
	</table>
	</div>
		|-/if-|




	</div>
	|-/if-|



</div>

<script type="text/javascript" src="scripts/lightbox.js"></script>

|-if $action eq 'edit'-|
	
|-foreach from=$itemRecords item=itemRecord-|
	|-include file="VialidadMeasurementRecordRelationAttachDocumentInclude.tpl" id=$itemRecord->getId()-|
|-/foreach-|
|-foreach from=$fines item=fine-|
	|-include file="VialidadMeasurementRecordRelationAttachDocumentInclude.tpl" id=$fine->getMeasurementRecordRelation()->getId()-|
|-/foreach-|
|-foreach from=$dailyWorks item=dailyWork-|
	|-include file="VialidadMeasurementRecordRelationAttachDocumentInclude.tpl" id=$dailyWork->getMeasurementRecordRelation()->getId()-|
|-/foreach-|
|-foreach from=$adjustments item=adjustment-|
	|-include file="VialidadMeasurementRecordRelationAttachDocumentInclude.tpl" id=$adjustment->getMeasurementRecordRelation()->getId()-|
|-/foreach-|
|-foreach from=$others item=other-|
	|-include file="VialidadMeasurementRecordRelationAttachDocumentInclude.tpl" id=$other->getMeasurementRecordRelation()->getId()-|
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
		setCommentsDimensions();
		|-/if-|
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
