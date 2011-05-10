	<div id="titleContentHome">
		<h1>Novedades</h1>
	</div>
	<div id="titleContentHomeSubtitle">|-$newsArticle->getTitle()-|</div>
	<div id="completeText">
		|-$newsArticle->getBody()-|
	</div>
	<div id="titleContentHomeBottom">
		|-assign var="lastpage" value=$pager->getLastPage()-||-if $lastpage neq $page-|
		<a href="#" onClick='new Ajax.Updater("homeNews", "Main.php?do=newsArticlesViewX", { method: "get", parameters: { page: "|-$pager->getNext()-|", evalScripts: true}});' title="ver más novedades" class="red_arrow"></a>|-/if-|
		|-if $pager->getPrev() gt 0-|<a href="#" onClick='new Ajax.Updater("homeNews", "Main.php?do=newsArticlesViewX", { method: "get", parameters: { page: "|-$pager->getPrev()-|", evalScripts: true}});' title="regresar" class="red_arrowBack"></a>|-/if-|
</div>
