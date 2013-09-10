|-extends file="Template.tpl"-|
|-block name="title"-|
	<title>|-$parameters.siteName-| |-if $SESSION.supervisorUser-|#supervisor como: |-$SESSION.loginUser->getUsername()-| |-/if-|</title>
|-/block-|