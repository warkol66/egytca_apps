EventsMap = function(canvasId, events, icons) {

	this.parent = new BaseMap;
	this.inheritance = BaseMap;
	this.inheritance();

	if (icons != undefined)
		this.icons = icons;

	this.geocoder;
	this.suggestions = [];


	this.initializeMap = function(canvasId) {
		var _this = this;

		_this.parent.initializeMap.call(_this, canvasId);

		_this.directionsDisplay = new google.maps.DirectionsRenderer();
		_this.geocoder = new google.maps.Geocoder();
	}

	this.parentDisplayMarker = this.displayMarker;
	this.displayMarker = function(id, position, type) {
		var marker = this.parentDisplayMarker(id, position, type);
		marker.type = type;
	}

	this.filterEventsByAxisId = function(axisId) {
		for (var id in this.markers) {
			if (this.markers[id].type == axisId)
				this.showMarker(id);
			else
				this.hideMarker(id);
		}
	}

	if (!this.map) {
		this.initializeMap(canvasId);
	}

	for (var key in events) {
		var event = events[key];

		if (event.Latitude != null && event.Longitude != null) {
			var position = new google.maps.LatLng(event.Latitude, event.Longitude);
			this.displayMarker(event.Id, position, event.Axisid);
			this.setMarkerInfo(event.Id, '<u>Título</u>: '+event.Title);
		}
	}
};
