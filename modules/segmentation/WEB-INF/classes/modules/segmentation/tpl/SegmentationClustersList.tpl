<h2>Segmentación</h2>
<h1>Grupos de Usuarios</h1>
<div id="div_segmentationclusters">
	<p>
	A continuación se presentan los envíos programados de newsletters realizados por el sistema. Puede agregar uno nuevo, editar uno existente o eliminarlo.
	</p>
	|-if $message eq "ok"-|
		<div class="resultSuccess">Segmentation Cluster guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="resultSuccess">Segmentation Cluster eliminado correctamente</div>
	|-/if-|
	<table width="100%" cellpadding="0" cellspacing="0" id="tabla-segmentationclusters" class="tableTdBorders">
		<col width="5%">
		<col width="90%">
		<col width="5%">
			<thead>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=segmentationClustersEdit" class="addLink">Agregar Grupo</a></div></th>
			</tr>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$segmentationclusters item=segmentationcluster name=for_segmentationclusters-|
			<tr>
				<td>|-$segmentationcluster->getid()-|</td>
				<td>|-$segmentationcluster->getname()-|</td>
				<td nowrap="nowrap"><form action="Main.php" method="get">
						<input type="hidden" name="do" value="segmentationClustersEdit" />
						<input type="hidden" name="id" value="|-$segmentationcluster->getid()-|" />
						<input type="submit" name="submit_go_edit_segmentationcluster" value="Editar" class="buttonImageEdit" title="Editar información del grupo" />
					</form>
				<form action="Main.php" method="get">
						<input type="hidden" name="do" value="segmentationClustersPreview" />
						<input type="hidden" name="id" value="|-$segmentationcluster->getid()-|" />
						<input type="submit" name="submit_go_preview_segmentationcluster" value="Preview" class="buttonImageView" title="Vista previa de integrantes del grupo" />		
				</form>					
				<form action="Main.php" method="post">
						<input type="hidden" name="do" value="segmentationClustersDoDelete" />
						<input type="hidden" name="id" value="|-$segmentationcluster->getid()-|" />
						<input type="submit" name="submit_go_delete_segmentationcluster" value="Borrar" onclick="return confirm('Seguro que desea eliminar el grupo?')" class="buttonImageDelete" title="Eliminar grupo" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=segmentationClustersEdit" class="addLink">Agregar Grupo</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
