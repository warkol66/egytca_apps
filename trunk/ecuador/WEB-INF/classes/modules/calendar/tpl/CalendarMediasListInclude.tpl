<script type="text/javascript" src="scripts/calendar.js"></script>
|-if $images|@count gt 0-|
<div id="mediasImagesLister">
	<fieldset title="Imágenes asociadas al Evento">
	<legend>Imágenes</legend> 
		<p><span id="imagesOrderMsg"></span></p>
		<p>
			<ul id="imagesList">
			|-foreach from=$images item=calendarMedia name=for_calendarMedias-|
				<li id="imagesList_|-$calendarMedia->getId()-|">
					<span style="float:left;width:95%;">
						<strong>Título:</strong>
					|-if $calendarMedia->getTitle() ne ''-|
						<span id="titleEdit_|-$calendarMedia->getId()-|">|-$calendarMedia->getTitle()-|</span>
					|-else-|
						<span id="titleEdit_|-$calendarMedia->getId()-|">(No se ingresó título)</span>
					|-/if-|				
						 <strong>Descripción:</strong>
					|-if $calendarMedia->getDescription() ne ''-|
						<span id="descriptionEdit_|-$calendarMedia->getId()-|">|-$calendarMedia->getDescription()-|</span>
					|-else-|
						<span id="descriptionEdit_|-$calendarMedia->getId()-|">(No se ingresó descripción)</span>
					|-/if-|				
					</span> 

						<script type="text/javascript">
							new Ajax.InPlaceEditor('titleEdit_|-$calendarMedia->getId()-|', 'Main.php?do=calendarMediasDoEditX', {});
							new Ajax.InPlaceEditor('descriptionEdit_|-$calendarMedia->getId()-|', 'Main.php?do=calendarMediasDoEditX', {});													
						</script>
						
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						<input type="hidden" name="do" value="calendarMediasDoDelete" />
						<input type="hidden" name="id" value="|-$calendarMedia->getid()-|" />
						<input type="button" name="submit_go_delete_calendarMedia" value="Borrar" onClick="javascript:submitCalendarEventsMediaDeleteX(|-$calendarMedia->getId()-|,this.form)" class="buttonImageDelete" />
						<input type="hidden" name="ajaxFromArticle" value="1" />
					</form> <span id="calendarMediaItemMsgBox|-$calendarMedia->getId()-|"></span>
				</li><br clear="all" />
			|-/foreach-|
			</ul>
		</p>
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
	 imagesSortable = Sortable.create("imagesList", {

			onChange: function() {
						new Ajax.Updater("imagesOrderMsg", "Main.php?do=calendarMediasSortX",
							{
			 					method: "post",  
			 					parameters: { data: Sortable.serialize("imagesList") }
							});
					} 
				});
</script>
