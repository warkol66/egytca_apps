<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<!-- TITULO ULTIMAS NOTICIAS -->
	<div id="titleContent">
		<h2>Novedades</h2>
	</div>
|-if !is_object($newsArticle)-|
<p>La noticia especificada no existe</p>
|-else-|
<!-- begin ACTIONBOX --> 
|-if $newsArticlesConfig.comments.useCommets.value eq "YES" || $newsArticlesConfig.useSendArticle.value eq "YES"-|<div class="actionBox">
 <ul>
	<li><a href="javascript:showSendEmailFormX(|-$newsArticle->getId()-|,'sendToEmailDiv|-$newsArticle->getId()-|Top')" class="enviar">Enviar</a></li>
|-if $newsArticlesConfig.comments.useCommets.value eq "YES"-|<li><a href="#commentsForm" onClick='javascript:showCommentAddForm("div_comments_adder_|-$newsarticle->getId()-|")' class="comentar">Comentar</a></li>|-/if-|
<!--	<li><a href="*" class="imprimir">Imprimir</a></li> -->
<!--			 <li><a href="*" class="letterLow">&nbsp;</a></li>
<li><a href="*" class="letterPlus">Cambiar Tamaño</a></li>			 	 -->
 </ul>
</div>
<!-- end ACTIONBOX -->  		
<!-- begin NEWS01 -->
<div class="news01">
	|-if $newsArticlesConfig.useSendArticle.value eq "YES"-|<div id="sendToEmailDiv|-$newsArticle->getId()-|Top" style="display: none;">
		<p>
			|-include file='NewsArticlesSendToEmailInclude.tpl' article=$newsArticle-|
		</p>
	</div>
|-/if-|
|-/if-|
|-*<h4>|-$newsArticle->getCreationDate()|date_format:"%d-%m-%Y"-| - 
|-if $newsArticlesConfig.useRegion.value eq "YES"-||-assign var=region value=$newsArticle->getRegion()-|
	|-if not empty($region)-||-$region->getName()-||-/if-||-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-||-assign var=category value=$newsArticle->getCategory()-|
	|-if not empty($category)-||-if not empty($region)-| &gt;&gt;|-/if-||-$category->getName()-||-/if-||-/if-|</h4>*-|
|-if $newsArticlesConfig.useTopTitle.value eq "YES"-|<h2>|-$newsArticle->gettoptitle()-|</h2>|-/if-|
<h1>|-$newsArticle->getTitle()-|</h1>
|-if $newsArticlesConfig.useSubTitle.value eq "YES"-|<p><em>|-$newsArticle->getSubTitle()-|</em></p>|-/if-|
	<!-- Begin  COMPLETE TEXT //  TEXTO NOTICIA COMPLETA --------------------- -->
|-if $moduleConfig.image.useImages.value eq "YES"-||-if $newsArticle->getImages()|@count gt 0-||-include file='NewsMediasViewInclude.tpl'-||-/if-||-/if-|
	
|-if $moduleConfig.image.useAudio.value eq "YES" || $moduleConfig.image.useVideo.value eq "YES"-||-if $newsArticle->getVideos()|@count gt 0 or $newsArticle->getSounds()|@count gt 0-||-include file='NewsMediasVideosViewInclude.tpl'-||-/if-||-/if-|
<div id="completeText">
	
	|-$newsArticle->getBody()-|
	<p>Fecha: |-$newsArticle->getCreationDate()|date_format:"%d-%m-%Y"-|<br />
	|-if $newsArticlesConfig.useSource.value eq "YES"-||-assign var=source value=$newsArticle->getSource()-||-if not empty($source)-|Contacto: |-$source-||-/if-|<br />
	|-assign var=sourceContact value=$newsArticle->getSourceContact()-||-if not empty($sourceContact)-|Para más información: |-$sourceContact-||-/if-||-/if-|</p>
</div>
<!-- End  COMPLETE TEXT // TEXTO NOTICIA COMPLETA --------------------- -->
		<p>|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);">|-else-|
			<input type="button" title="Ir al listado de Novedades" value="Ir al listado de Novedades" onClick="location.href='Main.php?do=newsArticlesShow|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-else-|&page=1|-/if-|'"/>
|-/if-|</p>
	</div>
	|-if $newsArticlesConfig.comments.useComments.value eq "YES"-|<p>
		|-include file='NewsCommentsInclude.tpl' article=$newsArticle comments=$comments-|
	</p>|-/if-|
	|-if $newsArticlesConfig.useSendArticle.value eq "YES"-|<div id="sendToEmailDiv|-$newsArticle->getId()-|Bottom" style="display: none;">
		<p>
			|-include file='NewsArticlesSendToEmailInclude.tpl' article=$newsArticle-|
		</p>
	</div>|-/if-|
<!-- END NOTICIA  **************************************** -->
<!-- **************************************** --> 
   
       <!-- begin ACTIONBOX >
			<div class="right actionBox">
           <ul>
             <li><a href="javascript:showSendEmailFormX(|-$newsArticle->getId()-|,'sendToEmailDiv|-$newsArticle->getId()-|Bottom')" class="enviar">Enviar</a></li>
|-if $newsArticlesConfig.useCommets.value eq "YES"-|<li><a href='javascript:showCommentAddForm("div_comments_adder_|-$newsArticle->getId()-|")' class="comentar">Comentar</a></li>|-/if-|
<!--			 <li><a href="*" class="imprimir">Imprimir</a></li>-->
<!--			 <li><a href="*" class="letterLow">&nbsp;</a></li>
			 <li><a href="*" class="letterPlus">Cambiar Tamaño</a></li>			- -> 			 			 
           </ul>
       </div><!-- end ACTIONBOX -->  		
|-/if-|

