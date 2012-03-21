<?php


class OrdersImportPlugin {

	/*
	* Obtiene el separador de campos.
	*
	* @return string Separador de campo utilizado
	*/
	function getSeparator() {
		return ";";
	}

	/*
	* Obtiene las ordenes en un formato comun.
	*
	* @param array $rows Ordenes leidas del archivo de importacion
	* @return array Ordenes en formato comun
	*/	
	function getOrders($rows) {

						
		/*
			formato download.csv
			01 Encabezado
			detalle o encabezado; Nro de pedido; Fecha del pedido; Fecha ; Fecha; Razón social; Responsable; email responsable; Empresa provedora; Nro Proveedor; Sucursal; Código Sucursal; Dirección Sucursal;  Tipo de PEdido;
			02 Detalle
			detalle o encabezado; Nro de pedido; código de producto; descripcion; código anmaga; Cantidad; Unidad; Total; Unidades por empaque; no se;Precio por unidad; total					
		*/
		$orders = array();
		foreach ($rows as $row) {
			if ($row[0] == "1") { //Es un encabezado
				if ( !empty($row[1]) && !empty($row[2]) && !empty($row[11]) ) {
					$order = array();
					$order["number"] = $row[1];

/* El 7 de Mayo de 2010 se modifican los separadores
						//saco los . por ser posibles separadores de miles
						$row[19] = str_replace('.','',$row[19]);  
						//reemplazo la , del separador decimal por .
						$row[19] = str_replace(',','.',$row[19]);				
					$order["total"] = $row[19];
						//saco los . por ser posibles separadores de miles
						$row[18] = str_replace('.','',$row[18]);  
						//reemplazo la , del separador decimal por .
						$row[18] = str_replace(',','.',$row[18]);				
					$order["tax"] = $row[18];
						//saco los . por ser posibles separadores de miles
						$row[17] = str_replace('.','',$row[17]);  
						//reemplazo la , del separador decimal por .
						$row[17] = str_replace(',','.',$row[17]);				
*/

					//saco las , por ser posibles separadores de miles
						$row[19] = str_replace(',','',$row[19]);  
					$order["total"] = $row[19];
					//saco las , por ser posibles separadores de miles
						$row[18] = str_replace(',','',$row[18]);  
					$order["tax"] = $row[18];
					//saco los . por ser posibles separadores de miles
						$row[17] = str_replace(',','',$row[17]);  
					$order["subtotal"] = $row[17];


					$order["created"] = $row[2];
					$order["branchNumber"] = $row[11];
					$order["modifiedProductCodes"] = false;
					$orders[$order["number"]] = $order;
				}							
			}
			if ($row[0] == "2") { //Es un detalle
				if ( !empty($row[1]) && !empty($row[4]) && !empty($row[7]) && !empty($row[10]) ) {
					$item = array();
					$item["orderNumber"] = $row[1];
					$item["productCode"] = str_pad($row[4], strlen($row[4])+1, "0", STR_PAD_LEFT);
					$item["affiliateProductCode"] = $row[2];
					$item["quantity"] = $row[7];

/* El 7 de Mayo de 2010 se modifican los separadores
					//saco los . por ser posibles separadores de miles
					$row[10] = str_replace('.','',$row[10]);  
					//reemplazo la , del separador decimal por .
					$row[10] = str_replace(',','.',$row[10]);				
*/

					//saco las , por ser posibles separadores de miles
						$row[10] = str_replace(',','',$row[10]);  
					$item["price"] = $row[10];
					$orders[$item["orderNumber"]]["items"][] = $item;
				}							
			}						
		}
		
		return $orders;
	}
	
	/*
	* Obtiene las ordenes en un formato comun a partir de un archivo de ordenes.
	*
	* @param string $file Nombre del archivo de ordenes
	* @return array Ordenes en formato comun
	*/		
	function getOrdersFromFile($file) {
		
		$handle = fopen($file, "r");    
		$rows = array();
		$separator = OrdersImportPlugin::getSeparator();
		while (($data = fgetcsv($handle, 1000, $separator)) !== FALSE) {
					$rows[] = $data;
		}
		fclose($handle);  	

		$orders = OrdersImportPlugin::getOrders($rows); 				
		return $orders;
	}	
	
}