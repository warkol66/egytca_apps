{
	"errors": |-json_encode($errors)|default:null-|
	|-if $headlines-|
		, "headlines": [
			|-foreach $headlines as $headline-|
				|-$headline->toJSON()-|
				|-if !$headline@last-|,|-/if-|
			|-/foreach-|
		]
	|-/if-|
}