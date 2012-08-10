	|-if $isTreeRoot-|
		<h4><a href="javascript:void(null);" onClick="$('#|-get_class($root)-||-$root->getId()-|').toggle();" style="display:block; text-decoration: none; ">|-$root-|</a></h4>
			|-assign var=isTreeRoot value=false-|
	|-else-|
		<a href="javascript:void(null);" onClick="$('#|-get_class($root)-||-$root->getId()-|').toggle();" style="display:block; text-decoration: none; ">|-$root-|</a>
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
