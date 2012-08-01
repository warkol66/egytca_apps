|-if !$isAjax-|
	
|-include file="BaseQueryDebug.tpl" debugInfo=$debugInfo-|

<script type="text/javascript" src="scripts/jquery/egytca.js"></script>
<!--<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>-->
<link type="text/css" rel="stylesheet" href="css/chosen.css" />
<script src="scripts/jquery/chosen.js"></script>
<script src="scripts/jquery/ajax-chosen.min.js"></script>

<div>
	<p>La búsqueda "empty" (literalmente escribir empty) no devuelve resultados.
	Cualquier otra búsqueda devuelve siempre las mismas opciones</p>
</div>
<div>
	<h2 id="response">Recibido</h2>
	<p>actorId: |-$get.actorId-|</p>
</div>

<hr>

<div><form method="get" action="Main.php">
	<input type="hidden" name="do" value="planningDummy" />
	<script>
		$(document).ready(function() {
			$('#test1').egytca('autocomplete', 'Main.php?do=planningDummy', {
				disable: '#test1submit',
				noResultsText: 'texto ridiculo de prueba',
				noResultsCallback: function() {
					return { 27: 'value is 27!!' }
					
					// o mostrar form y luego actualizar autocomplete con
					// $('#test1').data('setElem')({4: 'es cuatro'});
				}
			}).change(function() { $('#test1valuespan').html($(this).val()) });
		});
	</script>
	<p>
	<select id="test1" name="actorId" class="chzn-select markets-chz-select" data-placeholder="este texto es modificable">
		<option value="defaultValue" selected="selected">Default Value</option>
		<option value="not selected by default">loaded but not Default Value</option>
	</select>
	&nbsp;
	Valor seleccionado: <span id="test1valuespan">defaultValue</span>
	</p>
	<p><input id="test1submit" type="submit" value="submit" /></p>
</form></div>

<div><form method="get" action="Main.php">
	<input type="hidden" name="do" value="planningDummy" />
	<script>		
		$(document).ready(function() {
			$('#test2').egytca('autocomplete', 'Main.php?do=planningDummy', {
				disable: '#test2submit',
				noResultsText: 'texto ridiculo de prueba',
				noResultsCallback: function() {console.log('super func 2')}
			}).change(function() { $('#test2valuespan').html($(this).val()) });
		});
	</script>
	<p>
	<select id="test2" name="actorId" class="chzn-select markets-chz-select" data-placeholder="este texto es modificable">
		<option value="defaultValue" selected="selected">Default Value</option>
		<option value="not selected by default">loaded but not Default Value</option>
	</select>
	&nbsp;
	Valor seleccionado: <span id="test2valuespan">defaultValue</span>
	</p>
	<p><input id="test1submit" type="submit" value="submit" /></p>
</form></div>


<hr>

|-else-|
	{
		|-if !$empty-|
		"1": "my valor es 1",
		"2": "my valor es 2",
		"3": "my valor es 3",
		"4": "my valor es 4",
		"5": "my valor es 5"
		|-/if-|
	}
|-/if-|
