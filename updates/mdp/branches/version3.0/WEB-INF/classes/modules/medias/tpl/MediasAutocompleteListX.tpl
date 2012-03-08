<ul>
	|-if count($medias) == 0-|
		<b>No hay resultados que coincidan</b>
		|-if $lightboxId-|
			<a href="#lightbox_medias" rel="lightbox_medias" class="lbOn addLink">Crear Medio</a>
		|-/if-|
	|-else-|
		|-foreach from=$medias item=media-|
			<li id="|-$media->getId()-|">|-$media-|</li>
		|-/foreach-|
		|-if count($medias) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>