<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>
<style>
	.inplaceEditSize20 {
		color: 'red';
	}
</style>
|-if $images|@count gt 0-|
<div id="mediasImagesLister">
	<fieldset title="Contenido Multimedia asociado al Artículo">
	<legend>Imágenes</legend> 
		<span id="imagesOrderMsg"></span>
		<ul id="imagesList">
			|-foreach from=$images item=newsmedia name=for_newsmedias-|
				<li id="|-$newsmedia->getId()-|">
					<span style="float:left;width:95%;">
						<strong>Título: </strong>
					|-if $newsmedia->getTitle() ne ''-|
						<span id="titleEdit_|-$newsmedia->getId()-|" name="params[title]" class="in_place_editable">|-$newsmedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$newsmedia->getId()-|" name="params[title]" class="in_place_editable">(No se ingresó título)</span>
					|-/if-|				
						 <strong>Descripción: </strong>
					|-if $newsmedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|" name="params[description]" class="in_place_editable">|-$newsmedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|" name="params[description]" class="in_place_editable">(No se ingresó descripción)</span>
					|-/if-|
	(Tipo: |-$newsmedia->getMediaTypeName()-|)
					</span> 

						<script type="text/javascript">
							$('#titleEdit_|-$newsmedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=newsDoEditFieldX', {
								cssclass: 'inplaceEditSize20',
								submitdata: {
									objectType: 'newsMedia',
									objectId: '|-$newsmedia->getId()-|',
									paramName: 'title'
								},
								callback: function(value, settings) {
									return chomp(value);
								}
							});
							$('#descriptionEdit_|-$newsmedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=newsDoEditFieldX', {
								cssclass: 'inplaceEditSize20',
								submitdata: {
									objectType: 'newsMedia',
									objectId: '|-$newsmedia->getId()-|',
									paramName: 'description'
								},
								callback: function(value, settings) {
									return chomp(value);
								}
							});												
						</script>
						
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						<input type="hidden" name="do" value="newsMediasDoDeleteX" />
						<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
						<input type="button" name="submit_go_delete_newsmedia" value="Borrar" onClick="javascript:submitNewsArticleMediaDeleteX(|-$newsmedia->getId()-|,this.form)" class="icon iconDelete" />
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
		<li id="|-$newsmedia->getId()-|">
			<span style="float:left;width:95%;">
				<strong>Título: </strong>
					|-if $newsmedia->getTitle() ne ''-|
						<span id="titleEdit_|-$newsmedia->getId()-|" name="params[title]" class="in_place_editable">|-$newsmedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$newsmedia->getId()-|" name="params[title]" class="in_place_editable">(No se ingresó título)</span>
					|-/if-|				
				 <strong>Descripción: </strong>
					|-if $newsmedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|" name="params[description]" class="in_place_editable">|-$newsmedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|" name="params[description]" class="in_place_editable">(No se ingresó descripción)</span>
					|-/if-|				
(Tipo: |-$newsmedia->getMediaTypeName()-|)
			</span> 
			<script type="text/javascript">
				$('#titleEdit_|-$newsmedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=newsDoEditFieldX', {
					cssclass: 'inplaceEditSize20',
					submitdata: {
						objectType: 'newsMedia',
						objectId: '|-$newsmedia->getId()-|',
						paramName: 'title'
					},
					callback: function(value, settings) {
						return chomp(value);
					}
				});
				$('#descriptionEdit_|-$newsmedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=newsDoEditFieldX', {
					cssclass: 'inplaceEditSize20',
					submitdata: {
						objectType: 'newsMedia',
						objectId: '|-$newsmedia->getId()-|',
						paramName: 'description'
					},
					callback: function(value, settings) {
						return chomp(value);
					}
				});												
			</script>
			<form action="Main.php" method="post">
				<!--pasaje de parametros de filtros -->
				<input type="hidden" name="do" value="newsMediasDoDelete" />
				<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
				<input type="button" name="submit_go_delete_newsmedia" value="Borrar" onClick="javascript:submitNewsArticleMediaDeleteX(|-$newsmedia->getId()-|,this.form)" class="icon iconDelete" />
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
		<li id="|-$newsmedia->getId()-|">
			<span style="float:left;width:95%;">
				<strong>Título: </strong>
					|-if $newsmedia->getTitle() ne ''-|
						<span id="titleEdit_|-$newsmedia->getId()-|" name="params[title]" class="in_place_editable">|-$newsmedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$newsmedia->getId()-|" name="params[title]" class="in_place_editable">(No se ingresó título)</span>
					|-/if-|				
				 <strong>Descripción: </strong>
					|-if $newsmedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|" name="params[description]" class="in_place_editable">|-$newsmedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$newsmedia->getId()-|" name="params[description]" class="in_place_editable">(No se ingresó descripción)</span>
					|-/if-|				
	(Tipo: |-$newsmedia->getMediaTypeName()-|)
			</span> 
			<script type="text/javascript">
				$('#titleEdit_|-$newsmedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=newsDoEditFieldX', {
					cssclass: 'inplaceEditSize20',
					submitdata: {
						objectType: 'newsMedia',
						objectId: '|-$newsmedia->getId()-|',
						paramName: 'title'
					},
					callback: function(value, settings) {
						return chomp(value);
					}
				});
				$('#descriptionEdit_|-$newsmedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=newsDoEditFieldX', {
					cssclass: 'inplaceEditSize20',
					submitdata: {
						objectType: 'newsMedia',
						objectId: '|-$newsmedia->getId()-|',
						paramName: 'description'
					},
					callback: function(value, settings) {
						return chomp(value);
					}
				});											
			</script>
			<form action="Main.php" method="post">
				<!--pasaje de parametros de filtros -->
				<input type="hidden" name="do" value="newsMediasDoDelete" />
				<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
				<input type="button" name="submit_go_delete_newsmedia" value="Borrar" onClick="javascript:submitNewsArticleMediaDeleteX(|-$newsmedia->getId()-|,this.form)" class="icon iconDelete" />
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
		$('#msgBoxUploader').html('Se ha subido el archivo con éxito');
	|-/if-|
</script>

<script type="text/javascript">
	$(function() {
		$("#imagesList").sortable({
			update: function(event,ui){
				$('#imagesOrderMsg').html("<span class='inProgress'>Cambiando orden...</span>");
				$.ajax({
					url: "Main.php?do=newsMediasSortX",
					data: $("#imagesList").sortable("toArray"),
					type: 'post',
					success: function(data){
						$('#imagesOrderMsg').html(data);
					}	
				});
			}
		});
		$("#soundsList").sortable({
			update: function(event,ui){
				$('#soundsOrderMsg').html("<span class='inProgress'>Cambiando orden...</span>");
				$.ajax({
					url: "Main.php?do=newsMediasSortX",
					data: {data: $("#soundsList").sortable("toArray")},
					type: 'post',
					success: function(data){
						$('#soundsOrderMsg').html(data);
					}	
				});
			}
		});
		$("#videosList").sortable({
			update: function(event,ui){
				$('#videosOrderMsg').html("<span class='inProgress'>Cambiando orden...</span>");
				$.ajax({
					url: "Main.php?do=newsMediasSortX",
					data: $("#videosList").sortable("toArray"),
					type: 'post',
					success: function(data){
						$('#videosOrderMsg').html(data);
					}	
				});
			}
		});
	});		
</script>
