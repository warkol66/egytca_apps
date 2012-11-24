<div id="div_blogEntries">
		|-foreach from=$blogEntryColl item=blogEntry name=for_blogEntries-|
			<div id="article|-$blogEntry->getId()-|" class="blog01">
				<h4>|-$blogEntry->getCreationDate()|date_format:"%A %e de %B de %Y"-|</h4>
				<h1><a href="Main.php?do=blogView&id=|-$blogEntry->getId()-|">|-$blogEntry->gettitle()-|</a>
				|-assign var="category" value=$blogEntry->getBlogCategory()-||-if !empty($category)-|<br /><span class="blogCategoryLink"><a href="Main.php?do=blogShow&categoryId=|-$category->getId()-|" class="blogCategoryLink">|-$category->getName()-|</a></span>|-/if-|</h1>
				<div id="summary">|-if $blogEntry->getBody()|mb_count_characters:true:true > $moduleConfig.charsInList-|
				|-assign var=id value=$blogEntry->getId()-|
				|-assign var=url value="Main.php?do=blogView&id=$id"-|
				|-assign var=readMore value="<p class='readMore'><a href='$url'> ... seguir leyendo</a></p>"-|
				|-$blogEntry->getBody()|mb_truncate_strip_tags:$moduleConfig.charsInList:"...":$readMore-|
				|-else-||-$blogEntry->getBody()-|
				|-/if-|
				</div>
				<div class="masInfo">
					 <a href="Main.php?do=blogView&id=|-$blogEntry->getId()-|" title="Haga click aquí para comentar">Comentarios: |-$blogEntry->getApprovedCommentsCount()-|</a>
				</div>
		<div class="tags">Etiquetas: |-foreach from=$blogEntry->getBlogTags() item=tag name=for_tagss-|
       <a href="Main.php?do=blogShow&tagId=|-$tag->getId()-|">|-$tag->getName()-|</a>&nbsp;|-/foreach-|
		</div><div class="close"></div>
			</div>
		|-/foreach-|			
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<div class="pages">|-if $smarty.get.page == ''-||-include file="BlogHomePaginateInclude.tpl"-||-else-||-include file="BlogShowPaginateInclude.tpl"-||-/if-|</div>
		|-/if-|
	</div>
	<div>
</div>
