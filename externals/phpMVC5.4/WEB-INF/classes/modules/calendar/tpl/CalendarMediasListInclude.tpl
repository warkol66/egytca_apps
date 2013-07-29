<script src="Main.php?do=js&name=js&module=calendar&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.js"></script>
<style>
	.inplaceEditSize20 {
		color: 'red';
	}
</style>
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
							$('#titleEdit_|-$calendarMedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=calendarMediasDoEditX', {
								cssclass: 'inplaceEditSize20',
								submitdata: {
									objectType: 'calendarMedia',
									objectId: '|-$calendarMedia->getId()-|',
									paramName: 'title'
								},
								callback: function(value, settings) {
									return chomp(value);
								}
							});
							$('#descriptionEdit_|-$calendarMedia->getId()-|').egytca('inplaceEdit', 'Main.php?do=calendarMediasDoEditX', {
								cssclass: 'inplaceEditSize20',
								submitdata: {
									objectType: 'calendarMedia',
									objectId: '|-$calendarMedia->getId()-|',
									paramName: 'description'
								},
								callback: function(value, settings) {
									return chomp(value);
								}
							});												
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
		var msgbox = $('#msgBoxUploader');
		msgbox.innerHTML = 'Se ha subido el archivo con éxito';
	|-/if-|
</script>

<script type="text/javascript">
	$(function() {
		$("#imagesList").sortable({
			update: function(event,ui){
				$('#imagesOrderMsg').html("<span class='inProgress'>Cambiando orden...</span>");
				$.ajax({
					url: "Main.php?do=calendarMediasSortX",
					data: $("#imagesList").sortable("toArray"),
					type: 'post',
					success: function(data){
						$('#imagesOrderMsg').html(data);
					}	
				});
			}
		});
</script>
