<?php



/**
 * Skeleton subclass for performing query and update operations on the 'registration_user' table.
 *
 * Users by registration
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.registration.classes
 */
class RegistrationUserQuery extends BaseRegistrationUserQuery
{

    protected static $countries = array(
        'Argentina',
        'Bolivia',
        'Brasil',
        'Chile',
        'Paraguay',
        'Uruguay',
        'separator',
        'Otro',
        'separator',
        'Afghanistán',
        'Albania',
        'Argelia',
        'Samoa Americana',
        'Andorra',
        'Angola',
        'Antigua y Bermuda',
        'Armenia',
        'Aruba',
        'Australia',
        'Austria',
        'Azerbaidjan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Bielorrusia',
        'Bélgica',
        'Belize',
        'Benin',
        'Bermuda',
        'Buthán',
        'Bosnia',
        'Botswana',
        'Brunei',
        'Bulgaria',
        'Burkina Faso',
        'Burundí',
        'Camboya',
        'Camerún',
        'Canadá',
        'Cabo Verde',
        'Islas Caymanes',
        'República Centroafricana',
        'Chad',
        'China',
        'Colombia',
        'Comoros',
        'Islas Cook',
        'Costa Rica',
        'Costa de Marfil',
        'Croacia',
        'Chipre',
        'República Checa',
        'Dinamarca',
        'Djibouti',
        'República Dominicana',
        'Timor Oriental',
        'Ecuador',
        'Egipto',
        'El Salvador',
        'Guinea Ecuatorial',
        'Eritrea',
        'Estonia',
        'Etiopía',
        'Islas Malvinas',
        'Fiji',
        'Finlandia',
        'Francia',
        'Guyana Francesa',
        'Polinesia',
        'Gabón',
        'Gambia',
        'Georgia',
        'Alemania',
        'Ghana',
        'Gibraltar',
        'Grecia',
        'Groenlandia',
        'Granada',
        'Guadalupe',
        'Guam',
        'Guatemala',
        'Guinea',
        'Guinea Bissau',
        'Guyana',
        'Haití',
        'Honduras',
        'Hong Kong',
        'Hungría',
        'Islandia',
        'India',
        'Indonesia',
        'Irlanda',
        'Israel',
        'Italia',
        'Jamaica',
        'Japón',
        'Jordania',
        'Kazakstán',
        'Kenya',
        'Kiribati',
        'Corea del Sur',
        'Kuwait',
        'Kyrgyzstán',
        'Laos',
        'Líbano',
        'Lesotho',
        'Liberia',
        'Liechtenstein',
        'Lituania',
        'Luxemburgo',
        'Macaos',
        'Macedonia',
        'Madagascar',
        'Malawe',
        'Malasia',
        'Malí',
        'Malta',
        'Islas Marshall',
        'Martinica',
        'Mauritania',
        'Mauritius',
        'México',
        'Micronesia',
        'Moldavia',
        'Mónaco',
        'Mongolia',
        'Montserrat',
        'Marruecos',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nepal',
        'Holanda',
        'Antillas Holandesas',
        'Nueva Caledonia',
        'Nueva Zelanda',
        'Nicaragua',
        'Nigeria',
        'Islas Marianas',
        'Noruega',
        'Omán',
        'Pakistán',
        'Palau',
        'Panamá',
        'Papúa-Nueva Guinea',
        'Perú',
        'Filipinas',
        'Polonia',
        'Portugal',
        'Puerto Rico',
        'Qatar',
        'Reunión',
        'Rumania',
        'Rusia',
        'Ruanda',
        'Santa Helena',
        'Saint Kitts and Nevis',
        'Santa Lucía',
        'Saint Pierre y Miquelón',
        'S.Vincente and Granadina',
        'Samoa',
        'San Marino',
        'Santo Tomé y Príncipe',
        'Arabia Saudita',
        'Senegal',
        'Seychelles',
        'Sierra León',
        'Singapur',
        'Eslovaquia',
        'Eslovenia',
        'Islas Solomon',
        'Somalía',
        'Sudáfrica',
        'España',
        'Sri Lanka',
        'Surinam',
        'Swaziland',
        'Suecia',
        'Suiza',
        'Taiwán',
        'Tajikistán',
        'Tanzania',
        'Tailandia',
        'Togo',
        'Tonga',
        'Trinidad y Tobago',
        'Túnez',
        'Turquía',
        'Turkmenistán',
        'Uganda',
        'Ucrania',
        'Emiratos Árabes Unidos',
        'Gran Bretaña',
        'Estados Unidos de América',
        'Uzbekistán',
        'Vanatu',
        'El Vaticano',
        'Venezuela',
        'Vietnam',
        'Islas Vírgenes (EE.UU.)',
        'Islas Vírgenes (Británicas)',
        'Sahara Occidental',
        'Yemen',
        'Yugoslavia',
        'República Democrática de Congo',
        'Zambia',
        'Zimbabwe'
    );

    public static function getGroups(){
        return RegistrationUserQuery::$groups;
    }

    /**
     * Retorna el listado de paises para el registro de usuarios.
     * @static
     * @return array
     */
    public static function getCountries(){
        return RegistrationUserQuery::$countries;
    }

	/**
	 * Genera un hash y se lo asocia a un determinado usuario
	 * @param RegistrationUser $user RegistrationUser instance
	 * @return string
	 */
	public static function generateHash($user) {

		try {

			$hash = sha1($user->getId() . $user->getUsername() . date("Y-m-d H:i:s"));
			$user->setVerificationHash($hash);
			$user->save();

		} catch (Exception $e) {

			return false;

		}

		return $user->getVerificationHash();

	}

}
