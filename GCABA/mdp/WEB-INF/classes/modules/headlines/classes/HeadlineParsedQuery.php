<?php



/**
 * Skeleton subclass for performing query and update operations on the 'headlines_parsed' table.
 *
 * Headline parsed
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineParsedQuery extends BaseHeadlineParsedQuery {
    
    const STATUS_IDLE       = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_PROCESSED  = 3;
    const STATUS_DISCARDED  = 4;

} // HeadlineParsedQuery
