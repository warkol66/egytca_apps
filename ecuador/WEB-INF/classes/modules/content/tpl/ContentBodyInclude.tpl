|-assign var=contenido value=$result[0]->setLocale($currentLanguageCode)-|
|-if is_object($contenido)-||-$contenido->getBody()-||-/if-|