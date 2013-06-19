|-include file="CommonAutocompleterInclude.tpl"-|
<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="viewWorking"></div>
	<div class="innerLighbox">
		<div id="viewDiv"></div>
	</div>
</div> 
<h2>Facturas</h2>
<h1>Administración de Facturas de Contratistas</h1>
<p>A continuación podrá ver la lista de Facturas de Contratistas del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Factura de Contratista guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Factura de Contratista eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar la Factura de Contratista.</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	<tr>
		<td colspan="11" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar Factura de Contratista</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
			<input type="hidden" name="do" value="vialidadInvoicesList" />
			<p>
				<div style="position: relative;z-index:12000;">
				|-include id="autocompleter_construction" file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadConstructionsAutocompleteListX" hiddenName="filters[constructionid]" disableSubmit="button_filtersSubmit" label="Obra" defaultValue=$defaultConstructionValue-|
				</div>
			</p>
			<p>
				<div style="position: relative;z-index:11000;">
				|-include id="autocompleter_contractor" file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=affiliatesContractorsAutocompleteListX" hiddenName="filters[contractorid]" disableSubmit="button_filtersSubmit" label="Contratista" defaultValue=$defaultContractorValue-|
				</div>
			</p>
			<p>
				<div style="position: relative;z-index:10000;">
				|-include id="autocompleter_contract" file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadContractsAutocompleteListX" hiddenName="filters[contractid]" disableSubmit="button_filtersSubmit" label="Contrato" defaultValue=$defaultContractValue-|
				</div>
			</p>
			<table><tr><td valign="top">
			  <p><label for="filters[date][min]">Fecha</label>
			  </p></td>
			<td valign="top">
			  <p>
				<label for="filters[date][min]">desde</label>
				<input name="filters[date][min]" type='text' value='|-if isset($filters.date.min)-||-$filters.date.min|date_format-||-/if-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[date][min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
				</td>
				<td valign="top">
				  <p><label for="filters[date][max]">hasta</label>
				<input name="filters[date][max]" type='text' value='|-if isset($filters.date.max)-||-$filters.date.max|date_format-||-/if-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[date][max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p></td>
				</tr></table>				
			&nbsp;&nbsp;<input id="button_filtersSubmit" type='submit' value='Buscar' />
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadInvoicesList'" />|-/if-|
		</form></div></td>
	</tr>
	|-if "vialidadInvoicesEdit"|security_has_access-|<tr>
		<th colspan="11" ><div class="rightLink">
			<a href="Main.php?do=vialidadAdvancePaymentInvoicesEdit&returnToInvoicesList=1|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Factura de Anticipo</a>
			<a href="Main.php?do=vialidadCertificateInvoicesEdit&returnToInvoicesList=1|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Factura de Certificado</a>
		</div></th>
	</tr>|-/if-|
	<tr>
		<th width="5%">NºContratista</th>
		<th width="5%">Certificado</th>
		<th width="18%">Obra</th>
		<th width="18%">Contratista</th>
		<th width="9%">Período</th>
		<th width="9%">Certificado</th>
		<th width="9%">Anticipo</th>
		<th width="9%">Recupero anticipo</th>
		<th width="9%">Retención</th>
		<th width="9%">Importe</th>
		<th width="2%">&nbsp;</th>

	</tr>
	</thead>
	<tbody>
	|-if $invoiceColl|@count eq 0-|
	<tr><td colspan="11" >No hay certificados que mostrar</td></tr>
	|-else-||-foreach from=$invoiceColl item=invoice name=for_invoices-|
	<tr>
		|-assign var=certificate value=$invoice->getCertificate()-|
		|-if !empty($certificate)-||-assign var=record value=$certificate->getMeasurementRecord()-||-/if-|
		<td>|-$invoice->getContractorNumber()-|</td>
		<td>|-if !empty($record)-||-$record->getCode()-||-/if-|</td>
		<td>|-if !empty($record)-||-$record->getConstruction()-||-/if-|</td>
		<td>|-if !empty($record)-||-$record->getContractor()-||-/if-|</td>
		<td>|-if !empty($record)-||-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-||-/if-|</td>
		<td align="right">|-if !empty($certificate)-||-$certificate->getTotalPrice()|system_numeric_format-||-/if-|</td>
		<td align="right">|-$invoice->getadvancePayment()|system_numeric_format-|</td>
		<td align="right">|-$invoice->getAdvancePaymentRecovery()|system_numeric_format-|</td>
		<td align="right">|-$invoice->getWithholding()|system_numeric_format-|</td>
		<td align="right">|-$invoice->getTotalPrice()|system_numeric_format-|</td>
		<td nowrap align="center">
		
						|-if !empty($invoice)-||-if $invoice->getClassKey() eq InvoicePeer::CLASSKEY_CERTIFICATEINVOICE-|<a href="#lightbox1" rel="lightbox1" class="lbOn">
						<input type="button" class="icon iconView" onClick='{new Ajax.Updater("viewDiv", "Main.php?do=vialidadInvoicesViewX&id=|-$invoice->getId()-|", { method: "post", parameters: { id: "|-$invoice->getId()-|"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_view" /></a>|-/if-||-/if-|


			|-if "vialidadInvoicesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="|-if $invoice->getClassKey() eq InvoicePeer::CLASSKEY_CERTIFICATEINVOICE-|vialidadCertificateInvoicesEdit|-else-|vialidadAdvancePaymentInvoicesEdit|-/if-|" /> 
			  <input type="hidden" name="returnToInvoicesList" value="1" />
			<input type="hidden" name="id" value="|-$invoice->getId()-|" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_certificate" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadInvoicesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="|-if $invoice->getClassKey() eq InvoicePeer::CLASSKEY_CERTIFICATEINVOICE-|vialidadCertificateInvoicesDoDelete|-else-|vialidadAdvancePaymentInvoicesDoDelete|-/if-|" /> 
			  <input type="hidden" name="id" value="|-$invoice->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_certificate" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Factura de Contratista?')" class="icon iconDelete" /> 
			</form>|-/if-|
		</td>
	</tr>
		|-/foreach-|
	</tbody>
		|-if isset($pager) && $pager->haveToPaginate()-|
	<tfoot>
		<tr> 
			<td colspan="11" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
	|-/if-|
	|-if "vialidadInvoicesEdit"|security_has_access && $invoiceColl|@count gt 5-|<tr>
		<th colspan="11" ><div class="rightLink">
			<a href="Main.php?do=vialidadAdvancePaymentInvoicesEdit&returnToInvoicesList=1|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Factura de Anticipo</a>
			<a href="Main.php?do=vialidadCertificateInvoicesEdit&returnToInvoicesList=1|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Factura de Certificado</a>
		</div></th>
	</tr>|-/if-|
	</tfoot>
</table>
