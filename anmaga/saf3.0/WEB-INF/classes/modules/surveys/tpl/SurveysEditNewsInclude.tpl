<h3>Asociar la encuesta a una noticia&nbsp;&nbsp;<a href="#" |-popup sticky='true' fgcolor='#ffffff' bgcolor='#ffffff' closecolor='#cdcdcd' closetext='Cerrar' closetitle='Cerrar' capcolor='#ffffff' bgcolor='#0054A4' snapx='10' snapy='10' width='350' trigger='onMouseOver' caption='Asociar a una noticia' text='Puede asociar una encuesta a una noticia, eso hará que la encuesta se despliegue en la parte inferior de la bajada de la misma.'-|><img src="images/clear.png" class="linkImageInfo" /></a></h3>
	<p>
	<label for="survey_articleId">Artículo</label>
	<select name="survey[articleId]">
		<option value="0">Seleccione un Artículo</option>
		|-foreach from=$articles item=article name=for_articles-|
			<option value="|-$article->getId()-|"|-if $survey->getArticleId() eq $article->getId()-| selected="selected"|-/if-|>|-$article->getTitle()|truncate:65:"...":true-|</option>
		|-/foreach-|
	</select>
	</p>
