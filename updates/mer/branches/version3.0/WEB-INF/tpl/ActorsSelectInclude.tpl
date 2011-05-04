<form method='get' name='sel'>
	<table class='tableTdBorders' cellspacing='0' cellpadding='0' border='0' width='100%'>
		<tr>
			<th colspan='2'><div class='textTitleTh'>##200,Actores Clave de## &quot;|-$category->getName()-|&quot;</div></th>
		</tr>
		|-foreach from=$principalActors item=actor name=for_principal_actors-|
		<tr>
			<td width="90%" class='tdTextTitle'><a href='Main.php?do=|-$do-|&actor=|-$actor->getId()-|'>|-$actor->getName()-|</a></div></td>
			<td width='10%' nowrap>[ <a href='Main.php?do=|-$do-|&actor=|-$actor->getId()-|' class='deta'>|-if $do eq "analysisActor"-|##236,Ver Análisis##|-else-|Ver Estrategias|-/if-|</a> ]</td>
		</tr>
		|-/foreach-|
		<tr>
			<td class='tdButton' colspan='2'><input name="button" type='button' class='boton' onclick='history.go(-1)' value='##104,Regresar##' /></td>
		</tr>
	</table>
</form>
