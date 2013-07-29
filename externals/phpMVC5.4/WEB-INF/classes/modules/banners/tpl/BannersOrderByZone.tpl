<h2>Banners</h2>
<h1>Orden de banners de la Zona</h1>
|-if !is_object($bannerZone) or $bannerZone->isNew()-|
<p>La zona especificada no existe</p>
|-else-|
<p>A continuación encontrará los banners que se incluyen el la Zona "|-$bannerZone->getName()-|". Puede con este formulario determinar el orden de impresión de un banner versus los demás colocando la posición a cada banner. La ubicación de cada banner ser calculará a partir del orden ingresado.<br /> 
	Para guardar los cambios haga click en "Guardar".</p>
<div id="orderChanged"></div>
	<fieldset title="Orenar banners">
		<legend>Orden de Banners en la zona</legend>
		<ul id="bannersList">
		|-foreach from=$banners item=banner name=for_banners-|
			<li id="|-$banner->getId()-|" class="contentLi">
				<span class="textOptionMove" style="float:left;" title="Mover este banner">|-$banner->getName()-|</span><br style="clear: all" />
			</li>
		|-/foreach-|
	</ul>
</fieldset>
 	<script type="text/javascript">
    $(function() {
        $("#bannersList").sortable({
			update: function(event,ui){
				$('#orderChanged').html("<span class='inProgress'>Cambiando orden...</span>");
				$.ajax({
					url: "Main.php?do=bannersDoOrderByZoneX",
					data: { zoneId: "|-$bannerZone->getId()-|", data: $("#bannersList").sortable("toArray") },
					type: 'post',
					success: function(data){
						$('#orderChanged').html(data);
					}	
				});
			}
        });
    });
 </script>
|-/if-|
<p><input type="button" onclick="location.href='Main.php?do=bannersZonesList';" value="Regresar" /></p>
