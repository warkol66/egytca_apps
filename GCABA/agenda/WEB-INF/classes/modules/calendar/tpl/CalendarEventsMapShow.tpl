|-assign var="useSolapas" value=true-|
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<style>
#map_canvas {
	height: 580px !Important;
	width: 900px !Important;
/*	margin-left: 150px; */
}</style>
<div>
	<!-- mapa google -->
	<div id="map_container">
		<div><ul id="directions_results" style="display:none"></ul></div>
		<div id="map_canvas"></div>
	</div>
	<!-- fin mapa google -->
</div>

<div style="display:none;"><div id="fancyboxDiv"></div></div>
<a id="fancyboxDummy" style="display:none" href="#fancyboxDiv"></a>

<!-- map -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/jquery/map-base.js"></script>
<script type="text/javascript" src="scripts/jquery/events-map.js"></script>
<!-- end map -->

<!-- fancybox -->
<script type='text/javascript' src='scripts/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<!-- end fancybox -->

<script type="text/javascript">
	
	var map;
	
	$(function() {
		
		$('#fancyboxDummy').fancybox();
		
		var events = JSON.parse(|-json_encode($events)-|);
		var icons = {
			"default": "images/marker_blanco.png",
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
		map.markerOnClick = function(marker) {
			$('#fancyboxDiv').load(
				'Main.php?do=calendarEventsShowX&id='+marker.eventId,
				{},
				function() {$('#fancyboxDummy').click()}
			);
		}
		
		|-foreach from=$axisNameToIdMap key="name" item="axisId"-|
			$("div.boxNavSolapas li[hide='|-$name-|']").click(function() {
				map.filterEventsByAxisId("|-$axisId-|")
			});
		|-/foreach-|
	});
</script>