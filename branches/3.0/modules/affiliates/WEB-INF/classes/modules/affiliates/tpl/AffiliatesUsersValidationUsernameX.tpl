|-if $value eq 0-|
	{ "name": "|-$name-|", "value": "|-$value-|", "message": "<!--<span class='resultValid'>&#x2713;</span>-->" }
|-else-|
	|-if $minLength eq 1-|
		{ "name": "|-$name-|", "value": "|-$value-|", "message": "<span class='resultInvalid'>El nombre de usario debe tener al menos 4 caracteres</span>" }
	|-else-|
		{ "name": "|-$name-|", "value": "|-$value-|", "message": "<span class='resultInvalid'>Nombre ingresado no disponible</span>" }
	|-/if-|
|-/if-|