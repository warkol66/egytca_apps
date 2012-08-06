<h2>Agenda</h2>
<h1>Administración de Formatos de Eventos</h1>
<p>A continuación se muestra la lista de Formatos de Eventos cargados en el sistema.</p>
<div id="div_axes"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Formato guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Formato eliminado correctamente</div>
	|-/if-|
	<table id="tabla-tipos" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<!--<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de Formatos</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="calendarEventTypesList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$filters.perPage-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=calendarEventTypesList'"/>|-/if-|
			</form>
			</div></td>
		</tr>-->
			|-if "calendarEventTypesEdit"|security_has_access-|<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarEventTypesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Formato de Evento</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle">
	<!--			<th width="5%">Id</th> -->
				<th width="92%">Formato de Evento</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
	  </thead> 
	<tbody id="calendarEventTypesList">|-if $eventTypeColl|@count eq 0-|
		<tr>
			 <td colspan="2">|-if isset($filter)-|No hay tipos que concuerden con la búsqueda|-else-|No hay tipos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$eventTypeColl item=calendarEventTypes name=for_axes-|
		<tr>
			<td>|-if "calendarEventTypesEdit"|security_has_access-|<span id="media_type_|-$calendarEventTypes->getid()-|" class="in_place_editable">|-$calendarEventTypes->getName()-|</span>|-else-||-$calendarEventTypes->getName()-||-/if-|</td>
			<td nowrap>|-if "calendarEventTypesEdit"|security_has_access-|<!--<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="calendarEventTypesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$calendarEventTypes->getid()-|" /> 
					<input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|-->
				|-if "calendarEventTypesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="calendarEventTypesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$calendarEventTypes->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Tipo?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		<tr>
	  </tbody> 
        <tfoot>
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="2" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "calendarEventTypesEdit"|security_has_access-|<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarEventTypesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Formato de Evento</a></div></th>
			</tr>|-/if-|
		|-/if-|
        </tfoot>
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
|-foreach from=$eventTypeColl item=calendarEventTypes name=for_axes-|
    new Ajax.InPlaceEditor(
        'media_type_|-$calendarEventTypes->getId()-|',
        'Main.php?do=commonDoEditFieldX',
        {
            rows: 1,
            okText: 'Guardar',
            cancelText: 'Cancelar',
            savingText: 'Guardando...',
						hoverClassName: 'in_place_hover',
				    highlightColor: '#b7e0ff',
            cancelControl: 'button',
            savingClassName: 'inProgress',
            externalControl: 'axis_edit_|-$calendarEventTypes->getid()-|',
            clickToEditText: 'Haga click para editar',
						callback: function(form, value) {
							return 'objectType=eventType&objectId=|-$calendarEventTypes->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
						},
						onComplete: function(transport, element) {
							clean_text_content_from(element);
							new Effect.Highlight(element, { startcolor: this.options.highlightColor });
						},
						onFormReady: function(obj,form) {
							form.insert({ top: new Element('label').update('Departamento: ') });
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
            success: 'calendarEventTypesList'
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
