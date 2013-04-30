<?php



/**
 * This class defines the structure of the 'board_bondRelation' table.
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
class BoardBondRelationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'board.classes.map.BoardBondRelationTableMap';

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
        $this->setName('board_bondRelation');
        $this->setPhpName('BoardBondRelation');
        $this->setClassname('BoardBondRelation');
        $this->setPackage('board.classes');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('CHALLENGEID', 'Challengeid', 'INTEGER' , 'board_challenge', 'ID', true, null, null);
        $this->addForeignPrimaryKey('BONDID', 'Bondid', 'INTEGER' , 'board_bond', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BoardChallenge', 'BoardChallenge', RelationMap::MANY_TO_ONE, array('challengeId' => 'id', ), 'CASCADE', null);
        $this->addRelation('BoardBond', 'BoardBond', RelationMap::MANY_TO_ONE, array('bondId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // BoardBondRelationTableMap
