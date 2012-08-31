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

    public function searchString($searchString) {
        $this->where("Headline.Name LIKE ?", "%$searchString%")
            ->_or()
        ->where("Headline.Content LIKE ?", "%$searchString%");
        
        return $this;
    }
    
    public function rangePublished($range) {
        return $this->filterByDatepublished($range);
    }

} // HeadlineQuery
