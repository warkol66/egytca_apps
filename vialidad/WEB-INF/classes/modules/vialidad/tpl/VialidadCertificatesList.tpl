|-include file="CommonAutocompleterInclude.tpl" -|
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
<h2>Certificados de Obra</h2>
<h1>Administración de Certificados de Obra</h1>
<p>A continuación podrá editar la lista de Certificados de Obra del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Certificado de Obra guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Certificado de Obra eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el Certificado de Obra.</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	<tr>
		<td colspan="5" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar Certificado</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
			<input type="hidden" name="do" value="vialidadCertificatesList" />
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
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadCertificatesList'" />|-/if-|
		</form></div></td>
	</tr>
	|-if "vialidadCertificatesEdit"|security_has_access-|<tr>
		<th colspan="5"><div class="rightLink"><a href="Main.php?do=vialidadCertificatesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Certificado de Obra</a></div></th>
	</tr>|-/if-|
	<tr>
		<th width="5%">Nº</th>
		<th width="40%">Obra</th>
		<th width="35%">Contratista</th>
		<th width="15%">Período</th>
		<th width="5%">&nbsp;</th>

	</tr>
	</thead>
	<tbody>
	|-if $certificates->count() eq 0-|
	<tr><td colspan="5">No hay certificados que mostrar</td></tr>
	|-else-||-foreach from=$certificates item=certificate name=for_certificates-|
	<tr>
		|-assign var=record value=$certificate->getMeasurementRecord()-|
		<td>|-$record->getCode()-|</td>
		<td>|-$record->getConstruction()-|</td>
		<td>|-$record->getContractor()-|</td>
		<td>|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</td>
		<td nowrap align="center">
		
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("viewDiv", "Main.php?do=vialidadCertificatesViewX&id=|-$certificate->getId()-|", { method: "post", parameters: { id: "|-$certificate->getId()-|"}, evalScripts: true})};$("viewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_view" /></a>


			|-if "vialidadCertificatesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadCertificatesEdit" /> 
			  <input type="hidden" name="id" value="|-$certificate->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_certificate" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadCertificatesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadCertificatesDoDelete" /> 
			  <input type="hidden" name="id" value="|-$certificate->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_certificate" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Certificado de Obra?')" class="icon iconDelete" /> 
			</form>|-/if-|
		</td>
	</tr>
	|-/foreach-||-/if-|
	</tbody>
	<tfoot>
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="5" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadCertificatesEdit"|security_has_access && $certificates|@count gt 5-|<tr>
		<th colspan="5"><div class="rightLink"><a href="Main.php?do=vialidadCertificatesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Certificado de Obra</a></div></th>
	</tr>|-/if-|
	</tfoot>
</table>
