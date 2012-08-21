|-if $event->getIsConstruction()-|
<script type="text/javascript" language="javascript" src="scripts/jquery/jquery.carouFredSel-5.6.1.js"></script>
<script language="javascript" type="text/javascript">
 $('#fancyboxDiv').ajaxComplete(function() {
				//	Scrolled by user interaction
	$("#foo2").carouFredSel({
		circular: false,
		infinite: false,
		auto 	: false,
		scroll	: {
			items	: "page"
		},
		prev	: {	
			button	: "#foo2_prev",
			key		: "left"
		},
		next	: { 
			button	: "#foo2_next",
			key		: "right"
		},
		pagination	: "#foo2_pag"
	});
});
</script>
<div class="fichaObra">
       <div class="fichaHeader">
		    <div class="fichaHeaderTitle"></div>
    	    <div class="fichaHeaderLogo"></div>
       </div><!-- // fichaHeader-->
<div class="fichaMainTitle">
        	<ul class="fichaTitle gris">
                   <li class="fichaTitleLeft"></li>
            <li class="fichaTitleCenter">|-$event->getTitle()-|</li>
                   <li class="fichaTitleRight"></li>
		           <li class="fichaTitleDate"><span>Fecha de visita: </span> 16/06/2012</li>
		           <li class="fichaTitlePerson"><span>Relevador: </span> 16/06/2012</li>
            </ul>
   	</div>
<!-- // fichaMainTitle-->

<table width="100%" border="0" cellspacing="8" cellpadding="0" class="fichaTable">
<tr>
<th>Dependencia</th>
		<td colspan="2" class="fichaTd75">|-assign var=categories value=$event->getCategorys()-||-foreach from=$categories item=object-||-if $categories|@count gt 1-||-if !$object@first-|,|-/if-| |-/if-||-$object-||-/foreach-|</td>
</tr>
<tr>
<th>Localización</th>
<td colspan="2" class="fichaTd75">|-$event->getAddress()-|</td>
</tr>
<tr>
<th>Ficha estimada del evento</th>
<td colspan="2" class="fichaTd75">|-$event->getStartDate()|date_format-|</td>
</tr>
<tr>
<th>Descripción</th>
<td colspan="2" class="fichaTd75">|-$event->getBody()-|</td>
</tr>
<tr>
<td rowspan="2" class="fichaMap"><div class="fichaGoogleMap"></div></td>
<th >&nbsp;

Avance de la obra </th>
<td rowspan="2" class="fichaMap"><div class="fichaMapaCaba">
|-assign var=comuna value=$event->getComuna()-|<img src="images/Comuna_|-$comuna-|.png" alt="|-if $comuna gt 0-|Comuna |-$comuna-||-else-||-/if-|"/></div></td>
</tr>
<tr>
<td class="fichaTd50 fichaDescription"><div class="fichaDescriptionText">
<p>250 caracteres con espacios, consectetur adipiscing elit. Etiam eget nisl nec ipsum elementum porta sed vitae est. Duis ac mauris ac ligula vestibulum fringilla a vitae elit. Phasellus interdum commodo dui a pulvinar. Fusce vel elit arcu, ut tincidunt.</p>
</div></td>
</tr>
<tr>
<td rowspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableDetallesTable">
<tr>
<th>FF Estim. sobre Relev.<br />
<span>(al día de la visita)</span></th>
<td>21/06/2018</td>
</tr>
<tr>
<th>FF s/ Ministerio<br />
<span>(al día de la visita)</span></th>
<td>14/01/2012</td>
</tr>
<tr>
<th>Obrador</th>
<td>No</td>
</tr>
<tr>
<th>Avance s/ Relev</th>
<td>100%</td>
</tr>
<tr>
<th>Ritmo de Trabajo</th>
<td>BAJO</td>
</tr>
<tr>
<th>Cant. de Personal</th>
<td>1000</td>
</tr>
</table></td>
<th>Conclusiones

</th>
<td rowspan="2" class="fichaEstadoTable"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th>Estado</th>
<td><div class="indicadorRojo"></div></td>
</tr>
<tr>
<th>Obra civil finaliz.</th>
<td><div class="indicadorAmarillo"></div></td>
</tr>
<tr>
<th>Infraestruct. Finaliz.</th>
<td><div class="indicadorVerde"></div></td>
</tr>
<tr>
<th>Servicios</th>
<td><div class="indicadorAzul"></div></td>
</tr>
<tr>
<th>Equipamiento</th>
<td><div class="indicadorBlanco"></div></td>
</tr>
<tr>
<th>Personal/Nombr.</th>
<td><div class="indicadorNegro"></div></td>
</tr>
</table></td>
</tr>
<tr>
<td class="fichaTd50 fichaConclusion"><div class="fichaConclusionText">
<p>250 caracteres con espacios, consectetur adipiscing elit. Etiam eget nisl nec ipsum elementum porta sed vitae est. Duis ac mauris ac ligula vestibulum fringilla a vitae elit. Phasellus interdum commodo dui a pulvinar. Fusce vel elit arcu, ut tincidunt.</p>
</div></td>
</tr>

