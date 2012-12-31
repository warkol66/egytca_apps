<script>
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
        $( ".datepickerFrom" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerTo").datepicker("option", "minDate", selectedDate);
            }
		});
		$(".datepickerTo").datepicker({
			dateFormat:"dd-mm-yy",
			defaultValue: $.datepicker.parseDate("dd-mm-yy", "1-1-2013"),
			onClose: function(selectedDate) {
                $(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
            }
		});
    });
</script>
<h2>Banners</h2>
|-if !is_object($banner)-|
<p>El banner especificado no existe</p>
|-else-|
<h1>|-if $banner->isNew()-|Editar|-else-|Crear|-/if-| Banners</h1>
<p>A continuación encontrará el formularo de información del Banner. Ingrese la información solicitada y haga clcik en "Guardar" para conservar los cambios. 
</p>
<form method="post" action="Main.php" id="form1" enctype="multipart/form-data">
	<fieldset title="Formulario de edición de datos de banner">
	<legend>Datos de Banners</legend>
		<p>
			<label for="name">Nombre</label>
			<input type="text" size="50" id='params[name]' name="params[name]" value="|-$banner->getName()-|" class="emptyValidation" |-ajax_onchange_validation_attribute actionName="bannersValidationNameX"-| /> |-validation_msg_box idField="params[name]"-|
		</p>
		<p>
			<label for="clientId">Cliente</label>
			<select name="params[clientId]" size="1">
				<option value="0">Elija un cliente</option>
			|-foreach from=$clients item=client name=for_clients-|
				<option value="|-$client->getId()-|" |-if $client->getId() eq $banner->getClientId()-| selected |-/if-|>|-$client->getName()|truncate:45:"..."-|</option>
			|-/foreach-|
			</select>
		</p>
		<p>
			<label for="targetUrl">URL de destino</label>
			<input type="text" name="params[targetUrl]" size="50" value="|-$banner->getTargetUrl()-|" />
			</p>
		<p>
			<label for="altText">Texto ALT</label>
			 <input type="text" name="params[altText]" size="30" value="|-$banner->getAltText()-|" />
		</p>
		<p>
			<label for="description">Descripción</label>
			<input type="text" name="params[description]" size="55" value="|-$banner->getDescription()-|" />
		</p>
		<p>
			<label for="printsTotal">Total impresiones</label>
			<input type="text" name="params[printsTotal]" size="5" value="|-$banner->getPrintsTotal()-|" />
		</p>
		<p>
			<label for="printsLeft">Restantes</label>
			<input type="text" name="params[printsLeft]" size="5" value="|-$banner->getPrintsLeft()-|" />
		</p>
		<p>
			<label for="frequency">Frecuencia</label>
			<select name="params[frequency]">|-html_options options=$banner->getFrecuencies() selected=$banner->getFrequency()-|</select>
		</p>
		<p>
			<label for="targetUrl">Fecha inicio</label>
			<input name="params[campaignStartDate]" type="text" id="params_campaignStartDate" class="datepickerFrom" title="fromDate" value="|-$banner->getCampaignStartDate()|date_format:"%d-%m-%Y"-|" size="12" />
			
			<span title="|-$banner->getCampaignStartDate()-|">*</span>
		</p>
		<p>
			<label for="targetUrl">Fecha fin</label>
			<input name="params[campaignFinalDate]" type="text" id="params_campaignFinalDate" class="datepickerTo" title="toDate" value="|-$banner->getCampaignFinalDate()|date_format:"%d-%m-%Y"-|" size="12" /> 

			<span title="|-$banner->getCampaignFinalDate()-|">*</span>
		</p>
		<p>
			<label for="content">Contenido</label>
			<input type="file" name="document_file" size="30">
		</p>
		<p>
			<label for="linkTarget">Target del Link</label>
			<select name="params[linkTarget]">|-html_options options=$banner->getLinkTargets() selected=$banner->getLinkTarget()-|</select>
		</p>
		<p>
			<label for="active">Activo</label>
			<input type="checkbox" name="params[active]" value="1" |-if $banner->getActive() eq 1-|checked="checked"|-/if-| />
		</p>
		<p>
			<label for="zones">Zonas</label>
			<div id="assignBannerZones"style="overflow: auto; height: 160px; border: 1px #CCC solid; width: 380px;">
				|-* FIXME: posiblemente se pueda hacer más simple aca y trabajarlo más en el action*-|
				|-foreach from=$allZones item=zone name=for_zones-|
					<label>|-$zone->getName()-|</label>
					<input type="checkbox" name="params[zones][|-$zone->getId()-|]" value="|-$zone->getId()-|" 
					|-foreach from=$selectedZones item=selectedZone name=for_selectedZones-|
						|-if $zone->getId() eq $selectedZone->getZoneId()-| checked |-/if-|
					|-/foreach-|  
					/> <br clear="all"/>
				|-/foreach-|
			</div>
		</p>
		<p>Dimesiones: Sólo ingreselas si la imagen se mostrará en un tamaño diferente al archivo</p>
		<p>
			<label for="width">Ancho</label>
			<input type="text" name="params[width]" size="5" value="|-$banner->getWidth()-|" />
		</p>
		<p>
			<label for="height">Alto</label>
			<input type="text" name="params[height]" size="5" value="|-$banner->getHeight()-|" />
		</p>
		<p>
			<input type="submit" value="##5,Guardar##" class="button" />
			<input type="button" value="##6,Regresar##" onClick="history.go(-1)" class="button" />			    
		</p>
	</fieldset>    
	<input type="hidden" name="id" value="|-$banner->getId()-|" />
	<input type="hidden" name="do" value="bannersDoEdit" />
</form>
|-/if-|
