<div>
	<table class="errorReport">
		<thead>
			<tr align="center">
				<td colspan="2">Error</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Fecha y hora</td>
				<td>|-$datetime-|</td>
			</tr>
			<tr>
				<td>Tipo</td>
				<td>|-$type-|</td>
			</tr>
			<tr>
				<td>Mensaje</td>
				<td>|-$text-|</td>
			</tr>
			<tr>
				<td>En</td>
				<td>|-$file-|:|-$line-|</td>
			</tr>
			|-if $context-|
				<tr>
					<td>Context</td>
					|-* asigno a una variable para no mostrar el resultado de print_r ("1") *-|
					<td><pre>|-$dontUseMe = $context|print_r-|</pre></td>
				</tr>
			|-/if-|
		</tbody>
	</table>
</div>