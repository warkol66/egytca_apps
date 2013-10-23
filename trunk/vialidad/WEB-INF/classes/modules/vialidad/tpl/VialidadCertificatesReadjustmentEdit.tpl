<h2>Reajustes</h2>
|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del certificado ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadCertificatesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Certificados"/>
|-else-|
<h1>Reajustes de Certificados</h1>
<div id="div_certificate">
	<p>A continuación se muestra la tabla de relación de reajustes del certificado</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Certificado de Obra</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_certificate" id="form_edit_certificate"  action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Certificado de Obra">
			<legend>Formulario de Administración de Certificado de Obra</legend>
			<p>
				|-assign var=record value=$certificate->getMeasurementRecord()-|
				|-assign var=construction value=$record->getConstruction()-|
				|-assign var=bulletin value=$certificate->getBulletin()-|
				<label for="params[measurementRecordId]">Acta</label>
				<span>|-$construction->getName()-|&nbsp;-&nbsp;|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</span>
			</p>
			<p>
				<label for="totalPrice">Precio Total</label>
				<span id="totalPrice" name="totalPrice" title="Precio total">|-$certificate->calculatePrice()|system_numeric_format-|</span>
			</p>
		 <p>
		   <label for="params[code]">Número</label>
				<span id="code" name="code" title="Número">|-$record->getCode()-|</span>
		</p>
			<p>
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadCertificatesList'"/>
				<input type="hidden" name="do" id="do" value="vialidadCertificatesReadjustmentDoEdit" />
				<input type="hidden" name="id" value="|-$certificate->getid()-|" />
				<input type="submit" id="button_edit_readjustment"  title="Guardar reajustes" value="Guardar reajustes" />
				<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
	<h3>Items</h3>
	<div id=div_itemPrices>
	<table id="table_itemPrices" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="25%">Item</th> 
			<th width="5%">Unidad</th> 
			<th width="8%">Precio unitario</th>
			<th width="8%">Cantidad Certificada</th> 
			<th width="8%">Monto ejecutado menos anticipo <br> [1]</th> 
			<th width="5%">Coeficiente Ku <br> [2]</th> 
			<th width="8%">Monto reajustado <br> [3] = [1] x [2]</th> 
			<th width="8%">Monto del reajuste <br> [4] = [3] - [1]</th> 
			<th width="8%">Certificado anterior</th> 
			<th width="10%">Monto Total</th>
		</tr>
		</thead>
		<tbody>
		|-if $relations->count() eq 0-|
		<tr>
			<td colspan="5">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-$acumulatedTotalMinusDown = 0-|
		|-$acumulatedReadjustment = 0-|
		|-$acumulatedReadjustmentAmount = 0-|
		|-$acumulatedTotalAmount = 0-|
		|-foreach from=$relations item=relation name=for_relations-|
		<tr>
			|-$item = $relation->getConstructionItem()-|
			<td>|-$item->getName()-|</td>
			<td align="center">|-$item->getMeasureUnit()-|</td>
			<td align="right">|-$item->getPrice()|system_numeric_format-|</td>
			<td align="right">|-$relation->getQuantity()|system_numeric_format-|</td>
			<td align="right">|-$totalMinusDown = $relation->getTotalMinusDown()-||-$totalMinusDown|system_numeric_format-|</td>|-$acumulatedTotalMinusDown = $totalMinusDown + $acumulatedTotalMinusDown-|
			<td align="right">|-$ku = $relation->getKu()-||-$ku|system_numeric_format:5-|</td>
			<td align="right">|-$readjustment = $relation->getReadjustment()-||-$readjustment|system_numeric_format-|</td>|-$acumulatedReadjustment = $readjustment + $acumulatedReadjustment-|
			<td align="right">|-$readjustmentAmount = $readjustment - $totalMinusDown-||-$readjustmentAmount|system_numeric_format-|</td>|-$acumulatedReadjustmentAmount = $readjustmentAmount + $acumulatedReadjustmentAmount-|	
			<td align="right">
				|-$previousRelation = $relation->getPrevious()-|
				|-if $previousRelation-|
					|-$previous = $previousRelation->getAccumulated()-|
				|-else-|
					|-$previous = 0-|
				|-/if-|
				|-$previous|system_numeric_format-|</td>
			<td align="right">|-$totalAmount = $readjustment + $previous-||-$totalAmount|system_numeric_format-|</td>|-$acumulatedTotalAmount = $totalAmount + $acumulatedTotalAmount-|
		</tr>
		|-/foreach-|
		<tr>
			<th></th>
			<th></th>
			<th align="right"></th>
			<th align="right"></th>
			<th align="right">|-$acumulatedTotalMinusDown|system_numeric_format-|</th>
			<th align="right"></th>
			<th align="right">|-$acumulatedReadjustment|system_numeric_format-|</th>
			<th align="right">|-$acumulatedReadjustmentAmount|system_numeric_format-|</th>
			<th align="right"></th>
			<th align="right">|-$acumulatedTotalAmount|system_numeric_format-|</th>
		</tr>
		|-/if-|
		</tbody>
	</table>
	</div>
	
	

	
|-if $fines->count() gt 0-|
	<h3>Multas</h3>
	<div id=div_fines>
	<table id="table_fines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$fines item=fine-|
		<tr>
			<td>|-$fine->getDescription()-|</td>
			<td align="right">|-$fine->getPrice()|system_numeric_format-|</td>
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
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$dailyWorks item=dailyWork-|
		<tr>
			<td>|-$dailyWork->getDescription()-|</td>
			<td align="right">|-$dailyWork->getPrice()|system_numeric_format-|</td>
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
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$adjustments item=adjustment-|
		<tr>
			<td>|-$adjustment->getDescription()-|</td>
			<td align="right">|-$adjustment->getPrice()|system_numeric_format-|</td>
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
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$others item=other-|
		<tr>
			<td>|-$other->getDescription()-|</td>
			<td align="right">|-$other->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
		|-/if-|
</div>
|-/if-|
