<?php

class CatalogProductsDoUpdateAction extends BaseAction {

	function CatalogProductsDoUpdateAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$productKeys = array('code', 'name', 'description', 'price', 'category', 'unitName', 'stockAlert', 'stock01', 'stock02', 'stock03');
		$loaded = 0;

		global $system;
		$updatesDir =  'WEB-INF/../' . $system["config"]["catalog"]["pricesAutoUpdate"]["updatesDir"]."/";
		$processedDir = $updatesDir."processed/";

		if (is_file($updatesDir . "Catalogo.txt")) {
			
			$fileExist = true;

			$products = array();
			$handle = fopen($updatesDir . "Catalogo.txt", "r");
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
				$products[] = $data;
			fclose($handle);

			$records = count($products);
			$added = 0;
			$updated = 0;

			foreach ($products as $product) {

				if (count($product) > 4) {

					foreach ($productKeys as $key => $value)
						$productData[$value] =  trim(iconv("ISO-8859-1//TRANSLIT","UTF-8", $product[$key]));

					$productObj = ProductQuery::create()->findOneByCode($productData['code']);
					
					if (empty($productObj))
						$productObj = new Product();

					//Busco la categoria
					$category = CategoryQuery::create()->findOneByCode($productData['category']);
					if (!empty($category) && $category->getModule() == 'catalog') {
						$relation = ProductCategoryQuery::create()->filterByCategory($category)->filterByProduct($productObj)->findOne();
						if (empty($relation))
							$productObj->addCategory($category);
					}						

					//Busco la unidad
					$unit = UnitQuery::create()->findOneByName($product['unitName']);
					if (!empty($unit))
						$productData['unitId'] = $unit->getId();
					else
						unset($productData['unitId']);

					//Busco la unidad de medida
					$measureUnit = MeasureUnitQuery::create()->findOneByName($product['measureUnitId']);
					if (!empty($measureUnit))
						$productData['measureUnitId'] = $measureUnit->getId();
					else
						unset($productData['measureUnitId']);


					$productObj = Common::setObjectFromParams($productObj,$productData);

					if ($productObj->isNew())
						$added++;
					else
						$updated++;

					if ($productObj->isModified())
						$productObj->save();

				}
			}
			copy($updatesDir . "Catalogo.txt",$processedDir . "Catalogo_" . date("Ymdhms") . '.txt');
			unlink($updatesDir . "Catalogo.txt");
		}
		die;
	}
}
