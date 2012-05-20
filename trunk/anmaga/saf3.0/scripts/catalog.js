db = openDatabase('catalog', '1.0', 'Anmaga Catalog', 2 * 1024 * 1024);

function ordersAddItemToCartX(form) {  
  //TODO: mejorar
  var code = form.elements[1].value;
  var quantity = form.elements[0].value;
  
	$('#messageCart').html("<span class='inProgress'>Agregando al carrito...</span>");
  
  cart.add_product(code,quantity);
  
  $('#messageCart').html("<span class='resultSuccess'>Producto agregado al carrito</span>");
} 

function ordersRemoveItemCartX(form) {
  //TODO: mejorar
  var code = form.elements[0].value;  
  
	$('#messageCart').html("<span class='inProgress'>Eliminando producto del carrito...</span>");
  
  cart.remove_product(code);
  
  $("#product_"+code).remove();
  
  $('#messageCart').html("<span class='resultSuccess'>Producto eliminado</span>");
}

function ordersChangeItemCartX(form) {

  //TODO: mejorar
  var code = form.elements[1].value;
  var quantity = form.elements[0].value;
  
	$('#messageCart').html("<span class='inProgress'>Agregando al carrito...</span>");
  
  cart.set_quantity(code,quantity);
  
  $('#messageCart').html("<span class='resultSuccess'>Producto agregado al carrito</span>");
}

function catalogDownload() {
  $('#messageCart').html("<span class='inProgress'>Descargando catalogo...</span>");
  $.getJSON('Main.php',{do: "catalogDownload"}, function(products) {
    //Todo corregir esto
    catalog = new Catalog();    
    catalog.initialize(products);
    catalog.create_rows();

    $('#messageCart').html("<span class='resultSuccess'>Catalogo descargado</span>");
  });
}

function Cart() {
  this.add_product = function(code,quantity) {
    db.transaction(function (tx) {      
	    tx.executeSql('SELECT * FROM cart where code = ?', [code], function (tx, results) {
        var len = results.rows.length;
        if (len == 0) {
          tx.executeSql('INSERT INTO cart (code, quantity) VALUES (?,?)',[code,quantity]);        
        } else {
          params = results.rows.item(0);
          var actualQuantity = params.quantity;
          var totalQuantity = parseInt(actualQuantity) + parseInt(quantity);
          tx.executeSql('UPDATE cart set quantity = ? WHERE code = ?',[totalQuantity,code]);        
        }
      });
    });    
  };

  this.set_quantity = function(code,quantity) {
    db.transaction(function (tx) {            
      tx.executeSql('UPDATE cart set quantity = ? WHERE code = ?',[quantity,code]);        
    });
  };
  
  this.remove_product = function(code) {
    db.transaction(function (tx) {            
      tx.executeSql('DELETE FROM cart WHERE code = ?',[code]);        
    });
  };  

  this.create_rows = function() {
  db.transaction(function (tx) {	
	  tx.executeSql('SELECT * FROM cart left join products on cart.code = products.code', [], function (tx, results) {
      var len = results.rows.length, i;
      for (i = 0; i < len; i++) {
        var params = results.rows.item(i);
        var product = new Product(params);
        var itemPrice = parseFloat(product.price) * parseInt(params.quantity);
        var row = "<tr id='product_"+product.code+"'><td>"+product.code+"</td><td>"+product.name+"</td><td nowrap align='right'>"+product.price+"</td><td align='center' nowrap>"+product.salesunit+"</td><td align='center' nowrap>"+itemPrice+"</td><td>";
                
        row += '<form>';
        row += '<input type="text" name="quantity" value="'+params.quantity+'" size="3" />';
        row += '<input type="hidden" name="productCode" value="'+product.code+'" />';
				row += '<input type="hidden" name="do" value="ordersAddItemToCartX" />';
        row += '<input type="button" value="Agregar" class="icon iconAddToCart" onclick="javascript:ordersChangeItemCartX(this.form)" />';
        row += '</form>';          
        
				row += '<form>';
				row += '<input type="hidden" name="productCode" value="'+product.code+'" />';
				row += '<input type="hidden" name="do" value="ordersRemoveItemCartX" />';
				row += '<input type="button" value="Eliminar" class="icon iconRemoveFromCart" title="Eliminar del carrito" alt="Eliminar del carrito" onclick="javascript:ordersRemoveItemCartX(this.form)" />';
				row += '</form>';          
          
        row += "</td></tr>";  
        
        $('#products').append(row);
      }
    });
  });
  };  
}

function Product(params) {
  this.code = params.code;
  this.name = params.name;
  this.description = params.description;
  this.price = params.price;
  this.salesunit = params.salesunit;
}

function Catalog() {  

  this.initialize = function(products) {
    db.transaction(function (tx) {
      tx.executeSql('DROP TABLE IF EXISTS products');
      tx.executeSql('CREATE TABLE products (id, code, name, description, price, salesunit)');
      tx.executeSql('DROP TABLE IF EXISTS cart');
      tx.executeSql('CREATE TABLE cart (code, quantity)');    
    });
    db.transaction(function (tx) {
      $.each(products, function(index, product) {
       tx.executeSql('INSERT INTO products (id, code, name, description, price, salesunit) VALUES (?,?,?,?,?,?)',[product.Id,product.Code,product.Name,product.Description,product.Price,product.Salesunit]);
      })
    });
  }
  
  this.create_rows = function() {
  db.transaction(function (tx) {	
	  tx.executeSql('SELECT * FROM products', [], function (tx, results) {
      var len = results.rows.length, i;
      for (i = 0; i < len; i++) {
        var params = results.rows.item(i);
        var product = new Product(params);
        var row = "<tr><td>"+product.code+"</td><td></td><td>"+product.name+"</td><td>"+product.description+"</td><td>"+product.price+"</td><td>"+product.salesunit+"</td><td>";
        
        if (product.price != 0) {
          row += '<form>';
          row += '<input type="text" name="quantity" value="0" size="3" />';
          row += '<input type="hidden" name="productCode" value="'+product.code+'" />';
					row += '<input type="hidden" name="do" value="ordersAddItemToCartX" />';
          row += '<input type="button" value="Agregar" class="icon iconAddToCart" onclick="javascript:ordersAddItemToCartX(this.form)" />';
				  row += '</form>';
        }
        
        row += "</td></tr>";  
        
        $('#products').append(row);
      }
    });
  });
	}

} 
