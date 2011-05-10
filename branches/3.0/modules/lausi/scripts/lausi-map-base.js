BaseMap = function() {
	//Referencia al mapa
	this.map;
	
	//Indica si se habilita el comportamiento que esté definido en el
	//manejador del evento onClick del mapa.
	this.mapClickable = false;
	
	//Indica si se pueden arrastrar los markers.
	this.markersDraggables = false;
	
	//Referencias a los markers.
	//id => marker
	this.markers = new Hash();
	
	//Indice invertido para acceder a un id a partir de una posición.
	//positionString => id
	//positionString es el resultado de un toString() sobre un LatLng.
	this.idsByPosition = new Hash();
	
	//Referencias a las info windows de los markers.
	//id => infoWindow
	this.infoWindows = new Hash();
	
	//Mapeo de tipos de markers con sus respectivos iconos.
	this.icons = {
		pinBlue: 'images/pin_blue.png',
		available: 'images/marker_green.png', 
		assigned: 'images/marker_blue.png',
		partiallyAssigned: 'images/partiallyAssigned.png',
		client: 'images/pin_green.png'
	};
	
	//Colores para los trazos de los anillos
	this.strokeColors = ['#00ff00', '#0000ff', '#fffc00', '#ff0000'];
	
	//Opciones a utilizar para inicializar el mapa.
	//Por defecto se usa zoom de 12 y centro en '-34.609', '-58.445'.
	this.mapOptions = new Hash({
	      zoom: 12,
	      center: new google.maps.LatLng('-34.609', '-58.445'),
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	
	this.autoincrementalIdx = 0;
	
	/**
	 * Inicia y muestra el mapa.
	 * 
	 * Las opciones a aplicar son las definidas en this.mapOptions.
	 * 
	 * @param string canvasId, id del div donde renderizar el mapa
	 */
	this.initializeMap = function(canvasId) {
		var _this = this;
	    this.map = new google.maps.Map(document.getElementById(canvasId), _this.mapOptions.toObject());
	    
	    this.map.enableKeyDragZoom({
			boxStyle: {
				border: "thick blue",
				backgroundColor: "blue",
				opacity: 0.3
			},
			paneStyle: {
				backgroundColor: "grey",
				opacity: 0.1
			}
		});
		
		google.maps.event.addListener(_this.map, 'click', function(ev) {
			if (_this.mapClickable)
	    		_this.mapOnClick(this, ev);
	  	});
	  	
	  	_this.drawCircuits();
	}
	
	/**
	 * Muestra un marker en el mapa, le asigna manejadores de eventos
	 * y lo almacena para posterior referencia.
	 * 
	 * @param string id, identificador del marker para posterior referencia.
	 * @param LatLng position, ubicación donde mostrar el marker.
	 * @param string type, tipo de marker a mostrar según this.icons (afecta al icono).
	 * 
	 * @return Marker, el marker agregado.
	 */
	this.displayMarker = function(id, position, type) {
		var _this = this;
		var marker;
		var icon;
		
		if (type === undefined)
			icon = '';
		else
			icon = _this.icons[type];
			
		if (id === undefined) {
			id = _this.autoincrementalIdx.toString();
			_this.autoincrementalIdx++;
		}
		
		marker = _this.markers[id];
		if (marker != undefined)
			_this.removeMarker(id);
			
		marker = new google.maps.Marker({
	       	map: _this.map, 
	       	position: position,
	       	icon: icon,
	       	draggable: _this.markersDraggables
	    });
	    
	    google.maps.event.addListener(marker, 'click', function() {
	    	_this.markerOnClick(this)
	    });
	    
	  	google.maps.event.addListener(marker, 'mouseover', function() {
	  		_this.markerOnMouseOver(this)
	  	});
	  	
	  	google.maps.event.addListener(marker, 'mouseout', function() {
	  		_this.markerOnMouseOut(this)
	  	});
	  	
	  	google.maps.event.addListener(marker, 'dragstart', function() {
	    	_this.markerOnDragstart(this);
	  	});
	  	
	  	google.maps.event.addListener(marker, 'drag', function() {
	    	_this.markerOnDrag(this);
	  	});
	  	
	  	google.maps.event.addListener(marker, 'dragend', function() {
	    	_this.markerOnDragend(this);
	  	});
	        
	  	_this.markers[id] = marker;
	  	_this.idsByPosition[position.toString()] = id;
	  	
	  	return marker;
	}
	
	/**
	 * Elimina el marker y toda referencia a él
	 */
	this.removeMarker = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker != undefined) {
			marker.setMap(null);
			_this.idsByPosition.unset(marker.position.toString())
			_this.markers.unset(markerId);
			_this.hideMarkerInfo(markerId);
		}
	}
	
	this.removeAllMarkers = function() {
		var _this = this;
		_this.markers.each(function(marker, id) {
			_this.removeMarker(id);
		});
	}
	
	/**
	 * Hace que el marker no se muestre en el mapa, pero conserva las referencias a él.
	 */
	this.hideMarker = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker != undefined) {
			marker.setMap(null);
			_this.hideMarkerInfo(markerId);
		};
	}
	
	/**
	 * Muestra un marker que estaba oculto.
	 * 
	 * @param bool showInfo, indica si mostrar automáticamente la infoWindow asociada. false por defecto.
	 */
	this.showMarker = function(markerId, showInfo) {
		if (showInfo === undefined)
			showInfo = false;
			
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker != undefined) {
			marker.setMap(_this.map);
			if (showInfo)
				_this.showMarkerInfo(markerId)
		};
	}
	
	this.hideAllMarkers = function() {
		var _this = this;
		_this.markers.each(function(marker, id) {
			_this.hideMarker(id);
		});
	}
	
	this.showAllMarkers = function() {
		var _this = this;
		_this.markers.each(function(marker, id) {
			_this.showMarker(id);
		});
	}
	
	/**
	 * Asigna información en forma de texto a un marker, pero no la muestra,
	 * para ello usar this.showMarkerInfo().
	 * 
	 * @param string information, información a mostrar en la InfoWindow.
	 */
	this.setMarkerInfo = function(markerId, information) {
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker === undefined)
			return;
		var infoWindow = _this.infoWindows[markerId];
		if (infoWindow === undefined) 
			infoWindow = new google.maps.InfoWindow();
		infoWindow.setContent(information);
		_this.infoWindows[markerId] = infoWindow;
	}
	
	this.showMarkerInfo = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		var infoWindow = _this.infoWindows[markerId];
		if (marker != undefined && infoWindow != undefined)
			infoWindow.open(_this.map, marker);
	}
	
	this.hideMarkerInfo = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		var infoWindow = _this.infoWindows[markerId];
		if (marker != undefined && infoWindow != undefined)
			infoWindow.close();
	}
	
	/**
	 * Cambia el estado del marker como assignado.
	 * 
	 * @param string id, identificador del marker
	 */
	this.markAssigned = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker != undefined)
			marker.setIcon(_this.icons['assigned']);
	}
	
	/**
	 * Cambia el estado del marker como assignado.
	 * 
	 * @param string id, identificador del marker
	 */
	this.markAvailable = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker != undefined)
			marker.setIcon(_this.icons['available']);
	}
	
	/**
	 * Cambia el estado del marker como assignado.
	 * 
	 * @param string id, identificador del marker
	 */
	this.markPartiallyAssigned = function(markerId) {
		var _this = this;
		var marker = _this.markers[markerId];
		if (marker != undefined)
			marker.setIcon(_this.icons['partiallyAssigned']);
	}
	
	/**
	 * Dibuja un circulo.
	 * 
	 * @param LatLng center, centro del circulo en coordenadas.
	 * @param int radius, radio del circulo en metros.
	 * @param int colorIndex, indice del color a utilizar según this.strokeColors, opcional.
	 * 
	 * @return Circle, el círculo dibujado.
	 */
	this.drawRing = function(center, radius, colorIndex) {
		if (colorIndex === undefined)
			colorIndex = 0;
		var circle = new google.maps.Circle({
			center: center,
			map: this.map,
			radius: radius,
			strokeColor: this.strokeColors[colorIndex],
			strokeOpacity: 0.6,
			fillColor: '#0000ff',
			fillOpacity: 0.0
		});
		
		return circle;
	}
	
	/// Event Handlers
	
	this.markerOnClick = function(marker) {
		var _this = this;
		var markerId = _this.idsByPosition[marker.getPosition().toString()];
		this.showMarkerInfo(markerId);
	}
	
	this.markerOnDragend = function(marker) {}
	
	this.markerOnDrag = function(marker) {}
	
	this.markerOnDragstart = function(marker) {}
	
	this.markerOnMouseOver = function(marker) {}
	
	this.markerOnMouseOut = function(marker) {}
	
	this.mapOnClick = function(map, mouseEvent) {
		this.displayMarker(undefined, mouseEvent.latLng);
	}
	
	/// Fin de Event Handlers
	
	/**
	 * Este callback es vacío por defecto.
	 * Si se quiere dibujar los circuitos, se debe redefinir por ej. utilizando el
	 * contenido del LausiCircuitsDraw.tpl
	 */
	this.drawCircuits = function() {}
	
	/**
	 * Shortcut para que todos los markers existentes pasen a ser draggables o no draggables.
	 * 
	 * @param bool draggable, valor a imponer como draggable. true por defecto.
	 */
	this.setAllMarkersDraggable = function(daggable) {
		var _this = this;
		if (draggable === undefined)
			draggable = true;
			
		_this.markersDraggables = daggable;
		_this.markers.each(function(marker) {
			marker.setDraggable(daggable);
		})
	}
};
