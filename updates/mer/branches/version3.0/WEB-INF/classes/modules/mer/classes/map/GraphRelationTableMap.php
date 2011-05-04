<?php



/**
 * This class defines the structure of the 'MER_graphRelation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.mer.classes.map
 */
class GraphRelationTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.GraphRelationTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('MER_graphRelation');
		$this->setPhpName('GraphRelation');
		$this->setClassname('GraphRelation');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addForeignKey('ACTOR1ID', 'Actor1id', 'INTEGER', 'MER_actor', 'ID', false, null, null);
		$this->addForeignKey('ACTOR2ID', 'Actor2id', 'INTEGER', 'MER_actor', 'ID', false, null, null);
		$this->addColumn('JUDGEMENT', 'Judgement', 'VARCHAR', false, 255, null);
		$this->addColumn('OLD', 'Old', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ActorRelatedByActor1id', 'Actor', RelationMap::MANY_TO_ONE, array('actor1Id' => 'id', ), 'CASCADE', null);
    $this->addRelation('ActorRelatedByActor2id', 'Actor', RelationMap::MANY_TO_ONE, array('actor2Id' => 'id', ), 'CASCADE', null);
    $this->addRelation('GraphRelationQuestion', 'GraphRelationQuestion', RelationMap::ONE_TO_MANY, array('id' => 'graphRelationId', ), 'CASCADE', null);
	} // buildRelations()

} // GraphRelationTableMap
