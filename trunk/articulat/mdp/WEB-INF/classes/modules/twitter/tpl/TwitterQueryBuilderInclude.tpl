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
		<p>
			<input type="submit" class="acceptBtn" onclick="throw 'no target defined. use addQueryBuilder()'; return false;" value="Aceptar">
		</p>
	</form>
</div>
<script src="scripts/char-separated-texts.js"></script>
<script src="scripts/twitter-query-builder.js"></script>
<script src="scripts/twitter-query-parser.js"></script>
<script>
	var callback = |-$callback-|;
	var queryParser = new TwitterQueryParser();
	
	var addQueryBuilder = function(target, trigger) {
		var form = document.getElementById('twitter-query-builder').getElementsByTagName('form')[0];
		var acceptBtn = form.getElementsByClassName('acceptBtn')[0];
		var queryBuilder = new TwitterQueryBuilder(form, target);
		trigger.onclick = function() {
			fillForm(form, target);
			acceptBtn.onclick = function() {
				queryBuilder.apply();
				callback();
			};
		};
	};
	
	var fillForm = function(form, query) {
		
		var results = queryParser.parse(query.value).getResultsStrings();
		
		form.reset();
		form.querySelector('.all-of-these').value = results.word;
		form.querySelector('.exact-frase').value = results.exactFrase;
		form.querySelector('.any-of-these').value = results.anyWord;
		form.querySelector('.none-of-these').value = results.bannedWord;
		form.querySelector('.hashtags').value = results.hashtag;
		form.querySelector('.from-accounts').value = results.fromAccount;
		form.querySelector('.to-accounts').value = results.toAccount;
		form.querySelector('.mentions').value = results.mention;
		
		var langSelect = form.querySelector('.lang');
		
		for (var i = 0; i < langSelect.options.length; i++) {
			if (langSelect.options[i].value === results.lang) {
				langSelect.selectedIndex = i;
				break;
			}
		};
	};
</script>
