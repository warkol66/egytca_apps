<?php
class ReportService{
    private $conn;

//DATOS DE CONEXION
    var $db_host;
    var $db_user;
    var $db_password;
    var $db_name;

    var $base;
    var $meta;
    var $base_numerica;
    var $meta_numerica;

    var $count = 0;

    var $variable;
    var $valores = array();
    var $valores_numericos = array();

    var $isValid;


    public function __construct($idProyecto=null){

				$moduleRootDir = dirname(__FILE__);
        $configDbFromPropel = file(realpath($moduleRootDir . "/config/application-conf.php"));

				$dbParts = explode("=>", substr(trim($configDbFromPropel[11]), 0, -1));
				$dbParts = explode(";", substr(trim($dbParts[1]), 0, -1));
				$dbHost = explode("=", trim($dbParts[0]));
				$dbName = explode("=", trim($dbParts[1]));

				$userParts = explode("=>", substr(trim($configDbFromPropel[12]), 0, -1));
				$user = trim(str_replace('\'','',$userParts[1]));
				$pwParts = explode("=>", substr(trim($configDbFromPropel[13]), 0, -1));
				$pw = trim(str_replace('\'','',$pwParts[1]));
				$encodeParts = explode("=>", substr(trim($configDbFromPropel[18]), 0, -1));
				$encode = trim(str_replace('\'','',$encodeParts[1]));

        $this->db_name = $dbName[1];
        $this->db_host = $dbHost[1];
        $this->db_user = $user;
        $this->db_password = $pw;

        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
				if (mysqli_connect_error()) {
					die('Connect Error (' . mysqli_connect_errno() . ') '
								. mysqli_connect_error());
				}
        mysqli_set_charset($this->conn, $encode);


        if($idProyecto == null)
            return;

        $this->loadProyecto($idProyecto);
    }


    public function loadProyecto($idProyecto)
    {

        $dataIndicador = $this->getIndicador($idProyecto);

        if(!$dataIndicador)
            return;

        $this->base = $dataIndicador["base"];
        $this->meta = $dataIndicador["meta"];
        $idIndicador = $dataIndicador["idIndicator"];

        $valores = $this->getValoresIndicador($idIndicador);

        $this->count = count($valores);
        $this->valores = $valores;

        if($this->count > 0)
            $this->variable = $valores[0]["variable"];


        if(is_numeric($this->base))
        {
            $this->isValid = true;
            $this->base_numerica = intval($this->base);
        }
        else
        {
            $this->isValid = false;
            return;
        }

        if(is_numeric($this->meta))
        {
            $this->isValid = true;
            $this->meta_numerica = intval($this->meta);
        }
        else
        {
            $this->isValid = false;
            return;
        }


        foreach($valores as $key => $value)
        {
            if(is_numeric($value["valor"]))
            {
                array_push($this->valores_numericos, array(
                    "valor" => intval($value["valor"]),
                    "periodo" => $value["periodo"],
                    "porcentaje" => round(intval($value["valor"] - $this->base)/($this->meta - $this->base)*100,2) . "%"
                ));
                $this->isValid = true;
            }else{
                $this->valores_numericos = array();
                $this->isValid = false;
                return;
            }
        }


    }

    private function getIndicador($id){
        if(!is_numeric($id))
            throw new Exception("Id erroneo");

        $query = "SELECT planning_indicator.id as idIndicator, planning_indicator.realValue as base, planning_project.goalQuantification as meta
        FROM planning_project
        JOIN planning_projectIndicator ON (planning_projectIndicator.planningProjectId = planning_project.id)
        JOIN planning_indicator ON  (planning_projectIndicator.indicatorId = planning_indicator.id)
        WHERE planning_project.id = " . $id;

        $result = mysqli_query($this->conn, $query);
        $resp = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $resp;
    }

    private function getValoresIndicador($id){
        if(!is_numeric($id))
            throw new Exception("Id erroneo");

        $query = "SELECT  serie.name as variable, x.name as periodo , y.value as valor
        FROM planning_indicatorSerie serie
        join planning_indicatorY y on (serie.id = y.serieId)
        join planning_indicatorX x on (y.xId = x.id)
        WHERE x.indicatorId = " . $id . "
        AND serie.id = (select min(id) from planning_indicatorSerie where indicatorId = x.indicatorId)
        order by x.order asc";

        $result = mysqli_query($this->conn, $query);

        $allRows = array();

        while(($row = mysqli_fetch_assoc($result))){
            array_push($allRows, $row);
        }
        mysqli_free_result($result);

        return $allRows;
    }



