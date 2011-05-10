DistributionMap = function() {
	this.parent = BaseMap;
	this.parent();
	
	this.markerOnClick = function(marker){
		var markerId = this.idsByPosition[marker.getPosition()];
		var div = $('div_'+markerId)
		if (div != undefined) {
			div.toggle(); 
			document.location.href = '#div_'+markerId;
		}
	};
};
