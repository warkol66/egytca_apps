<h2>|-if !empty($loginAffiliateUser)-||-assign var="userInfo" value=$loginAffiliateUser->getAffiliateUserInfo()-||-$userInfo->getName()-|, |-$userInfo->getSurname()-|<br>|-/if-|
Bienvenido al Sistema |-$parameters.siteName-|</h2>
<p>|-if !empty($SESSION.lastLogin)-|Su último ingreso al sistema fue el <strong>|-$SESSION.lastLogin|change_timezone|date_format:"%d-%m-%Y a las %R"-|</strong>|-/if-|
|-if $parameters.affiliateNews ne ''-|
<br>
<br>|-$parameters.affiliateNews-|
|-/if-|
</p>
