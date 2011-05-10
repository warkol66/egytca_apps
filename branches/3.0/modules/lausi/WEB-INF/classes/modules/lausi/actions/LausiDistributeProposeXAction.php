<?php

require_once("ProposalGenerator.php");

class LausiDistributeProposeXAction extends BaseAction {

	function LausiDistributeProposeXAction() {
		;
	}

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

		$proposalGenerator = new ProposalGenerator();

		if (empty($_POST['themeId']))
			return $mapping->findForwardConfig('failure');

		if (isset($_POST['mode']) && !empty($_POST['themeId'])) {

			$themeId = $_POST['themeId'];

			//opciones generales
			$theme = ThemePeer::get($themeId);
			$smarty->assign('theme',$theme);
			$smarty->assign('publishDate',Common::convertToMysqlDateFormat($_POST['publishDate']));
			$smarty->assign('duration',$_POST['duration']);

			if (empty($_POST['duration']) && empty($_POST['duration']))
				return $mapping->findForwardConfig('failure');

			switch ($_POST['mode']) {

				//opciones especificas de la propuesta por region.
				case 'region':
					foreach ($_POST['byRegion'] as $regionId => $quantity)	{
						if ($quantity != "" && $quantity > 0) {
							$results[$regionId]['region'] = RegionPeer::get($regionId);
							$results[$regionId]['options'] = $proposalGenerator->generateProposalForRegion($themeId, $regionId, Common::convertToMysqlDateFormat($_POST['publishDate']), $_POST['duration'], $quantity);
							$results[$regionId]['quantity'] = $proposalGenerator->getQuantityByType(ThemePeer::get($themeId),$quantity);
						}
					}
					$smarty->assign('results',$results);
					return $mapping->findForwardConfig('success-by-region');
					break;

				//opciones especificas de la propuesta por circuito.
				case 'circuit':
					foreach ($_POST['byCircuit'] as $circuitId => $quantity)	{
						if ($quantity != "" && $quantity > 0) {
							$results[$circuitId]['circuit'] = CircuitPeer::get($circuitId);
							$results[$circuitId]['options'] = $proposalGenerator->generateProposalForCircuit($themeId, $circuitId, Common::convertToMysqlDateFormat($_POST['publishDate']), $_POST['duration'], $quantity);
							$results[$circuitId]['quantity'] = $proposalGenerator->getQuantityByType(ThemePeer::get($themeId),$quantity);
						}
					}
					$smarty->assign('results',$results);
					return $mapping->findForwardConfig('success-by-circuit');
					break;

				//opciones especificas de la propuesta por valoracion.
				case 'rating':
					$rating = $_POST['rating'];
					$quantity = $_POST['quantity'];
					if ($quantity != "" && $quantity > 0) {
						$results[$rating]['rating'] = $_POST['rating'];
						$results[$rating]['options'] = $proposalGenerator->generateProposalForRating($themeId, $rating, Common::convertToMysqlDateFormat($_POST['publishDate']), $_POST['duration'], $quantity);
						$results[$rating]['quantity'] = $proposalGenerator->getQuantityByType(ThemePeer::get($themeId),$quantity);
					}
					$smarty->assign('results',$results);
					return $mapping->findForwardConfig('success-by-rating');
					break;

				//opciones especificas de la propuesta por ubicacion geografica.
				case 'location':
					$quantity = $_POST['quantity'];
					if ($quantity != "" && $quantity > 0) {
						$clientAddress = ClientAddressPeer::get($_POST['byLocation']['clientAddressId']);
						$longitude_0 = $clientAddress->getLongitude();
						$latitude_0 = $clientAddress->getLatitude();
						$radius = $_POST['byLocation']['radius'];
						$description = $clientAddress->getName() . " - Distancia Limite: $radius m";
						$results[0]['description'] = $description;
						$results[0]['radius'] = $radius;
						$results[0]['options'] = $proposalGenerator->generateProposalForLocation($themeId, $longitude_0, $latitude_0 ,$radius, Common::convertToMysqlDateFormat($_POST['publishDate']), $_POST['duration'], $quantity);
						$results[0]['quantity'] = $proposalGenerator->getQuantityByType(ThemePeer::get($themeId),$quantity);
					}
					$smarty->assign('radiusRanges', BillboardPeer::getRadiusRanges($radius));
					$smarty->assign('clientAddress', $clientAddress);
					$smarty->assign('results',$results);
					return $mapping->findForwardConfig('success-by-location');
					break;

				case 'circuitPercentage':
					foreach ($_POST['byCircuitPercentage'] as $circuitId => $percentage)	{
						if ($percentage != "" && $percentage > 0) {
							$results[$circuitId]['circuit'] = CircuitPeer::get($circuitId);
							if ($_POST['percentageMode'] == 'total')
								$results[$circuitId]['options'] = $proposalGenerator->generateProposalForCircuitPercentageTotal($themeId, $_POST['total'], $percentage, $circuitId, Common::convertToMysqlDateFormat($_POST['publishDate']), $_POST['duration']);

							if ($_POST['percentageMode'] == 'circuitBillBoard')
								$results[$circuitId]['options'] = $proposalGenerator->generateProposalForCircuitBillboardPercentage($themeId, $percentage, $circuitId, Common::convertToMysqlDateFormat($_POST['publishDate']), $_POST['duration']);
						}
					}

					$smarty->assign('results',$results);
					return $mapping->findForwardConfig('success-by-circuit');

					break;
			}// End - switch

		}// End - if (isset($_POST['mode']) && !empty($_POST['themeId']))

	}
}
