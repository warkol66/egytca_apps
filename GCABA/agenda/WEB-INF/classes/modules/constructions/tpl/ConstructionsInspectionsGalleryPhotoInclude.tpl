<a class="galleryPhoto" rel="|-$gallery|default:'unnamedGallery'-|" href="#divPhoto|-$photo->getId()-|"></a>
<div id="divPhoto|-$photo->getId()-|">
	<p>
		<span id="title" class="jeditable_|-$photo->getId()-|">|-$photo->getTitle()|default:'inserte título...'-|</span>
	</p>
	<p>
		<span id="description" class="jeditable_|-$photo->getId()-|">|-$photo->getDescription()|default:'inserte descripción...'-|</span>
	</p>
	<img src="|-$photo->getPath()-|" alt=""/>
</div>
<script>
	$('.jeditable_|-$photo->getId()-|').editable('Main.php?do=resourcesDoEditParam', {
		id: 'paramName',
		name: 'paramValue',
		submitdata: { id: |-$photo->getId()-| },
		submit: 'OK',
		cancel: 'Cancel',
		indicator : 'Saving...'
	});
</script>