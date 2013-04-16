|-if !$toPrint-|
<h2>Boletines</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del boletín ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadBulletinList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Boletines"/>
|-else-|

<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Boletín Formula Paramétrica</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Boletín</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Boletín Formula Paramétrica</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_bulletin" id="form_edit_bulletin" action="Main.php" method="post">
	<fieldset title="Formulario de edición de datos de un Boletín">
		<legend>Formulario de Administración de Boletines</legend>
		<p>
			<label for="params[number]">Número</label>
			<input type="text" id="params[number]" name="params[number]" size="10" value="|-$bulletin->getNumber()|escape-|" title="N&uacute;mero" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
		</p>
		<p>     
			<label for="params[bulletinDate]">Mes del Boletín</label>
				<select id="params[bulletinDateMonth]" name="params[bulletinDateMonth]" title="Seleccione el mes" > 
					 <option value="01" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"01"-|>Enero</option> 
					 <option value="02" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"02"-|>Febrero</option> 
					 <option value="03" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"03"-|>Marzo</option> 
					 <option value="04" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"04"-|>Abril</option> 
					 <option value="05" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"05"-|>Mayo</option> 
					 <option value="06" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"06"-|>Junio</option> 
					 <option value="07" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"07"-|>Julio</option> 
					 <option value="08" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"08"-|>Agosto</option> 
					 <option value="09" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"09"-|>Septiembre</option> 
					 <option value="10" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"10"-|>Octibre</option> 
					 <option value="11" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"11"-|>Noviembre</option> 
					 <option value="12" |-$bulletin->getBulletinDate()|date_format:"m"|selected:"12"-|>Diciembre</option> 
				 </select> 
				<select id="params[bulletinDateYear]" name="params[bulletinDateYear]" title="Seleccione el año" > 
					 <option value="2010" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2010"-|>2010</option> 
					 <option value="2011" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2011"-|>2011</option> 
					 <option value="2012" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2012"-|>2012</option> 
					 <option value="2013" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2013"-|>2013</option> 
					 <option value="2014" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2014"-|>2014</option> 
					 <option value="2015" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2015"-|>2015</option> 
					 <option value="2016" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2016"-|>2016</option> 
					 <option value="2017" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2017"-|>2017</option> 
					 <option value="2018" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2018"-|>2018</option> 
					 <option value="2019" |-$bulletin->getBulletinDate()|date_format:"Y"|selected:"2019"-|>2019</option> 
				 </select> 
		</p>
		<p>     
			<label for="params[comments]">Observaciones</label>
			<textarea name="params[comments]" cols="60" wrap="VIRTUAL" id="params[comments]" title="Observaciones">|-$bulletin->getComments()|escape-|</textarea>
		</p>
		<p>     
			<label for="params[published]">Publicado</label>
			<input name="params[published]" type="hidden" value="0">
			<input name="params[published]" type="checkbox" value="1" |-$bulletin->getPublished()|checked_bool-| title="Indica si el boletín acepta modificaciones o no">
		</p>
		<p>
			|-if $action eq 'edit'-|
			<input type="hidden" name="id" id="id" value="|-$bulletin->getid()-|" />
			|-/if-|
			|-if $action eq 'copy'-|
			<input type="hidden" name="toBeCopiedId" value="|-$toBeCopiedId-|" />
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" />
			<input type="hidden" name="do" id="do" value="vialidadBulletinDoEdit" />
			<input type="submit" id="button_edit_bulletin" name="button_edit_bulletin" title="Aceptar" value="Guardar" />
			<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadBulletinList'"/>
			<a href="Main.php?do=vialidadBulletinEdit&id=|-$bulletin->getid()-|&toPrint=true" target="_blank" tilte="Imprimir" class="noDecoration"><input type="button" value="Imprimir" /></a>
		</p>
	</fieldset>
