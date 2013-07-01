<script type="text/javascript" language="javascript" charset="utf-8">
	jQuery.noConflict();
</script>
<script src="scripts/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
|-include file="NewslettersTemplatesEditTinyMCE.tpl" articles=$articles-|

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
				<input type="text" id="newslettertemplate_name" name="newslettertemplate[name]" value="|-$newslettertemplate->getname()-|" title="name" maxlength="255" />
			</p>
			<p>
				<label for="newslettertemplate_content">Cotenido de Plantilla</label>
				<textarea id="newslettertemplate_content" name="newslettertemplate[content]">|-$newslettertemplate->getcontent()-|</textarea>
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
				</p>
			</fieldset>
	</form>
</div>
