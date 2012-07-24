<h2>Medios</h2>
<h1>Administración de audiencias de medios</h1>
<p>A continuación se muestra la lista de audiencias de medio cargados en el sistema.</p>
<div id="div_audiences"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Audiencia guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Audiencia eliminada correctamente</div>
	|-/if-|
	<table id="tabla-audiences" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="mediasAudienceList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|	
				|-if $loginUser->isSupervisor()-|Incluir eliminados<input name="filters[includeDeleted]" type="checkbox" value="true" |-$filters.includeDeleted|checked:"true"-|>|-/if-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=mediasAudienceList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			|-if "mediasAudienceEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasAudienceEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Tipo</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">Tipo</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $mediaAudiences|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay tipos que concuerden con la búsqueda|-else-|No hay tipos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$mediaAudiences item=mediaAudience name=for_audiences-|
		<tr> 
	<!--		<td>|-$mediaAudience->getid()-|</td> -->
			<td>|-if "mediasAudienceEdit"|security_has_access-|<span id="media_audience_|-$mediaAudience->getId()-|" class="in_place_editable">|-$mediaAudience->getName()-|</span>|-else-||-$mediaAudience->getName()-||-/if-|</td>      
			<td nowrap>|-if "mediasAudienceEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasAudienceEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaAudience->getid()-|" /> 
					<input type="submit" name="submit_go_edit_audience" value="Editar" title="Editar" id="media_audience_edit_|-$mediaAudience->getid()-|" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "mediasAudienceDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasAudienceDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaAudience->getid()-|" /> 
					<input type="submit" name="submit_go_delete_audience" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Tipo?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "mediasAudienceEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasAudienceEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Tipo</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
<script type="text/javascript">
Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
  enterEditMode:function(e) {
    this.__enterEditMode(e);
    this.triggerCallback('onFormReady',this._form);
  }
});

window.onload = function() {
|-foreach from=$mediaAudiences item=mediaAudience name=for_audiences-|
    new Ajax.InPlaceEditor(
        'media_audience_|-$mediaAudience->getId()-|',
        'Main.php?do=mediasAudienceEditFieldX',
        {
            rows: 1,
            okText: 'Guardar',
            cancelText: 'Cancelar',
            savingText: 'Guardando...',
						hoverClassName: 'in_place_hover',
				    highlightColor: '#b7e0ff',
            cancelControl: 'button',
            savingClassName: 'inProgress',
            externalControl: 'media_audience_edit_|-$mediaAudience->getid()-|',
            clickToEditText: 'Haga click para editar',
            callback: function(form, value) { 
                return 'id=|-$mediaAudience->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
            },
            onComplete: function(transport, element) {
                clean_text_content_from(element);
                new Effect.Highlight(element, { startcolor: this.options.highlightColor });
            },
            onFormReady: function(obj,form) {
                form.insert({ top: new Element('label').update('Nombre: ') });
            }
        }
    );
|-/foreach-|
}

function showInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}

function prepareAndSubmit(form) {
    var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater({
            success: 'mediaAudienceList'
        },
        'Main.php',
        {
            method: 'post',
            postBody: fields,
            evalScripts: true,
            insertion: Insertion.Bottom
        }
    );
    form.name.value = '';
}

function chomp(raw_text) {
    return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
    element.innerHTML = chomp(element.innerHTML);
}
</script>
