<div id="clientQuoteItemAdder">
<h1>Busqueda y Agregado de Productos</h1>

	<div id="productSearch">
		<form action="Main" method="post">
			<p>
				<label for="productSearchLabel">Busqueda de Productos</label>
				<input type="text" name="productSearch[query]" value="" />
				<input type="hidden" name="do" value="importProductSearchX" />
				<input type="button" value="Buscar Productos" name="productSearchButton" onClick="javascript:importSearchProductsX(this.form)"/> <div id="productSearchMsgBox"></div>
				<input type="hidden" name="clientQuoteId" value="|-$clientQuote->getId()-|">
			</p>
		</form>
	</div>	 
	<div id="productAdder">
	</div>
	<br />
</div>