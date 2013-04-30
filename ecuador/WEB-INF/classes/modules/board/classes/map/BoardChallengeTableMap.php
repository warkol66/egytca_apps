<?php



/**
 * This class defines the structure of the 'board_challenge' table.
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
class BoardChallengeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'board.classes.map.BoardChallengeTableMap';

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
        $this->setName('board_challenge');
        $this->setPhpName('BoardChallenge');
        $this->setClassname('BoardChallenge');
        $this->setPackage('board.classes');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('URL', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('BODY', 'Body', 'LONGVARCHAR', false, null, null);
        $this->addColumn('CREATIONDATE', 'Creationdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('STARTDATE', 'Startdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('ENDDATE', 'Enddate', 'TIMESTAMP', false, null, null);
        $this->addColumn('LASTUPDATE', 'Lastupdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('STATUS', 'Status', 'INTEGER', false, null, null);
        $this->addForeignKey('USERID', 'Userid', 'INTEGER', 'users_user', 'ID', true, null, null);
        $this->addColumn('VIEWS', 'Views', 'INTEGER', false, null, 0);
        $this->addColumn('DELETED_AT', 'DeletedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('userId' => 'id', ), null, null);
        $this->addRelation('BoardComment', 'BoardComment', RelationMap::ONE_TO_MANY, array('id' => 'challengeId', ), null, null, 'BoardComments');
        $this->addRelation('BoardBondRelation', 'BoardBondRelation', RelationMap::ONE_TO_MANY, array('id' => 'challengeId', ), 'CASCADE', null, 'BoardBondRelations');
        $this->addRelation('BoardBond', 'BoardBond', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'BoardBonds');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'soft_delete' => array('deleted_column' => 'deleted_at', ),
        );
    } // getBehaviors()

} // BoardChallengeTableMap
