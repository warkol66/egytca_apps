<form id="form" method="post">

	<p>
	<h1>Acciones sobre Motivo: |-$theme->getName()-|</h1>
	</p>
	<fieldset>
		<legend>Extensión de Publicación</legend>
		<p>A continuación indique la cantidad de días a extender la publicación de los avisos en las carteleras seleccionadas.</p>
		<p>
			<label>Cantidad de Dias</label>
			<input type="hidden" name="themeId" value="|-$theme->getId()-|" id="" />
			<input type="text" name="extension"/>
		</p>
		<p><input type="button" value="Extender Opciones Selecionadas" onClick="javascript:lausiCampaignsDoExtension(this.form)"/> <span class='inProgress' id="msgboxExtension"></span></p>
	</fieldset>
	<br />
	<fieldset>
		<legend>Reducir Publicación</legend>
		<p>A continuación indique la cantidad a reducir la publicación de los avisos en las carteleras seleccionadas.</p>
		<p>
			<label>Cantidad de Días</label>
			<input type="hidden" name="themeId" value="|-$theme->getId()-|" id="" />
			<input type="text" name="reduction"/>
		</p>
		<p><input type="button" value="Reducir Opciones Selecionadas" onClick="javascript:lausiCampaignsDoReduction(this.form)"/> <span class='inProgress' id="msgboxReduction"></span></p>
	</fieldset>
	<input type="hidden" name="do" value="" id="actionDoField">

	<table id="campaignTable" width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				 <th colspan="6" class="thFillTitle">Motivo: |-$theme->getName()-| (|-if $theme->getType() eq 2-|Séxtuples|-else-|Afiches|-/if-| distribuidos:  |-$theme->getSheetsDistributed()-| / Por distribuir: |-$theme->getSheetsToBeDistributed()-|)</th>
			</tr>
		|-if empty($campaign)-|
		<td width="1%"></thead>
		<tbody>
			<tr>
				 <th colspan="6" class="thFillTitle">No hay avisos de este motivo </th>
			</tr>
		</tbody>
		|-else-|
			<tr>
				<th><input name="allbox" onclick="javascript:CheckAllBoxes(this.form)" type="checkbox" checked="checked"></th>
				<th>Dirección</th>
				<th width="5%" nowrap="nowrap">Número de Cartelera</th>
				<th width="15%" nowrap="nowrap">Inicia</th>
				<th width="15%" nowrap="nowrap">Duración</th>
				<th width="15%" nowrap="nowrap">Finaliza</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$campaign item=addressHolder-|

			|-assign var=address value=$addressHolder.address -|
<!--			<tr>
				<td colspan="6">|-$address->getName()-|</td>
			</tr>-->
			|-foreach from=$addressHolder.billboards item=billboardHolder-|

				|-assign var=billboard value=$billboardHolder.billboard-|

				|-foreach from=$billboardHolder.adverts item=advert name=for_campaign-|
					|-assign var=billboard value=$advert->getBillboard()-|
					|-assign var=address value=$billboard->getAddress()-|
					<tr id="advertRow|-$advert->getId()-|">
						<td><input type="checkbox" checked="checked" name="toExtend[]" value="|-$advert->getId()-|" /></td>
						<td width="45%">|-$address->getName()-|</td>
						<td>|-$billboard->getNumber()-|</td>
						<td>|-$advert->getPublishDate()|date_format:"%d-%m-%Y"-|</td>
						<td>|-$advert->getDuration()-|</td>
						<td>|-$advert->getEndDate()|date_format:"%d-%m-%Y"-|</td>
					</tr>
				|-/foreach-|									

			|-/foreach-|
			
		|-/foreach-|						
			<tr> 
				<td colspan="6">				</td> 
			</tr>							
		</tbody>
		|-/if-|
	</table>
	<p>
		<input type="button" name="deleteButton" value="Eliminar Avisos Seleccionados" id="deleteButton" onClick="javascript:lausiCampaignsDoDelete(this.form)"> <span id="msgboxDeletion"></span>
	</p>

</form>
	<br />
	<form action="Main.php" method="get">	
		<fieldset>
			<legend>Agregado de Avisos a Motivo</legend>
			<p>A continuación seleccione el método de distribución para poder cargar el asistente de distribución para la nuevas carteleras</p>
			<p>	
				<label>Método de Distribución</label>
				<input type="hidden" name="actionType" value="ajax"/>
				<select name="do">
					<option value="lausiDistributeByRegion">Por Barrio</option>
					<option value="lausiDistributeByCircuit">Por Circuito</option>
					<option value="lausiDistributeByCircuitPercentage">Por Porcentual por Circuito</option>
					<option value="lausiDistributeByRating">Por Valoración</option>
					<option value="lausiDistributeByLocation">Por Ubicación Geográfica</option>
				</select>
				<input type="hidden" name="themeId" value="|-$theme->getId()-|" />
				<input type="button" name="loadDistributionButton" value="Cargar Asistente de Distribución" onClick="javascript:lausiCampaignsLoadDistributionWizard(this.form)"/>
			</p>
		</fieldset>
	</form>



		<div id="distributionHolder">
		</div>