<tr>
<td colspan="3" class="fichaTd100 fichaGallery">
<div class="image_carousel">
	<div id="foo2">
		<a href="http://www.google.com" target="_blank"><img src="/examples/images/small/basketball.jpg" alt="basketball" width="140" height="140" /></a>
		<a href="http://www.google.com" target="_blank"><img src="/examples/images/small/beachtree.jpg" alt="beachtree" width="140" height="140" /></a>
		<a href="http://www.google.com" target="_blank"><img src="/examples/images/small/cupcackes.jpg" alt="cupcackes" width="140" height="140" /></a>
		<a href="http://www.google.com" target="_blank"><img src="/examples/images/small/hangmat.jpg" alt="hangmat" width="140" height="140" /></a>
		<a href="http://www.google.com" target="_blank"><img src="/examples/images/small/new_york.jpg" alt="new york" width="140" height="140" /></a>
		<img src="/examples/images/small/laundry.jpg" alt="laundry" width="140" height="140" />
		<img src="/examples/images/small/mom_son.jpg" alt="mom son" width="140" height="140" />
		<img src="/examples/images/small/picknick.jpg" alt="picknick" width="140" height="140" />
		<img src="/examples/images/small/shoes.jpg" alt="shoes" width="140" height="140" />
		<img src="/examples/images/small/paris.jpg" alt="paris" width="140" height="140" />
		<img src="/examples/images/small/sunbading.jpg" alt="sunbading" width="140" height="140" />
		<img src="/examples/images/small/yellow_couple.jpg" alt="yellow couple" width="140" height="140" />	</div>
	<div class="clearfix"></div>
	<a class="prev" id="foo2_prev" href="#"><span>prev</span></a>
	<a class="next" id="foo2_next" href="#"><span>next</span></a>
	<div class="pagination" id="foo2_pag"></div>
</div></td>
</tr>
</table>
</div>
<!-- // fichaObra-->



|-else-|
<div class="fichaObra">
	 <div class="fichaHeader">
		<div class="fichaHeaderTitle"></div>
			<div class="fichaHeaderLogo"></div>
	 </div><!-- // fichaHeader-->
<div class="fichaMainTitle">
<ul class="fichaTitle gris">
 <li class="fichaTitleLeft"></li>
	<li class="fichaTitleCenter">|-$event->getTitle()-|</li>
 <li class="fichaTitleRight"></li>
</ul>
</div>
<!-- // fichaMainTitle-->

<table width="100%" border="0" cellspacing="8" cellpadding="0" class="fichaTable">
	<tr>
		<th>Dependencia</th>
		<td colspan="2" class="fichaTd75">|-assign var=categories value=$event->getCategorys()-||-foreach from=$categories item=object-||-if $categories|@count gt 1-||-if !$object@first-|,|-/if-| |-/if-||-$object-||-/foreach-|</td>
	</tr>
	<tr>
		<th>Localización</th>
		<td colspan="2" class="fichaTd75">|-$event->getAddress()-|</td>
	</tr>
	<tr>
		<th>Fecha estimada del evento</th>
		<td colspan="2" class="fichaTd75">|-$event->getStartDate()|dateTime_format-| - |-$event->getEndDate()|dateTime_format-|</td>
	</tr>
	<tr>
		<th>Descripción</th>
		<td colspan="2" class="fichaTd75">|-$event->getBody()-|</td>
	</tr>
	<tr>
		<td rowspan="2" class="fichaMap"><div class="fichaGoogleMap"></div></td>
		<th>Comentarios</th>
		<td rowspan="2" class="fichaMap"><div class="fichaMapaCaba">|-assign var=comuna value=$event->getComuna()-|<img src="images/Comuna_|-$comuna-|.png" alt="|-if $comuna gt 0-|Comuna |-$comuna-||-else-||-/if-|"/></div></td>


	</tr>
	<tr>
		<td class="fichaTd50 fichaDescription">|-$event->getComments()-|</td>
	</tr>
</table>
</div>
<!-- // fichaObra-->


|-/if-|
<div id="showEvent">
<fieldset>
<p><br>
<input type='button' id="cancelButton" onClick="$.fancybox.close();" value="Cerrar" />
|-if "calendarEventsDoEditX"|security_has_access && !$noEdit-|<input type='button' id="editButton" onClick="callEditEvent();" value="Editar" />|-/if-|
|-if "calendarEventsDoDelete"|security_has_access && !$noDelete-|<input type='button' id="deleteButton" onClick="callDeleteEvent();" value="Eliminar" />|-/if-|</p>
</fieldset>
</div>

<script>
	var callEditEvent = function() {
		$.fancybox.close();
		var event = |-include file="CalendarPhpEventToJson.tpl" event=$event-|;
		event.start = new Date(event.start);
		event.end = new Date(event.end);
		setTimeout(function() {editEvent(event)}, 300); // hack feo para fancybox
	}
	
	var callDeleteEvent = function() {
		if (confirm('¿Desea borrar el evento?')) {
			doDeleteEventById(|-$event->getId()-|);
			$.fancybox.close();
		}
	}
</script>