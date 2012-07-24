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
		data: [],
		xRelStart: 0.3
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
		var cantContainerW = 10;
		var xStart = _this.w * _this.settings.xRelStart;
		
		_this.x = d3.scale.linear().domain([0, maxX]).range([0, (_this.w - xStart) - (cantContainerW + 10) - marginX]);
		_this.y = d3.scale.linear().domain([0, data.length - 1]).range([0 + marginY, _this.h - marginY]);
		
		if (_this.svg)
			_this.svg.remove();
		
		_this.svg = d3.selectAll(_this.selector)
			.append("svg:svg")
			.attr("width", _this.w)
			.attr("height", _this.h)
			.attr("class", "egytca bargraph");
			
		_this.rows = _this.svg.selectAll("g")
			.data(_this.y.ticks(data.length - 1))
		.enter().append("svg:g")
			.attr("transform", function(d) {return "translate(0, "+ (_this.y(d)) +")"})
		
		var colors = [
			["#4682B4", "#4682B4"] /*, // 2 colores iguales y el gradiente no se nota
			["#fdd406", "#fdd406"], // 2 colores iguales y el gradiente no se nota
			["#B8860B", "#B8860B"],
			["#00008B", "#00008B"],
			["#8B0000", "#8B0000"],
			["#F5F5F5", "#F5F5F5"],
			["#B22222", "#B22222"],
			["#008080", "#008080"],
			["#FF8C00", "#FF8C00"],
			["#7B68EE", "#7B68EE"],
			["#1E90FF", "#1E90FF"],
			["#40E0D0", "#40E0D0"],
			["#00FF00", "#00FF00"],
			["#BDB76B", "#BDB76B"],
			["#FFDEAD", "#FFDEAD"]*/
		]
		var grad = new GradientSupplier(_this.svg, colors);
			
		_this.bars = _this.rows.append("rect")
			.attr("x", xStart)
			.attr("y", -(barH / 2))
			.attr("width", function(d, i) { return _this.x(data[i][1]) > 0 ? _this.x(data[i][1]) : 1 })
			.attr("height", barH)
			
		_this.bars = _this.rows.append("rect")
			.attr("x", xStart)
			.attr("y", -(barH / 2))
			.attr("width", function(d, i) { return _this.x(data[i][1]) })
			.attr("height", barH)
			.style("fill", function() { return "url("+grad.getNext()+")" })
			
		_this.legends = _this.rows.append("svg:text")
			.attr("text-anchor", "end")
			.attr("x", xStart - 5)
			.attr("dy", 4)
			.text(function(i) { return data[i][0]})
			
		_this.counts = _this.rows.append("svg:g")
			.attr("transform", function(d, i) {
				return "translate("+ (xStart + _this.x(data[i][1]) + 10 + cantContainerW / 2) +", 0)";
			})
		
/*		_this.counts.append("rect")
			.attr("x", -(cantContainerW / 2))
			.attr("y", -(barH / 2))
			.attr("width", cantContainerW)
			.attr("height", barH)
*/			
		_this.counts.append("svg:text")
			.attr("text-anchor", "middle")
			.attr("dy", 4)
			.text(function(i) { return data[i][1] });
			
		_this.svg.append("svg:line")
			.attr('y1', 0)
			.attr('y2', _this.h)
			.attr('x1', xStart)
			.attr('x2', xStart)
			.attr('class', "xstart-separator");
	}
	
	var GradientSupplier = function(svg, colors) {
		
		var gradients = svg.append("svg:defs").selectAll("linearGradient")
			.data(colors)
		.enter().append("svg:linearGradient")
			.attr("id", function(d,i) { return "gradient"+i })
			.attr("x1", "0%")
			.attr("y1", "0%")
			.attr("x2", "100%")
			.attr("y2", "100%")
			.attr("spreadMethod", "pad");

		gradients.append("svg:stop")
			.attr("offset", "0%")
			.attr("stop-color", function(d) { return d[0] })
			.attr("stop-opacity", 1);

		gradients.append("svg:stop")
			.attr("offset", "100%")
			.attr("stop-color", function(d) { return d[1] })
			.attr("stop-opacity", 1);

		this.length = colors.length;
		this.count = 0;
		this.getNext = function() {
			if (this.count == this.length)
				this.count = 0;
			return "#gradient"+(this.count++);
		}
	}
	
	_this.draw(_this.settings.data);
};
