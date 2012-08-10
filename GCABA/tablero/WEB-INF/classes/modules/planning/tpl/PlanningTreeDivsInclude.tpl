	|-if $isTreeRoot-|
		<h1><a href="javascript:void(null);" onClick="$('#|-get_class($root)-||-$root->getId()-|').toggle();">|-$root-|</a></h1>
			|-assign var=isTreeRoot value=false-|
	|-else-|
		|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
			<p><a href="javascript:void(null);" onClick="$('#|-get_class($root)-||-$root->getId()-|').toggle();">|-$root-|</a></p>
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
