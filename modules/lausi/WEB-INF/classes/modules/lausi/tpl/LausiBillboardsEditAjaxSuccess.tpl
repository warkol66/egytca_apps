<li id="billboardListItem|-$billboard->getId()-|">Número: |-$billboard->getNumber()-| - Fila: |-$billboard->getRow()-| - Columna:|-$billboard->getColumn()-| 

<form method="post">
	<input type="hidden" name="do" value="lausiBillboardsDoDelete" />
	<input type="hidden" name="mode" value="ajax" />
	<input type="hidden" name="id" value="|-$billboard->getId()-|" />
	<input type="button" value="Eliminar" onClick="javascript:lausiDeleteBillboard(this.form)"/>	
</form>

</li>

