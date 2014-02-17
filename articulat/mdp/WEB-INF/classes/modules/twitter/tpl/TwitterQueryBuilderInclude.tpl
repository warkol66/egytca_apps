<link rel="stylesheet" type="text/css" href="css/twitter-query-builder.css">
<div id="twitter-query-builder">
	<form>
		<p>
			<label>Todas estas palabras</label>
			<input type="text" class="all-of-these" value="">
		</p>
		<p>
			<label>Esta frase exacta</label>
			<input type="text" class="exact-frase" value="">
		</p>
		<p>
			<label>Cualquiera de estas palabras</label>
			<input type="text" class="any-of-these" value="">
		</p>
		<p>
			<label>Ninguna de estas palabras</label>
			<input type="text" class="none-of-these" value="">
		</p>
		<p>
			<label>Estos hastags</label>
			<input type="text" class="hashtags" value="">
		</p>
		<p>
			<label>Desde estas cuentas</label>
			<input type="text" class="from-accounts" value="">
		</p>
		<p>
			<label>Hacia estas cuentas</label>
			<input type="text" class="to-accounts" value="">
		</p>
		<p>
			<label>Mencionando estas cuentas</label>
			<input type="text" class="mentions" value="">
		</p>
		<p>
			<label>Escrito en</label>
			<select class="lang">
				<option value="" selected="selected">-- Cualquiera --</option>
				<option value="es">Español</option>
				<option value="en">Inglés</option>
			</select>
		</p>
<!--		<p>
			<label>Cerca de</label>
			<input type="text" class="near" value="">
		</p>-->
		<p>
			<input type="submit" class="acceptBtn" onclick="callback();" value="Aceptar">
		</p>
	</form>
</div>
<script src="scripts/twitter-query-builder.js"></script>
<script>
	var callback = |-$callback-|;
	
	var addQueryBuilder = function(target, trigger) {
		var form = document.getElementById('twitter-query-builder').getElementsByTagName('form')[0];
		var acceptBtn = form.getElementsByClassName('acceptBtn')[0];
		var queryBuilder = new TwitterQueryBuilder(form, target);
		trigger.onclick = function() {
			form.reset();
			acceptBtn.onclick = function() {
				queryBuilder.apply();
				callback();
			};
		};
	};
</script>
