<?php



/**
 * This class defines the structure of the 'MER_relationshipActiveQuestion' table.
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
class RelationshipActiveQuestionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.RelationshipActiveQuestionTableMap';

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
		$this->setName('MER_relationshipActiveQuestion');
		$this->setPhpName('RelationshipActiveQuestion');
		$this->setClassname('RelationshipActiveQuestion');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ACTOR1ID', 'Actor1id', 'INTEGER' , 'MER_actor', 'ID', true, null, null);
		$this->addForeignPrimaryKey('ACTOR2ID', 'Actor2id', 'INTEGER' , 'MER_actor', 'ID', true, null, null);
		$this->addForeignPrimaryKey('QUESTIONID', 'Questionid', 'INTEGER' , 'MER_formSectionQuestion', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ActorRelatedByActor1id', 'Actor', RelationMap::MANY_TO_ONE, array('actor1Id' => 'id', ), null, null);
    $this->addRelation('ActorRelatedByActor2id', 'Actor', RelationMap::MANY_TO_ONE, array('actor2Id' => 'id', ), null, null);
    $this->addRelation('Question', 'Question', RelationMap::MANY_TO_ONE, array('questionId' => 'id', ), null, null);
	} // buildRelations()

} // RelationshipActiveQuestionTableMap
