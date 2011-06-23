<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_branch' table.
 *
 * Sucursales de Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateBranch extends BaseAffiliateBranch {

  /**
  * Obtiene el nombre del afiliado o nada si no lo encuentra
  *
  * @return string Nombre del afiliado
  */
	function getAffiliate() {
		$affiliateId = $this->getAffiliateId();
		$affiliate = AffiliateQuery::create()->findPk($affiliateId);
		if($affiliate)
			return $affiliate->getName();
		else
			return;
  }

} // AffiliateBranch
