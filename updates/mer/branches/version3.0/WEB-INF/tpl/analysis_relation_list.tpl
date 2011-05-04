
	<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tablaborde'>
<tr>

<th colspan='2'>
<form method="GET" action="Main.php" style="display:inline">
	<input type="hidden" name="do" value="|-$smarty.request.do-|" />
	<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
Relaciones entre |-$actor1->getName()-| y <select name='actor2' onchange="this.form.submit()">|-html_options options=$actors selected=$actor2->getId() -|</select>
</form>
</th>

</tr>
</table>
<br />

|-if $actor1->getId() and $actor2->getId()-|

<a href="Main.php?do=analysisCompareRel&actor=|-$actor1->getId()-|&actor2=|-$actor2->getId()-|">Nuevo Grafico</a>

<table class='tablaborde0'>
	<thead>
		<tr>
			<th>Name</th><th>Judgement</th><th></th>
		</tr>
	</thead>
	<tbody>
	|-foreach from=$graphs item=graph-|
		<tr>
			<td>
				<span>|-$graph->getName()-|</span>
			</td>
			<td>|-$graph->getJudgement()-|</td>
			<td>
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="analysisGraphRelationDoEdit" />
					<input type="hidden" name="id" value="|-$graph->getId()-|" />
          <input type="hidden" name="graphName" value="|-$graph->getName()-|" />
					<input type="submit" value="Cambiar Nombre" class="boton" onclick="return changeNameGraphRelation(this.parentNode)" />
				</form>
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="analysisGraphRelationDoDelete" />
					<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
					<input type="hidden" name="actor2" value="|-$actor2->getId()-|" />
					<input type="hidden" name="id" value="|-$graph->getId()-|" />
					<input type="submit" value="Borrar" onclick="return confirm('Seguro que desea eliminar el grafico?')" class="boton" />
				</form>
			</td>			
		</tr>
	|-/foreach-|
	</tbody>
</table>

|-/if-|

