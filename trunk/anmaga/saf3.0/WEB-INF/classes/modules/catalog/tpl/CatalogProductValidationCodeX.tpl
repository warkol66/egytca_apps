|-if $value eq 0-|
	{ "name": "|-$name-|", "value": "|-$value-|", "message": "|-$message-|", "disableElement": "save_product", "disabled": "false" }
|-else-|
	|-if $minLength eq 1-|
		{ "name": "|-$name-|", "value": "|-$value-|", "message": "|-$message-|<span class='resultInvalid'>El código de producto debe tener al menos 4 caracteres</span>", "disableElement": "save_product", "disabled": "true" }
	|-else-|
		{ "name": "|-$name-|", "value": "|-$value-|", "message": "|-$message-|<span class='resultInvalid'>El código de producto se encuentra en uso, no puede asignar un código existente.</span>", "disableElement": "save_product", "disabled": "true" }
	|-/if-|
|-/if-|