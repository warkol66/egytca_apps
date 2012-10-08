<?php



/**
 * Skeleton subclass for performing query and update operations on the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineQuery extends BaseHeadlineQuery {

 /**
	* Agrega filtros por nombre o contenido del Headline
	*
	* @param   type string $searchString texto a buscar
	* @return condicion de filtrado por texto a buscar
	*/
	public function searchString($searchString) {
		return $this->where("Headline.Name LIKE ?", "%$searchString%")
							->_or()
								->where("Headline.Content LIKE ?", "%$searchString%")
							->_or()
								->where("Headline.Author LIKE ?", "%$searchString%");
	}

 /**
	* Agrega filtros por ocndicion de procesado Headline
	*
	* @param   type string $value condicion de procesado
	* @return condicion de filtrado por condicion de procesado
	*/
	public function processed($value = true) {
		
		if ($value) {
			$this->filterByHeadlinescope(0, Criteria::NOT_EQUAL) // se inicializa en 0. sino: filterByXxx(null, Criteria::ISNOTNULL)
				->filterByRelevance(0, Criteria::NOT_EQUAL)
				->filterByAgenda(0, Criteria::NOT_EQUAL)
				->filterByValue(0, Criteria::NOT_EQUAL)
				->join('HeadlineIssue')
				->groupBy('Headline.Id')
			;
		} else {
			$this
				->filterByHeadlinescope(0) // se inicializa en 0. sino: filterByXxx(null, Criteria::ISNULL)
			->_or()
				->filterByValue(0)
			->_or()
				->filterByRelevance(0)
			->_or()
				->filterByAgenda(0)
			->_or()
				->where("Headline.Id NOT IN (SELECT `Headlineid` FROM `headlines_issue`)")
			->groupBy('Headline.Id')
			;
	    }
	    return $this;
    }

 /**
	* Agrega filtros por fecha de publicacion del  Headline
	*
	* @param   type array $range array con rango de fechas
	* @return condicion de filtrado por rango de fecha de publicacion
	*/
	public function rangePublished($range) {
			return $this->filterByDatepublished($range);
	}

 /**
	* Agrega filtros por tipo de medio
	*
	* @param   type integer $mediaTypeId id del tipo de medio
	* @return condicion de filtrado por tipo de medio
	*/
	public function mediaTypeId($mediaTypeId) {
			return $this->useMediaQuery()
										->filterByTypeid($mediaTypeId)
									->endUse();
	}

 /**
	* Agrega filtros por issue y sus descendientes
	*
	* @param   type integer $issueId id del Issue
	* @return condicion de filtrado por issue y descendientes
	*/
	public function broodIssues($issueId) {
		$issue = IssueQuery::create()->findOneById($issueId);
		return $this->useHeadlineIssueQuery()
									->filterByIssue($issue->getThisAndBrood())
								->endUse();
	}

 /**
	* Agrega orden especifico para reportes
	*
	* @return condicion de ordenamiento de los datos para reporte
	*/
	public function setReportOrder() {
		return $this->orderByDatepublished('asc')
									->useHeadlineIssueQuery()
										->useIssueQuery()
											->orderByName()
										->endUse()
									->endUse()
									->useMediaQuery()
										->orderByName()
									->endUse();
	}

} // HeadlineQuery
