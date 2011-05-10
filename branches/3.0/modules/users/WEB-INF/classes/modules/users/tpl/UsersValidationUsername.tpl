|-if $value eq 0-|
	{ "name": "|-$name-|", "value": "|-$value-|", "message": "<!--<span class='resultValid'>&#x2713;</span>-->" }
|-else-|
	{ "name": "|-$name-|", "value": "|-$value-|", "message": "<span class='resultInvalid'>Nombre ingresado no disponible</span>" }
|-/if-|