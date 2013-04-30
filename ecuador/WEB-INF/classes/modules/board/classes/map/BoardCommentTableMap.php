<?php



/**
 * This class defines the structure of the 'board_comment' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.board.classes.map
 */
class BoardCommentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'board.classes.map.BoardCommentTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('board_comment');
        $this->setPhpName('BoardComment');
        $this->setClassname('BoardComment');
        $this->setPackage('board.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('CHALLENGEID', 'Challengeid', 'INTEGER', 'board_challenge', 'ID', true, null, null);
        $this->addColumn('TEXT', 'Text', 'LONGVARCHAR', false, null, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('USERNAME', 'Username', 'VARCHAR', false, 255, null);
        $this->addColumn('URL', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('IP', 'Ip', 'VARCHAR', false, 50, null);
        $this->addColumn('CREATIONDATE', 'Creationdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('STATUS', 'Status', 'INTEGER', true, null, null);
        $this->addColumn('USERID', 'Userid', 'INTEGER', true, null, null);
        $this->addColumn('OBJECTTYPE', 'Objecttype', 'VARCHAR', false, 50, null);
        $this->addColumn('OBJECTID', 'Objectid', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BoardChallenge', 'BoardChallenge', RelationMap::MANY_TO_ONE, array('challengeId' => 'id', ), null, null);
    } // buildRelations()

} // BoardCommentTableMap
