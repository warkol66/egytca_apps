<h2>Contratos</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del contrato ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

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
		<p>Realice los cambios y para guardar haga click en "Guardar"</p>
			<form method="post" action="Main.php?do=vialidadContractsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$contract->getId()-|" name="id">
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" id="params[name]" type="text" value="|-$contract->getName()|escape-|" size="60" title="Nombre del contrato" class="emptyValidation"> |-validation_msg_box idField="params[name]"-|
		 </p>
		 <p><label for="params_type">Tipo</label>
			<select id="params_type" name="params[type]" title="Tipo de contrato">
				<option value="">Seleccione el tipo de contrato</option>
				|-foreach from=$types key=key item=name-|
							<option value="|-$key-|" |-$contract->getType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		 </p>
		 <p><label for="params[pacNumber]">Id de contrato (N° PAC)</label>
			<input name="params[pacNumber]" id="params[pacNumber]" type="text" value="|-$contract->getPacNumber()|escape-|" size="8" title="Id de contrato (N° PAC), buscar el ID en la página de contrataciones" class="emptyValidation"> |-validation_msg_box idField="params[pacNumber]"-| |-if $contract->getPacNumber() ne ''-|<a href="https://www.contrataciones.gov.py/sicp/llamado/llamadosPorID.seam?nroPacParam=|-$contract->getPacNumber()-|" target="_blank" title="Ir a Contrato" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a>|-/if-| 
		 </p>
		 <p>
		   <label for="params[contractNumber]">Nro de Contrato</label>
				<input name="params[contractNumber]" id="params[contractNumber]" type="text" value="|-$contract->getContractNumber()|escape-|" size="15" title="Nro de Contrato" class="emptyValidation" /> |-validation_msg_box idField="params[contractNumber]"-| 
		</p>
		 <p>
		   <label for="params[tenderNumber]">Nro de Llamado</label>
				<input name="params[tenderNumber]" id="params[tenderNumber]" type="text" value="|-$contract->getTenderNumber()|escape-|" size="15" title="Nro de Llamado" class="emptyValidation" /> |-validation_msg_box idField="params[tenderNumber]"-| 
		</p>
			<p>     
				<label for="params[startDate]">Fecha de inicio</label>
				<input id="params[startDate]" name="params[startDate]" type='text' value='|-$contract->getStartDate()|date_format-|' size="12" title="Ingrese la fecha de inicio"  class="dateValidation emptyValidation" /> |-validation_msg_box idField="params[startDate]"-|  <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[startDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<div id="contractor" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_contractorId" label="Proveedor" url="Main.php?do=affiliatesAutocompleteListX" hiddenName="params[contractorId]" defaultHiddenValue=$contract->getContractorId() defaultValue=$contract->getAffiliate() class="emptyValidation"-| 
			</div>
		 <p><label for="params_tprano">Línea presupuestaria</label>
			<input name="params[tprano]"  id="params_tprano" type="text" value="|-$contract->getTprano()|escape-|" size="4" title="Año del contrato (aaaa)">
			<input name="params[tprcod]"  id="params_tprcod" type="text" value="|-$contract->getTprcod()|escape-|" size="1" title="Tipo de presupuesto (t)">
			<input name="params[prgcod]"  id="params_prgcod" type="text" value="|-$contract->getPrgcod()|escape-|" size="3" title="Programa (ttt)">
			<input name="params[subprgcod]"  id="params_subprgcod" type="text" value="|-$contract->getSubprgcod()|escape-|" size="3" title="Subprograma (ttt)">
			<input name="params[prycod]"  id="params_prycod" type="text" value="|-$contract->getPrycod()|escape-|" size="2" title="Proyecto (tt)">
			<input name="params[prydes]"  id="params_prydes" type="text" value="|-$contract->getPrydes()|escape-|" size="40" title="Descripción">
		 </p>
		 <p><label for="params_adjudication">Resolución y/o Decreto de Adjudicación</label>
			<input name="params[adjudication]"  id="params_adjudication" type="text" value="|-$contract->getAdjudication()|escape-|" size="60" class="emptyValidation" /> |-validation_msg_box idField="params[adjudication]"-|
		 </p>
			<p>     
				<label for="params_adjudicationDate">Fecha de adjudicación</label>
				<input id="params_adjudicationDate" name="params[adjudicationDate]" type='text' value='|-$contract->getAdjudicationDate()|date_format-|' size="12" title="Ingrese la fecha de adjudicación" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[adjudicationDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de adjudicación">
			</p>
			<p>     
				<label for="params[signDate]">Fecha de firma</label>
				<input id="params[signDate]" name="params[signDate]" type='text' value='|-$contract->getSignDate()|date_format-|' size="12" title="Ingrese la fecha de firma" class="dateValidation emptyValidation" /> |-validation_msg_box idField="params[signDate]"-| <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[signDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
		 <p><label for="params[validationLength]">Plazo contractual</label>
			<input name="params[validationLength]" id="params[validationLength]" type="text" value="|-$contract->getValidationLength()|system_numeric_format:0-|" size="6" class="numericValidation emptyValidation" /> 
			<select id="params_validationType" name="params[validationType]" title="Tipo de plazo">
				|-foreach from=$termTypes key=key item=name-|
							<option value="|-$key-|" |-$contract->getValidationType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>|-validation_msg_box idField="params[validationLength]"-| 
		 </p>

		 <p><label for="params[contractLength]">Vigencia del Contrato</label>
			<input name="params[contractLength]" id="params[contractLength]" type="text" value="|-$contract->getContractLength()|system_numeric_format:0-|" size="6" class="numericValidation emptyValidation" /> 
			<select id="params_termType" name="params[termType]" title="Tipo de plazo">
				|-foreach from=$termTypes key=key item=name-|
							<option value="|-$key-|" |-$contract->getTermType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>|-validation_msg_box idField="params[contractLength]"-| 
		 </p>

		 <p><label for="params[validationLengthModified]">Plazo contractual Modificado</label>
			<input name="params[validationLengthModified]" type="text" value="|-$contract->getValidationLengthModified()|system_numeric_format:0-|" size="6"> 
			<select id="params_validationTypeModified" name="params[validationTypeModified]" title="Tipo de plazo Modificado">
				|-foreach from=$termTypes key=key item=name-|
							<option value="|-$key-|" |-$contract->getValidationTypeModified()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		 </p>

		 <p><label for="params[contractLengthModified]">Vigencia del Contrato Modificado</label>
			<input name="params[contractLengthModified]" type="text" value="|-$contract->getContractLengthModified()|system_numeric_format:0-|" size="6"> 
			<select id="params_termTypeModified" name="params[termTypeModified]" title="Tipo de plazo">
				|-foreach from=$termTypes key=key item=name-|
							<option value="|-$key-|" |-$contract->getTermTypeModified()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		 </p>


			<div id="bulletin" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_bulletinId" label="Boletín base" url="Main.php?do=commonAutocompleteListX&object=bulletin" hiddenName="params[bulletinId]" defaultHiddenValue=$contract->getBulletinId() defaultValue=$contract->getBulletin() class="emptyValidation"-| 
			</div>



		 <h3>Montos del Contrato</h3>
		 |-if !$contract->isNew()-||-include file="VialidadContractsAmountInclude.tpl"-||-/if-|
		 


	 <p><script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
		 		|-if $action eq 'edit'-|
		 		<input type='button' onClick='location.href="Main.php?do=indicatorsList&contractId=|-$contract->getId()-|"' value='Curva de Avance' title="Curva de Avance"/>
				
				|-assign var=indicators value=$contract->getIndicators()-|
				|-if !empty($indicators)-|
				|-foreach from=$indicators item=indicator-|
		 		<input type='button' onClick='location.href="Main.php?do=indicatorsView&id=|-$indicator->getId()-|"' value='Ir a Curva de Avance' title="Ir a Curva de Avance"/>
				|-/foreach-|
				 |-else-|
		 		<input type='button' onClick='location.href="Main.php?do=indicatorsEdit&contractId=|-$contract->getId()-|&id="' value='Curva de Avance' title="Curva de Avance"/>
				 |-/if-|
				 |-/if-|
				<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
			 </p>
		</form>

	</fieldset>
	|-if !$contract->isNew()-||-include file="DocumentsListInclude.tpl" entity="Contract" entityId=$contract->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="Contract" entityId=$contract->getId()-||-/if-|

|-else-|
<div class="errorMessage">El identificador del contrato ingresado no es válido. Seleccione un contrato de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
|-/if-|


<script type="text/javascript" language="javascript" charset="utf-8">
	function addSourceToContract(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'sourceList'},
					'Main.php?do=vialidadContractsDoAddSourceX',
					{
						method: 'post',
						postBody: fields,
						evalScripts: true,
						insertion: Insertion.Bottom
					});
		$('sourceMsgField').innerHTML = '<span class="inProgress">Agregando fuente al contrato...</span>';
			$('autocomplete_sources').value = '';
			$('addSourceSubmit').disable();
		return true;
	}
	
	function removeSourceFromContract(form){
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'sourceMsgField'},
					'Main.php?do=vialidadContractsDoRemoveSourceX',
					{
						method: 'post',
						postBody: fields,
						evalScripts: true
					});
		$('sourceMsgField').innerHTML = '<span class="inProgress">Eliminando fuente...</span>';
		return true;
	}

	function selectAmmount(sourceId, ammountValue) {
		new Ajax.Updater (
			'span_ammount_for_'+sourceId,
			'Main.php?do=vialidadContractsSelectSourceAmmount',
			{
				method: 'get',
				parameters: {
					contractId: |-$contract->getId()-|,
					sourceId: sourceId,
					ammount: ammountValue
				}
			});
	}

	function displayAmmountSelector(sourceId) {
		$('p_ammount_for_'+sourceId).hide();
		$('select_ammount_for_'+sourceId).show();
	}
