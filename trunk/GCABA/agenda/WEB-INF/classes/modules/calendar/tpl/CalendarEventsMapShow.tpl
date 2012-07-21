|-assign var="useSolapas" value=true-|

<div>
	<!-- mapa google -->
	<div id="map_container">
		<div><ul id="directions_results" style="display:none"></ul></div>
		<div id="map_canvas"></div>
	</div>
	<!-- fin mapa google -->
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/jquery/map-base.js"></script>
<script type="text/javascript" src="scripts/jquery/events-map.js"></script>
<script type="text/javascript">
	
	var map;
	
	$(function() {
		var events = JSON.parse('|-$events-|');
		var icons = {
			"|-$axisCssClassToIdMap.amarillo-|": "images/marker_amarillo.png",
			"|-$axisCssClassToIdMap.cyan-|": "images/marker_cyan.png",
			"|-$axisCssClassToIdMap.gris-|": "images/marker_gris.png",
			"|-$axisCssClassToIdMap.naranja-|": "images/marker_naranja.png",
			"|-$axisCssClassToIdMap.naranjabis-|": "images/marker_naranjabis.png",
			"|-$axisCssClassToIdMap.rojo-|": "images/marker_rojo.png",
			"|-$axisCssClassToIdMap.verde1-|": "images/marker_verde1.png",
			"|-$axisCssClassToIdMap.verde1bis-|": "images/marker_verde1bis.png",
			"|-$axisCssClassToIdMap.verde2-|": "images/marker_verde2.png"
		};
		
		map = new EventsMap("map_canvas", events, icons);
		var latlng = new google.maps.LatLng('-34.649', '-58.456');
		map.mapOptions.zoom = 12;
		map.mapOptions.center = latlng;
		map.drawRegions = function() {
			|-include file="RegionsDrawInclude.tpl" mapJsVarName="map"-|
		}
		
		|-foreach from=$axisNameToIdMap key="name" item="axisId"-|
			$("div.boxNavSolapas li[hide='|-$name-|']").click(function() {
				map.filterEventsByAxisId("|-$axisId-|")
			});
		|-/foreach-|
	});
</script>