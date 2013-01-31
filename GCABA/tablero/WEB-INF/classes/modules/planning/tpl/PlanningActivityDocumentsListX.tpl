|-if $planningActivityDocumentColl|count eq 0-|
	<li>No hay documentos asociados</li>
|-else-|
	|-foreach $planningActivityDocumentColl as $planningActivityDocument-|
		<li>
			<span>|-$planningActivityDocument->getName()-|</span>
			<a href="#">ver</a>
			<a href="#">editar</a>
			<a href="#">borrar</a>
		</li>
	|-/foreach-|
|-/if-|