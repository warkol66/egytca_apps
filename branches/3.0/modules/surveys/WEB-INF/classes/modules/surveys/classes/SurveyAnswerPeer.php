<?php

/**
 * Class SurveyAnswerPeer
 *
 * @package Survey
 */
class SurveyAnswerPeer extends BaseSurveyAnswerPeer {

	/**
	* Elimina un survey answer a partir de los valores de la clave.
	*
	* @param int $id id del surveyanswer
	* @return boolean true si se elimino correctamente el surveyanswer, false sino
	*/
	function delete($id) {
		return SurveyAnswerQuery::create()->filterByPrimaryKey($id)->delete() > 0;
	}

	/**
	* Obtiene la informacion de un survey answer.
	*
	* @param int $id id del surveyanswer
	* @return array Informacion del surveyanswer
	*/
	function get($id) {
		return SurveyAnswerQuery::create()->findPk($id);
	}

	/**
	* Obtiene todos los survey answers.
	*
	*	@return array Informacion sobre todos los surveyanswers
	*/
	function getAll() {
		return SurveyAnswerQuery::create()->find();
	}

	/**
	* Obtiene todos los survey answers paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los surveyanswers
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"SurveyAnswerPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

}
