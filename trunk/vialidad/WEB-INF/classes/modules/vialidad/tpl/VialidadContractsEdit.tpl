|-include file="CommonAutocompleterInclude.tpl" -|
<h2>Contratos</h2>
	<h1>Administración de Contratos - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Contrato</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Contrato.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Contrato.</p>
|-/if-|
|-if $message eq "ok"-|
	<div class="successMessage">Contrato guardado</div>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Contrato">
		<legend>Contratos</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=vialidadContractsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$contract->getId()-|" name="id">
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$contract->getName()|escape-|" size="60">
		 </p>
		 <p>
		   <label for="params[code]">Código</label>
				<input name="params[code]" type="text" value="|-$contract->getCode()|escape-|" size="55"> 
		</p>
			<div id="contractor" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_contractorId" label="Contratista" url="Main.php?do=affiliatesContractorsAutocompleteListX" hiddenName="params[contractorId]" defaultHiddenValue=$contract->getContractorId() defaultValue=$contract->getAffiliate()-|
			</div>
	 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del contrato ingresado no es válido. Seleccione un contrato de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
|-/if-|


|-if $action eq 'edit'-|
<h3>Obras</h3>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	|-if "vialidadConstructionsEdit"|security_has_access-|<tr>
		<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Obra</a></div></th>
	</tr>|-/if-|
	<tr>
		<th width="30%">Nombre</th>
		<th width="65%">Description</th>
		<th width="5%">&nbsp;
		</th>
	</tr>
	</thead>
	<tbody id="constructions_table_body">
	|-foreach from=$constructions item=construction name=for_constructions-|
	<tr id="construction|-$construction->getId()-|">
		<td nowrap="nowrap">|-$construction->getName()-|</td>
		<td nowrap="nowrap">|-$construction->getDescription()-|</td>
		<td nowrap="nowrap">
			|-if "vialidadConstructionsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadConstructionsEdit" /> 
			  <input type="hidden" name="id" value="|-$construction->getId()-|" /> 
			  <input type="hidden" name="returnToContract" value="|-$contract->getId()-|" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_item" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadConstructionsDoDelete"|security_has_access-|
				<input type="submit" name="submit_go_delete_item" value="Borrar" onclick="return confirm('Seguro que desea eliminar la Obra?') ? removeConstruction('|-$construction->getId()-|'): '';" class="icon iconDelete" /> 
			|-/if-|
		</td>
	</tr>
	|-/foreach-|
	</tbody>
	<tfoot>
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadConstructionItemEdit"|security_has_access && $items|@count gt 5-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Obra</a></div></th>
	</tr>|-/if-|
	</tfoot>
</table>
|-/if-|

<script type="text/javascript">
	
function removeConstruction(constructionId) {
	new Ajax.Request(
		'Main.php?do=vialidadConstructionsDoDelete',
		{
			method: 'post',
			parameters: {
				id: constructionId
			},
			evalScripts: true,
			onSuccess: function() {
				$('constructions_table_body').removeChild($('construction'+constructionId));
			}
		}
	);
}

</script>