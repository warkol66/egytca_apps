<?php



/**
 * Skeleton subclass for performing query and update operations on the 'lausi_theme' table.
 *
 * Base de Motivos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lausi.classes
 */
class ThemeQuery extends BaseThemeQuery {
	public function filterByAddress($address) {
		return $this->join('Advertisement')
					->useQuery('Advertisement')
						->filterByAddress($address)
					->endUse()
					->distinct();
	}
	
	public function filterByCurrent() {
		return $this->join('Advertisement')
					->useQuery('Advertisement')
						->filterByCurrent()
					->endUse();
	}
	
	public function filterByBillboard($billboard) {
		return $this->join('Advertisement')
					->useQuery('Advertisement')
						->filterByBillboard($billboard)
					->endUse();
	}
	
	public function selectFieldsForThemesReport() {
		$this->withColumn(AdvertisementPeer::THEMEID, 'ThemeId');
		$this->withColumn(ThemePeer::NAME, 'ThemeName');
		$this->withColumn('DATE_ADD(lausi_advertisement.publishDate,INTERVAL lausi_advertisement.duration DAY)', 'EndDate');
		$this->withColumn('COUNT(*)', 'TotalAdvertisements');
		$this->select(array('ThemeId', 'ThemeName', 'EndDate', 'TotalAdvertisements'));
		return $this;
	}
} // ThemeQuery
