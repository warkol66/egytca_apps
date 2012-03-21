<h2>Configuración del Sistema</h2>
	<h1>Lista de precios por afiliado </h1>
	<p>A continuación podrá cargar una lista de precios por afiliado </p>

|-if isset($rowsCreated)-|

<div id="resultado-importacion" >
	<p>Resultado de la importación</p>
	<p>Registros Creados: |-$rowsCreated-|</p>
	<p>Registros Leidos: |-$rowsReaded -|</p>
	<p>Códigos no Encontrados: 
		<ul>
			|-foreach from=$errorCodes item=code-|
			<li>|-$code-|</li>
			|-/foreach-|
		</ul>
	</p>	
</div>	

|-else-|
<div id="menu-de-importacion" >
	<form id="consulta-form" method="post" class="cmxform" action="Main.php?do=catalogAffiliateProductsDoImport" enctype="multipart/form-data">
		<fieldset>
		<legend>actualización de precios de afiliado</legend>
		<p>Seleccione el archivo con los Precios a importar y el afiliado correspondiente, luego haga click en "Importar".<br />
El archivo a importar debe tener los siguientes campos: <em>|-$importKey-|</em></p>
				<p>
					<label>Afiliado</label>
					<select id="affiliate" name="affiliate" >
						|-foreach from=$affiliates item=affiliate -| 
						<option value="|- $affiliate->getId() -|" >|-$affiliate->getName()-|&nbsp;&nbsp;&nbsp;</option>
						|- /foreach -|
					</select>
				</p>
				<p>
					<label>Archivo de importación:</label>	
					<input name="fileImport" type="file" id="fileImport" size="50">
				</p>
			<input type="submit" value="Importar" id="import-button" />
		</fieldset>
	</form>
</div>
|-/if-|

