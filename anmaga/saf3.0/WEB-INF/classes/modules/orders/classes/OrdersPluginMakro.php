<?php


class OrdersImportPlugin {

	/*
	* Obtiene el separador de campos.
	*
	* @return string Separador de campo utilizado
	*/
	function getSeparator() {
		return ",";
	}

	/*
	* Obtiene las ordenes en un formato comun.
	*
	* @param array $rows Ordenes leidas del archivo de importacion
	* @return array Ordenes en formato comun
	*/		
	function getOrders($rows) {

		/*
			formato orders_V....csv
			Nro,Tipo,Nro Prov,Nro Suc Prov,Tienda,Estado,Emision,Entrega,Planific Entrega,PlanificaciÃ³n,Import,Total Import,Cant Total,Cant Pallet,Cant Camadas,Cod Art Prov,Cod Art Makro,Cant Recebida,Cant Pedida,1era Compra,Costo,Costo Neto,Folder
		*/	
		$orders = array();				
		foreach ($rows as $row) {						
			if ( !empty($row[0]) && is_numeric($row[0]) && !empty($row[15]) && !empty($row[18]) && !empty($row[21]) && !empty($row[6]) && !empty($row[4]) ) {
				$item = array();
				$item["orderNumber"] = $row[0].$row[4];
				$item["productCode"] = str_pad($row[15], strlen($row[15])+1, "0", STR_PAD_LEFT);
				$item["affiliateProductCode"] = $row[16];
				$item["quantity"] = $row[18];
				$item["price"] = $row[21];
				//si todavia no se cargo la informacion de la orden esa
				if ( !isset($orders[$item["orderNumber"]]) ) {
					$order = array();
					$order["number"] = $row[0].$row[4];
					$order["created"] = $row[6];
					$order["branchNumber"] = $row[4];
					$order["modifiedProductCodes"] = true;
					$orders[$order["number"]] = $order;				
				}
				$orders[$item["orderNumber"]]["items"][] = $item;
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
		require_once("zip.class.php"); 
		$zipFile = new zipfile;
		$zipFile->read_zip($file); 
		
		$rows = array();
		$separator = OrdersImportPlugin::getSeparator();
		
		foreach($zipFile->files as $file)
		{
			$rowsFile = explode("\r\n",$file['data']);
			$rows = array_merge($rows,$rowsFile);
		}
		
		$ordersRow = array();
		foreach ($rows as $row)
			$ordersRow[] = explode($separator,$row);
		
		$orders = OrdersImportPlugin::getOrders($ordersRow); 				
		return $orders;
	}
	
}