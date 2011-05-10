<div id="rightColumn">
<h2>Formularios</h2>
<h1>Respuestas de Formularios</h1>
<div id="div_processedform">
		<fieldset title="Vista de datos de una Respuesta">
		<p>
			<label for="processedform_formId">Formulario</label>
			|-$processedform->getformId()-|
		</p>
		<p>
			<label for="processedform_formFillingDate">Fecha</label>
			|-$processedform->getformFillingDate()|date_format:"%d-%m-%Y %R"-|
		</p>
		<p>
			<label for="processedform_processedContent">Respuesta</label>
			</p>
			<div id="answers">
			<p>|-$processedform->getProcessedContentDOM()-|</p>
			</div>
		<p>
			<label for="processedform_ip">Enviado desde IP</label>
			|-$processedform->getip()-|
		</p>
		<p><input type="button" onClick="window.close()" value="Cerrar" /></p>
		</fieldset>
	</div>
</div>
