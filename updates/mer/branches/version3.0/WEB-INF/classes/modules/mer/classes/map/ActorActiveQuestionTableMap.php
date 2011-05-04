<?php



/**
 * This class defines the structure of the 'MER_actorActiveQuestion' table.
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
class ActorActiveQuestionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.ActorActiveQuestionTableMap';

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
		$this->setName('MER_actorActiveQuestion');
		$this->setPhpName('ActorActiveQuestion');
		$this->setClassname('ActorActiveQuestion');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ACTORID', 'Actorid', 'INTEGER' , 'MER_actor', 'ID', true, null, null);
		$this->addForeignPrimaryKey('QUESTIONID', 'Questionid', 'INTEGER' , 'MER_formSectionQuestion', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Actor', 'Actor', RelationMap::MANY_TO_ONE, array('actorId' => 'id', ), null, null);
    $this->addRelation('Question', 'Question', RelationMap::MANY_TO_ONE, array('questionId' => 'id', ), null, null);
	} // buildRelations()

} // ActorActiveQuestionTableMap
