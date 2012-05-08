<div id="mapdiv" align="center"></div>
<script language="JavaScript" src="scripts/FusionMaps/FusionMaps.js"></script>
   <script type="text/javascript">
	   var map = new FusionMaps("scripts/FusionMaps/Maps/FCMap_Argentina.swf", "Map1Id", "500", "800", "0", "0");
//	   map.setDataXML("<map showCanvasBorder='1' canvasBorderColor='f1f1f1' canvasBorderThickness='2' borderColor='00324A' fillColor='F0FAFF' hoverColor='C0D2F8'></map>");		   
	   map.setDataURL("scripts/mapArgentina.xml");		   
	   map.render("mapdiv");
	</script>

|-if ($systemUrl|substr:-29:-9) eq "tablerodecontrol.org"-|
	|-assign var=mapKey value="ABQIAAAA6yTdCO3hOAP_Cfu_aye9JhRg1kWW_-_UsIQYlpbsXluHAjvVoxRfAsq9_oouMFIHf_QHXX3q919nlw"-|
|-elseif ($systemUrl|substr:-41:-9) eq "misionesphp.tablerodecontrol.org"-|
	|-assign var=mapKey value="ABQIAAAA6yTdCO3hOAP_Cfu_aye9JhRg1kWW_-_UsIQYlpbsXluHAjvVoxRfAsq9_oouMFIHf_QHXX3q919nlw"-|
|-elseif ($systemUrl|substr:-21:-9) eq "sistemas.biz"-|
	|-assign var=mapKey value="ABQIAAAA6yTdCO3hOAP_Cfu_aye9JhSBVxvK-OBer81wwVW_sU95YS40_RQSiswCkSS93vCHV33hNhihHb5r1g"-|
|-else-|
	|-assign var=mapKey value="ABQIAAAA6yTdCO3hOAP_Cfu_aye9JhQiHTyAsg6WQUkFoURB_RST2Rzt-RTv4cgGw88QiBIhKt_aSO0oH-MR7A"-|
|-/if-|

	<div id="contenido_general">
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=|-$mapKey-|" type="text/javascript"></script>

<script type="text/javascript"> 
 if (navigator.appName.indexOf("Microsoft")>=0) {
  if (document.documentElement.clientWidth < 1000) {// Use window.innerWidth or screen.width
		var divMap = document.getElementById('map');
		divMap.style.height = 420;
		divMap.style.width = 520;}
	else if (document.documentElement.clientWidth > 1300){
		var divMap = document.getElementById('map');
		divMap.style.height = 560;
		divMap.style.width = 640;}
	else {
		var divMap = document.getElementById('map');
		divMap.style.height = 460;
		divMap.style.width = 520;}
}else{
  if (window.innerWidth < 1000){ // Use window.innerWidth or screen.width
		var divMap = document.getElementById('map');
		divMap.style.height = 420;
		divMap.style.width = 520;}
	else if (window.innerWidth > 1300) {
		var divMap = document.getElementById('map');
		divMap.style.height = 560;
		divMap.style.width = 640;}
	else {
		var divMap = document.getElementById('map');
		document.write('default');
		divMap.style.height = 460;
		divMap.style.width = 520;}
}
</script>
  <div id="map" style="border: 4px double #CCCCCC; position: relative; float: left; margin-top: 8px;">Cargando mapa...</div>
  <div id="contenido_listado_obras">
    <div style="text-align:center"><b>Opciones de Visualización y Referencias</b><br />
      <br />
    </div>
    <div id="icono_adju"><img src="ptuba/images/adjudicacion.gif" width="28" height="28" alt="ico_adju" />Obras en Adjudicación</div>
    <div id="icono_ejecu"><img src="ptuba/images/ejecucion.gif" width="28" height="28" alt="ico_ejecu" />Obras en Ejecución</div>
    <div id="icono_termi"><img src="ptuba/images/terminada.gif" width="28" height="28" alt="ico_termi" />Obras Terminadas</div>
    <div>
      <input type="checkbox" id="modbox" onClick="boxclick(this,'mod')" />
      <b>[S]</b> Modernizaciones Subte</div>
    <div>
      <input type="checkbox" id="meebox" onClick="boxclick(this,'mee')" />
      <b>[M]</b> Mejoras Entornos a Estaciones</div>
    <div>
      <input type="checkbox" id="pdnbox" onClick="boxclick(this,'pdn')" />
      <b>[P]</b> Pasos a Distinto Nivel</div>
    <div>
      <input type="checkbox" id="ctbox" onClick="boxclick(this,'ct')" />
      <b>[C]</b> Centros de Transbordo<br />
    </div>
    <div style="text-align:left"><b>Resultado de la seleccion:</b></div>
    <div id="side_bar" style="diplay:none;"></div>
    <script type="text/JavaScript" src="../../f_js/mapa_sidebar_zoom.js"></script>
    <script type="text/javascript">
