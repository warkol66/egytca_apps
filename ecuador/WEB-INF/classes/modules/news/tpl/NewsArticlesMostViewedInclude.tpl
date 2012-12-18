			   <div class="titleArticulos">Art&iacute;culos más leídos</div>

				|-foreach from=$result item=newsMostViews name=for_newsMostViewed-|
						<div class="rightColumnArticulo"><a href="Main.php?do=newsArticlesView&id=|-$newsMostViews->getId()-|">|-$newsMostViews->gettitle()-|</a></div>
				|-/foreach-|  