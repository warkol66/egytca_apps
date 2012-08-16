	|-if $isTreeRoot-|
		<h1><a href="javascript:void(null);" onClick="$('|-get_class($root)-||-$root->getId()-|').toggle();">|-$root-|</a></h1>
			|-assign var=isTreeRoot value=false-|
	|-else-|
		|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
			<p>|-if get_class($root) eq "PlanningProject" || get_class($root) eq "PlanningConstruction"-|
			|-if $root->getActivities()|count gt 0-|
				|-if get_class($root) eq "PlanningProject"-|
					<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningProjectsViewX&showGantt=true&id=|-$root->getId()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" /> |-else-|
					<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningConstructionsViewX&showGantt=true&id=|-$root->getId()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" /> |-/if-|
				|-else-|<img src="images/clear.png" class="icon iconClear disabled" title="No hay actividades definidas, no se puede generar el Gantt correspondiente" /> |-/if-|
				|-if get_class($root) eq "PlanningProject"-| <a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningProjectsShowDiv", "Main.php?do=planningProjectsViewX&id=|-$root->getid()-|", { method: "post", parameters: { id: "|-$root->getId()-|"}, evalScripts: true})};$("planningProjectsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Proyecto...</span>";' value="Ver detalle del proyecto" name="submit_go_show_project" title="Ver detalle del proyecto" /></a>|-/if-|
					
					|-/if-| &nbsp; &nbsp; <a href="javascript:void(null);" onClick="$('|-get_class($root)-||-$root->getId()-|').toggle();">|-$root-|</a></p>
			|-else-|
			<p>|-$root-|</p>
		|-/if-|
	|-/if-|
	|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
		<div id="|-get_class($root)-||-$root->getId()-|" class="|-get_class($root)-|" style="display:none">
		|-assign var=descendants value=$root->getBrood()-|
		|-foreach $descendants as $descendant-|
			|-if $descendant@first-|<h4>
				|-if get_class($descendant) eq "ImpactObjective"-|Objetivos de Impacto
				|-else if get_class($descendant) eq "MinistryObjective"-|Objetivos Ministeriales
				|-else if get_class($descendant) eq "OperativeObjective"-|Objetivos Operativos
				|-else if get_class($descendant) eq "PlanningProject"-|Proyectos
				|-else if get_class($descendant) eq "PlanningConstruction"-|Obras
				|-else if get_class($descendant) eq "PlanningActivity"-|Hitos
				|-else-|&nbsp;|-/if-|</h4>
			|-/if-|
			|-include file="PlanningTreeDivsInclude.tpl" root=$descendant first=$first-|
		|-/foreach-|
		</div>
	|-/if-|
