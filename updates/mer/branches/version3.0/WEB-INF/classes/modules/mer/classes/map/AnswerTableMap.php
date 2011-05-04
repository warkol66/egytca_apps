<?php



/**
 * This class defines the structure of the 'MER_formAnswer' table.
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
class AnswerTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.AnswerTableMap';

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
		$this->setName('MER_formAnswer');
		$this->setPhpName('Answer');
		$this->setClassname('Answer');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ACTORID', 'Actorid', 'INTEGER', 'MER_actor', 'ID', true, null, null);
		$this->addForeignKey('QUESTIONID', 'Questionid', 'INTEGER', 'MER_formSectionQuestion', 'ID', true, null, null);
		$this->addColumn('ANSWER', 'Answer', 'VARCHAR', true, 255, null);
		$this->addColumn('JUDGEMENT', 'Judgement', 'VARCHAR', false, 255, null);
		$this->addColumn('OLD', 'Old', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Actor', 'Actor', RelationMap::MANY_TO_ONE, array('actorId' => 'id', ), 'CASCADE', null);
    $this->addRelation('Question', 'Question', RelationMap::MANY_TO_ONE, array('questionId' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // AnswerTableMap
