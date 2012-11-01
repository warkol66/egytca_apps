<h2>|-if !empty($loginAffiliateUser)-||-$loginAffiliateUser->getName()-|, |-$loginAffiliateUser->getSurname()-|<br>|-/if-|
Bienvenido al Sistema |-$parameters.siteName-|</h2>
<p>|-if !empty($SESSION.lastLogin)-|Su último ingreso al sistema fue el <strong>|-$SESSION.lastLogin|change_timezone|date_format:"%d-%m-%Y a las %R"-|</strong>|-/if-|
|-if $parameters.news ne ''-|
<br>
<br>|-$parameters.news-|
|-/if-|
</p>
