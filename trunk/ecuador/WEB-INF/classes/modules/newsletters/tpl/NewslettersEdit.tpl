<script type="text/javascript" language="javascript" charset="utf-8">
	//jQuery.noConflict();
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
		}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	});
</script>
<h2>Newsletter</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Newsletters Enviados</h1>
				<div id="div_newsletter">
					<form name="form_edit_newsletter" id="form_edit_newsletter" action="Main.php" method="post">
						|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el newsletter</span>|-/if-|
						<p>
							Ingrese los datos del newsletter.
						</p>
						<fieldset title="Formulario de edición de datos de un newsletter">
							<p>
								<label for="newsletter_subject">Asunto</label>
								<input name="newsletter[subject]" type="text" id="newsletter_subject" title="subject" value="|-$newsletter->getsubject()-|" size="45" maxlength="255" />
							</p>
							<p>
								<label for="newsletter_content">Contenido</label>
								<textarea name="newsletter[content]" cols="45" rows="6" wrap="virtual" id="newsletter_content">|-$newsletter->getcontent()-|</textarea>
						</p>
						<p>
								<label for="newsletter_sentAt">Enviado</label>
								<input name="newsletter[sentAt]" type="text" id="newsletter_sentAt" class="datepicker" title="sentAt" value="|-$newsletter->getsentAt()|date_format:"%d-%m-%Y"-|" size="12" /> 
								<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
							</p>
							<p>
							|-if $action eq "edit"-|
								<input type="hidden" name="newsletter[id]" id="newsletter_id" value="|-$newsletter->getid()-|" />
							|-/if-|
								<input type="hidden" name="action" id="action" value="|-$action-|" />
								<input type="hidden" name="do" id="do" value="newslettersDoEdit" />
								<input type="submit" id="button_edit_newsletter" name="button_edit_newsletter" title="Aceptar" value="Aceptar" />
								<input type="button" id="button_return_list" name="button_return_list" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=newslettersList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
							</p>
			      </fieldset>
					</form>
				</div>
				
|-if $newsletter neq ''-|
<div>
	<fieldset>
		<legend>Usuarios a los que se les ha enviado este Newsletter</legend>
		<ul>
		|-if $usersSent|@count eq 0-|
			<p>Este Newsletter no ha sido enviado a ningun usuario</p>
		|-/if-|
		|-foreach from=$usersSent item=user name=for_usersSent-|
			<li>|-$user->getUsername()-|</li>
		|-/foreach-|
		</ul>
	</fieldset>
</div>
|-/if-|
