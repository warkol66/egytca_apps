//
// This work is licensed under the Creative Commons Attribution 2.5 License.
//
// To view a copy of this license, visit:
//   http://creativecommons.org/licenses/by/2.5/
//
// or send a letter to:
//   Creative Commons
//   543 Howard Street, 5th Floor
//   San Francisco, California, 94105, USA.
//
// All copies and derivatives of this source must contain the license statement 
// above and the following attribution:
//
// Author: Kyle Scholz      http://kylescholz.com/
// Copyright: 2006
//

/**
 * Seed DataGraph with contents of an XML tree structure.
 * 
 * @author Kyle Scholz
 * 
 * @version 0.1
 */
var XMLLoader = function( dataGraph ) {
	this.init( dataGraph );
}
XMLLoader.prototype = {

	/*
	 * Initialize instance.
	 * 
	 * @param {HTTP} http
	 */
	init: function( dataGraph ) {
		this.http = new HTTP();

		this.dataGraph = dataGraph;
	},

	/*
	 * Fetch XML data for processing
	 */
	load: function( url ) {
		this.http.get( url, this, this.handle );
	},
	
	/*
	 * Process XML data in DataGraph.
	 * 
	 * @param {XMLHTTPRequest} request
	 */
	handle: function( request ) {

		var xmlDoc = request.responseXML;

		var root = xmlDoc.getElementsByTagName("root")[0];

		// Add Root Node
		var rootNode = new DataGraphNode( true );
		var mass = root.getAttribute("mass");
		rootNode.mass = mass;
		var color = root.getAttribute("color");
		rootNode.color = color;
		var x = root.getAttribute("x");
		rootNode.x = x;
		var y = root.getAttribute("y");
		rootNode.y = y;


		this.dataGraph.addNode( rootNode );

		// Add children
		this.branch( root, rootNode );
	},

	branch: function( root, rootNode ) {
		var childNodes = root.childNodes;
		for( var i=0, l=childNodes.length; i<l; i++ ){
			if( childNodes[i].nodeName == "node" ) {
				var node = new DataGraphNode( false );
				node.parent = rootNode;
				var mass = childNodes[i].getAttribute("mass");
				node.mass = mass;
				var color = childNodes[i].getAttribute("color");
				node.color = color;
				var x = childNodes[i].getAttribute("x");
				node.x = x;
				var y = childNodes[i].getAttribute("y");
				node.y = y;

				this.dataGraph.addNode( node );
				
				this.branch( childNodes[i], node );
			}
		}
	}
}
