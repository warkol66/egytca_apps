<!-- TITULO ULTIMAS NOTICIAS -->
<!-- begin NEWS01 -->
<div class="news01">
	<div id="sendToEmailDiv|-$result->getId()-|Top" style="display: none;">
		<p>
			|-include file='NewsArticlesSendToEmailInclude.tpl' article=$result-|
		</p>
	</div>
<h1>|-$result->gettitle()-|</h1>
|-if $newsArticlesConfig.useSubTitle.value eq "YES"-|<p><em>|-$result->getSubTitle()-|</em></p>|-/if-|
	<!-- Begin  COMPLETE TEXT //  TEXTO NOTICIA COMPLETA --------------------- -->
|-if $moduleConfig.image.useImages.value eq "YES"-||-if $result->getImages()|@count gt 0-||-include file='NewsMediasViewInclude.tpl'-||-/if-||-/if-|
	
|-if $moduleConfig.image.useAudio.value eq "YES" || $moduleConfig.image.useVideo.value eq "YES"-||-if $result->getVideos()|@count gt 0 or $result->getSounds()|@count gt 0-||-include file='NewsMediasVideosViewInclude.tpl'-||-/if-||-/if-|
<div id="completeText">
	
	|-$result->getBody()-|
</div>
<!-- End  COMPLETE TEXT // TEXTO NOTICIA COMPLETA --------------------- -->
	</div>
	<p>|-if $newsArticlesConfig.useCommets.value eq "YES"-|
		|-include file='NewsCommentsInclude.tpl' article=$result comments=$comments-|
		|-/if-|
	</p>
	<div id="sendToEmailDiv|-$result->getId()-|Bottom" style="display: none;">
		<p>
			|-include file='NewsArticlesSendToEmailInclude.tpl' article=$result-|
		</p>
	</div>
<!-- END NOTICIA  **************************************** -->
<!-- **************************************** --> 

	   
       <!-- begin ACTIONBOX -->
			<div class="actionBox">
           <ul>
             <li><a href="javascript:showSendEmailFormX(|-$result->getId()-|,'sendToEmailDiv|-$result->getId()-|Bottom')" class="enviar">Enviar</a></li>
|-if $newsArticlesConfig.useCommets.value eq "YES"-|<li><a href='javascript:showCommentAddForm("div_comments_adder_|-$result->getId()-|")' class="comentar">Comentar</a></li>|-/if-|
<!--			 <li><a href="*" class="imprimir">Imprimir</a></li>-->
<!--			 <li><a href="*" class="letterLow">&nbsp;</a></li>
			 <li><a href="*" class="letterPlus">Cambiar Tamaño</a></li>			--> 			 			 
           </ul>
       </div><!-- end ACTIONBOX -->  		


