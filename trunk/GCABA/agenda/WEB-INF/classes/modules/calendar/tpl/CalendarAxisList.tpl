<h2>Agenda</h2>
<h1>Administración de Ejes de Gestión</h1>
<p>A continuación se muestra la lista de ejes de gestión cargados en el sistema.</p>
<div id="div_axes"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Eje guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Eje eliminado correctamente</div>
	|-/if-|
	<div class="errorMessage">Los Ejes de Gestión están ligados al diseño gráfico y todos los eventos del sistema y semanas temáticas!!!!.<br>
Si un evento o semana temática está vinculado con un Eje, no puede eliminarlo!!!!. El eliminar un eje vinculado, genera incompatibilidades insubsanables.<br>
La disposición de las pestañas en la vista de la agenda requieren del correcto uso de los ejes de gestión, si no está seguro que lo que está haciendo, por favor no modifique nada de esta pantalla.</div>
	<table id="tabla-tipos" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<!--<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ejes</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="calendarAxisList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$filters.perPage-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=calendarAxisList'"/>|-/if-|
			</form>
			</div></td>
		</tr>-->
			|-if "calendarAxisEdit"|security_has_access-|<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarAxisEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Eje de Gestión</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle">
			  <th width="3%">Color</th> 
	<!--			<th width="5%">Id</th> -->
				<th width="92%">Eje de Gestión</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
	  </thead> 
	<tbody id="calendarAxisList">|-if $calendarAxisColl|@count eq 0-|
		<tr>
			 <td colspan="4">|-if isset($filter)-|No hay tipos que concuerden con la búsqueda|-else-|No hay tipos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$calendarAxisColl item=calendarAxis name=for_axes-|
		<tr>
		  <td bgcolor="|-$calendarAxis->getColor()-|">&nbsp;</td> 
			<td>|-if "calendarAxisEdit"|security_has_access-|<span id="media_type_|-$calendarAxis->getid()-|" class="in_place_editable">|-$calendarAxis->getName()-|</span>|-else-||-$calendarAxis->getName()-||-/if-|</td>
			<td nowrap>|-if "calendarAxisEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="calendarAxisEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$calendarAxis->getid()-|" /> 
					<input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if is_object($loginUser) && $loginUser->isSupervisor()-||-if "calendarAxisDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="calendarAxisDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$calendarAxis->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Tipo?')" class="icon iconDelete" /> 
			</form>
			|-/if-||-/if-|</td> 
		</tr> 
		|-/foreach-|
		<tr>
	  </tbody> 
        <tfoot>
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "calendarAxisEdit"|security_has_access-|<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarAxisEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Eje de Gestión</a></div></th>
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
|-foreach from=$calendarAxes item=calendarAxis name=for_axes-|
    new Ajax.InPlaceEditor(
        'media_type_|-$calendarAxis->getId()-|',
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
            externalControl: 'axis_edit_|-$calendarAxis->getid()-|',
            clickToEditText: 'Haga click para editar',
						callback: function(form, value) {
							return 'objectType=calendarAxis&objectId=|-$calendarAxis->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
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
            success: 'calendarAxisList'
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
