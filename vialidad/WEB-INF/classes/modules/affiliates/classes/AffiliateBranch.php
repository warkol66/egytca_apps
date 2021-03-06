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
	 * Informa si un usuario es owner del afiliado relacionado al branch
	 * @param $user obj objeto propel user
	 * @return bool true si es owner false si no.
	 */
	public function isOwner($user) {
		$affiliate = $this->getAffiliate();
		if ($affiliate->isOwner($user))
			return true;
		else
			return false;
	}

} // AffiliateBranch
