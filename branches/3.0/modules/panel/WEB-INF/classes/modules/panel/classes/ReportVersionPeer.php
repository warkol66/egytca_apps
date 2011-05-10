<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_reportVersion' table.
 *
 * Versiones de reportes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class ReportVersionPeer extends BaseReportVersionPeer {
	/**
	* Obtiene todas las versiones paginadas.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return PropelPager Informacion sobre todas las versiones.
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"ReportVersionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	public function get($id){
		$reportVersion = ReportVersionPeer::retrieveByPK($id);
		return $reportVersion;
	}

	/**
	* Elimina una version de reporte a partir de los valores de la clave.
	*
	* @param int $id id de la version de reporte
	* @return boolean true si se elimino correctamente la sección, false sino
	*/
	function delete($id){
		$version = ReportVersionQuery::create()->findPk($id);
		$version->delete();
		return true;
	}	 
	
	/**
	* Elimina una version de reporte y todas las secciones asociadas a partir de los valores de la clave.
	*
	* @param int $id id de la version de reporte
	* @return boolean true si se elimino correctamente la sección, false sino
	*/
	function fullDelete($id){
		ReportSectionQuery::create()->inTree($id)->forceDelete();
		$version = ReportVersionQuery::create()->findPk($id)->forceDelete();
		return true;
	}

	/**
	* Obtiene todas las versiones paginadas.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return PropelPager Informacion sobre todas las versiones.
	*/
	function getIncludeAll($options){
		$allObjs = ReportVersionQuery::create()->find();
		return $allObjs;
	 }

} // ReportVersionPeer
