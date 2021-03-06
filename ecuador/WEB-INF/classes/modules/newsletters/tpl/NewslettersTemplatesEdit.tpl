|-include file="NewslettersTemplatesEditTinyMCE.tpl" articles=$articles entries=$entries challenge=$challenge-|
<h2>Newsletter</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Plantilla</h1>
<div id="div_newslettertemplate">
	<form name="form_edit_newslettertemplate" id="form_edit_newslettertemplate" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="resultFailure">Ha ocurrido un error al intentar guardar el newsletter template</div>
		|-/if-|
		<p>
			Ingrese los datos de la plantilla de newsletter.
		</p>
		<fieldset title="Formulario de edición de datos de plantilla de newsletter">
			<p>
				<label for="newslettertemplate_name">Nombre de Plantilla</label>
				<input name="newslettertemplate[name]" type="text" id="newslettertemplate_name" title="name" value="|-$newslettertemplate->getname()-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="newslettertemplate_content">Cotenido de Plantilla</label>
				<textarea name="newslettertemplate[content]" cols="70" rows="9" wrap="VIRTUAL" id="newslettertemplate_content">|-$newslettertemplate->getcontent()-|</textarea>
			</p>
			<p>
				<label>Agregar Fecha de Envio a Asunto</label>
				<input type="checkbox" name="newslettertemplate[hasDeliveryDate]" value="1" |-if $newslettertemplate->hasDeliveryDateOnSubject()-|checked="checked"|-/if-|></input>
			</p>
			<p>
				<label>Agregar Numero de Envio a Asunto</label>
				<input type="checkbox" name="newslettertemplate[hasDeliveryNumber]" value="1" |-if $newslettertemplate->hasDeliveryNumberOnSubject()-|checked="checked"|-/if-|></input>
			</p>
			<p>
				<label for="newslettertemplate_newsletterTemplateExternalId">Plantilla Externa</label>
				<select id="newslettertemplate_newsletterTemplateExternalId" name="newslettertemplate[newsletterTemplateExternalId]" title="newsletterTemplateExternalId">
					<option value="">Ninguna</option>
						|-foreach from=$newsletterTemplateExternalIdValues item=object-|
						<option value="|-$object->getid()-|" |-if $newslettertemplate->getnewsletterTemplateExternalId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
						|-/foreach-|
					</select>
				</p>
				<p>
				|-if $action eq "edit"-|
					<input type="hidden" name="newslettertemplate[id]" id="newslettertemplate_id" value="|-$newslettertemplate->getid()-|" />
					|-/if-|
					<input type="hidden" name="action" id="action" value="|-$action-|" />
					<input type="hidden" name="do" id="do" value="newslettersTemplatesDoEdit" />
					<input type="submit" id="button_edit_newslettertemplate" name="button_edit_newslettertemplate" title="Aceptar" value="Aceptar" />
					<input type="button" id="button_return_list" name="button_return_list" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=newslettersTemplatesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
				</p>
			</fieldset>
	</form>
</div>
