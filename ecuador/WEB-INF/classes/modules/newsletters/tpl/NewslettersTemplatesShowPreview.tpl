|-if $message eq "sent"-|
	<div class="resultSuccess">Los envíos de prueba se han realizado con éxito</div>
|-elseif $message eq "sent_error"-|
	<div class="resultFailure">Ha ocurrido un error al realizar el envío</div>
|-/if-|

<div>
<iframe width="780" height="450" src="Main.php?do=newslettersTemplatesPreview&amp;id=|-$id-|"></iframe>
</div>
<div id="div_newslettertemplate_testsend">
	<form action="Main.php" method="post" >
		<fieldset style="width:760px">
			<legend>Envío de prueba de vista preliminar de Newsletter</legend>
			<p>Indique a continuación un conjunto de emails separados por coma, para recibir la prueba</p>
			<p><textarea name="emails" cols="65" rows="4" wrap="virtual"></textarea>
			</p>

			<p>
				<input type="hidden" name="do" value="newslettersTemplatesSendPreview" />
				<input type="hidden" name="id" value="|-$id-|" id="id"/>
				<input type="submit" value="Realizar envío de Prueba">
			</p>
		</fieldset>
	</form>	
</div>
