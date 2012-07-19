/**
 * options:
 *   selector: selector for the graphic container(s)
 *   data: data array with format: [ [legend, value], [legend, value], ... ]
 */
BarGraph = function(options) {
	
	if ( !(this instanceof BarGraph) )
		return new BarGraph();
	
	var _this = this;
	
	_this.settings = $.extend(true, {
		data: []
	}, options);

	if (_this.settings.selector != undefined)
		_this.selector = _this.settings.selector;
	else
		throw "selector is undefined";

	if (_this.settings.width != undefined)
		_this.w = _this.settings.width;
	else
		_this.w = $(_this.selector).width();

	if (_this.settings.width != undefined)
		_this.w = _this.settings.width;
	else
		_this.h = $(_this.selector).height();
	
	
	_this.draw = function(data) {
		
		var cantArray = new Array();
		for (var i=0; i<data.length; i++)
			cantArray.push(data[i][1]);
		var maxX = d3.max(cantArray);
		
		var barH = ( _this.h / data.length ) * 0.50;
		var marginY = barH * 2;
		var marginX = 10;
		var cantContainerW = 40;
		var xStart = _this.w * 0.3;
		
		_this.x = d3.scale.linear().domain([0, maxX]).range([0, (_this.w - xStart) - (cantContainerW + 10) - marginX]);
		_this.y = d3.scale.linear().domain([0, data.length - 1]).range([0 + marginY, _this.h - marginY]);
		
		if (_this.svg)
			_this.svg.remove();
		
		_this.svg = d3.selectAll(_this.selector)
			.append("svg:svg")
			.attr("width", _this.w)
			.attr("height", _this.h)
			.attr("class", "egytca bargraph");
			
		_this.svg.append("svg:line")
			.attr('y1', 0)
			.attr('y2', _this.h)
			.attr('x1', xStart)
			.attr('x2', xStart)
			.attr('class', "xstart-separator");
			
		_this.rows = _this.svg.selectAll("g")
			.data(_this.y.ticks(data.length - 1))
		.enter().append("svg:g")
			.attr("transform", function(d) {return "translate(0, "+ (_this.y(d)) +")"})
		
		_this.bars = _this.rows.append("rect")
			.attr("x", xStart)
			.attr("y", -(barH / 2))
			.attr("width", function(d, i) { return _this.x(data[i][1]) })
			.attr("height", barH)
			
		_this.bars = _this.rows.append("rect")
			.attr("x", xStart)
			.attr("y", -(barH / 2))
			.attr("width", function(d, i) { return _this.x(data[i][1]) })
			.attr("height", barH)
			
		_this.legends = _this.rows.append("svg:text")
			.attr("text-anchor", "end")
			.attr("x", xStart - 5)
			.attr("dy", 4)
			.text(function(i) { return data[i][0]})
			
		_this.counts = _this.rows.append("svg:g")
			.attr("transform", function(d, i) {
				return "translate("+ (xStart + _this.x(data[i][1]) + 10 + cantContainerW / 2) +", 0)";
			})
		
		_this.counts.append("rect")
			.attr("x", -(cantContainerW / 2))
			.attr("y", -(barH / 2))
			.attr("width", cantContainerW)
			.attr("height", barH)
			
		_this.counts.append("svg:text")
			.attr("text-anchor", "middle")
			.attr("dy", 4)
			.text(function(i) { return data[i][1] });
	}
	
	_this.draw(_this.settings.data);
};
