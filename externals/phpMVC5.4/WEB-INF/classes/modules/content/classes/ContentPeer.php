<?php



/**
 * Skeleton subclass for performing query and update operations on the 'content_content' table.
 *
 * Contents
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.content.classes
 */
class ContentPeer extends BaseContentPeer {

    const TYPE_CONTENT = 0;
    const TYPE_SECTION = 1;
    const TYPE_LINK    = 2;

    //nombre de los tipos de contenido
    protected static $contentTypes = array(
        self::TYPE_CONTENT    => 'content',
        self::TYPE_SECTION    => 'section',
        self::TYPE_LINK       => 'link'
    );

    /**
     * Devuelve los tipos de contenido
     */
    public static function getContentTypes() {
        $contentTypes = Content::$contentTypes;
        return $contentTypes;
    }

    /**
     * Devuelve el Type de un Contenido en forma de string.
     * @static
     * @param $type
     * @return mixed
     */
    public static function getTypeTranslated($type){
        return self::$contentTypes[$type];
    }

} // ContentPeer
