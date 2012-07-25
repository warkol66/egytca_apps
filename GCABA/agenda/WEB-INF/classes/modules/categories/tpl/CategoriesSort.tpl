<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script>
	$(document).ready(function() {
		$("tbody#categoriesList").sortable({
			cursor: 'move',
			revert: true,
			distance: 10, // recien se arrastra despues de mover el mouse X pixeles.
			stop: function() {
				var categoriesIds = [];
				$("tbody#categoriesList tr").each(function() {
					categoriesIds.push($(this).attr('categoryId'));
				});
				$.ajax({
					url: 'Main.php?do=categoriesDoSortX',
					type: 'post',
					data: { categoriesIds: categoriesIds }
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
<h1>Administración de Dependencias</h1>
<p>A continuación se muestra la lista de dependencias cargados en el sistema. Ordene las dependencias arrastrando los nombres según la jerarquía.</p>
<div id="div_categories"> 
	<table id="tabla-categories" class='tableTdBorders' cellpadding='5' cellspacing='0'> 
		<thead>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">Dependencia</th> 
				<th width="40%">Responsable</th> 
			</tr> 
		</thead> 
	<tbody id="categoriesList">|-if $categories|@count eq 0-|
		<tr>
			 <td colspan="2">|-if isset($filter)-|No hay dependencias que concuerden con la búsqueda|-else-|No hay dependencias disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$categories item=category name=for_categories-|
		<tr class="ui-state-default" categoryId="|-$category->getId()-|"> 
	<!--		<td>|-$category->getid()-|</td> -->
			<td>|-$category-|</td> 
			<td>|-$category->getResponsible()-|</td>

		</tr> 
		|-/foreach-|
	</tbody> 
	|-/if-|
	</table> 
</div>
