<h2 class="home">Experiencias de Gestión </h2>
<div id="div_blogEntries">
		|-foreach from=$blogEntryColl item=blogEntry name=for_blogEntries-|
			<!--class ex blog01-->
			<div id="article|-$blogEntry->getId()-|" class="blog01">
				|-assign var="eId" value=$blogEntry->getId()-|
				<h5><a href="Main.php?do=blogView&url=|-$blogEntry->getUrl()-|">|-$blogEntry->gettitle()-|</a></h5>
				|-assign var="category" value=$blogEntry->getBlogCategory()-||-if !empty($category)-|<br /><span class="blogCategoryLink"><a href="Main.php?do=blogShow&categoryId=|-$category->getId()-|" class="blogCategoryLink">|-$category->getName()-|</a></span>|-/if-|
				<div id="summary">
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
				<div class="masInfo">
					 <a class="commentsBut" href="Main.php?do=blogView&id=|-$blogEntry->getId()-|" title="Haga click aquí para comentar">Comentarios: |-$blogEntry->getApprovedCommentsCount()-|</a><span class="tags">Etiquetas: |-foreach from=$blogEntry->getBlogTags() item=tag name=for_tagss-|
       <a href="Main.php?do=blogShow&tagId=|-$tag->getId()-|">|-$tag->getName()-|</a>&nbsp;|-/foreach-|</span>
				</div>
		<div class="close"></div>
			</div>
		|-/foreach-|			
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<div class="pages">|-if $smarty.get.page == ''-||-include file="BlogHomePaginateInclude.tpl"-||-else-||-include file="BlogShowPaginateInclude.tpl"-||-/if-|</div>
		|-/if-|
</div>
<div>|-if "blogList"|security_has_access-|<a href="Main.php?do=blogList" class="addLink">Administrar Experiencias</a>|-/if-|
</div>
