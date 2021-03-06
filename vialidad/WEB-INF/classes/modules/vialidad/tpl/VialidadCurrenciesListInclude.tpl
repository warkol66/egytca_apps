|-if $currencyColl|@count eq 0-|
	<tr>
		<td colspan="3">|-if isset($filter)-|No hay Monedas búsqueda|-else-|No hay Monedas de medida disponibles|-/if-|</td>
	</tr>
|-else-|
	|-foreach from=$currencyColl item=currency name=for_currencies-|
		<tr> 
			<td>
				|-if "vialidadCurrenciesEdit"|security_has_access-|
				<span id="name_|-$currency->getId()-|" class="in_place_editable">|-$currency->getName()-|</span>
				|-else-|
				|-$currency->getName()-|
				|-/if-|
			</td>
			<td>
				|-if "vialidadCurrenciesEdit"|security_has_access-|
					<span id="code_|-$currency->getId()-|" class="in_place_editable">|-$currency->getCode()-|</span>
				|-else-|
				|-$currency->getCode()-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "vialidadCurrenciesEdit"|security_has_access-|
					<input type="hidden" name="do" value="vialidadCurrenciesEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$currency->getid()-|" />
					<input type="submit" id="name_edit_|-$currency->getId()-|" name="submit_go_edit_vialidad_currency" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "vialidadCurrenciesDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadCurrenciesDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$currency->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_currency" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar la Moneda?')" class="icon iconDelete" />
				</form>
				|-/if-|
			</td>
		</tr> 
	|-/foreach-|
|-/if-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|

<script language="JavaScript" type="text/JavaScript">
function attachNameInPlaceEditors() {
	|-foreach from=$currencyColl item=currency name=for_currencies_ajax-|
	new Ajax.InPlaceEditor(
		'name_|-$currency->getId()-|',
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
			externalControl: 'name_edit_|-$currency->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'objectType=currency&objectId=|-$currency->getId()-|&paramName=name&paramValue='
						+ encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
				msgs = $$('.successMessage');
				for (var i=0; i<msgs.length; i++)
					msgs[i].hide();
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Nombre: ') });
			}
		}
	);
|-/foreach-|
}
function attachCodeInPlaceEditors() {
	|-foreach from=$currencyColl item=currency-|
	new Ajax.InPlaceEditor(
		'code_|-$currency->getId()-|',
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
			callback: function(form, value) {
				return 'objectType=currency&objectId=|-$currency->getId()-|&paramName=code&paramValue='
					+ encodeURIComponent(clean(value));
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
				msgs = $$('.successMessage');
				for (var i=0; i<msgs.length; i++)
					msgs[i].hide();
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Código: ') });
			}
		}
	);
	|-/foreach-|
}
attachCodeInPlaceEditors();
attachNameInPlaceEditors();
|-if isset($status)-|
setStatus('|-$status-|');
|-/if-|
</script>