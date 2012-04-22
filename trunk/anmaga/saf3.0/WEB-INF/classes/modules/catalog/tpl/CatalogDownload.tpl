<script>
var products = [|-foreach from=$products item=product name=for_products-||-$product->toJSON()-|,|-/foreach-|];

db = openDatabase('catalog', '1.0', 'Anmaga Catalog', 2 * 1024 * 1024);
db.transaction(function (tx) {
  tx.executeSql('DROP TABLE products');
  tx.executeSql('CREATE TABLE IF NOT EXISTS products (id, code, name, description, price, salesunit)');
  //tx.executeSql('TRUNCATE TABLE products');
});
db.transaction(function (tx) {
  for (x=0;x<products.length;x++)  {
   tx.executeSql('INSERT INTO products (id, code, name, description, price, salesunit) VALUES (?,?,?,?,?,?)',[products[x].Id,products[x].Code,products[x].Name,products[x].Description,products[x].Price,products[x].Salesunit]);
  }
});

function Product(params) {
  this.code = params.code;
  this.name = params.name;
  this.description = params.description;
  this.price = params.price;
  this.salesunit = params.salesunit;
}

function catalog() {  
	this.create_rows = function() {
  db.transaction(function (tx) {	
	  tx.executeSql('SELECT * FROM products', [], function (tx, results) {
      var len = results.rows.length, i;
      for (i = 0; i < len; i++) {
        var params = results.rows.item(i);
        var product = new Product(params);
        $('#products').append("<tr><td>"+product.code+"</td><td></td><td>"+product.name+"</td><td>"+product.description+"</td><td>"+product.price+"</td><td>"+product.salesunit+"</td></tr>");  
      }
    });
  });
	}
} 

</script>


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

catalog = new catalog();
catalog.create_rows();

</script>
