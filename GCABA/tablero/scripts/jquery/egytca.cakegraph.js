/**
 * params:
 *   containerId: id del container
 *   data: array con los valores a graficar
 *   color: funcion que recibe el indice de un valor en el array data y devuelve un color
 */
CakeGraph = function(params) {
	
	var _this = this;
	
	var selector = params.selector;
	var data = params.data;
	var color = params.color;
	
	var w = $(selector).width();
	var h = $(selector).height();
	var r = Math.min(w, h) / 2;
	
	_this.color = color;
	_this.cake = d3.layout.pie().sort(null);
	_this.arc = d3.svg.arc().innerRadius(0).outerRadius(r);
	
	_this.svg = d3.select(selector).append('svg:svg')
		.attr('width', w)
		.attr('height', h)
		.append('svg:g')
		.attr('transform', 'translate(' + w / 2 + ',' + h / 2 + ')');
	
	_this.arcs = _this.svg.selectAll('path')
		.data(_this.cake(data))
		.enter().append("svg:path")
		.attr("fill", function(d, i) { return _this.color(i) })
		.attr("d", _this.arc)
		.each(function(d) { this._current = d; });
	
	// Store the currently-displayed angles in this._current.
	// Then, interpolate from this._current to the new angles.
	_this.arcTween = function(a) {
		var i = d3.interpolate(this._current, a);
		this._current = i(0);
		return function(t) {
			return _this.arc(i(t));
		};
	}
	
	_this.update = function(data) {
		_this.arcs = _this.arcs.data(_this.cake(data));
		_this.arcs.transition().duration(750).attrTween("d", _this.arcTween);
	}
	
}