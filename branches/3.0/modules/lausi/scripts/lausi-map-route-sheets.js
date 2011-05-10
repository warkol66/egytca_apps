RouteSheetsMap = function() {
	this.parent = new BaseMap;
	this.inheritance = BaseMap;
	this.inheritance();
	this.polyLine;
	this.directionsDisplays = [];
	this.directionsService;
	
	/**
	 * Inicia y muestra el mapa.
	 * 
	 * @param string canvasId, id del div donde renderizar el mapa
	 */
	this.initializeMap = function(canvasId) {
	    this.parent.initializeMap.call(this, canvasId);
	    
	    var polyOptions = {
		    strokeColor: '#0000ff',
		    strokeOpacity: 1.0,
		    strokeWeight: 3
	  	}
	  	
	    this.polyLine = new google.maps.Polyline(polyOptions);
	  	this.polyLine.setMap(this.map);
	  	
	  	this.directionsService = new google.maps.DirectionsService();
	}
	
	this.markerOnMouseOver = function(marker) {
		marker.setIcon('images/marker_green.png');
		$(this.idsByPosition[marker.position.toString()]).setStyle({'background': '#00ff00', 'textDecoration': 'underline'});
	}
	
	this.markerOnMouseOut = function(marker) {
		marker.setIcon('');
		$(this.idsByPosition[marker.position.toString()]).setStyle({'background': 'transparent', 'textDecoration': 'none'});
	}
	
	this.markerOnClick = function(marker) {
		var _this = this;
		var path = _this.polyLine.getPath();
		var i = 0;
		var found = false;
		var inFirstPath = false;
		
		while (i < path.getLength() && !found) {
			if (path.getAt(i).equals(marker.getPosition()))
				found = true;
			i++;
		}
		
		var li = _this.idsByPosition[marker.getPosition().toString()];
		if (li != undefined) {
			li = $(li);
			li.toggle();
			inFirstPath = true;
			_this.redrawPolyline(li.parentNode);
		}
		
		if (!inFirstPath){
			// Because path is an MVCArray, we can simply append a new coordinate
	  		// and it will automatically appear
	  		path.push(marker.getPosition());
	  	}
	}
	
	this.generateDirections = function() {
		var _this = this;
		var path = _this.polyLine.getPath();
		var subPath = [];
	
		path.forEach(function(position, idx) {
			subPath.push(position);
			//Enviamos los puntos en paquetes de a 10 para no exceder las limitaciones del geocoder
			if (subPath.size() == 10) {
				_this.requestDirections(subPath);
				subPath.clear();
				subPath.push(position);
			}
		});
		
		//Si quedó algún resto sin enviar lo enviamos ahora.
		if (subPath.size() > 1) {
			_this.requestDirections(subPath);
		}
		
		_this.clearPolyLine();
	}
	
	this.requestDirections = function(waypoints) {
		var _this = this;
		var origin = waypoints.first();
		var destination = waypoints.last();
		
		waypts = [];
		var i;
		
		for (i = 1; i < waypoints.size() - 1; i++) {
			waypts.push({
				location: waypoints[i],
				stopover: true
			});
		}
		
		var request = {
			origin: origin, 
			destination: destination,
			waypoints: waypts,
			travelMode: google.maps.DirectionsTravelMode.DRIVING
	    };
	    
	    _this.directionsService.route(request, function(result, status) {
	    	 _this.displayDirections(result, status); 
	    });
	}
	
	this.displayDirections = function(result, status) {
		var _this = this;
	    if (status == google.maps.DirectionsStatus.OK) {
	    	var renderer = new google.maps.DirectionsRenderer({
		   		suppressMarkers: true,
		   		directions: result,
		   		map: _this.map,
		   	});
		   	_this.directionsDisplays.push(renderer);
	    }
	}
	
	this.clearPolyLine = function() {
		var path = this.polyLine.getPath();
		var lenght = path.getLength();
		var i;
		for (i=0; i<lenght; i++) {
			path.pop();
		}
	}
	
	this.clearAll = function() {
		this.clearPolyLine();
		this.clearDirections();
	}
	
	this.clearDirections = function() {
		this.directionsDisplays.each(function(renderer) {
			renderer.setMap(null);
		});
	}
	
	this.redrawPolyline = function(list) {
		var _this = this;
		var lis = list.childElements();
		_this.clearPolyLine();
		var path = _this.polyLine.getPath();
		
		lis.each(function(li) {
			if (li.visible())
				path.push(_this.markers[li.id].getPosition());
		});
	}
};
