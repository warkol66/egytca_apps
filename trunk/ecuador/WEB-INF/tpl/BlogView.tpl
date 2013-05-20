|-if $message eq "captcha"-|
<div id="errorMessage">Captcha incorrecto, intente nuevamente</div>
|-/if-|
<h2 class="home">Experiencias exitosas</h1>
|-if $message eq "captcha"-|
<div id="errorMessage">Captcha incorrecto, intente nuevamente</div>
|-/if-|
|-if !is_object($blogEntry) or isset($entryDeleted)-|
		<div>Entrada no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
 Puede regresar a la página principal del blog haciendo click <a href="Main.php?do=blogShow">aquí</a></div>
|-elseif $message eq "noEntryIdRequested"-|
		<div>No se ingresó inguna entrada, debe identificar una entrada para visualizarla. <br />
Puede regresar a la página principal del blog haciendo click <a href="Main.php?do=blogShow">aquí</a></div>
|-else-|
<!-- begin blog01 -->
<div class="blog01">
	<h3>|-$blogEntry->getTitle()-|</h3>	
	<div id="completeText">
		|-$blogEntry->getBody()-|
	</div>
		<div class="tags">Etiquetas: |-foreach from=$blogEntry->getBlogTags() item=tag name=for_tagss-|
     <a href="Main.php?do=blogShow&tagId=|-$tag->getId()-|">|-$tag->getName()-|</a>&nbsp;|-/foreach-|
</div>
<p>&nbsp;</p>
		<p><input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"></p>
</div>
|-if $moduleConfig.comments.useComments.value eq "YES"-|
		|-if isset($loggedUser)-||-assign var=logged value="logged"-||-else-||-assign var=logged value="nlogged"-||-/if-|
		|-include file='BlogCommentsInclude.tpl' entry=$blogEntry comments=$comments logged=$logged-|
		|-/if-|
<!-- END Entrada  **************************************** -->

|-/if-|

