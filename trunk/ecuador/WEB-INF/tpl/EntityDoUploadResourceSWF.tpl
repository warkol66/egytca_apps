{
	"error": |-json_encode($error)-|,
	|-if $error eq 1-|
		"message": |-json_encode($message)-|
	|-else-|
		"data": |-json_encode($data)-|
	|-/if-|
}