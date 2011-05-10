<!-- TITULO ULTIMAS NOTICIAS -->
<div id="titleLastNews">Noticias</div>
<!-- begin ACTIONBOX --> 
<div class="actionBox">
 <ul>
	<li><a href="javascript:showSendEmailFormX(|-$newsarticle->getId()-|,'sendToEmailDiv|-$newsarticle->getId()-|Top')" class="enviar">Enviar</a></li>
|-if $newsArticlesConfig.useCommets.value eq "YES"-|<li><a href="#commentsForm" onClick='javascript:showCommentAddForm("div_comments_adder_|-$newsarticle->getId()-|")' class="comentar">Comentar</a></li>|-/if-|
<!--	<li><a href="*" class="imprimir">Imprimir</a></li> -->
<!--			 <li><a href="*" class="letterLow">&nbsp;</a></li>
<li><a href="*" class="letterPlus">Cambiar Tamaño</a></li>			 	 -->
 </ul>
</div>
<!-- end ACTIONBOX -->  		
<!-- begin NEWS01 -->
<div class="news01">
	<div id="sendToEmailDiv|-$newsarticle->getId()-|Top" style="display: none;">
		<p>
			|-include file='NewsArticlesSendToEmailInclude.tpl' article=$newsarticle-|
		</p>
	</div>
<h4>|-$newsarticle->getCreationDate()|date_format:"%d-%m-%Y"-| - 
|-if $newsArticlesConfig.useRegion.value eq "YES"-||-assign var=region value=$newsarticle->getRegion()-|
	|-if not empty($region)-||-$region->getName()-||-/if-||-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-||-assign var=category value=$newsarticle->getCategory()-|
	|-if not empty($category)-||-if not empty($region)-| &gt;&gt;|-/if-||-$category->getName()-||-/if-||-/if-|</h4>
|-if $newsArticlesConfig.useTopTitle.value eq "YES"-|<h2>|-$newsarticle->gettoptitle()-|</h2>|-/if-|
<h1>|-$newsarticle->gettitle()-|</h1>
|-if $newsArticlesConfig.useSubTitle.value eq "YES"-|<p><em>|-$newsarticle->getSubTitle()-|</em></p>|-/if-|
	<!-- Begin  COMPLETE TEXT //  TEXTO NOTICIA COMPLETA --------------------- -->
|-if $moduleConfig.image.useImages.value eq "YES"-||-if $newsarticle->getImages()|@count gt 0-||-include file='NewsMediasViewInclude.tpl'-||-/if-||-/if-|
	
|-if $moduleConfig.image.useAudio.value eq "YES" || $moduleConfig.image.useVideo.value eq "YES"-||-if $newsarticle->getVideos()|@count gt 0 or $newsarticle->getSounds()|@count gt 0-||-include file='NewsMediasVideosViewInclude.tpl'-||-/if-||-/if-|
<div id="completeText">
	
	|-$newsarticle->getBody()-|
	<p>Fecha: |-$newsarticle->getCreationDate()|date_format:"%d-%m-%Y"-|<br />
	|-if $newsArticlesConfig.useSource.value eq "YES"-||-assign var=source value=$newsarticle->getSource()-||-if not empty($source)-|Contacto: |-$source-||-/if-|<br />
	|-assign var=sourceContact value=$newsarticle->getSourceContact()-||-if not empty($sourceContact)-|Para más información: |-$sourceContact-||-/if-||-/if-|</p>
</div>
<!-- End  COMPLETE TEXT // TEXTO NOTICIA COMPLETA --------------------- -->
		<p><input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"></p>
	</div>
	<p>|-if $newsArticlesConfig.useCommets.value eq "YES"-|
		|-include file='NewsCommentsInclude.tpl' article=$newsarticle comments=$comments-|
		|-/if-|
	</p>
	<div id="sendToEmailDiv|-$newsarticle->getId()-|Bottom" style="display: none;">
		<p>
			|-include file='NewsArticlesSendToEmailInclude.tpl' article=$newsarticle-|
		</p>
	</div>
<!-- END NOTICIA  **************************************** -->
<!-- **************************************** --> 

	   
       <!-- begin ACTIONBOX -->
			<div class="actionBox">
           <ul>
             <li><a href="javascript:showSendEmailFormX(|-$newsarticle->getId()-|,'sendToEmailDiv|-$newsarticle->getId()-|Bottom')" class="enviar">Enviar</a></li>
|-if $newsArticlesConfig.useCommets.value eq "YES"-|<li><a href='javascript:showCommentAddForm("div_comments_adder_|-$newsarticle->getId()-|")' class="comentar">Comentar</a></li>|-/if-|
<!--			 <li><a href="*" class="imprimir">Imprimir</a></li>-->
<!--			 <li><a href="*" class="letterLow">&nbsp;</a></li>
			 <li><a href="*" class="letterPlus">Cambiar Tamaño</a></li>			--> 			 			 
           </ul>
       </div><!-- end ACTIONBOX -->  		


