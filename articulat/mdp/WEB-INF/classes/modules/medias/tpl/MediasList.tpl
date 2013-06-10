|-include file="CommonAutocompleterInclude.tpl"-|
<h2>Tablero de Gestión</h2>
<h1>Administración de ##medias,1,Medios##</h1>
<p>A continuación se muestra la lista de ##medias,1,Medios## cargados en el sistema.</p>
<div id="div_medias"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##medias,2,Medio## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##medias,2,Medio## eliminado correctamente</div>
	|-elseif $message eq "not_deleted"-|
		<div class="errorMessage">No se pudo eliminar el ##medias,2,Medio##</div>
	|-/if-|
	<table id="tabla-medias" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##medias,1,Medios## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="mediasList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
				<label for="filters[typeid]">Tipo</label>
				<select name="filters[typeid]" id="filters[typeid]" >
     		<option value="">Seleccione</option>
				|-foreach from=$mediaTypes item=mediaType name=for_mediaType-|
        		<option value="|-$mediaType->getId()-|" |-$mediaType->getId()|selected:$filters.typeid-|>|-$mediaType->getName()-|</option>
				|-/foreach-|
				</select>
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$filters.perPage-|	
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=mediasList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			|-if "mediasEdit"|security_has_access-|<tr>
				 <th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##medias,2,Medio##</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="40%">##medias,2,Medio##</th> 
				<th width="15%">Tipo</th> 
				<th width="40%">Descripción</th>
				<th width="5%">&nbsp;</th>
			</tr> 
		</thead> 
	<tbody>|-if $medias|@count eq 0-|
		<tr>
			 <td colspan="4">|-if isset($filters)-|No hay ##medias,1,Medios## que concuerden con la búsqueda|-else-|No hay ##medias,1,Medios## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$medias item=media name=for_medias-|
		<tr id="media|-$media->getid()-|"> 
	<!--		<td>|-$media->getid()-|</td> -->
			<td nowrap="nowrap">
				|-$media->getName()-|
				<!--	<a href="#" id="link_makeAlias|-$media->getId()-|" onclick="this.hide(); $('form_makeAlias|-$media->getId()-|').show(); return false;">make alias</a>
				<form onsubmit="makeAlias('|-$media->getId()-|'); return false;" id="form_makeAlias|-$media->getId()-|" style="display:none;">
					<div style="position: relative;z-index:10000; display:inline;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_medias|-$media->getId()-|" url="Main.php?do=mediasAutocompleteListX" hiddenName="aliasOf" label="&nbsp;-&nbsp;alias de" disableSubmit="submit_media|-$media->getId()-|"-|
					</div>
					<input type="hidden" name="mediaId" value="|-$media->getId()-|" />
					<input type="submit" id="submit_media|-$media->getId()-|" disabled="disabled" value="make alias" />
					<input type="button" onclick="this.form.hide(); $('link_makeAlias|-$media->getId()-|').show();" value="cancelar" />
				</form>-->
			</td> 
			<td>|-$media->getMediaType()-|</td> 
			<td>|-$media->getDescription()-|</td> 
			<td nowrap>|-if "mediasEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$media->getid()-|" /> 
					<input type="submit" name="submit_go_edit_media" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "mediasDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$media->getid()-|" /> 
					<input type="submit" name="submit_go_delete_media" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##medias,2,Medio##?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "mediasEdit"|security_has_access-|<tr>
				 <th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##medias,2,Medio##</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
		
<script type="text/javascript">
	function makeAlias(mediaId) {
		var fields = Form.serialize($('form_makeAlias'+mediaId));
		new Ajax.Request(
			'Main.php?do=mediasMakeAliasX',
			{
				method: 'post',
				postBody: fields,
				onSuccess: function() {
					var item = $('media'+mediaId);
					item.parentNode.removeChild(item);
				}
			}
		);
	}
</script>
	