<h2>Newsletter</h2>
<h1>Ver Newsletter Enviado</h1>
				<div id="div_newsletter">
					<form name="form_edit_newsletter" id="form_edit_newsletter" action="Main.php" method="post">
						|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el newsletter</span>|-/if-|
						<p>
							Detalle del newsletter.
						</p>
						<fieldset title="Formulario de edición de datos de un newsletter">
							<p>
								<label for="newsletter_subject">Asunto</label>|-$newsletter->getsubject()-|</p>
								<p>
									<label for="newsletter_sentAt">Fecha de 	Envio</label>|-$newsletter->getsentAt()|date_format:"%d-%m-%Y"-|
								</p>
								<p>
									<label for="newsletter_content">Contenido</label>
								<div>
								|-$newsletter->getcontent()-|
								</div>
							</p>

			      </fieldset>
					</form>
				</div>
				

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

