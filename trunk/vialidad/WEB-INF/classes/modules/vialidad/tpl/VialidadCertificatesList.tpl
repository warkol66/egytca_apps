|-include file="CommonAutocompleterInclude.tpl" -|
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
		<td colspan='3' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar Certificado</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
			<input type="hidden" name="do" value="vialidadCertificatesList" />
			
			&nbsp;&nbsp;<input id="button_filtersSubmit" type='submit' value='Buscar' />
			|-if $filters|@count gt 0-|<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadCertificatesList'" />|-/if-|
		</form></div></td>
	</tr>
	|-if "vialidadCertificatesEdit"|security_has_access-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadCertificatesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Certificado de Obra</a></div></th>
	</tr>|-/if-|
	<tr>
		<th width="50%">Obra</th>
		<th width="40%">Período</th>
		<th width="10%">&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	|-if $certificates->count() eq 0-|
	<tr><td colspan="3">No hay certificados cargados en el sistema</td></tr>
	|-else-||-foreach from=$certificates item=certificate name=for_certificates-|
	<tr>
		|-assign var=record value=$certificate->getMeasurementRecord()-|
		<td>|-$record->getConstruction()-|</td>
		<td>|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</td>
		<td nowrap align="center">
			|-if "vialidadCertificatesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadCertificatesEdit" /> 
			  <input type="hidden" name="id" value="|-$certificate->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_certificate" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadCertificatesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadCertificatesDoDelete" /> 
			  <input type="hidden" name="id" value="|-$certificate->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_certificate" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Certificado de Obra?')" class="icon iconDelete" /> 
			</form>|-/if-|
		</td>
	</tr>
	|-/foreach-||-/if-|
	</tbody>
	<tfoot>
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadCertificatesEdit"|security_has_access && $certificates|@count gt 5-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadCertificatesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Certificado de Obra</a></div></th>
	</tr>|-/if-|
	</tfoot>
</table>
