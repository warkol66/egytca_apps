<script type="text/javascript" src="scripts/news.js"></script>
|-if $images|@count gt 0-|
<div id="mediasImagesLister">
	<fieldset title="Contenido Multimedia asociado al Artículo">
	<legend>Imágenes</legend> 
		<span id="imagesOrderMsg"></span>
		<ul id="imagesList">
			|-foreach from=$images item=newsmedia name=for_newsmedias-|
				<li id="imagesList_|-$newsmedia->getId()-|">
					<span style="float:left;width:95%;">
						<strong>Título: </strong>
					|-if $newsmedia->getTitle() ne ''-|
						<span id="titleEdit_|-$newsmedia->getId()-|">|-$newsmedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$newsmedia->getId()-|">(No se ingresó título)</span>
					|-/if-|				
						 <strong>Descripción: </strong>
					|-if $newsmedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|">|-$newsmedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|">(No se ingresó descripción)</span>
					|-/if-|				
	(Tipo: |-$newsmedia->getMediaTypeName()-|)
					</span> 

						<script type="text/javascript">
							new Ajax.InPlaceEditor('titleEdit_|-$newsmedia->getId()-|', 'Main.php?do=newsMediasDoEditX', {});
							new Ajax.InPlaceEditor('descriptionEdit_|-$newsmedia->getId()-|', 'Main.php?do=newsMediasDoEditX', {});													
						</script>
						
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						<input type="hidden" name="do" value="newsMediasDoDelete" />
						<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
						<input type="button" name="submit_go_delete_newsmedia" value="Borrar" onClick="javascript:submitNewsArticleMediaDeleteX(|-$newsmedia->getId()-|,this.form)" class="buttonImageDelete" />
						<input type="hidden" name="ajaxFromArticle" value="1" />
					</form> <span id="newsMediaItemMsgBox|-$newsmedia->getId()-|"></span>
				</li><br clear="all" />
			|-/foreach-|
			</ul>
	</fieldset>
</div>
|-/if-|
|-if $sounds|@count gt 0-|
<div id="mediasSoundsLister">
	<fieldset title="Contenido Multimedia asociado al Artículo">
	<legend>Audio</legend>
		<div id="soundsOrderMsg"></div>
		<ul id="soundsList">
		|-foreach from=$sounds item=newsmedia name=for_newsmedias-|
		<li id="soundsList_|-$newsmedia->getId()-|">
			<span style="float:left;width:95%;">
				<strong>Título: </strong>
					|-if $newsmedia->getTitle() ne ''-|
						<span id="titleEdit_|-$newsmedia->getId()-|">|-$newsmedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$newsmedia->getId()-|">(No se ingresó título)</span>
					|-/if-|				
				 <strong>Descripción: </strong>
					|-if $newsmedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|">|-$newsmedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|">(No se ingresó descripción)</span>
					|-/if-|				
(Tipo: |-$newsmedia->getMediaTypeName()-|)
			</span> 

				<script type="text/javascript">
					new Ajax.InPlaceEditor('titleEdit_|-$newsmedia->getId()-|', 'Main.php?do=newsMediasDoEditX', {});
					new Ajax.InPlaceEditor('descriptionEdit_|-$newsmedia->getId()-|', 'Main.php?do=newsMediasDoEditX', {});													
				</script>
				
			<form action="Main.php" method="post">
				<!--pasaje de parametros de filtros -->
				<input type="hidden" name="do" value="newsMediasDoDelete" />
				<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
				<input type="button" name="submit_go_delete_newsmedia" value="Borrar" onClick="javascript:submitNewsArticleMediaDeleteX(|-$newsmedia->getId()-|,this.form)" class="buttonImageDelete" />
				<input type="hidden" name="ajaxFromArticle" value="1" />
			</form> <span id="newsMediaItemMsgBox|-$newsmedia->getId()-|"></span>
		</li><br clear="all" />
		|-/foreach-|
		</ul>
	</fieldset>
</div>
|-/if-|
|-if $videos|@count gt 0-|
<div id="mediasVideosLister">
	<fieldset title="Contenido Multimedia asociado al Artículo">
	<legend>Videos</legend>
		<div id="videosOrderMsg"></div>
		<ul id="videosList">
		|-foreach from=$videos item=newsmedia name=for_newsmedias-|
		<li id="videosList_|-$newsmedia->getId()-|">
			<span style="float:left;width:95%;">
				<strong>Título: </strong>
					|-if $newsmedia->getTitle() ne ''-|
						<span id="titleEdit_|-$newsmedia->getId()-|">|-$newsmedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$newsmedia->getId()-|">(No se ingresó título)</span>
					|-/if-|				
				 <strong>Descripción: </strong>
					|-if $newsmedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|">|-$newsmedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|">(No se ingresó descripción)</span>
					|-/if-|				
	(Tipo: |-$newsmedia->getMediaTypeName()-|)
			</span> 

				<script type="text/javascript">
					new Ajax.InPlaceEditor('titleEdit_|-$newsmedia->getId()-|', 'Main.php?do=newsMediasDoEditX', {});
					new Ajax.InPlaceEditor('descriptionEdit_|-$newsmedia->getId()-|', 'Main.php?do=newsMediasDoEditX', {});													
				</script>
			
			<form action="Main.php" method="post">
				<!--pasaje de parametros de filtros -->
				<input type="hidden" name="do" value="newsMediasDoDelete" />
				<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
				<input type="button" name="submit_go_delete_newsmedia" value="Borrar" onClick="javascript:submitNewsArticleMediaDeleteX(|-$newsmedia->getId()-|,this.form)" class="buttonImageDelete" />
				<input type="hidden" name="ajaxFromArticle" value="1" />
			</form> <span id="newsMediaItemMsgBox|-$newsmedia->getId()-|"></span>
		</li><br clear="all" />
		|-/foreach-|
		</ul>
	</fieldset>
</div>
|-/if-|
<script type="text/javascript">
	|-if $created eq "1"-|	
		var msgbox = $('msgBoxUploader');
		msgbox.innerHTML = 'Se ha subido el archivo con éxito';
	|-/if-|
</script>

<script type="text/javascript">
	
	if ($('imagesList')) {
	
		imagesSortable = Sortable.create("imagesList", {

				onUpdate: function() {
							new Ajax.Updater("imagesOrderMsg", "Main.php?do=newsMediasSortX",
								{
				 					method: "post",  
				 					parameters: { data: Sortable.serialize("imagesList") }
								});
						} 
					});

	 }
	
	if ($('soundsList')) {
		soundsSortable = Sortable.create("soundsList", {

				onUpdate: function() {
							new Ajax.Updater("soundsOrderMsg", "Main.php?do=newsMediasSortX",
								{
				 					method: "post",  
				 					parameters: { data: Sortable.serialize("soundsList") }
								});
						} 
					});

	 }

	if ($('videosList')) {
	
		videosSortable = Sortable.create("videosList", {

				onUpdate: function() {
							new Ajax.Updater("videosOrderMsg", "Main.php?do=newsMediasSortX",
								{
				 					method: "post",  
				 					parameters: { data: Sortable.serialize("videosList") }
								});
						} 
					});
	}						
</script>