</form>
	
	|-if $prices neq ''-|
	<div id=div_supplies>
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="30%">Insumo</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Precio</th> 
			<th width="5%" nowrap="nowrap">Publicar</th>
			<th width="5%" nowrap="nowrap">Definitivo</th>
			|-if $bulletin->getPublished()-|
			<th width="10%" nowrap="nowrap">Definitivo en</th>
			<th width="10%" nowrap="nowrap">Modificado</th>
			|-/if-|
			<th width="2%">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		|-if $prices|@count eq 0-|
		<tr>
			<td colspan="|-if $bulletin->getPublished()-|4|-else-|3|-/if-|">No hay Insumos que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$prices key=idx item=price name=for_items-|
		<tr id="priceRow|-$idx-|">
			|-assign var=priceInformation value=$price->getPrice()-|
			|-assign var=supply value=$price->getSupply()-|
			<td>|-$supply->getName()-|</td>
			<td align="center">|-$supply->getMeasureUnit()-|</td>
			<td align="right">
				|-if $price->getAveragePrice() neq ''-|
				|-$price->getAveragePrice()|system_numeric_format-|
				|-else-|
				-
				|-/if-|
			</td>
			<td align="center"><input onchange="updatePublish('|-$supply->getId()-|', this.checked);" name="publish[]" type="checkbox" value="1" |-$price->getPublish()|checked_bool-| |-if $bulletin->getPublished()-|disabled="disabled"|-/if-|></td>
			<td align="center">|-$price->getDefinitive()|si_no-|</td>
			|-if $bulletin->getPublished()-|
			<td align="center"><span>|-$price->getDefinitiveOn()|date_format:"%B / %Y"|@ucfirst-|</span></td>
			<td align="right"><span>|-$priceInformation.price|system_numeric_format-|<span>|-if $price->getModifiedOn() ne ''-| -> |-$price->getModifiedOn()|date_format:"%B / %Y"|@ucfirst-||-/if-|</td>
			<td align="center"><a href="#lightbox|-$idx-|" rel="lightbox|-$idx-|" class="lbOn"><img src="images/clear.png" class="icon iconEdit"></a></td>
			|-else-|
			<td align="center"><a href='Main.php?do=vialidadSupplyPriceEdit&amp;bulletinId=|-$bulletin->getId()-|&amp;supplyId=|-$supply->getId()-|'><img src="images/clear.png" class="icon iconEdit"></a></td>
			|-/if-|
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>

|-if $bulletin->getPublished()-|
<script type="text/javascript" src="scripts/lightbox.js"></script>
|-foreach from=$prices key=idx item=price name=for_items_lightboxes-|
	|-assign var=priceInformation value=$price->getPrice()-|
<div id="lightbox|-$idx-|" class="leightbox"> 
	<p align="right"><a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario<input type="button" class="icon iconClose" /></a></p>
	<form method="post" action="Main.php?do=vialidadSupplyPriceEditModifiedPrice" enctype="multipart/form-data" id="documentsAdderForm|-$i-|">
        <input type="hidden" name="bulletinId" value="|-$price->getBulletinId()-|" />
        <input type="hidden" name="supplyId" value="|-$price->getSupplyId()-|" />
        <input type="hidden" name="id" value="|-$price->getId()-|" />
        <input type="hidden" name="priceIndex" value="|-$idx-|" />
        <fieldset title="Formulario para Agregar Nuevo Respaldo">
            <legend>Modificar precio</legend>
			    |-if !$price->getDefinitive()-|
            <p><label for="definitive_on">Definitivo en</label>
               <input id="definitiveOn" name="definitiveOn|-$idx-|" type='text' value='|-$price->getDefinitiveOn()|date_format-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('definitiveOn|-$idx-|', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
            </p>
			    |-/if-|
            <p>
                <label for="modified_price">Modificado</label>
                <input id="modifiedPrice" name="modifiedPrice" type='text' value='|-$priceInformation.price|system_numeric_format-|' size="12" />
          </p>
          <p>
               <label for="modified_on">Modificado en</label>
                <input id="modifiedOn" name="modifiedOn|-$idx-|" type='text' value='|-$price->getModifiedOn()|date_format-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('modifiedOn|-$idx-|', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
            </p>
            <p>
                <input type="submit" name="uploadButton" value="Guardar" ><span id="msgBoxUploader|-$idx-|"></span>
            </p>
        </fieldset>
	</form>
</div> 
|-/foreach-|
|-/if-|

<script type="text/javascript">
function updatePublish(supplyId, value) {
	new Ajax.Request(
		'Main.php?do=vialidadSupplyPriceEditFieldX',
		{
			method: 'post',
			parameters: {
				bulletinId: "|-$bulletin->getId()-|",
				supplyId: supplyId,
				paramName: 'publish',
				paramValue: value
			}
		}
	);
}
</script>

|-/if-| <!-- $notValidId eq "false" -->

|-else-|
|-include file="VialidadBulletinPrint.tpl"-|
|-/if-|	
