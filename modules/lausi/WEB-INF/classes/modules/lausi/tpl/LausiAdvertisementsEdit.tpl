<h2>Distribución de Motivos</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Aviso</h1>
<div id="div_advertisement">
	<form name="form_edit_advertisement" id="form_edit_advertisement" action="Main.php" method="post">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el aviso</span>|-/if-|
		<p>
			Ingrese los datos del aviso.
		</p>
		<fieldset title="Formulario de edición de datos de un advertisement">
			<legend>Aviso</legend>
			<p>
				<label for="advertisement[date]">Fecha</label>
				<input name="advertisement[date]" type="text" id="date" title="date" value="|-$advertisement->getdate()-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="advertisement[publishDate]">Publicación</label>
				<input name="advertisement[publishDate]" type="text" id="publishDate" title="publishDate" value="|-$advertisement->getpublishDate()-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('publishDate', false, 'ymd', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="advertisement[duration]">Duración</label>
				<input name="advertisement[duration]" type="text" id="duration" title="duration" value="|-$advertisement->getduration()-|" size="4" />
			</p>
			<p>
				<label for="advertisement[billboardId]">Cartelera</label>
				<select id="billboardId" name="advertisement[billboardId]" title="billboardId">
					<option value="">Seleccione una Cartelera</option>
									|-foreach from=$billboardIdValues item=object-|
									
									<option value="|-$object->getid()-|" |-if $advertisement->getbillboardId() eq $object->getid()-|selected="selected"|-/if-|>|-assign var=address value=$object->getAddress()-||-if $address ne ""-||-$address->getName()-| (|-$object->getNumber()-|)|-/if-|&nbsp;&nbsp;&nbsp;</option>
									|-/foreach-|
								</select>
							</p>
			<p>
				<label for="advertisement[themeId]">Motivo</label>
				<select id="themeId" name="advertisement[themeId]" title="themeId">
					<option value="">Seleccione un Motivo</option>
									|-foreach from=$themeIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $advertisement->getthemeId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|&nbsp;&nbsp;&nbsp;</option>
									|-/foreach-|
								</select>
							</p>
			<p>
				<input type="hidden" name="id" id="id" value="|-$advertisement->getid()-|" />
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiAdvertisementsDoEdit" />
				<input type="submit" id="button_edit_advertisement" name="button_edit_advertisement" title="Aceptar" value="Aceptar"/>
			</p>
				</fieldset>
	</form>
</div>
