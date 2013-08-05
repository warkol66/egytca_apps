{
	"errors": |-$errors|json_encode-|
	|-if $action-|
		,
		"action": |-$action|json_encode-|
	|-/if-|
	|-if $module-|
		,
		"module": |-$module|json_encode-|
	|-/if-|
}