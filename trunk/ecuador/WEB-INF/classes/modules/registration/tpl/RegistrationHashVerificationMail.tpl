<p>
	|-$registrationUser->getName()-| |-$registrationUser->getSurname()-|, Ha creado una cuenta. Ahora se requiere la activación de la misma.
</p>
<p>
	Acceda al siguiente link para activar su cuenta.<br />
	<a href="|-$systemUrl-|?do=registrationDoHashVerification&amp;hash=|-$hash-|">|-$systemUrl-|?do=registrationDoHashVerification&amp;hash=|-$hash-|</a>
</p>
<p>
	Si usted no realizo la petición de registro, o desea cancelar el proceso de inscripción acceda al siguiente link.<br />
	<a href="|-$systemUrl-|?do=registrationDoCancel&amp;hash=|-$hash-|">|-$systemUrl-|?do=registrationDoCancel&amp;hash=|-$hash-|</a>
</p>
