<!-- TITULO ULTIMAS NOTICIAS -->
<div id="titleLastNews">Ultimas noticias</div>
<!-- **************************************** --> 		   
<!--  NOTICIA  **************************************** -->
<div id="div_newsarticles">
		|-foreach from=$newsArticleColl item=newsarticle name=for_newsarticles-|
			<div id="article|-$newsarticle->getId()-|" class="news01">|-if $newsarticle->hasImages()-|<img src="Main.php?do=newsArticlesGetThumbnail&id=|-$newsarticle->getId()-|" width="150" height="105" align="left" class="newsImage" />
			|-elseif $newsarticle->hasVideos()-|<!--<img src="Main.php?do=newsArticlesGetVideoThumbnail&id=|-$newsarticle->getId()-|" width="150" height="105" align="left" class="newsImage" /> -->|-/if-|
					<h4>|-assign var=region value=$newsarticle->getRegion()-|
					|-if not empty($region)-||-$region->getName()-||-/if-|
					|-assign var=category value=$newsarticle->getCategory()-|
					|-if not empty($category)-||-if not empty($region)-|&gt;&gt; |-/if-||-$category->getName()-||-/if-|</h4>
				<!--<h2>|-$newsarticle->gettoptitle()-|</h2>-->
				<h1><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|">|-$newsarticle->gettitle()-|</a></h1>
				<!--<p>Estado: |-$newsarticle->getStatusName()-|</p>
				<p>
					|-assign var=newsUser value=$newsarticle->getUser()-|
					|-if not empty($newsUser)-|
						|-$newsUser->getUsername()-|
					|-/if-|
				</p>-->
				<p>|-$newsarticle->getSummary()-|</p>
				<div class="masInfo">
					<!--Cantidad de Vistas: |-$newsarticle->getViews()-|&nbsp;&nbsp;-->
					<a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|">Ver nota completa</a>
				</div>
				|-assign var=survey value=$newsarticle->getSurvey()-|
				|-if $survey neq ''-|
					|-include_module module=SurveysSurveys action=Display options="id="|cat:$survey->getId()-|
				|-/if-|
				<div class="sendToEmailFormClass" id="sendToEmailDiv|-$newsarticle->getId()-|" style="display: none;">

				</div>
			</div><!-- end NEWS01  -->
         <div class="actionBox">
           <ul>
             <li><a href="javascript:showSendEmailFormX(|-$newsarticle->getId()-|,'sendToEmailDiv|-$newsarticle->getId()-|')" class="enviar">Enviar</a></li>
			 |-if $newsarticle->hasSounds()-|<li><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|" class="audio">Audio</a></li>|-/if-|
			 |-if $newsarticle->hasImages()-|<li><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|" class="fotos">Fotos</a></li>	|-/if-|		 			 			 
			 |-if $newsarticle->hasVideos()-|<li><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|" class="video">Video</a></li> |-/if-|
           </ul>
         </div>
         <!-- end ACTIONBOX -->  		 		   
<!-- END NOTICIA  **************************************** -->
<!-- **************************************** --> 


		|-/foreach-|			
|-if $smarty.get.page == ''-|<div id="surveyInclude" class="news01">
|-*include_module module=SurveysSurveys action=Display options="lastActive=1&includeHome=1"*-|
</div>|-/if-|
				|-if isset($pager) && ($pager->getLastPage() gt 1)-|
				<div class="pages">|-if $smarty.get.page == ''-||-include file="NewsHomePaginateInclude.tpl"-||-else-||-include file="NewsArticleShowPaginateInclude.tpl"-||-/if-|</div>
				|-/if-|
	</div>
	<div>
		<p class="pages">
			|-if not isset($archive)-|
				<a href="Main.php?do=newsArticlesShow&archive=1">Mostrar Archivo de Noticias</a> 
			|-else-|
				<a href="Main.php?do=newsArticlesShow">Mostrar Noticias Publicadas</a>
			|-/if-|		</p>
	</div>
