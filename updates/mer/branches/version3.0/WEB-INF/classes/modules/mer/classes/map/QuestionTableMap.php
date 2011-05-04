<?php



/**
 * This class defines the structure of the 'MER_formSectionQuestion' table.
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
class QuestionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.QuestionTableMap';

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
		$this->setName('MER_formSectionQuestion');
		$this->setPhpName('Question');
		$this->setClassname('Question');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SECTIONID', 'Sectionid', 'INTEGER', 'MER_formSection', 'ID', true, null, null);
		$this->addColumn('TYPE', 'Type', 'SMALLINT', true, null, null);
		$this->addColumn('QUESTION', 'Question', 'VARCHAR', true, 255, null);
		$this->addColumn('POSITION', 'Position', 'INTEGER', true, null, null);
		$this->addColumn('UNIT', 'Unit', 'VARCHAR', false, 20, null);
		$this->addColumn('ANALYSIS', 'Analysis', 'BOOLEAN', false, null, false);
		$this->addColumn('LABEL', 'Label', 'VARCHAR', false, 50, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('FormSection', 'FormSection', RelationMap::MANY_TO_ONE, array('sectionId' => 'id', ), 'CASCADE', null);
    $this->addRelation('QuestionOption', 'QuestionOption', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), 'CASCADE', null);
    $this->addRelation('Relationship', 'Relationship', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), null, null);
    $this->addRelation('ActorActiveQuestion', 'ActorActiveQuestion', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), null, null);
    $this->addRelation('RelationshipActiveQuestion', 'RelationshipActiveQuestion', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), null, null);
    $this->addRelation('Answer', 'Answer', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), 'CASCADE', null);
    $this->addRelation('GraphModelAxis', 'GraphModelAxis', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), 'CASCADE', null);
    $this->addRelation('GraphRelationQuestion', 'GraphRelationQuestion', RelationMap::ONE_TO_MANY, array('id' => 'questionId', ), 'CASCADE', null);
	} // buildRelations()

} // QuestionTableMap
