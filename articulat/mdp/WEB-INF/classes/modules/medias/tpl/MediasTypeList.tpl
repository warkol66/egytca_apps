<h2>Medios</h2>
<h1>Administración de tipos de medios</h1>
<p>A continuación se muestra la lista de tipos de medio cargados en el sistema.</p>
<div id="div_types"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Tipo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Tipo eliminado correctamente</div>
	|-/if-|
	<table id="tabla-tipos" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de tipos </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="mediasTypeList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|	
				|-if $loginUser->isSupervisor()-|Incluir eliminados<input name="filters[includeDeleted]" type="checkbox" value="true" |-$filters.includeDeleted|checked:"true"-|>|-/if-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=mediasTypeList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			|-if "mediasTypeEdit"|security_has_access-|<tr>
                <th colspan="3" class="thFillTitle">
                    <div class="rightLink">
                        <a href="#" onclick="showInput('addInput1', 'addLink1'); return false;" id="addLink1" class="addLink">Agregar Tipo</a>
                        <form id="addInput1" action="Main.php" method="POST" onsubmit="prepareAndSubmit(this); showInput('addLink1', 'addInput1'); return false;" style="display: none;">
                            <label>Ingrese nombre del tipo:</label>
                            <input type="text"   name="name" />
                            <input type="hidden" name="do" value="mediasTypeDoCreateListX" />
                            <input type="submit" value="Guardar" class="icon iconActivate" />
                            <input type="button" value="Guardar" class="icon iconCancel" onclick="showInput('addLink1', 'addInput1');" />
                        </form>
                    </div>
                </th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">Tipo</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody id="mediaTypeList">|-if $mediaTypes|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay tipos que concuerden con la búsqueda|-else-|No hay tipos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$mediaTypes item=mediaType name=for_types-|
		<tr> 
	<!--		<td>|-$mediaType->getid()-|</td> -->
			<td>
                |-if "mediasTypeEdit"|security_has_access-|<span id="media_type_|-$mediaType->getid()-|" class="in_place_editable">|-$mediaType->getName()-|</span>|-else-||-$mediaType->getName()-||-/if-|
            </td>
			<td nowrap>|-if "mediasTypeEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasTypeEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
					<input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" id="media_type_edit_|-$mediaType->getid()-|" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "mediasTypeDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasTypeDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Tipo?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		</tbody> 
        <tfoot>
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "mediasTypeEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle">
                    <div class="rightLink">
                        <a href="#" onclick="showInput('addInput2', 'addLink2'); return false;" id="addLink2" class="addLink">Agregar Tipo</a>
                        <form id="addInput2" action="Main.php" method="POST" onsubmit="prepareAndSubmit(this); showInput('addLink2', 'addInput2'); return false;" style="display: none;">
                            <label>Ingrese nombre del tipo:</label>
                            <input type="text"   name="name" />
                            <input type="hidden" name="do" value="mediasTypeDoCreateListX" />
                            <input type="submit" value="Guardar" />
                        </form>
                    </div>
                </th>
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
|-foreach from=$mediaTypes item=mediaType name=for_types-|
    new Ajax.InPlaceEditor(
        'media_type_|-$mediaType->getId()-|',
        'Main.php?do=mediasTypeEditFieldX',
        {
            rows: 1,
            okText: 'Guardar',
            cancelText: 'Cancelar',
            savingText: 'Guardando...',
						hoverClassName: 'in_place_hover',
				    highlightColor: '#b7e0ff',
            cancelControl: 'button',
            savingClassName: 'inProgress',
            externalControl: 'media_type_edit_|-$mediaType->getid()-|',
            clickToEditText: 'Haga click para editar',
            callback: function(form, value) { 
                return 'id=|-$mediaType->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
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
            success: 'mediaTypeList'
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
