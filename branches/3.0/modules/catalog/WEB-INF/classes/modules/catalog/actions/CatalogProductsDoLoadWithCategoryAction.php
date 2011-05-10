<?php

class CatalogProductsDoLoadWithCategoryAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogProductsDoLoadWithCategoryAction() {
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

		$module = "Catalog";
    $smarty->assign("module",$module);

		$moduleSection = "Products";
    $smarty->assign("moduleSection",$section);
    
    $productKeys = array('code', 'name', 'description', 'price', 'categoryId', 'unitId', 'measureUnitId', 'orderCode', 'salesUnit');

		$loaded = 0;

		if (!empty($_FILES["csv"])) {

			$handle = fopen($_FILES["csv"]["tmp_name"], "r");    
			$products = array();
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
						$products[] = $data;
			}
			fclose($handle);  

			switch ($_POST["mode"]) {
				case "1": //Reemplaza todo el catalogo
					ProductPeer::deleteAll();
					break;
				case "2": //Reemplaza codigos existentes
					break;
				case "4": //Solo actualiza precios
					break;					
				default: //Solo agrega nuevos
     			break;
     	}

			foreach ($products as $product) {
				//solo cargo si son 7 o mas elementos
				if (count($product) > 5 || $_POST["mode"] == 4) {
				  $product = array_combine($productKeys, $product);
          unset($product['unused']);
          $product['image'] = NULL;
          $product['categoryId'] = $_POST["categoryId"];
					//Busco la categoria
					$category = ProductCategoryPeer::getByName($product['categoryId']);
					if (!empty($category))
						$product['categoryId'] = $category->getId();
					else
						$product['categoryId'] = 0;
					//Busco la unidad
          $unit = UnitPeer::getByName($product['unitId']);
          if (!empty($unit))
            $product['unitId'] = $unit->getId();
          else
            $product['unitId'] = 0;
          //Busco la unidad de medida
          $measureUnit = MeasureUnitPeer::getByName($product['measureUnitId']);
          if (!empty($measureUnit))
            $product['measureUnitId'] = $measureUnit->getId();
          else
            $product['measureUnitId'] = 0;
					switch ($_POST["mode"]) {
						case "1": //Reemplaza todo el catalogo
        					if ( ProductPeer::createAndReplace($product) > 0 )
        						$loaded++;
							break;
						case "2": //Reemplaza codigos existentes
        					if ( ProductPeer::createAndReplace($product) > 0 )
        						$loaded++;
							break;
						case "4": //Solo actualiza los precios
							if ( ProductPeer::updatePrice($product['code'],$product['price']) )
								$loaded++;
							break; 
						default: //Solo agrega nuevos
        					if ( ProductPeer::create($product) > 0 )
        						$loaded++;
        					break;
     				}
				}
			}

		}

    $myRedirectConfig = $mapping->findForwardConfig('success');
    $myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&loaded='.$loaded;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
    return $fc;
	}

}
