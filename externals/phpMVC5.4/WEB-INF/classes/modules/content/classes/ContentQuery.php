<?php



/**
 * Skeleton subclass for performing query and update operations on the 'content_content' table.
 *
 * Contents
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.content.classes
 */
class ContentQuery extends BaseContentQuery {
    /**
     * Returns the root node for the tree
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     Content The tree root object
     */
    public function findRoot($con = null){
        $root=parent::findRoot($con);
        if(!$root){
            $root=new Content();
            $root->setType(1);
            $root->makeRoot();
            $root->save();
        }
        return $root;
    }


} // ContentQuery
