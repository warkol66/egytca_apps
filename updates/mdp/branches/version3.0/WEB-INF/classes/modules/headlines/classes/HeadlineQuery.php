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

    public function searchString($nameOrContent) {
        return $this->filterByName("%$filterValue%", Criteria::LIKE)
            ->_or()
        ->filterByContent("%$filterValue%", Criteria::LIKE);
    }
    
    public function rangePublished($min, $max) {
        return $this->filterByDatepublished(array('min' => $min, 'max' => $max));
    }

} // HeadlineQuery
