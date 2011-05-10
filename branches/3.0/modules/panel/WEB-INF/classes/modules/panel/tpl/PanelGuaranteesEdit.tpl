<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="iconDelete" /></a> 
	</p> 
	|-include file="PanelContractorsEditX.tpl"-|
</div> 
<h2>Tablero de Gestión</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Garantía</h1>
<div id="div_guarantee">
	<p>Ingrese los datos de la Garantía</p>
		<p><a href="#" onClick="location.href='Main.php?do=panelGuaranteesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la garantía</span>|-/if-|
	<form name="form_edit_guarantee" id="form_edit_guarantee" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Garantía">
			<legend>Formulario de Administración de Garantías</legend>
			<p>
				<label for="params[type]">Tipo</label>
				<select id="params[type]" name="params[type]" title="Tipo de Garantía"> 
			<option value="">Seleccione tipo</option>
				|-foreach from=$types item=type key=key name=for_valores-|
        <option value="|-$key-|" |-$guarantee->getType()|selected:$key-|>|-$type-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[code]">Número/Código</label>
				<input type="text" id="params[code]" name="params[code]" size="50" value="|-$guarantee->getcode()|escape-|" title="Número o Código" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p> 
				<label for="params[issueDate]">Fecha de Emisión</label>
				<input type="text" id="params[issueDate]" name="params[issueDate]" value="|-$guarantee->getIssueDate()|date_format:"%d-%m-%Y"-|" title="Fecha de emisión" />
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[issueDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> </p> 
			<p>
				<label for="params[issuer]">Emisor</label>
				<input type="text" id="params[issuer]" name="params[issuer]" size="50" value="|-$guarantee->getissuer()|escape-|" title="Emisor" />
			</p>
			<p>
				<label for="params[projectId]">Proyecto/contrato</label>
				<select id="params[projectId]" name="params[projectId]" title="Proyecto"> 
				<option value="">Seleccione proyecto/contrato</option>
				|-foreach from=$projects item=project key=key name=for_valores-|
        <option value="|-$project->getId()-|" |-$guarantee->getProjectId()|selected:$project->getId()-|>|-$project->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[contractorId]">Contratista</label>
				<select id="contractorId" name="params[contractorId]" title="Contratista"> 
				<option value="">Seleccione contratista</option>
				|-foreach from=$contractors item=contractor key=key name=for_contractors-|
        <option id="contractorOption|-$contractor->getId()-|" value="|-$contractor->getId()-|" |-$guarantee->getContractorId()|selected:$contractor->getId()-|>|-$contractor->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" /> 			<a href="#lightbox1" rel="lightbox1" class="lbOn addNew">Agregar nuevo contratista</a>

			</p> 
			<p>
				<label for="params[currency]">Moneda</label>
				<select id="params[currency]" name="params[currency]" title="Moneda"> 
			<option value="">Seleccione moneda</option>
				|-foreach from=$currencies item=type key=key name=for_currencies-|
        <option value="|-$key-|" |-$guarantee->getCurrency()|selected:$key-|>|-$type-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				<label for="params[ammount]">Monto de la garantía</label>
				<input type="text" id="params[ammount]" name="params[ammount]" size="20" value="|-$guarantee->getAmmount()|number_format:2:',':'.'-|" title="Monto" />
			</p>
			<p>
				<label for="params[expirationType]">Tipo de Vencimiento</label>
				<select id="params[expirationType]" name="params[expirationType]" title="Tipo Vencimiento de la Garantía"> 
			<option value="">Seleccione tipo</option>
				|-foreach from=$expirationTypes item=type key=key name=for_valores-|
        <option value="|-$key-|" |-$guarantee->getExpirationType()|selected:$key-|>|-$type-|</option> 
				|-/foreach-|
      </select> <img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" /><a class="tooltipWide" href="#"><span>Seleccione Vencimiento por Fecha en aquellos casos en los que la Garantía posee una fecha concreta de vencimiento (ejemplo 31/12/2010). Para especificar esta fecha utilice el siguiente campo Fecha de vencimiento. Seleccione Vencimiento por condición en aquellos casos en los que la garantía posee una fecha de vencimiento condicionada a la ocurrencia de algún evento tal como finalización de la obra. Para especificar esta condición, utilice el campo Términos de vencimiento.</span><img src="images/icon_info.gif"></a>
			</p>
    <p> 
      <label for="params[expirationDate]">Fecha de Vencimiento</label>
      <input type="text" id="params[expirationDate]" name="params[expirationDate]" value="|-$guarantee->getExpirationDate()|date_format:"%d-%m-%Y"-|" title="Fecha de vencimiento" />
      <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[expirationDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> </p> 
			<p>
				<label for="params[expirationTerms]">Términos de vencimiento</label>
				<input type="text" id="params[expirationTerms]" name="params[expirationTerms]" size="70" value="|-$guarantee->getExpirationTerms()|escape-|" title="Emisor" />
			</p>
    <p> 
      <label for="params[returned]">Devuelta</label> 
      <input type="hidden" name="params[returned]" value="0" />
      <input type="checkbox" name="params[returned]" value="1"  title="Marque esta opción si la garantía fue devuelta" |-$guarantee->getReturned()|checked_bool-| /> </p> 
    </p> 
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$guarantee->getid()-|" />
				|-else-|
			<p>* Para anexar documentos, guarde primero la garantía. </p>
				|-/if-|
			<p>	<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="panelGuaranteesDoEdit" />
				<input type="submit" id="button_edit_guarantee" name="button_edit_guarantee" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=panelGuaranteesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
|-if $action eq 'edit'-|
	|-include file="DocumentsListInclude.tpl" entity="Guarantee" entityId=$guarantee->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="Guarantee" entityId=$guarantee->getId()-|
|-/if-| 