<div id="casesList">|-foreach from=$studycases item=studycase name=for_studycases-|
<ul><!--<a href="Main.php?do=studycasesView&id=|-$studycase->getId()-|&toPdf=true&toDownload=true" title="Descargar en formato PDF"><img src="images/icon_pdf.png" /></a>--><h3><a href="Main.php?do=studycasesView&id=|-$studycase->getId()-|" title="Ver detalle de la experiencia"> |-$studycase->getTitle()-|</a>
	<br />|-$studycase->getReference()-|</h3> 
	<p>|-$studycase->getSummary()-|</p>
</ul>|-/foreach-|
</div>