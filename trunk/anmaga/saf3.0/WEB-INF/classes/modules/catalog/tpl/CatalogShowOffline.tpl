
  <div id="messageCart" style="position:fixed; right: 50px; top: 5px;">
	</div>

  <a href="#" onclick="catalogDownload()">Descargar Catalogo</a>

	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products"> 
		<COL>
		<COL>
		<COL id="description" class="colCollapse">
		<thead> 
			<tr> 
				<th width="5%" colspan="2">Código</th> 
				<th width="35%">Nombre</th> 
				<th width="30%">Descripción</th> 
				<th width="5%">Precio Unitario</th> 
				<th width="5%">Unidad de Venta</th>
				<th width="4%">Precio</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody id="products"> 		</tbody> 
	</table> 

<script>
cart = new Cart();
catalog = new Catalog();
catalog.create_rows();

</script>
