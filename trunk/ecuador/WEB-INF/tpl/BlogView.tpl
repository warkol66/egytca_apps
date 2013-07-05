|-if $message eq "captcha"-|
<div id="errorMessage">Captcha incorrecto, intente nuevamente</div>
|-/if-|
<h2 class="home">Experiencias de Gestión</h1>
|-if $message eq "captcha"-|
<div id="errorMessage">Captcha incorrecto, intente nuevamente</div>
|-/if-|
|-if !is_object($blogEntry) or isset($entryDeleted)-|
		<div>Entrada no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
 Puede regresar a la página principal de las Experiencias de Gestión haciendo click <a href="Main.php?do=blogShow">aquí</a></div>
|-elseif $message eq "noEntryIdRequested"-|
		<div>No se ingresó identificación de ninguna experiencia, debe identificar una para visualizarla. <br />
Puede regresar a la página principal del experiencias de gestión haciendo click <a href="Main.php?do=blogShow">aquí</a></div>
|-else-|
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<!-- begin blog01 -->
<div class="blog01">
	<h3>|-$blogEntry->getTitle()-|</h3>	
	<div id="completeText">
		|-$blogEntry->getBody()-|

|-if $blogEntry->hasRecordSheet()-|
<table border="0" class="tableTdBorders">
<colgroup><col width="25%"><col width="75%"></colgroup>
|-if $blogEntry->getParish()|strlen gt 1-|<tr>
<th>Parroquia</th>
<td>|-$blogEntry->getParish()-|</td>
</tr>|-/if-|
|-if $blogEntry->getCanton()|strlen gt 1-|<tr>
<th>Cantón</th>
<td>|-$blogEntry->getCanton()-|</td>
</tr>|-/if-|
|-if $blogEntry->getauthority()|strlen gt 1-|<tr>
<th>Autoridad</th>
<td>|-$blogEntry->getauthority()-|</td>
</tr>|-/if-|
|-if $blogEntry->getexperience()|strlen gt 1-|<tr>
<th>Experiencia</th>
<td>|-$blogEntry->getexperience()-|</td>
</tr>|-/if-|
|-if $blogEntry->getactors()|strlen gt 1-|<tr>
<th>Actores</th>
<td>|-$blogEntry->getactors()-|</td>
</tr>|-/if-|
|-if $blogEntry->getPopulationServed()|strlen gt 1-|<tr>
<th>Población beneficiada</th>
<td>|-$blogEntry->getPopulationServed()-|</td>
</tr>|-/if-|
|-if $blogEntry->gettarget()|strlen gt 1-|<tr>
<th>Objetivo</th>
<td>|-$blogEntry->gettarget()-|</td>
</tr>|-/if-|
|-if $blogEntry->getactions()|strlen gt 1-|<tr>
<th>Acciones</th>
<td>|-$blogEntry->getactions()-|</td>
</tr>|-/if-|
|-if $blogEntry->getresults()|strlen gt 1-|<tr>
<th>Resultados</th>
<td>|-$blogEntry->getresults()-|</td>
</tr>|-/if-|
|-if $blogEntry->getreplica()|strlen gt 1-|<tr>
<th>Replica</th>
<td>|-$blogEntry->getreplica()-|</td>
</tr>|-/if-|
<tr>
<th>Conclusión</th>
<td>|-if $blogEntry->getResult()-|Se considera experiencia exitosa|-else-|No se considera exitosa|-/if-|</td>
</tr>
</table>
|-/if-|

	</div>
		<div class="tags">Etiquetas: |-foreach from=$blogEntry->getBlogTags() item=tag name=for_tagss-|
     <a href="Main.php?do=blogShow&tagId=|-$tag->getId()-|">|-$tag->getName()-|</a>&nbsp;|-/foreach-|
</div>
|-if $blogEntry->isOwned($loginUser) || $loginUser->isAdmin()-|
|-assign var=editable value=true-|
|-/if-|
|-include file="BlogEditDocumentsInclude.tpl" path=$path blogEntryDocumentColl=$documents photos=$photos entityId=$blogEntry->getId() editable=$editable-|
<p>&nbsp;</p>
		<p><input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"></p>
</div>
|-if $moduleConfig.comments.useComments.value eq "YES"-|
		|-include file='BlogCommentsInclude.tpl' entry=$blogEntry comments=$comments-|
<!-- END Entrada  **************************************** -->

|-/if-|
|-/if-|
