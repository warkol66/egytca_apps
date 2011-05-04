<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>##12,Sistema para Manejo Estratégico de Relaciones con los Actores Clave##</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/mer.css" type="text/css">
	<!--[if !IE]>--> <link href="css/mer_mozilla.css" rel="stylesheet" type="text/css"> <!--<![endif]-->
	<link rel="shortcut icon" href="images/mer.ico">
	<script src="scripts/functions.js">
	</script>
	<script language="JavaScript" src="scripts/JSViz/DataGraph.js"></script>
	<script language="JavaScript" src="scripts/JSViz/Magnet.js"></script>
	<script language="JavaScript" src="scripts/JSViz/Spring.js"></script>
	<script language="JavaScript" src="scripts/JSViz/Particle.js"></script>
	<script language="JavaScript" src="scripts/JSViz/ParticleModel.js"></script>
	<script language="JavaScript" src="scripts/JSViz/Timer.js"></script>
	<script language="JavaScript" src="scripts/JSViz/EventHandler.js"></script>
	<script language="JavaScript" src="scripts/JSViz/HTMLGraphView.js"></script>
	<script language="JavaScript" src="scripts/JSViz/SVGGraphView.js"></script>
	<script language="JavaScript" src="scripts/JSViz/RungeKuttaIntegrator.js"></script>
	<script language="JavaScript" src="scripts/JSViz/Control.js"></script><!-- Demo Libraries -->
	<script language="JavaScript" src="scripts/JSViz/HTTP.js"></script>
	<script language="JavaScript" src="scripts/JSViz/XMLLoader.js"></script>

	<script language="JavaScript">

		function init() {
											
			var relations = new Array();
			// Create a View to display our model.
			var view;
			var dataGraphNodes = new Array();
			// Create a DataGraph to define the nodes and relationships that we're
			// going to model.
			var dataGraph = new DataGraph();
			var nodeHandler;
	
			// Get the size of our window. We'll keep our model inside these boundaries. 
			var FRAME_WIDTH;
			var FRAME_HEIGHT;
			
			if (document.all) {
				FRAME_WIDTH = document.body.offsetWidth - 5;
				FRAME_HEIGHT = document.documentElement.offsetHeight - 5;
			} else {
				FRAME_WIDTH = window.innerWidth - 5;
				FRAME_HEIGHT = window.innerHeight - 5;
			}
	

			view = new HTMLGraphView( 0, 0, FRAME_WIDTH, FRAME_HEIGHT );


			// Create the model that we'll use to represent the nodes and
			// relationships in our graph.
			var particleModel = new ParticleModel( view );
			particleModel.start();

			// Control contains event handlers that will enable the model to respond
			// to user interaction.
			var control = new Control( particleModel, view );
			
			// A NodeHandler processes the contents of the graph into our model.
			// Let's initialize the Node Handler and start observing the DataGraph.
			nodeHandler = new NodeHandler( dataGraph, particleModel, view, control );
			dataGraph.subscribe( nodeHandler );

			|-foreach from=$actors item=actor-|
			var dataGraphNode = new DataGraphNode(true,1,(|-$actor->getNumericAnswerByLabel("longitud")-|-(|-$centerLongitud-|))*|-$range-|,-(|-$actor->getNumericAnswerByLabel("latitud")-|-(|-$centerLatitud-|))*|-$range-|);
			dataGraphNode.name = '|-$actor->getName()-|';
			dataGraph.addNode(dataGraphNode);
			dataGraphNodes[|-$actor->getId()-|] = dataGraphNode;
			nodeHandler.addParticle(dataGraphNode);  
			|-/foreach-|

			|-foreach from=$relations item=relation name=for_relations-|
				props = {
					'pixelColor': '|-$relation.color-|',
					'pixelWidth': '|-$relation.rels-|px',
					'pixelHeight': '|-$relation.rels-|px',
					'pixels': 300
				};
				view.addEdge( dataGraphNodes[|-$relation.actor1-|].particle, dataGraphNodes[|-$relation.actor2-|].particle, props );
			|-/foreach-|

			}

			/**
			 * The NodeHandler is responsible for translating our Data Model (DataGraph)
			 * into a ParticleModel and View.
			 * 
			 * @param {DataGraph} dataGraph
			 * @param {ParticleModel} particleModel
			 * @param {GraphView} view
			 */
			var NodeHandler = function( dataGraph, particleModel, view, control ) {
				
				this.dataGraph = dataGraph;
				this.particleModel = particleModel;
				this.view = view;
				this.control = control;
				
				this.queue = new Array();

				/*
				 * Handle a new node.
				 *  
				 * @param {DataGraphNode} dataGraphNode
				 */
				this['newDataGraphNode'] = function( dataGraphNode ) {
					this.enqueueNode( dataGraphNode );						
				}

				/*
				 * Handle a new relationship.
				 *  
				 * @param {DataGraphNode} nodeA
				 * @param {DataGraphNode} nodeB
				 */
				this['newDataGraphEdge'] = function( nodeA, nodeB ) {
					// In this demo, we're modeling a tree structure. All relationships are parent-child
					// and available when newDataGraphNode is called. We'll leave this function empty.
							props = {
								'pixelColor': '#888888',
								'pixelWidth': '2px',
								'pixelHeight': '2px',
								'pixels': 300
							};
							var viewEdge = view.addEdge(nodeA.particle,nodeA.particle,props);
							//view.drawEdge(nodeA.particle,nodeA.particle);
				}

				/*
				 * Enqueue a node for modeling later.
				 * 
				 * @param {DataGraphNode} dataGraphNode
				 */
				this['enqueueNode'] = function( dataGraphNode ) {
					this.queue.push( dataGraphNode );
				}

				/*
				 * Dequeue a node and create a particle representation in the model.
				 * 
				 * @param {DataGraphNode} dataGraphNode
				 */
				this['dequeueNode'] = function() {
					var node = this.queue.shift();
					if ( node ) {
						this.addParticle( node );						
					}
				}

				/*
				 * Called by timer to control dequeuing of nodes into addParticle.
				 */
				this.update = function() {
					this.dequeueNode();
				}

				/*
				 * Add a particle to the model and view.
				 * 
				 * @param {DataGraphNode} node
				 */
				this['addParticle'] = function( dataGraphNode ) {

					// Create a particle to represent this data node in our model.
					particle = this.particleModel.makeParticle( dataGraphNode.mass, dataGraphNode.x, dataGraphNode.y );
					particle.positionX = dataGraphNode.x;
					particle.positionY = dataGraphNode.y;

					var bubble = document.createElement( 'div' );
					bubble.style.position = "absolute";
					bubble.style.width = "90px";
					bubble.style.height = "12px";
					bubble.style.textAlign = "center";
					bubble.style.verticalAlign  = "auto";

					bubble.innerHTML = '<br class="brBubbleBefore" /><img src="images/bubble.png" /><br class="brBubbleAfter" /><span class="bubbleTitle">'+dataGraphNode.name+'</span>';
					bubble.onmousedown =  new EventHandler( control, control.handleMouseDownEvent, particle.id )
					var viewNode = this.view.addNode( particle, bubble);

					// Determine if this particle's position should be fixed.
					if ( dataGraphNode.fixed ) { particle.fixed = true; }

					dataGraphNode.particle = particle;

					// Set a width and height for this particle for bounds checking
					particle.width=12;
					particle.height=12;

					dataGraphNode.viewNode = viewNode;
					return dataGraphNode;
				}
			}
		</script>
</head>
<body leftmargin='2' topmargin='2' onload="init()">
	|-$centerHTML-|
</body>
</html>
