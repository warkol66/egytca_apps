<div id=contentBody>
	<div id=titleContent>
		<h1>Novedades</h1>
	</div>
	<div id="div_newsarticles">
		|-foreach from=$newsarticles item=newsarticle name=for_newsarticles-|
			<div id="article|-$newsarticle->getId()-|" class="news01">|-if $newsarticle->hasImages()-|<img src="Main.php?do=newsArticlesGetThumbnail&id=|-$newsarticle->getId()-|" width="150" height="105" align="left" class="newsImage" />
			|-elseif $newsarticle->hasVideos()-|<img src="Main.php?do=newsArticlesGetVideoThumbnail&id=|-$newsarticle->getId()-|" width="150" height="105" align="left" class="newsImage" />|-/if-|
					|-if $newsArticlesConfig.useRegions.value eq "YES" || $newsArticlesConfig.useCategories.value eq "YES"-|<h4>|-assign var=region value=$newsarticle->getRegion()-|
					|-if not empty($region)-||-$region->getName()-||-/if-||-assign var=category value=$newsarticle->getCategory()-||-if not empty($category)-||-if not empty($region)-|&gt;&gt; |-/if-||-$category->getName()-||-/if-|</h4>|-/if-|
				|-if $newsArticlesConfig.useTopTitle.value eq "YES"-|<h2>|-$newsarticle->gettoptitle()-|</h2>|-/if-|
				<h1>|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|">|-$newsarticle->gettitle()-|</a>|-else-||-$newsarticle->gettitle()-||-/if-|</h1>
				|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<p>|-$newsarticle->getSummary()-|</p>|-else-||-$newsarticle->getBody()-||-/if-|
			|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<div class="masInfo">
					Cantidad de Vistas: |-$newsarticle->getViews()-|&nbsp;&nbsp; <a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|">Ver nota completa</a>
				</div> |-/if-|
				|-assign var=survey value=$newsarticle->getSurvey()-|
				|-if $survey neq ''-|
					|-include_module module=SurveysSurveys action=Display options="id="|cat:$survey->getId()-|
				|-/if-|
				<div class="sendToEmailFormClass" id="sendToEmailDiv|-$newsarticle->getId()-|" style="display: none;"> </div>
			</div><!-- end NEWS01  -->
			|-if $newsArticlesConfig.useSendArticles.value eq "YES" || $newsarticle->hasSounds() || $newsarticle->hasImages() || $newsarticle->hasVideos()-|
         <div class="actionBox">
           <ul>|-if $newsArticlesConfig.useSendArticles.value eq "YES"-|<li><a href="javascript:showSendEmailFormX(|-$newsarticle->getId()-|,'sendToEmailDiv|-$newsarticle->getId()-|')" class="enviar">Enviar</a></li>|-/if-|
			 |-if $newsarticle->hasSounds()-|<li><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|" class="audio">Audio</a></li>|-/if-|
			 |-if $newsarticle->hasImages()-|<li><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|" class="fotos">Fotos</a></li>|-/if-|
			 |-if $newsarticle->hasVideos()-|<li><a href="Main.php?do=newsArticlesView&id=|-$newsarticle->getId()-|" class="video">Video</a></li>|-/if-|</ul>
         </div><!-- end ACTIONBOX -->|-/if-|	 		   
			<!-- END NOTICIA -->

		|-/foreach-|

		|-if $pager neq ''-|
			|-if $pager->getTotalPages() gt 0-|
				<div class="pages">|-if $smarty.get.page == ''-||-include file="NewsHomePaginateInclude.tpl"-||-else-||-include file="NewsArticleShowPaginateInclude.tpl"-||-/if-|</div>
			|-else-|
				<div class="pages"><a href="|-$url-|" class="detail">Inicio</a></div>
			|-/if-|
		|-/if-|
	</div>
</div>
