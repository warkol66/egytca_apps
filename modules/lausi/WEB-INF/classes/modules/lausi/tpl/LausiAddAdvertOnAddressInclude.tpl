<script type="text/javascript" src="scripts/lausi-distribution.js"></script>

<div id="div_advertisement">
	<form name="form_add_advertisement" id="form_add_advertisement" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un advertisement">
			<p>
				<label for="advertisement[publishDate]">Fecha de Publicación</label>
				<input name="advertisement[publishDate]" type="text" id="publishDate" title="publishDate" value="" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('publishDate', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="advertisement[duration]">Duración</label>
				<input name="advertisement[duration]" type="text" id="duration" title="duration" value="" size="4" />
			</p>
			<p>
				<label for="quantity">Cantidad de Afiches</label>
				<input type="input" name="quantity" value="" id="quantity">
			</p>
			<p>
				<label for="advertisement[themeId]">Motivo</label>
				<select id="themeId" name="advertisement[themeId]" title="themeId">
					<option value="">Seleccione un Motivo</option>
									|-foreach from=$themes item=object-|
									<option value="|-$object->getid()-|">|-$object->getname()-|&nbsp;&nbsp;&nbsp;</option>
									|-/foreach-|
								</select>
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiAddAdvertOnAddressX" />
				<input type="hidden" name="addressId" value="|-$address->getId()-|" >
				<input type="button" id="button_add_advertisement" name="button_edit_advertisement" title="Aceptar" value="Aceptar" onClick="javascript:lausiAddAdvertOnAddress(this.form)"/> <span id="msgBoxAddAdvert"></span>
			</p>
				</fieldset>
	</form>
</div>
