<?php



/**
 * This class defines the structure of the 'MER_actor' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.actors.classes.map
 */
class ActorTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'actors.classes.map.ActorTableMap';

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
		$this->setName('MER_actor');
		$this->setPhpName('Actor');
		$this->setClassname('Actor');
		$this->setPackage('actors.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addForeignKey('CATEGORYID', 'Categoryid', 'INTEGER', 'MER_category', 'ID', false, null, null);
		$this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, null, null);
		$this->addColumn('STRATEGY', 'Strategy', 'VARCHAR', false, 255, null);
		$this->addColumn('TACTIC', 'Tactic', 'VARCHAR', false, 255, null);
		$this->addColumn('OBSERVATIONS', 'Observations', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('categoryId' => 'id', ), null, null);
    $this->addRelation('Hierarchy', 'Hierarchy', RelationMap::ONE_TO_MANY, array('id' => 'actorId', ), null, null);
    $this->addRelation('RelationshipRelatedByActor1id', 'Relationship', RelationMap::ONE_TO_MANY, array('id' => 'actor1Id', ), null, null);
    $this->addRelation('RelationshipRelatedByActor2id', 'Relationship', RelationMap::ONE_TO_MANY, array('id' => 'actor2Id', ), null, null);
    $this->addRelation('ActorActiveQuestion', 'ActorActiveQuestion', RelationMap::ONE_TO_MANY, array('id' => 'actorId', ), null, null);
    $this->addRelation('RelationshipActiveQuestionRelatedByActor1id', 'RelationshipActiveQuestion', RelationMap::ONE_TO_MANY, array('id' => 'actor1Id', ), null, null);
    $this->addRelation('RelationshipActiveQuestionRelatedByActor2id', 'RelationshipActiveQuestion', RelationMap::ONE_TO_MANY, array('id' => 'actor2Id', ), null, null);
    $this->addRelation('Answer', 'Answer', RelationMap::ONE_TO_MANY, array('id' => 'actorId', ), 'CASCADE', null);
    $this->addRelation('GraphActor', 'GraphActor', RelationMap::ONE_TO_MANY, array('id' => 'actorId', ), 'CASCADE', null);
    $this->addRelation('GraphRelationRelatedByActor1id', 'GraphRelation', RelationMap::ONE_TO_MANY, array('id' => 'actor1Id', ), 'CASCADE', null);
    $this->addRelation('GraphRelationRelatedByActor2id', 'GraphRelation', RelationMap::ONE_TO_MANY, array('id' => 'actor2Id', ), 'CASCADE', null);
    $this->addRelation('JudgementActor', 'JudgementActor', RelationMap::ONE_TO_ONE, array('id' => 'actorId', ), 'CASCADE', null);
	} // buildRelations()

} // ActorTableMap
