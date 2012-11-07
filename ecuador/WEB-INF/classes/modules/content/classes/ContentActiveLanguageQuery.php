<?php


/**
 * Skeleton subclass for performing query and update operations on the 'content_activeLanguages' table.
 *
 * ContentActiveLanguages
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.content.classes
 */
class ContentActiveLanguageQuery extends BaseContentActiveLanguageQuery {

	/**
	 * Returns a new ContentActiveLanguageQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ContentActiveLanguageQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ContentActiveLanguageQuery) {
			return $criteria;
		}
		$query = new self('application', 'ContentActiveLanguage', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

    /**
     * Retorna el idioma por defecto, seteado en config/config.php
     * Si no existe el idioma configurado, se utiliza el primero como Default.
     * @static
     * @return ContentActiveLanguage
     */
    public static function getDefaultLanguage(){
        global $useLocale;
        $locale=preg_replace("/\..+/","",$useLocale);
        $lang=self::create()->filterByLanguagecode($locale)->findOne();
        if($lang) return $lang;
        return self::create()->orderById()->findOne();
    }

} // ContentActiveLanguageQuery
