<?php
class Locale {
	var $ENGLISH = NULL;
	var $FRENCH = NULL;
	var $GERMAN = NULL;
	var $ITALIAN = NULL;
	var $JAPANESE = NULL;
	var $KOREAN = NULL;
	var $CHINESE = NULL;
	var $SIMPLIFIED_CHINESE = NULL;
	var $TRADITIONAL_CHINESE = NULL;
	var $FRANCE = NULL;
	var $GERMANY = NULL;
	var $ITALY = NULL;
	var $JAPAN = NULL;
	var $KOREA = NULL;
	var $CHINA = NULL;
	var $PRC = NULL;
	var $TAIWAN = NULL;
	var $UK = NULL;
	var $US = NULL;
	var $CANADA = NULL;
	var $CANADA_FRENCH = NULL;
	var $language;
	var $country;
	var $variant;
	var $defaultLocale = NULL;
	function convertLanguage($language) {
		if ($language == '')
			return $language;
		$language = strtolower(language);
		$index = strpos("he,id,yi", $language);
		if ($index > 0)
			return substr("iw,in,ji", $index, $index + 2);
		return $language;
	}
	function Locale($language = '', $country = '', $variant = '', $defaultLocale = NULL) { $this -> defaultLocale = $defaultLocale;
		$this -> language = strtolower($language);
		$this -> country = strtoupper($country);
		$this -> variant = strtoupper($variant);
	}
	function getDefault() {
		return $this -> defaultLocale;
	}
	function setDefault($newLocale) {
		if ($newLocale == NULL) {
			return 'NullPointerException';
		} $this -> defaultLocale = $newLocale;
	}
	function getAvailableLocales() {
	}
	function getISOCountries() {
		return array("AD", "AE", "AF", "AG", "AI", "AL", "AM", "AN", "AO", "AQ", "AR", "AS", "AT", "AU", "AW", "AZ", "BA", "BB", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BM", "BN", "BO", "BR", "BS", "BT", "BV", "BW", "BY", "BZ", "CA", "CC", "CF", "CG", "CH", "CI", "CK", "CL", "CM", "CN", "CO", "CR", "CU", "CV", "CX", "CY", "CZ", "DE", "DJ", "DK", "DM", "DO", "DZ", "EC", "EE", "EG", "EH", "ER", "ES", "ET", "FI", "FJ", "FK", "FM", "FO", "FR", "FX", "GA", "GB", "GD", "GE", "GF", "GH", "GI", "GL", "GM", "GN", "GP", "GQ", "GR", "GS", "GT", "GU", "GW", "GY", "HK", "HM", "HN", "HR", "HT", "HU", "ID", "IE", "IL", "IN", "IO", "IQ", "IR", "IS", "IT", "JM", "JO", "JP", "KE", "KG", "KH", "KI", "KM", "KN", "KP", "KR", "KW", "KY", "KZ", "LA", "LB", "LC", "LI", "LK", "LR", "LS", "LT", "LU", "LV", "LY", "MA", "MC", "MD", "MG", "MH", "MK", "ML", "MM", "MN", "MO", "MP", "MQ", "MR", "MS", "MT", "MU", "MV", "MW", "MX", "MY", "MZ", "NA", "NC", "NE", "NF", "NG", "NI", "NL", "NO", "NP", "NR", "NU", "NZ", "OM", "PA", "PE", "PF", "PG", "PH", "PK", "PL", "PM", "PN", "PR", "PT", "PW", "PY", "QA", "RE", "RO", "RU", "RW", "SA", "SB", "SC", "SD", "SE", "SG", "SH", "SI", "SJ", "SK", "SL", "SM", "SN", "SO", "SR", "ST", "SV", "SY", "SZ", "TC", "TD", "TF", "TG", "TH", "TJ", "TK", "TM", "TN", "TO", "TP", "TR", "TT", "TV", "TW", "TZ", "UA", "UG", "UM", "US", "UY", "UZ", "VA", "VC", "VE", "VG", "VI", "VN", "VU", "WF", "WS", "YE", "YT", "YU", "ZA", "ZM", "ZR", "ZW");
	}
	function getISOLanguages() {
		return array("aa", "ab", "af", "am", "ar", "as", "ay", "az", "ba", "be", "bg", "bh", "bi", "bn", "bo", "br", "ca", "co", "cs", "cy", "da", "de", "dz", "el", "en", "eo", "es", "et", "eu", "fa", "fi", "fj", "fo", "fr", "fy", "ga", "gd", "gl", "gn", "gu", "ha", "he", "hi", "hr", "hu", "hy", "ia", "id", "ie", "ik", "in", "is", "it", "iu", "iw", "ja", "ji", "jw", "ka", "kk", "kl", "km", "kn", "ko", "ks", "ku", "ky", "la", "ln", "lo", "lt", "lv", "mg", "mi", "mk", "ml", "mn", "mo", "mr", "ms", "mt", "my", "na", "ne", "nl", "no", "oc", "om", "or", "pa", "pl", "ps", "pt", "qu", "rm", "rn", "ro", "ru", "rw", "sa", "sd", "sg", "sh", "si", "sk", "sl", "sm", "sn", "so", "sq", "sr", "ss", "st", "su", "sv", "sw", "ta", "te", "tg", "th", "ti", "tk", "tl", "tn", "to", "tr", "ts", "tt", "tw", "ug", "uk", "ur", "uz", "vi", "vo", "wo", "xh", "yi", "yo", "za", "zh", "zu");
	}
	function getLanguage() {
		return $this -> language;
	}
	function getCountry() {
		return $this -> country;
	}
	function getVariant() {
		return $this -> variant;
	}
	function toString() {
		if ((strlen($this -> language) == 0) && (strlen($this -> country) == 0))
			return '';
		$localeStr = '';
		$l_ = '';
		$c_ = '';
		if (strlen($this -> language) != 0) { $localeStr .= $this -> language;
			$l_ = '_';
		}
		if (strlen($this -> country) != 0) { $localeStr .= $l_;
			$localeStr .= $this -> country;
			$c_ = '_';
		}
		if (strlen($this -> variant) != 0)
			$localeStr .= $c_;
		$localeStr .= $this -> variant;
		return $localeStr;
	}
	function getISO3Language() {
	}
	function getISO3Country() {
	}
	function getDisplayLanguage($locale = NULL) {
		if ($locale == NULL)
			$locale = $this -> defaultLocale;
		return $this -> language;
	}
	function getDisplayCountry($locale = NULL) {
		if ($locale == NULL)
			return $this -> getDisplayCountry($this -> defaultLocale);
		return $this -> country;
	}
	function getDisplayVariant($locale = NULL) {
		if ($locale == NULL)
			return $this -> getDisplayVariant($this -> defaultLocale);
		return $this -> variant;
	}
	function getDisplayName($locale = NULL) {
		if ($locale == NULL)
			$locale = $this -> defaultLocale;
		$result = '';
		$count = 0;
		$delimiters = array('', ' (', ',');
		if (strlen($this -> language) != 0) { $result .= $delimiters[$count++];
			$result .= $this -> getDisplayLanguage($locale);
		}
		if (strlen($this -> country) != 0) { $result .= $delimiters[$count++];
			$result .= $this -> getDisplayCountry($locale);
		}
		if (strlen($this -> variant) != 0) { $result .= $delimiters[$count++];
			$result .= $this -> getDisplayVariant($locale);
		}
		if ($count > 1)
			$result .= ')';
		return $result;
	}
	function hashCode() {
	}
	function equals($obj) {
		if (get_class($obj) == get_class($this))
			return False;
		$l = $obj;
		return ($this -> language == $l -> language) && ($this -> country == $l -> country) && ($this -> variant == $l -> variant);
	}

}

