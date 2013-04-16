<div id="div_blogEntries">
		|-foreach from=$blogEntryColl item=blogEntry name=for_blogEntries-|
			<!--class ex blog01-->
			<div id="article|-$blogEntry->getId()-|" class="article">
				|-assign var="eId" value=$blogEntry->getId()-|
				|-$blogEntry|@print_r-|
				<h5>|-$blogEntry->stringDate-|</h5>
				<h2><a href="Main.php?do=blogView&url=|-$blogEntry->getUrl()-|">|-$blogEntry->gettitle()-|</a></h2>
				|-assign var="category" value=$blogEntry->getBlogCategory()-||-if !empty($category)-|<br /><span class="blogCategoryLink"><a href="Main.php?do=blogShow&categoryId=|-$category->getId()-|" class="blogCategoryLink">|-$category->getName()-|</a></span>|-/if-|
				<div id="summary">|-if $blogEntry->getBody()|mb_count_characters:true:true > $moduleConfig.charsInList-|
				|-assign var=id value=$blogEntry->getId()-|
				|-assign var=url value="Main.php?do=blogView&id=$id"-|
				|-assign var=readMore value="<p class='readMore'><a href='$url'> ... seguir leyendo</a></p>"-|
				|-$blogEntry->getBody()|mb_truncate_strip_tags:$moduleConfig.charsInList:"...":$readMore-|
				|-else-||-$blogEntry->getBody()-|
				|-/if-|
				</div>
				<div class="masInfo">
					 <a class="commentsBut" href="Main.php?do=blogView&id=|-$blogEntry->getId()-|" title="Haga click aquí para comentar">Comentarios: |-$blogEntry->getApprovedCommentsCount()-|</a><span>Etiquetas: |-foreach from=$blogEntry->getBlogTags() item=tag name=for_tagss-|
       <a href="Main.php?do=blogShow&tagId=|-$tag->getId()-|">|-$tag->getName()-|</a>&nbsp;|-/foreach-|</span>
				</div>
		<div class="close"></div>
			</div>
		|-/foreach-|			
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<div class="pages">|-if $smarty.get.page == ''-||-include file="BlogHomePaginateInclude.tpl"-||-else-||-include file="BlogShowPaginateInclude.tpl"-||-/if-|</div>
		|-/if-|
	</div>
	<div>
</div>
