CalendarMap = function(options) { // {disableId, streetId, numberId, latitudeId, longitudeId}
	this.parent = new BaseMap;
	this.inheritance = BaseMap;
	this.inheritance();
	
	this.disableButton = $('#'+options.disableId);
	this.street = $('#'+options.streetId);
	this.number = $('#'+options.numberId);
	this.latitude = $('#'+options.latitudeId);
	this.longitude = $('#'+options.longitudeId);
	
	this.markerBeingDragIndex;
	
	this.geocoder;
	this.suggestions = [];
	this.markersDraggables = true;
	this.mapClickable = true;
	
	this.initializeMap = function(canvasId) {
		var _this = this;
		
		_this.parent.initializeMap.call(_this, canvasId);
		
		_this.directionsDisplay = new google.maps.DirectionsRenderer();
		_this.geocoder = new google.maps.Geocoder();
	}
	
	this.mapOnClick = function(map, mouseEvent) {
		this.clearResultsList();
		this.displayMarker("unique", mouseEvent.latLng);
		this.updateAddressInfoByPosition(mouseEvent.latLng);
	}
	
	this.markerOnDragstart = function(marker) {
		this.markerBeingDragIndex = this.idsByPosition[marker.getPosition()];
		this.idsByPosition.unset(marker.getPosition().toString());
	}
	
	this.markerOnDragend = function(marker) {
		var _this = this;
		_this.idsByPosition[marker.getPosition().toString()] = _this.markerBeingDragIndex;
		this.clearResultsList;
		this.updateAddressInfoByPosition(marker.getPosition());
	}
	
	this.updateAddressInfoByPosition = function(position) {
		var _this = this;
		if (_this.geocoder) {
			_this.geocoder.geocode({'latLng': position}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						var markerId = _this.idsByPosition[position.toString()];
						_this.setMarkerInfo(markerId, results[0].formatted_address);
						_this.showMarkerInfo(markerId);
						_this.updateAddressInfoByResult(results[0]);
					}
				} else {
					alert("Geocoder failed due to: " + status);
				}
			});
		}
		_this.disableButton.removeAttr('disabled');
	}
	
	this.updateAddressInfoByResult = function(result) {
		var _this = this;
		
		var addressComponents = result.address_components;
		var routeComponent = _this.getComponent(addressComponents, 'route');
		if (routeComponent) {
			_this.street.val(routeComponent.long_name);
			_this.street.change();
		} else {
			_this.street.val('');
			_this.street.change();
		}

		var number = _this.getComponent(addressComponents, 'street_number').long_name;
		if (number) {
			//La altura devuelta por el geocoding es del tipo 2500-2600
			//Como necesitamos un único número y no un intervalo, tomamos el primer límite.
			number = number.split('-');
			number = parseInt(number[0]);
		} else {
			number = '';
		}
		_this.number.val(number);
		_this.number.change();
		
		var markerId = _this.idsByPosition[result.geometry.location.toString()];
		_this.setMarkerInfo(markerId, result.formatted_address);
		_this.showMarkerInfo(markerId);
		
		_this.latitude.val(result.geometry.location.lat());
		_this.latitude.change();
		_this.longitude.val(result.geometry.location.lng());
		_this.longitude.change();
		
		var region = _this.getComponent(addressComponents, 'neighborhood').long_name;
		_this.selectRegion(region);
		
		_this.disableButton.removeAttr('disabled');
	}
	
	this.getComponent = function(addressComponents, componentName) {
		var _this = this;
		var i = 0;
		var addressComponent;
		
		do {
			addressComponent = addressComponents[i];
			i++;
		} while (i < addressComponents.length && addressComponent.types[0] != componentName);
		if (addressComponent.types[0] != componentName)
			return false;
		return addressComponent;
	}
	
	this.selectRegion = function(region) {
//		var _this = this;
//		var corrections = {
//			'Monserrat': 'Montserrat',
//			'Núñez': 'Nuñez',
//			'San Nicolas': 'San Nicolás',
//			'Villa Ortuzar': 'Villa Ortúzar',
//			'Villa Pueyrredón': 'Villa Pueyrredon',
//			'Villa Gral.mitre': 'Villa Gral Mitre'
//		};
//		
//		if (corrections[region])
//			region = corrections[region];
//	
//		$$('select#regionId > option').each(function(option) {
//			if (option.innerHTML == region) {
//				option.selected = true;
//				$('regionId').selectedIndex = option.index;
//			} else {
//				option.selected = false;
//			}
//		});
		console.log('select region', region);
	}
	
	this.locate = function() {
		var _this = this;
		
		$('#map_container').show();
		if (!_this.map) {
			_this.initializeMap('map_canvas');
		}
		
		_this.clearResultsList();
		
		//Componemos la dirección para la busqueda de la siguiente manera:
		//<calle> <numero>[, <barrio>], Buenos Aires, Argentina
		var address = _this.street.val();
		address += ' ' + _this.number.val();
//		address += region????
	
//		//Convertimos el form en un objeto js para facilitar el análisis
//		var locationData = form.serialize(true);
//			
////		if (locationData['address[regionId]'] != '')
////			address += ', ' + $$('select#regionId > option[value="'+locationData['address[regionId]']+'"]')[0].innerHTML;
		
		address += ', Ciudad Autonoma de Buenos Aires, Capital Federal, Argentina';
		
		if (_this.geocoder) {
    		_this.geocoder.geocode( {'address': address}, function(results, status) {
	     		if (status == google.maps.GeocoderStatus.OK) {
	     			_this.suggestions.length = 0;
	    			var result = results[0];
	    			_this.displayMarker("unique", result.geometry.location);
	    			_this.updateAddressInfoByResult(result);
	    			if (results.length > 1)
	    				_this.displayResultsList(results);
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
		}
	}
	
	this.displayResultsList = function(results) {
		var _this = this;
		var resultsList = document.getElementById('directions_results');
		resultsList.style.display = 'block';
		resultsList.innerHTML = '<p>La dirección ingresada es ambigua, selecciona entre las alternativas:</p>';
		jQuery.each(results, function(idx, result) {
			_this.suggestions['suggestion_'+idx] = result;
			var li = $('<li id="suggestion_'+idx+'">'+result.formatted_address+'</li>');
			li.on('click', _this, function(event) {
				_this = event.data;
				_this.displayMarker("unique", _this.suggestions['suggestion_'+idx].geometry.location);
				_this.updateAddressInfoByResult(_this.suggestions['suggestion_'+idx]);
			});
			$(resultsList).append(li.get(0));
		});
	}
	
	this.clearResultsList = function() {
		var _this = this;
		var directionsResults = document.getElementById('directions_results');
		directionsResults.innerHTML = '';
		_this.suggestions.length = 0;
		directionsResults.style.display = 'none';
	}
};