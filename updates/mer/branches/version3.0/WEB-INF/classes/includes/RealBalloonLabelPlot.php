<?php
require_once("jpgraph/src/jpgraph.php");
require_once('jpgraph/src/jpgraph_plotmark.inc.php');


//===================================================
// CLASS Plot3DMark
// Description: Handles the plot marks in 3D graphs
//===================================================

class Plot3DMark extends PlotMark{

	public $iFormatCallback3="";
	private $labelFont;
  private $labelFontStyle;
  private $labelFontSize;
	
	function SetCallbackXYZ($aFunc) {
		$this->iFormatCallback3 = $aFunc;
	}
	
  function setLabelFont($font,$style,$size) {
   	$this->labelFont = $font;
   	$this->labelFontStyle = $style;
   	$this->labelFontSize = $size;
  }

	function Stroke($img,$x,$y,$z,$lt,$colorPoint) {
		if ( $this->iFormatCallback3 != '' ) {
    	$f = $this->iFormatCallback3;
			list($width,$color,$fcolor) = call_user_func($f,$x,$y,$z);
			$filename = $this->iFileName;
			$imgscale = $this->iScale;
			if ( !empty($width) )
				$this->width = $width;
			if ( !empty($color) )
				$this->color = $color;
			if ( !empty($fcolor) )
				$this->fill_color = $fcolor;
			else
				$this->fill_color = $colorPoint;
			$this->title=new Text($lt);
			if (!empty($this->labelFont))
				$this->title->SetFont($this->labelFont,$this->labelFontStyle,$this->labelFontSize);
		}
		PlotMark::Stroke($img,$x,$y);
	}
	
}	

//===================================================
// CLASS RealBalloonLabelPlot
// Description: Render X, Y and Z plots, Z with label and colors
//===================================================
class RealBalloonLabelPlot extends Plot {
    private $impuls = false;
    private $linkpoints = false, $linkpointweight=1, $linkpointcolor="black";
    private $dataz;
    private $labels;
    private $colors;
    private $labelFont;
    private $labelFontStyle;
    private $labelFontSize;
//---------------
// CONSTRUCTOR
    function RealBalloonLabelPlot($datay,$datax,$dataz,$labels,$colors=array("blue","red","yellow","aqua","green", "gray", "lime", "maroon", "navy", "olive", "purple", "silver", "teal")) {
	if( (count($datax) != count($datay)) || count($datax) != count($dataz) )
	    JpGraphError::RaiseL(20003);//("RealBalloonPlot must have equal number of X, Y and Z points.");
	$this->Plot($datay,$datax);
	$this->Plot->coords[2] = $dataz;
	$this->dataz = $dataz;
	$this->labels = $labels;
	$this->colors = $colors;
	$this->mark = new Plot3DMark();
	$this->mark->SetType(MARK_SQUARE);
	$this->mark->SetColor($this->color);
	$this->value->SetAlign('center','center');
	$this->value->SetMargin(0);
    }

//---------------
// PUBLIC METHODS
    function SetImpuls($f=true) {
	$this->impuls = $f;
    }
    
    function setLabelFont($font,$style,$size) {
    	$this->labelFont = $font;
    	$this->labelFontStyle = $style;
    	$this->labelFontSize = $size;
    }

    // Combine the scatter plot points with a line
    function SetLinkPoints($aFlag=true,$aColor="black",$aWeight=1) {
	$this->linkpoints=$aFlag;
	$this->linkpointcolor=$aColor;
	$this->linkpointweight=$aWeight;
    }

    function Stroke($img,$xscale,$yscale) {

	$ymin=$yscale->scale_abs[0];
	if( $yscale->scale[0] < 0 )
	    $yzero=$yscale->Translate(0);
	else
	    $yzero=$yscale->scale_abs[0];
	    
	$this->csimareas = '';
	for( $i=0; $i<$this->numpoints; ++$i ) {

	    // Skip null values
	    if( $this->coords[0][$i]==='' || $this->coords[0][$i]==='-' || $this->coords[0][$i]==='x')
		continue;

	    if( isset($this->coords[1]) )
		$xt = $xscale->Translate($this->coords[1][$i]);
	    else
		$xt = $xscale->Translate($i);
	    $yt = $yscale->Translate($this->coords[0][$i]);	
	    
	  $zt = $this->dataz[$i];  //echo "zt: ".$zt;
	  $lt = $this->labels[$i];
	  $color = $this->colors[$i];


	    if( $this->linkpoints && isset($yt_old) ) {
		$img->SetColor($this->linkpointcolor);
		$img->SetLineWeight($this->linkpointweight);
		$img->Line($xt_old,$yt_old,$xt,$yt);
	    }

	    if( $this->impuls ) {
		$img->SetColor($this->color);
		$img->SetLineWeight($this->weight);
		$img->Line($xt,$yzero,$xt,$yt);
	    }
	
	    if( !empty($this->csimtargets[$i]) ) {
	        $this->mark->SetCSIMTarget($this->csimtargets[$i]);
	        $this->mark->SetCSIMAlt($this->csimalts[$i]);
	    }
	    
	    if( isset($this->coords[1]) ) {
		$this->mark->SetCSIMAltVal($this->coords[0][$i],$this->coords[1][$i]);
	    }
	    else {
		$this->mark->SetCSIMAltVal($this->coords[0][$i],$i);
	    }

			$this->mark->setLabelFont($this->labelFont,$this->labelFontStyle,$this->labelFontSize);
	    $this->mark->Stroke($img,$xt,$yt,$zt,$lt,$color);
	
	    $this->csimareas .= $this->mark->GetCSIMAreas();
	    $this->value->Stroke($img,$this->coords[0][$i],$xt,$yt);

	    $xt_old = $xt;
	    $yt_old = $yt;
	}
    }
	
    // Framework function
    function Legend($aGraph) {
	if( $this->legend != "" ) {
	    $aGraph->legend->Add($this->legend,$this->mark->fill_color,$this->mark,0,
				 $this->legendcsimtarget,$this->legendcsimalt);
	}
    }	
} // Class
/* EOF */

?>
