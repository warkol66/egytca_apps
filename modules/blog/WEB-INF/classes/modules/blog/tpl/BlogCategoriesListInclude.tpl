|-if $result|@count eq 0-|No hay categorías disponibles
|-else-|
|-foreach from=$result item=category name=for_categoriess-|
	<p><a href="Main.php?do=blogShow&categoryId=|-$category->getId()-|">|-$category->getName()-|</a></p>
|-/foreach-|						
|-/if-|