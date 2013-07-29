|-if $result|@count eq 0-|No hay etiquetas disponibles
|-else-|
|-foreach from=$result item=tag name=for_tags-|
	<a href="Main.php?do=blogShow&tagId=|-$tag.blogTagId-|" class="w|-$tag.weight-|">|-$tag.blogTagName-|</a>
|-/foreach-|						
|-/if-|