// Funcion de creación de botones de zoom
	function TextualZoomControl() {}
    TextualZoomControl.prototype = new GControl();

	TextualZoomControl.prototype.initialize = function(map) {
    var container = document.createElement("div");
	  var zoomInDiv = document.createElement("div");
      this.setButtonStyle1_(zoomInDiv);
      container.appendChild(zoomInDiv);
      zoomInDiv.appendChild(document.createTextNode("Acercar"));
      GEvent.addDomListener(zoomInDiv, "click", function() {map.zoomIn();});

      var zoomOutDiv = document.createElement("div");
      this.setButtonStyle2_(zoomOutDiv);
      container.appendChild(zoomOutDiv);
      zoomOutDiv.appendChild(document.createTextNode("Alejar"));
      GEvent.addDomListener(zoomOutDiv, "click", function() {map.zoomOut();});
			map.getContainer().appendChild(container);
      return container;
    }
    TextualZoomControl.prototype.getDefaultPosition = function() {return new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(410, 50));}
    TextualZoomControl.prototype.setButtonStyle1_ = function(button) {
      button.style.textDecoration = "none";
      button.style.color = "#000000";
      button.style.backgroundColor = "white";
	  button.style.backgroundImage = 'url(ptuba/images/lupa-acerca.gif)';
	  button.style.backgroundRepeat = 'no-repeat';
	  button.style.font = "small Verdana";
      button.style.border = "1px solid black";
      button.style.padding = "0px 14px 0px 20px";
      button.style.marginBottom = "5px";
      button.style.textAlign = "left";
      button.style.width = "4em";
      button.style.cursor = "pointer";
    }
	TextualZoomControl.prototype.setButtonStyle2_ = function(button) {
      button.style.textDecoration = "none";
      button.style.color = "#000000";
      button.style.backgroundColor = "white";
	  button.style.backgroundImage = 'url(ptuba/images/lupa-aleja.gif)';
	  button.style.backgroundRepeat = 'no-repeat';
	  button.style.font = "small Verdana";
      button.style.border = "1px solid black";
      button.style.padding = "0px 14px 0px 20px";
      button.style.marginBottom = "5px";
      button.style.textAlign = "left";
      button.style.width = "4em";
      button.style.cursor = "pointer";
    }

