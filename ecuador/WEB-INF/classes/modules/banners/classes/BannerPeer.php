<?php
/**
 * Skeleton subclass for performing query and update operations on the 'banners_banner' table.
 *
 * Tabla de banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class BannerPeer extends BaseBannerPeer {

	private $byWeight = false;
	private $byOrder = false;

	/**
	 * Aplica ordenamiento por pesos
	 */
	public function setByWeight()

	{
		$this->byWeight = true;
	}

	/**
	 * Aplica ordenamiento por orden
	 */
	public function setByOrder()
	{
		$this->byOrder = true;
	}

} // BannerPeer
