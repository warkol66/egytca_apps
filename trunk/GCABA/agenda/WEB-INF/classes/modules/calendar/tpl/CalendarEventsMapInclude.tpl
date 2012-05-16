<!-- mapa google -->
<div id="map_container" style="display:none">
	<div><ul id="directions_results" style="display:none"></ul></div>
	<div id="map_canvas"></div>
	<br />
	<p>
		<input id="hide_map" type="button" value="Ocultar mapa" title="Ocultar mapa" onClick="$('#map_container').hide();/*$('#show_map').show()*/"/>
	</p>
</div>
<!--<p><input id="show_map" type="button" value="Mostrar mapa" title="Mostrar mapa" onClick="$('#map_container').show(); $(this).hide()" style="display:none;"/></p>-->
<!-- fin mapa google -->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/jquery/map-base.js"></script>
<script type="text/javascript" src="scripts/jquery/calendar-map.js"></script>

<script type="text/javascript">

	var calendarMap;

	$(document).ready(function() {
		calendarMap = new CalendarMap({
			disableId: '|-$disableId-|',
			streetId: '|-$streetId-|',
			numberId: '|-$numberId-|',
			latitudeId: '|-$latitudeId-|',
			longitudeId: '|-$longitudeId-|'
		});
		var latlng = new google.maps.LatLng('-34.649', '-58.456');
		calendarMap.mapOptions.zoom = 12;
		calendarMap.mapOptions.center = latlng;
		
		calendarMap.drawRegions = function() {
			|-include file="RegionsDrawInclude.tpl" mapJsVarName="calendarMap"-|
		}
		
		$('#|-$locateButtonId-|').on('click', calendarMap, function(event) { event.data.locate() } );
		$('#|-$streetId-|').change(disableIfNotEmpty);
		$('#|-$numberId-|').change(disableIfNotEmpty);
		$('#|-$latitudeId-|').change(disableIfNotEmpty);
		$('#|-$longitudeId-|').change(disableIfNotEmpty);
		
	});
	
	function disableIfNotEmpty(event) {
		if ($(this).val() == '')
			$('#|-$disableId-|').removeAttr('disabled');
		else
			$('#|-$disableId-|').attr('disabled', 'disabled');
	}
</script>