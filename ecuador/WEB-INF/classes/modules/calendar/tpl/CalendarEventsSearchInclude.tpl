<div id="buscador">
  <form action="Main.php" method="get">
	  <input type="hidden" name="do" value="newsArticlesSearch" id="do" />
	  <input name="searchString" type="text" size="13" class="textbox" value="|-if isset($searchString)-||-$searchString-||-/if-|" />
	  <br/>
	  <input type="submit" name="searchSubmit" value="Buscar"/>  	

  </form>
</div>
