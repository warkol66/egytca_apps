
	<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tableTdBorders'>
<tr>

<th colspan='2'>
<form method="GET" action="Main.php" style="display:inline">
	<input type="hidden" name="do" value="|-$smarty.request.do-|" />
	<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
Relaciones entre |-$actor1->getName()-| y <select name='actor2' onchange="this.form.submit()">|-html_options options=$actors selected=$actor2->getId() -|</select>
</form>
</th>

</tr>
</table>
<br />

|-if $message eq "saved"-|<span class="message_ok">Grafico guardado correctamente</span>|-/if-|

|-if $actor1->getId() and $actor2->getId()-|

<a href="Main.php?do=analysisRelation&list=1&actor=|-$actor1->getId()-|&actor2=|-$actor2->getId()-|">Ver graficos guardados para la relacion</a>

<form method="get" action="Main.php">
<ul>
|-foreach from=$questions item=question name=for_questions-|
	|-assign var=values value=$question->getRelationshipValues($actor1,$actor2)-|
	<li>|-$question->getQuestion()-| <input type="checkbox" name="questions[]" value="|-$question->getId()-|" |-if $question->getId()|in_array:$questions-|checked="checked" |-/if-|/>|-if $values.0 eq 0 || $values.0 eq 0-| <span class="textoerror">Sin Datos</span>|-/if-|</li>
|-/foreach-|
</ul>
<input type="hidden" name="do" value="|-$smarty.request.do-|" />
<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
<input type="hidden" name="actor2" value="|-$actor2->getId()-|" />
<input type="submit" value="Ver Grafico" />
</form>
|-/if-|

|-if $stringQuestions ne "" -|
	<img src="Main.php?do=analysisGraphCompareShow&actor1=|-$actor1->getId()-|&actor2=|-$actor2->getId()-|&|-$stringQuestions-|" alt="Error al Generar el Grafico Comparativo - No existen datos para las relaciones seleccionadas" />

<form method="post" action="Main.php">
<p>
	<label for="name">Name</label>
	<input type="text" name="name" />
</p>
<p>
	<label for="judgement">Judgement</label>
	<textarea name="judgement"></textarea>
</p>
|-foreach from=$activeQuestions item=activeQuestion name=for_active_questions-|
|-assign var=question value=$activeQuestion->getQuestion()-|
|-if $question->getId()|in_array:$questions-|<input type="hidden" name="questions[]" value="|-$question->getId()-|" />|-/if-|
|-/foreach-|
<input type="hidden" name="do" value="analysisGraphRelationDoSave" />
<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
<input type="hidden" name="actor2" value="|-$actor2->getId()-|" />
<input type="submit" value="Guardar Grafico" />
</form>

|-/if-|