// Mapa, Controles y Sidebar
if (GBrowserIsCompatible()) {
	function createMarker(point, descripcion, localidad, conv_estado, html, categoria, enlace, tipo_icono) {
		var marker = new GMarker(point,{icon: gicons[tipo_icono]});
		marker.micategoria = categoria;                                 
		marker.miestado = conv_estado;
		marker.midescripcion = descripcion;
		marker.milocalidad = localidad;
		marker.miicono = tipo_icono;
		GEvent.addListener(marker, "click", function(){
			marker.openInfoWindowHtml(html);
		});
		gmarkers.push(marker);
		return marker;
	}
	
	var gmarkers = [];
	var gicons = [];

	var iconito = new GIcon(); gicons["mod0"]=iconito;
	iconito.image = "ptuba/images/icon_s_cele.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_s_cele.gif";
	iconito.mozPrintImage = "ptuba/images/icon_s_cele.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["mod1"]=iconito;
	iconito.image = "ptuba/images/icon_s_verde.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_s_verde.gif";
	iconito.mozPrintImage = "ptuba/images/icon_s_verde.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["mod2"]=iconito;
	iconito.image = "ptuba/images/icon_s_rojo.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_s_rojo.gif";
	iconito.mozPrintImage = "../ptuba/images/icon_s_rojo.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["mee0"]=iconito;
	iconito.image = "ptuba/images/icon_m_cele.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_m_cele.gif";
	iconito.mozPrintImage = "ptuba/images/icon_m_cele.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["mee1"]=iconito;
	iconito.image = "ptuba/images/icon_m_verde.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_m_verde.gif";
	iconito.mozPrintImage = "ptuba/images/icon_m_verde.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["mee2"]=iconito;
	iconito.image = "ptuba/images/icon_m_rojo.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_m_rojo.gif";
	iconito.mozPrintImage = "ptuba/images/icon_m_rojo.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);
	
	var iconito = new GIcon(); gicons["pdn0"]=iconito;
	iconito.image = "ptuba/images/icon_p_cele.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_p_cele.gif";
	iconito.mozPrintImage = "ptuba/images/icon_p_cele.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["pdn1"]=iconito;
	iconito.image = "ptuba/images/icon_p_verde.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_p_verde.gif";
	iconito.mozPrintImage = "ptuba/images/icon_p_verde.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["pdn2"]=iconito;
	iconito.image = "ptuba/images/icon_p_rojo.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_p_rojo.gif";
	iconito.mozPrintImage = "../ptuba/images/icon_p_rojo.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["ct0"]=iconito;
	iconito.image = "ptuba/images/icon_c_cele.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_c_cele.gif";
	iconito.mozPrintImage = "ptuba/images/icon_c_cele.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["ct1"]=iconito;
	iconito.image = "ptuba/images/icon_c_verde.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_c_verde.gif";
	iconito.mozPrintImage = "ptuba/images/icon_c_verde.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	var iconito = new GIcon(); gicons["ct2"]=iconito;
	iconito.image = "ptuba/images/icon_c_rojo.png";
	iconito.transparent = "ptuba/images/icon_transp.png";
	iconito.printImage = "ptuba/images/icon_c_rojo.gif";
	iconito.mozPrintImage = "ptuba/images/icon_c_rojo.gif";
	iconito.iconSize = new GSize(21, 34);
	iconito.iconAnchor = new GPoint(10, 34);
	iconito.imageMap = [10,29,12,25,13,20,15,17,17,16,19,13,19,10,19,5,16,1,10,0,6,2,3,4,2,6,1,9,4,15,6,18,8,20,9,25,10,29];
	iconito.infoWindowAnchor = new GPoint(8, 3);

	// Muestra todos los markers de una categoria en particular y se asegura que el checkbox este tildado
	function show(categoria) {
		for (var i=0; i<gmarkers.length; i++) {
    		if (gmarkers[i].micategoria == categoria) {gmarkers[i].show();}
		}
		// chequea el checkbox
		document.getElementById(categoria+"box").checked = true;
	}

	// Oculta todos los markers de una categoria en particular y se asegura que el checkbox no este tildado
	function hide(categoria) {
		for (var i=0; i<gmarkers.length; i++) {
    		if (gmarkers[i].micategoria == categoria) {gmarkers[i].hide();}
		}
		// destilda el checkbox
		document.getElementById(categoria+"box").checked = false;
		// cierra el info window, en el caso de que se le hubiera hecho un clic a algun marcador
		map.closeInfoWindow();
	}

	// Un checkbox ha sido cliqueado
	function boxclick(box,categoria) {
		if (box.checked) {show(categoria);}
		else {hide(categoria);}

		// reconstruye el sidebar
		makeSidebar();
	
		sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		sorter.even = "evenrow";
		sorter.odd = "oddrow";
		sorter.evensel = "evenselected";
		sorter.oddsel = "oddselected";
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("table",0);
	}

	function miclick(i) {GEvent.trigger(gmarkers[i],"click");}
		// reconstruye el sidebar para que coincida con los markers actualmente mostrados
		function makeSidebar() {
			var html = '<table id="table" class="sortable"><thead><tr><th>Descripción</th><th>Partido</th></tr></thead><tbody>';
			for (var i=0; i<gmarkers.length; i++) {
				if (!gmarkers[i].isHidden()) {
					html += '<tr><td style="vertical-align:middle"><a href="javascript:miclick(' + i + ')">'+gmarkers[i].midescripcion+'</a></td><td style="vertical-align:middle">'+gmarkers[i].milocalidad+'</td></tr>';
				}
        	}
			html+='</tbody></table>';
//			document.getElementById("side_bar").innerHTML = html;
					sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		sorter.even = "evenrow";
		sorter.odd = "oddrow";
		sorter.evensel = "evenselected";
		sorter.oddsel = "oddselected";
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("table",0);
     	}

// Mapa y globos
		var map = new GMap2(document.getElementById("map"), {logoPassive:true}, {size: new GSize(506,526)});
		map.addMapType(G_PHYSICAL_MAP);
		map.setMapType(G_HYBRID_MAP);
		map.setCenter(new GLatLng(-34.67, -58.51), 10);
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		map.addControl(new GScaleControl());
        map.addControl(new TextualZoomControl());
			
		// Lee los datos de archivo
		GDownloadUrl("map_points.xml", function(doc) {
      		var xmlDoc = GXml.parse(doc);
      		var markers = xmlDoc.documentElement.getElementsByTagName("marker");
		  
        	for (var i = 0; i < markers.length; i++) {
        		// Obtiene los atributos de cada marker	
        		var lat = parseFloat(markers[i].getAttribute("lat"));
        		var lng = parseFloat(markers[i].getAttribute("lng"));
        		var point = new GLatLng(lat,lng);
        		var categoria = markers[i].getAttribute("categoria");

				var micategoria=categoria;
				switch(micategoria)
				{
					case (micategoria="mod"): micategoria="Modernización"; break;
					case (micategoria="ct"): micategoria="Centro de Transbordo"; break;
					case (micategoria="pdn"): micategoria="Paso a Distinto Nivel"; break;
					case (micategoria="mee"): micategoria="Mejora en Entorno a Estación"; break;
				}
				
				var descripcion = markers[i].getAttribute("descripcion");
				var localidad = markers[i].getAttribute("localidad");
        		var estado = markers[i].getAttribute("estado");

				var conv_estado=estado
				switch(conv_estado)
				{
					case (conv_estado="0"): conv_estado="Adjudicación"; break;
					case (conv_estado="1"): conv_estado="Ejecución"; break;
					case (conv_estado="2"): conv_estado="Terminada"; break;			
				}

				var enlace = markers[i].getAttribute("enlace");
        		
				var tipo_icono = markers[i].getAttribute("categoria");
				tipo_icono = tipo_icono + markers[i].getAttribute("estado");

				var mienlace;	if (enlace=="#") {mienlace='javascript:alert("La obra seleccionada tiene su DETALLE en ELABORACION")';}
				else {mienlace=enlace;}

				var color_estado;	if (conv_estado=="Adjudicación") {color_estado='<span style="color:#009999; font-weight: bold;">';}
				var color_estado;	if (conv_estado=="Ejecución") {color_estado='<span style="color:#009900; font-weight: bold;">';}
				var color_estado;	if (conv_estado=="Terminada") {color_estado='<span style="color:#FF0000; font-weight: bold;">';}
				
				var html = "<div style='font-size: 11px; font-family: verdana; color:#000 text-decoration: underline'><b>Tipo de Obra: </b>" +micategoria+ "<br /><br /><b>Descripción: </b>" +descripcion+ "<br/><br /><b>Estado: </b>" + color_estado + conv_estado + "</span>" + "<br /><br /><b>Detalle: </b>"+"<a target='_new' href='" +mienlace+ "'>" + "<b>Mostrar detalle de Obra</b>"+"</a></div>";		

				// Crea el marcador
        		var marker = createMarker(point, descripcion, localidad, conv_estado, html, categoria, mienlace, tipo_icono);
        		map.addOverlay(marker);
			}
        	// muestra u oculta las categorias inicialmente cuando carga la página
        	show("mod");
        	show("mee");
        	show("pdn");
        	show("ct");
			// Crea el sidebar inicial
        	makeSidebar();
      	});
    }else {alert("Lo lamentamos, Google Maps API no es compatible con este navegador");}


		</script>
  </div>
  <!--      <div id="imprimir_mapa" style="text-align:center"><input type="button" value="Imprimir Mapa" onclick="#" style="margin-top: 4px; font-family: Verdana, Geneva, sans-serif" /></div>-->
</div>
</body>