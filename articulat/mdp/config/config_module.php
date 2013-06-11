<?php

class ConfigModule {

	private static $configModule = array(
		"global" => array(
			"debugMode" => true,
			"noSecurity" => true,
			"noCheckLogin" => false,
			"nonConcurrentSession" => false,
			"developmentMode" => true,
			"showPropelExceptions" => true,
			"showSwiftExceptions" => true,
			"doLog" => true,
			"unifiedLogin" => true,
			"unifiedUsernames" => true,
			"backupTimeLimit" => 720,
			"tmpwatch" => "/usr/sbin/tmpwatch",
			"internalMailUseAffiliates" => false 
		),
		"users" => array(
			"licences" => 10,
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordHashExpirationTime" => 24,
			"internalMail" => false,
			"toStringFormat" => "Surname, Name (Username)" // "Name Surname (Username)"
		),
		"actors" => array(
			"toStringFormat" => "Name Surname (Institution)" // "Surname, Name (Institution)"
		),
		"issues" => array(
			"logsPerPage" => 5,
			"basic" => true
		),
		"medias" => array(
			"useAudiences" => true,
			"useMarkets" => false
		),
		"clients" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => false,
			"useFilterByUserGroup" => true,
			"passwordHashExpirationTime" => 24,
			"toStringFormat" => "Surname, Name (Username)" // "Name Surname (Username)"
		),
		"affiliates" => array(
			"useTimezones" => false,
			"forceFirstPasswordChange" => true,
			"askForNewPasswordOnRecovery" => true,
			"useFilterByUserGroup" => true,
			"passwordHashExpirationTime" => 24,
			"toStringFormat" => "Surname, Name (Username)" // "Name Surname (Username)"
		),
		"documents" => array(
			"useKeywords" => false,
			"useAuthors" => false,
			"useFullTextSearch" => true,
			"catdocPath" => "/usr/local/bin/",
			"pdftotextPath" => "/usr/local/bin/",
			"maxUploadSize" => '15M',
			"useSWFUploader" => false,
			"documentTypes" => array(
				"Word" => "doc,docx",
				"Excel" => "xls,xlsx",
				"Powerpoint" => "ppt,pptx",
				"Pdf" => "pdf",
				"Images" => "jpeg,jpg,png,gif"
				)
		),
		"headlines" => array(
			"useClients" => false,
			"uniqueByCampaigns" => false,
			"relationToHeadlines" => false,
			"parserTimeLimit" => 720,
			"searchEngineUrl" => "http://news.google.com",
			"clippingsPath" => "./WEB-INF/classes/modules/headlines/files/clipping/",
			"clippingsTmpPath" => "./WEB-INF/classes/modules/headlines/files/clipping/tmp/",
			"clippingApp" => "./WEB-INF/classes/modules/headlines/classes/urlcaptor/wkhtmltoimage",
			"contentProvider" => array(
				"strategies" => array(
					"default"    => "GoogleNewsStrategy",
					"compound"   => "CompoundStrategy",
					"googleNews" => "GoogleNewsStrategy",
					"google"     => "GoogleStrategy",
					"topsy"      => "TopsyStrategy"
				),
				"strategies_options" => array(
					// "twitter" => "Twitter",
					// "bing"    => "Bing",
					"googleNews" => "Google News",
					"google"     => "Google",
					"topsy"      => "Topsy"
				),
				"errors" => array(
					"service_unavailable" => "Ha realizado muchas consultas, espere 5 min e intente de nuevo.",
					"empty_response"      => "No hubo respuesta",
					"invalid_headline"    => "Hay algunos resultados con errores"
				)
			),
			"typeMap" => array(
				'web' => array('class' => 'WebHeadline', 'url' => 'http://localhost/htdocs2/apps/trunk/GCABA/mdp/rss1.xml'),
				'multimedia' => array('class' => 'MultimediaHeadline', 'url' => 'http://localhost/htdocs2/apps/trunk/GCABA/mdp/rss2.xml'),
				'press' => array('class' => 'PressHeadline', 'url' => 'http://localhost/htdocs2/apps/trunk/GCABA/mdp/rss3.xml')
			),
			"feedBackupsPath" => "./WEB-INF/classes/modules/headlines/files/feeds"
		)
	);

	public static function get($module,$key) {
		if (is_null(ConfigModule::$configModule[$module]) || is_null(ConfigModule::$configModule[$module][$key]) )
			return "";
		else
			return ConfigModule::$configModule[$module][$key];
	}


}