    public function tableAvanceMetas()
    {
        $tabla = '<table class="tablaInfo">
        <tr>
            <th>Período</th>
            <th>Linea Base</th>
            <th>Evolución</th>
            <th>Meta</th>
            <th>Avance</th>
        </tr>';

        $tabla .= '
        <tr>
            <td></td>
            <td>' . $this->base . '</td>
            <td></td>
            <td></td>
            <td>0%</td>
        </tr>
        ';

        for($i=0; $i< $this->count; $i++)
        {
            $tabla .= '
            <tr>
                <td>' . $this->valores[$i]["periodo"] . '</td>
                <td></td>
                <td>' . $this->valores[$i]["valor"] . '</td>
                <td></td>';

            if($this->isValid)
                $tabla .= '<td>' . $this->valores_numericos[$i]["porcentaje"] . '</td>';
            else
                $tabla .= '<td>Sin dato numérico</td>';

            $tabla .= '</tr>';
        }

        $tabla .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>' . $this->meta . '</td>
            <td>100%</td>
        </tr>
        ';


        $tabla .= '</table>';
        return $tabla;


    }

    public function getGraphMarkUp($id, $url_xml_grafico){
        if(!$this->isValid)
            return "<div>El gráfico no puede generarse porque los valores no son numéricos</div>";
        else
            return '
            <div id="'. $id .'"></div>
            <script type="text/javascript">
                var myChart3 = new FusionCharts( "images/MSCombi2D.swf", "myChartId3", "900", "400", "0", "1" );
                myChart3.setDataURL("' . $url_xml_grafico .'");
                myChart3.render("' .$id . '");
            </script>';
    }



    public function xmlAvanceMetas()
    {

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"  ?>
        <chart caption='Grado de cumplimiento y avance de las metas fisicas' showValues='0' sNumberSuffix='%25'
        showSecondaryLimits='0'
        decimals='2' setAdaptiveYMin='1' setAdaptiveSYMin='1' lineThickness='5'
        exportEnabled='1'
        exportAtClient='1'
        exportHandler='fcExporter1'
        exportDataSeparator='{tab}'
        showExportDataMenuItem='1'
        formatNumberScale='0'>
    <categories>
        <category name='Linea de Base'/>
         ";


        foreach($this->valores_numericos as $key => $value){
            $xml .= "<category name='" . $value["periodo"] . "' />\r\n";
        }

        $xml .= "<category name='Meta' />
        </categories>

        <dataset  seriesname='Linea de base'  >\r\n";

        $xml .= "<set value='" . $this->base_numerica . "'/>";

        for($i=0;$i<$this->count;$i++){
            $xml .= "<set value='0'/>\r\n";
        }

        $xml .= "<set value='0'/>\r\n";

        $xml .= "</dataset>";

        $xml .= "<dataset  seriesname='Meta'  >
        <set value='0'/>";

        for($i=0;$i<$this->count;$i++){
            $xml .= "<set value='0'/>\r\n";
        }

        $xml .= "<set value='" . $this->meta_numerica . "'/>";
        $xml .= "</dataset>";

        $xml .= "<dataset  seriesname='Evolucion' renderAs = 'Line' showValues='1'  >
        <set value='" . $this->base_numerica . "'/>";

        foreach($this->valores_numericos as $key => $value){
            $xml .= "<set value='" . $value["valor"] . "' />\r\n";
        }
        if($this->count > 0)
		    $xml .= "<set value='". $this->valores_numericos[$this->count - 1][valor] ."'/>";
		else
            $xml .= "<set value='". $this->base_numerica ."'/>";

        $xml .= "</dataset>
</chart>";
        return $xml;
    }


    public function xmlMapaObras(){
        $query = 'SELECT replace(r.name, "Comuna ","") as numero, count(c.id) as valor
						FROM planning_project as p
						JOIN planning_construction as c on (p.id = c.planningProjectId)
						JOIN planning_constructionRegion as cr on (c.id = cr.constructionId)
						RIGHT JOIN regions_region as r on (cr.regionId = r.id)
						WHERE p.priority in (1,2,3,4)
						GROUP BY numero';

        $result = mysqli_query($this->conn, $query);
        $allRows = array();

        while(($row = mysqli_fetch_assoc($result))){
            array_push($allRows, $row);
        }
        mysqli_free_result($result);
        $xml = "<mapa>
                    <comunas>";

        foreach($allRows as $key => $value)
            $xml .= '       <comuna numero="' . $value["numero"] . '" color="#fafa5c" valor="' . $value["valor"] . '" />';
        $xml .= '    </comunas>
</mapa>';
        return $xml;
    }

}