</script>

<fieldset title="Formulario de sourcees asociados al contrato">
	<legend>Fuentes de Financiamiento del Contrato</legend>
    |-if $action neq 'showLog'-|
	<!--	<p>Para asociar un source al contrato, ingrese el nombre en la casilla. Si no está en el sistema puede <a href="#lightbox2" rel="lightbox2" class="lbOn addLink">Crear source</a></p>-->
	<div id="sourceMsgField"></div>
	<form method="post" style="display:inline;">
		<div id="contractSource" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_sources" label="Agregar fuente" url="Main.php?do=commonAutocompleteListX&object=source&getCandidates=1&contractId="|cat:$contract->getId() hiddenName="sourceId" disableSubmit="addSourceSubmit"-|
		</div>
	<p>	<input type="hidden" name="do" id="do" value="vialidadContractsDoAddSourceX" />
		<input type="hidden" name="contractId" id="contractId" value="|-$contract->getId()-|" /> 
    <input type="button" id="addSourceSubmit" disabled="disabled" name="addSourceSubmit" value="Agregar source al contrato" title="Agregar source al contrato" onClick="javascript:addSourceToContract(this.form)"/> </p>
	</form>
    |-/if-|
  <div id="contractsSourcesList">
		<ul id="sourceList" class="iconOptionsList">
			|-foreach from=$contract->getSources() item=source-|
			<li id="sourceListItem|-$source->getId()-|" title="Source asociado al contrato">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="vialidadContractsDoRemoveSourceX" /> 
							<input type="hidden" name="contractId" value="|-$contract->getid()-|" /> 
							<input type="hidden" name="sourceId" value="|-$source->getid()-|" /> 
							<input type="button" name="submit_go_remove_source" value="Borrar" title="Eliminar fuente de contrato" onclick="if (confirm('Seguro que desea fuente el source del contrato?')) removeSourceFromContract(this.form);" class="icon iconDelete" /> 
						</form> |-$source-| &nbsp; &nbsp;
						|-foreach from=$contract->getContractSources() item=contractSource-|
							|-if $contractSource->getSourceId() eq $source->getId()-|
								|-assign var=ammount value=$contractSource->getAmmount()-|
							|-/if-|
						|-/foreach-|
						|-if $ammount neq ''-||-assign var=sourceAmmountAction value='show'-||-else-||-assign var=sourceAmmountAction value=''-||-/if-|
						|-assign var=contractPeer value=$contract->getPeer()-|
						<span id='span_ammount_for_|-$source->getId()-|' class="bold italic" title="Modifique el monto del financiamiento de la fuente para el contrato">
						|-*include file='VialidadContractsSelectSourceAmmount.tpl' action=$sourceAmmountAction sourceId=$source->getId() ammount=$ammount ammounts=$contractPeer->getContractAmmounts()*-|
						</span>
					</li>
			|-/foreach-|
			</ul>    
		</div> 
</fieldset>

|-if !$contract->isNew() && $contract->getType() eq 1-|
<h3>Obras</h3>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	|-if "vialidadConstructionsEdit"|security_has_access-|<tr>
		<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionsEdit&returnToContract=|-$contract->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Obra</a></div></th>
	</tr>|-/if-|
	<tr>
		<th width="30%">Nombre</th>
		<th width="65%">Descripción</th>
		<th width="5%">&nbsp;
		</th>
	</tr>
	</thead>
	<tbody id="constructions_table_body">
	|-foreach from=$constructions item=construction name=for_constructions-|
	<tr id="construction|-$construction->getId()-|">
		<td>|-$construction->getName()-|</td>
		<td>|-$construction->getDescription()-|</td>
		<td nowrap="nowrap">
			|-if "vialidadConstructionsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadConstructionsEdit" /> 
			  <input type="hidden" name="id" value="|-$construction->getId()-|" /> 
			  <input type="hidden" name="returnToContract" value="|-$contract->getId()-|" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
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
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit&returnToContract=|-$contract->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Obra</a></div></th>
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

|-/if-|
