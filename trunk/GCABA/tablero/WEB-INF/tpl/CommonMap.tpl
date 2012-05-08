|-if ($systemUrl|substr:-41:-9) eq "misionesphp.tablerodecontrol.org"-|
	|-assign var=mapKey value="ABQIAAAA6yTdCO3hOAP_Cfu_aye9JhRg1kWW_-_UsIQYlpbsXluHAjvVoxRfAsq9_oouMFIHf_QHXX3q919nlw"-|
|-else-|
	|-assign var=mapKey value="ABQIAAAA6yTdCO3hOAP_Cfu_aye9JhQiHTyAsg6WQUkFoURB_RST2Rzt-RTv4cgGw88QiBIhKt_aSO0oH-MR7A"-|
|-/if-|
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=|-$mapKey-|"></script>
<script type="text/javascript">
	function load(){
    var map      = null;
    var map = new GMap2(document.getElementById("map"));
        map.setMapType(G_HYBRID_MAP);
	    map.setCenter(new GLatLng(-31.39907,-64.182129), 13);
        map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
        map.addControl(new GScaleControl());
	var baseIcon = new GIcon();
      //baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
      //baseIcon.iconSize = new GSize(20, 34);
      //baseIcon.shadowSize = new GSize(37, 34);
      baseIcon.iconAnchor = new GPoint(9, 34);
      baseIcon.infoWindowAnchor = new GPoint(9, 2);
      baseIcon.infoShadowAnchor = new GPoint(18, 25);
      
      function createMarker(point, iconname, info) {
            var icon = new GIcon(baseIcon);
            icon.image = iconname.getAttribute("image");
            var marker = new GMarker(point, icon);      
           GEvent.addListener(marker, "click", function() {
              marker.openInfoWindowHtml(info,{pixelOffset:new GSize(32,5), maxWidth:200} );
            });
            return marker;
          }
       
	var request = GXmlHttp.create();
	//request.open("GET", "scripts/Mapa_Datos.asp.xml", true);
	request.open("GET", "Main.php?do=projectsXmlToMap", true);
	request.onreadystatechange = function() {
  	//alert(request.readyState);
  	if (request.readyState == 4) {
    		var xmlDoc = request.responseXML;
    		//alert(xmlDoc);
   		var points = xmlDoc.documentElement.getElementsByTagName("point");
   		//alert(points.length);
        var icons = xmlDoc.documentElement.getElementsByTagName("icon");
        //alert(points.length);
	    
    	    var centro = new GPoint(-26.848579,-54.838257);
	        for (var i = 0; i < points.length; i++) {
	        var point = new GPoint(parseFloat(points[i].getAttribute("lng")),
                             parseFloat(points[i].getAttribute("lat")));
            var info = points[i].getAttribute("info");
            var Localidad = points[i].getAttribute("Localidad");
            var id = points[i].getAttribute("id");
            
              info = "<strong>"+info+ "</strong><br /><strong>Localidad:</strong>"+Localidad+ "<br /><a href='Main.php?do=tableroProjectsView&id=" +id+ "'>Ver detalle</a>";
	            var marker = createMarker(point, icons[i], info);
	        map.addOverlay(marker);
    		}
  	}
}
request.send(null);

 }
//]]>
    </script>
<div id="map" style="width: 980px; height:670px;"></div>
<form name="Obras" action="mapa.asp" method="post">
	<table border="0">
		<tr>
			<td><input type="checkbox" name="Cadena_Dependencia" value="51" checked/>
				<img src="http://misiones.tablerodecontrol.org/graf/vialidad.png" /><font face="verdana" size="1">VIALIDAD</font></td>
			<td><input type="checkbox" name="Cadena_Dependencia" value="52" checked/>
				<img src="http://misiones.tablerodecontrol.org/graf/iprodha.png" /><font face="verdana" size="1">IPRODHA</font></td>
			<td><input type="checkbox" name="Cadena_Dependencia" value="53" checked/>
				<img src="http://misiones.tablerodecontrol.org/graf/casco.png" /><font face="verdana" size="1">ARQUITECTURA</font></td>
			<td><input type="checkbox" name="Cadena_Dependencia" value="54" checked/>
				<img src="http://misiones.tablerodecontrol.org/graf/globo_rojo.png" /><font face="verdana" size="1">UEP-PROMEBA</font></td>
		</tr>
	</table>
</form>
<script type="text/javascript">javascript:load();</script>
