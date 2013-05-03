|-if $message eq "captcha"-|
<div id="errorMessage">Captcha incorrecto, intente nuevamente</div>
|-/if-|
|-if !is_object($boardChallenge) or isset($entryDeleted)-|
		<div>Entrada no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
 Puede regresar a la página principal del board haciendo click <a href="Main.php?do=boardShow">aquí</a></div>
|-elseif $message eq "noChallengeIdRequested"-|
		<div>No se ingresó inguna entrada, debe identificar una entrada para visualizarla. <br />
Puede regresar a la página principal del board haciendo click <a href="Main.php?do=boardShow">aquí</a></div>
|-else-|
<!-- begin board01 -->
<div class="article">
<h5>|-$boardChallenge->getCreationDate()|date_format:"%A %e de %B de %Y"-|</h5>
<h2>|-$boardChallenge->getTitle()-|</h2>
<div id="completeText">
|-$boardChallenge->getBody()-|
</div>
<!-- End  COMPLETE TEXT // TEXTO NOTICIA COMPLETA --------------------- -->
<p>&nbsp;</p>
		<p><input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"></p>
</div>
	|-include file='BoardCommentsInclude.tpl' challenge=$boardChallenge comments=$comments bonds=$bonds-|
|-if $moduleConfig.comments.useComments.value eq "YES"-|
		
		|-/if-|
<!-- END Entrada  **************************************** -->

|-/if-|
