<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script>
	$(document).ready(function() {
		$("tbody#actorsList").sortable({
			cursor: 'move',
			revert: true,
			distance: 10, // recien se arrastra despues de mover el mouse X pixeles.
			stop: function() {
				var actorsIds = [];
				$("tbody#actorsList tr").each(function() {
					actorsIds.push($(this).attr('actorId'));
				});
				$.ajax({
					url: 'Main.php?do=actorsDoSortX',
					type: 'post',
					data: { actorsIds: actorsIds }
				});
			}
		});
	});
</script>
<style type="text/css">
<!--
.ui-state-default {cursor: n-resize}
-->
</style>

<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de ##actors,1,Actores##</h1>
<p>A continuación se muestra la lista de ##actors,4,actores## cargados en el sistema. Ordene los ##actors,4,actores## arrastrando los nombres según la jerarquía.</p>
<div id="div_actors"> 
	<table id="tabla-actors" class='tableTdBorders' cellpadding='5' cellspacing='0'> 
		<thead>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">##actors,2,Actor##</th> 
				<th width="40%">##actors,3,Institución##</th> 
			</tr> 
		</thead> 
	<tbody id="actorsList">|-if $actors|@count eq 0-|
		<tr>
			 <td colspan="2">|-if isset($filter)-|No hay ##actors,4,actores## que concuerden con la búsqueda|-else-|No hay ##actors,4,actores## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$actors item=actor name=for_actors-|
		<tr class="ui-state-default" actorId="|-$actor->getId()-|"> 
	<!--		<td>|-$actor->getid()-|</td> -->
			<td>|-if $actor->getTitle() ne ''-||-$actor->getTitle()-| |-/if-||-$actor->getName()-| |-$actor->getSurname()-|</td> 
			<td>|-$actor->getInstitution()-|</td>

		</tr> 
		|-/foreach-|
	</tbody> 
	|-/if-|
	</table> 
</div>
