|-include file="CommonAutocompleterInclude.tpl" -|
<h2>Obras</h2>
	<h1>Administración de Obras - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Obra</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Obra.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Obra.</p>
|-/if-|
|-if $message eq "ok"-|
	<div  class="successMessage">Obra guardada</div>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Obra">
		<legend>Obras</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form id="form_construction" method="post" action="Main.php?do=vialidadConstructionsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$construction->getId()-|" name="id">
		 <p><label for="params[contractId]">Contrato</label>
				<select id="params[contractId]" name="params[contractId]" |-$action|disabled-| >
					<option value="">Seleccione el contrato</option>
				|-foreach from=$contracts item=contract name=for_contract-|
        		<option id="option|-$contract->getId()-|" value="|-$contract->getId()-|" |-$construction->getContractId()|selected:$contract->getId()-|>|-$contract-|</option>
				|-/foreach-|
				</select>
			</p>
		 </p>
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$construction->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[description]">Descripción</label>
			 <textarea name="params[description]" rows="4" cols="58">|-$construction->getDescription()-|</textarea>
		 </p>
		 <div id="verifier" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_verifierId" label="Verificador" url="Main.php?do=affiliatesVerifiersAutocompleteListX" hiddenName="params[verifierId]" defaultHiddenValue=$construction->getVerifierId() defaultValue=$construction->getAffiliate()-|
		 </div>
		 |-if $returnContractId neq ""-|
		 <input type="hidden" name="returnToContract" value="|-$returnContractId-|" />
		 |-/if-|
		 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input id="button_back" type='button' onClick='location.href="|-if $returnContractId neq ""-|Main.php?do=vialidadContractsEdit&id=|-$returnContractId-||-else-|Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-||-/if-|"' value='##104,Regresar##' title="Regresar"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador de la obra ingresado no es válido. Seleccione una obra de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-/if-|


|-if $action eq 'edit'-|
<h3>Items de Construcción</h3>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	|-if "vialidadConstructionItemEdit"|security_has_access-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink">
			<form action="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" method="post">
			<input type="hidden" name="constructionId" value="|-$construction->getId()-|" />
			<a href="#" onclick='this.parentNode.submit()' class="addLink">Agregar Item</a></form>
		</div></th>
	</tr>
	<tr><th colspan="4" class="thFillTitle"><div class="rightLink">
		<a href="#" id="link_copy1" class="addLink" onclick="$('link_copy1').hide();$('form_copy1').show();return false">Agregar desde otro Item</a>
		<form id="form_copy1" style="display:none" action="Main.php" method="post">
			<div style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_items" label="copiar de" url="Main.php?do=vialidadConstructionItemAutocompleteListX" hiddenName="copiedId" disableSubmit="copyItemSubmit"-|
			</div>
			<input type="hidden" name="constructionId" value="|-$construction->getId()-|" />
			<input id="copyItemSubmit" type="button" disabled="disabled" class="icon iconActivate" onclick="copyItem(this.parentNode);$('form_copy1').hide();$('link_copy1').show();" />
			<input type="button" class="icon iconCancel" onclick="$('form_copy1').hide();$('link_copy1').show();" />
		</form>
	</div></th></tr>
	|-/if-|
	<tr>
		<th width="10%">Código</th>
		<th width="75%">Item</th>
		<th width="10%">Cantidad</th>
		<th width="5%">&nbsp;
		</th>
	</tr>
	</thead>
	<tbody id="items_table_body">
	|-foreach from=$items item=item name=for_item-|
		|-include file="VialidadConstructionsTableRowInclude.tpl" item=$item constructionId=$construction->getId() filters=$filters pager=$pager-|
	|-/foreach-|
	</tbody>
	<tfoot>
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadConstructionItemEdit"|security_has_access && $items|@count gt 5-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Item</a></div></th>
	</tr>|-/if-|
	</tfoot>
</table>
|-/if-|

<script type="text/javascript">

function copyItem(form) {
	var fields = Form.serialize(form);
	new Ajax.Updater(
		{success: 'items_table_body'},
		'Main.php?do=vialidadConstructionsAddItemFromOtherX',
		{
			method: 'post',
			parameters: fields,
			insertion: 'bottom',
			evalScripts: true
		}
	);
}

function removeItem(itemId) {
	new Ajax.Request(
		'Main.php?do=vialidadConstructionItemDoDelete',
		{
			method: 'post',
			parameters: {
				id: itemId
			},
			evalScripts: true,
			onSuccess: function() {
				$('items_table_body').removeChild($('item'+itemId));
			}
		}
	);
}

</script>