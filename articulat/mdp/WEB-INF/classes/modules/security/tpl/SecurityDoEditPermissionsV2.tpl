{
	"errors": |-$errors|json_encode-|
	|-if $actions-|
		,
		"actions": |-$actions|json_encode-|
	|-/if-|
	|-if $modules-|
		,
		"modules": |-$modules|json_encode-|
	|-/if-|
}