<?php



/**
 * Skeleton subclass for representing a row from the 'headlines_parsed' table.
 *
 * Headline parsed
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineParsed extends BaseHeadlineParsed {
    
    /**
     * Antes de guardar un objeto HeadlineParsed nuevo lo dejamos en estado IDLE.
     * 
     * @param   PropelPDO $con
     * @return  boolean
     */
    public function preInsert(PropelPDO $con = null) {
        $this->setStatus(HeadlineParsedQuery::STATUS_IDLE);
        return true;
    }
    
} // HeadlineParsed