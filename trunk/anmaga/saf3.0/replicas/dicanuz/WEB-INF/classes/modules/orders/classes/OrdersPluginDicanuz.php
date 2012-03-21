<?php


class OrdersImportPlugin {

	/*
	* Obtiene el separador de campos.
	*
	* @return string Separador de campo utilizado
	*/
	function getSeparator() {
		return "";
	}

	/*
	* Obtiene las ordenes en un formato comun.
	*
	* @param array $rows Ordenes leidas del archivo de importacion
	* @return array Ordenes en formato comun
	*/		
	function getOrders($rows) {

		$orders = array();				
		foreach ($rows as $row) {						
			$item = array();
			$item["orderNumber"] = $row["nro_ord"];
			$item["productCode"] = $row["co_art"];
			$item["affiliateProductCode"] = $row["co_art"];
			$item["quantity"] = $row["total_art"];
			$item["price"] = $row["prec_vta"];
			//si todavia no se cargo la informacion de la orden esa
			if ( !isset($orders[$item["orderNumber"]]) ) {
				$order = array();
				$order["number"] = $row["nro_ord"];
				$order["created"] = $row["fec_emis"];
				$order["branchNumber"] = $row["co_cli"];
				$order["modifiedProductCodes"] = true;
				$orders[$order["number"]] = $order;				
			}
			$orders[$item["orderNumber"]]["items"][] = $item;											
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
		
		require_once("xml2array.php");
		$array =  xml2array(file_get_contents($file));
 	
		$rows = $array["VFPData"]["cursor_profit_xml"];
	
		$orders = OrdersImportPlugin::getOrders($rows);
					
		return $orders;
	}	
	
}