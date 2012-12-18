<?php


/**
 * Skeleton subclass for performing query and update operations on the 'news_media' table.
 *
 * Media de las noticias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.news.classes
 */
class NewsMediaQuery extends BaseNewsMediaQuery {

	/**
	 * Returns a new NewsMediaQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    NewsMediaQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof NewsMediaQuery) {
			return $criteria;
		}
		$query = new self('application', 'NewsMedia', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // NewsMediaQuery
