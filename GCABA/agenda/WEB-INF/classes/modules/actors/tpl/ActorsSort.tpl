<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script>
	$(document).ready(function() {
		$("tbody#actorsList").sortable({
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
<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de ##actors,1,Actores##</h1>
<p>A continuación se muestra la lista de ##actors,4,actores## cargados en el sistema.</p>
<div id="div_actors"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##actors,2,Actor## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##actors,2,Actor## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-actors" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">##actors,2,Actor##</th> 
				<th width="40%">##actors,3,Institución##</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody id="actorsList">|-if $actors|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay ##actors,4,actores## que concuerden con la búsqueda|-else-|No hay ##actors,4,actores## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$actors item=actor name=for_actors-|
		<tr class="ui-state-default" actorId="|-$actor->getId()-|"> 
	<!--		<td>|-$actor->getid()-|</td> -->
			<td>|-if $actor->getTitle() ne ''-||-$actor->getTitle()-| |-/if-||-$actor->getName()-| |-$actor->getSurname()-|</td> 
			<td>|-$actor->getInstitution()-|</td>
			<td nowrap>|-if "actorsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="actorsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$actor->getid()-|" /> 
					<input type="submit" name="submit_go_edit_actor" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "actorsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="actorsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$actor->getid()-|" /> 
					<input type="submit" name="submit_go_delete_actor" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##actors,2,Actor##?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
	</tbody> 
	|-/if-|
	</table> 
</div>
