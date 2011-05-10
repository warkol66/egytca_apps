<?php

class LausiAddressesImportConfirmAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiAddressesImportConfirmAction() {
		;
	}
	

	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Addresses";
		$smarty->assign("section",$section);			

		if (!empty($_FILES["csv"])) {

			$handle = fopen($_FILES["csv"]["tmp_name"], "r");    
			$rows = array();
			$header = true;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						if (!$header)
							$rows[] = $data;
						else 
							$header = false;
			}
			fclose($handle);  
			
			//$row contiene:
			//Nombre,Calle,Calle1,Calle2,Altura,Partido,Localidad,CP,PisoDpto,Telefono,Coment1,Coment2,Coment3,Latitud,Longitud,
			//Nombre,Calle,Calle1,Calle2,Altura,Partido,Localidad,CP,PisoDpto,Telefono,Coment1,Coment2,Coment3,Zonas,Latitud,Longitud,nCalle,nCalle1,nCalle2,nMapa,nAltura

			$rows = MigrationPeer::utf8EncodeMultiArray($rows);

			//Reemplazo Acentos
			$replaces = array();
			$replaces[] = array("original"=>"Á","replacement"=>"á");
			$replaces[] = array("original"=>"É","replacement"=>"é");
			$replaces[] = array("original"=>"Í","replacement"=>"í");
			$replaces[] = array("original"=>"Ó","replacement"=>"ó");
			$replaces[] = array("original"=>"Ú","replacement"=>"ú");		
			
			$addresses = array();

			foreach ($rows as $row) {
				//solo cargo si son 15 o mas elementos
				if (count($row) > 14) {
					//Me fijo si ya existe la calle nro
					if ( !AddressPeer::exists($row[1],$row[4]) ) {
						//si no existe la calle nro, debo guardarla para que luego sea cargada
						$address = array();
						$address['street'] = $row[1];
						$address['number'] = $row[4];
						$address['intersection'] = '';
						if (!empty($row[2]))
							$address['intersection'] .= $row[2];
						if (!empty($row[2]) && !empty($row[3]))
							$address['intersection'] .= " - ";
						if (!empty($row[3]))	
							$address['intersection'] .= $row[3];
						$address['latitude'] = $row[14];
						$address['longitude'] = $row[15];
						$address['circuit'] = $row[11];
						
						$regionName = utf8_decode($row[6]);
//						$regionName = substr($regionName,0,strlen($regionName)-15);
						$regionName = trim($regionName,".");											
							
						$regionName = strtolower($regionName);
						$regionName = utf8_encode($regionName);
						
						foreach ($replaces as $replace)
							$regionName = str_replace($replace["original"],$replace["replacement"],$regionName);							
												
						switch ($regionName) {
							case "monserrat":
								$regionName = "montserrat";
								break;							
							case "nuÑez (localidad)":
								$regionName = "nuñez";
								break;	
							case "san nicolas":
								$regionName = "san nicolás";
								break;	
							case "villa ortuzar":
								$regionName = "villa ortúzar";
								break;		
							case "villa pueyrredón":
								$regionName = "villa pueyrredon";
								break;
							case "coghland":
								$regionName = "coghlan";
								break;	
							case "villa general mitre":
								$regionName = "villa gral mitre";
								break;			
							case "versailles":
								$regionName = "versalles";
								break;																					
																																					
						}						
						
						$region = RegionPeer::getByName($regionName);
						if (!empty($region)) {
							$address['region'] = $region->getName();
							$address['regionId'] = $region->getId();
						} else {
							$address['region'] = "INEXISTENTE (".$regionName.")";
							$address['regionId'] = 1;
						}
						$billboards = split("/",$row[10]);
						$billboardsDobles = split(":",$billboards[1]);
						$billboardsSextuples = split(":",$billboards[2]);
						$billboardsCount = split(":",$billboards[0]);
						$totalBillboardsDobles = $billboardsDobles[1];
						$totalBillboardsSextuples = $billboardsSextuples[1];
						$totalBillboardsCount = $billboardsCount[1];
						$rightBillboardsCount = true;
						//si no coincide la suma de carteleras dobles y sextuples
						if ( $totalBillboardsCount != ( ($totalBillboardsDobles*2) + ($totalBillboardsSextuples*6) ) )
							$rightBillboardsCount = false;
						$address['totalBillboardsCount'] = $totalBillboardsCount;
						$address['totalBillboardsDobles'] = $totalBillboardsDobles;
						$address['totalBillboardsSextuples'] = $totalBillboardsSextuples;
						$address['rightBillboardsCount'] = $rightBillboardsCount;
						$addresses[] = $address;
					}

				}
			}

		}
		$smarty->assign("addresses",$addresses);
		$smarty->assign("addressesFound",count($rows));
		$smarty->assign("addressesNew",count($addresses));

/*		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&loaded='.$loaded;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;		*/

		return $mapping->findForwardConfig('success');
	}

}
