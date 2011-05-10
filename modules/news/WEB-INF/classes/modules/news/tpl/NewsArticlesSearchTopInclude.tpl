<div id="searchbox">
  <form action="Main.php" method="get">
	  <input type="hidden" name="do" value="newsArticlesSearch" id="do" />
	  <input name="searchString" type="text" size="20" class="textbox" value="|-if isset($searchString)-||-$searchString-||-/if-|" />
	  <input type="submit" name="searchSubmit" value="Buscar" class="button" title="Buscar"/>  	
		<div id="rssSearchBox"><a href="|-$systemUrl-|?do=newsArticlesShow&amp;rss=1" title="Acceda al contenido suscribiendo al servicio RSS">RSS</a></div>
  </form>
</div>