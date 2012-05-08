<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_documentObjective' table.
 *
 * Asociacion entre Documentos y Objetivos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroDocumentObjectivePeer extends BaseTableroDocumentObjectivePeer {

	private  $objectiveId;
	private  $documnetId;

	/**
	 * Especifica el Id del Objetivo.
	 * @param int Id del Objetivo.
	 */
	public function setObjectiveId($objectiveId) {
		$this->objectiveId = $objectiveId;
	}

	/**
	 * Especifica el Id del Documento.
	 * @param int Id del Documento.
	 */
	public function setObjectiveId($documnetId) {
		$this->objectiveId = $documnetId;
	}

  /**
  * Crea una una relacion entre un documento y un objetivo
  *
   * @param $objectiveId id del objetivo
   * @param $documentId id de la documento
  * @return boolean true si se creo la relacion correctamente, false sino
	*/
	function create($objectiveId,$documentId) {
    $relationObj = new TableroDocumentObjective();
    $relationObj->setObjectiveId($objectiveId);
		$relationObj->setDocumentId($documentId);
    try {
		  $objectiveObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

 /**
   * Elimina una relacion entre un documento y un objetivo
   * @param $objectiveId id del objetivo
   * @param $documentId id de la documento
   */
  function delete($objectiveId,$documentId) {
    $cond = new Criteria();
    $cond->add(TableroDocumentObjectivePeer::OBJECTIVEID,$objectiveId);
    $cond->add(TableroDocumentObjectivePeer::DOCUMENTID,$documentId);

    $relation = TableroDocumentObjectivePeer::doSelectOne($cond);

    try {
      $relation->delete();
    }
    catch (PropelException $exp) {
      return false;
    }

    return true;
  }

} // TableroDocumentObjectivePeer
