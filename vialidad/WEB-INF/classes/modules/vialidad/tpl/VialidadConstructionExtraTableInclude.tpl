<h3>|-$extraName-|</h3>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	|-if $createAction|security_has_access-|
	<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink">
			<a href="#" id="link_add_|-$extraType-|" class="addLink" onclick="this.hide(); $('form_add_|-$extraType-|').show(); return false">Agregar |-$extraName-|</a>
			<form id="form_add_|-$extraType-|" onsubmit="add_|-$extraType-|(this); this.hide(); $('link_add_|-$extraType-|').show(); return false;" style="display:none">
				<input type="hidden" name="params[constructionId]" value="|-$construction->getId()-|" />
				<label>Descripción</label>
				<input type="text" size="60" name="params[description]" />
				<label>Fecha</label>
				<input type="text" size="12" name="params[date]" title="Fecha de |-$extraName-| en formato dd-mm-yyyy" />
				<label>Importe</label>
				<input type="text" size="12" name="params[price]" />
				<input type="submit" class="icon iconActivate" />
				<input type="button" class="icon iconCancel" onclick="this.form.hide(); $('link_add_|-$extraType-|').show();" />
			</form>
		</div></th>
	</tr>
	|-/if-|
	<tr>
		<th width="70%">Descripción</th>
		<th width="15%">Fecha</th>
		<th width="10%">Importe</th>
		<th width="3%">&nbsp;
		</th>
	</tr>
	</thead>
	<tbody id="|-$extraType-|s">
	|-foreach from=$extras item=extra-|
		|-include
			file="VialidadConstructionExtraTableRowInclude.tpl"
			extra=$extra
			extraType=$extraType
			deleteText=$deleteText
			editAction=$editAction
			deleteAction=$deleteAction
		-|
	|-/foreach-|
	</tbody>
</table>

<script type="text/javascript">
	function add_|-$extraType-|(form) {
		new Ajax.Updater(
			{success: "|-$extraType-|s"},
			"Main.php?do=|-$createAction-|",
			{
				method: "post",
				parameters: Form.serialize(form),
				insertion: "bottom",
				evalScripts: true
			}
		);
	}
</script>