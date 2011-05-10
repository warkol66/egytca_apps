<script type="text/javascript" language="javascript" src="scripts/lausi-rotate.js" ></script>
<h2>Distribución de Motivos</h2>
<h1>Rotación de Motivos</h1>
<p>Seleccione una dirección para ver los Motivos publicados en la misma.</p>

<fieldset>
<legend>Formulario de rotación de motivos</legend>
	<form action="Main.php" method="get" id="searchForm">
		<p>
			<label for="filters[searchRegionId]">Barrio</label>
			<select name="filters[searchRegionId]">
				<option value="">Seleccione un Barrio</option>
				|-foreach from=$regions item=region name=for_regions-|
					<option value="|-$region->getId()-|" |-$region->getId()|selected:$filters.searchRegionId-|>|-$region->getName()-|</option>
				|-/foreach-|
				</select>
		</p>
		<p>
			<label for="filters[searchCircuitId]">Circuito</label>
			<select name="filters[searchCircuitId]">
				<option value="">Seleccione un circuito</option>
				|-foreach from=$circuits item=circuit name=for_circuit-|
					<option value="|-$circuit->getId()-|" |-$circuit->getId()|selected:$filters.searchCircuitId-|>|-$circuit->getName()-|</option>
				|-/foreach-|
			</select>				
		</p>
		<p>
			<label for="filters[searchStreetName]">Nombre de Calle</label>
			<input type="text" name="filters[searchStreetName]" value="|-$filters.searchStreetName-|" />
		</p>		
|-if $filters ne '' and $filters|@count gt 0-|
	|-if $addresses|@count gt 0-|
		<p>
			<label for="addressId">Dirección</label>
			<select id='addressId' name="addressId">
					<option value="">Seleccione Una Dirección</option>
				|-foreach from=$addresses item=address name=for_address-|
					<option value="|-$address->getId()-|" |-if isset($addressId) and $addressId eq $address->getId()-|selected="selected"|-/if-|>|-$address->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
	|-else-|
		<p>
				<label for="result">Resultado</label> No hay direcciones que coincidan con la información ingresada
		</p>
	|-/if-|		
|-/if-|		
		<p>
			<input type="hidden" name="do" value="lausiThemesRotate" />
			<input type="submit" value="Buscar Motivos En Dirección" /> <span id="addressMsgbox"></span>
		</p>

	</form>
</fieldset>

|-if empty($advertisements)-|
|-if $addressId neq ''-|
	<div class="successMessage">No hay motivos vigentes en esta dirección</div>
|-/if-|
|-else-|
	|-foreach from=$advertisements item=advert name=for_advert-|
	<div id='advertHolder|-$advert->getId()-|'>
<fieldset>
	<form id="formAdvert|-$advert->getId()-|" method="post">
					|- assign var=theme value=$advert->getTheme()-|
					|- assign var=billboard value=$advert->getBillboard()-|
			<p>	<strong>Motivo: |-$theme->getName()-| - |-$theme->getShortName()-| </strong><br />
					Publicación: |-$advert->getPublishDate()|date_format:"%d-%m-%Y"-| - Duración: 
					|-$advert->getDuration()-| días - Número de Cartelera: |-$billboard->getNumber()-|
		</p>
			<p>
				<input type="hidden" name="themeId" value="|-$theme->getId()-|" />
				<input type="hidden" name="advertId" value="|-$advert->getId()-|" />
				<input type="button" name="recommend" value="Proponer Rotación" onClick="javascript:lausiProposeRotation(this.form,'|-$advert->getId()-|')" /> 
				<input type="hidden" name="do" value="lausiThemesProposeRotationX" />
				<span id="msgbox|-$advert->getId()-|"></span>
			</p>
	</form>				
	<div id="formAdvertDiv|-$advert->getId()-|">
		
	</div>
	
</fieldset>
	</div>
	|-/foreach-|
|-/if-|

<script type="text/javascript" language="javascript" >
// <![CDATA[
	Event.observe('regionIdForm','change',searchFormSubmit);
	Event.observe('circuitIdForm','change',searchFormSubmit);
	Event.observe('addressTextForm','change',searchFormSubmit);
// ]]>
</script>
