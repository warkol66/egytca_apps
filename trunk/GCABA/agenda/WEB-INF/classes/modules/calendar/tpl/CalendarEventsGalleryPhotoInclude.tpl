<a class="galleryPhoto" rel="|-$gallery|default:'unnamedGallery'-|" href="#divPhoto|-$photo->getId()-|"
   photoId="|-$photo->getId()-|"
   photoTitle="|-$photo->getTitle()|default:$defaultTitle-|"
   photoDescription="|-$photo->getDescription()|default:$defaultDescription-|"
></a>
<div id="divPhoto|-$photo->getId()-|" style="padding:12px; ">
	<img src="|-$photo->getPath()-|" alt="|-$photo->getTitle()|default:$defaultTitle-|" />
</div>