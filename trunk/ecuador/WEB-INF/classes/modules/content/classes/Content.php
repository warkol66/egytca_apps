<?php



/**
 * Skeleton subclass for representing a row from the 'content_content' table.
 *
 * Contents
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.content.classes
 */
class Content extends BaseContent
{

    /**
     * Se redefine el Title in Menu para que el root puede retornar la palabra "Base"
     * @return string
     */
    public function getTitleinmenu()
    {
        if ($this->isRoot()) return "Base";
        else return parent::getTitleinmenu();
    }

    /**
     * Retorna el texto para mostrar en el select de escoger la seccion en el Crear/Editar Contenido.
     * @param string $locale El idioma a mostrar
     * @return string
     */
    public function getNameForSelect($locale = "")
    {
        if($this->isRoot()) return "Base";
        if ($locale == "") {
            $defaultLanguage=ContentActiveLanguageQuery::getDefaultLanguage();
            $locale=$defaultLanguage->getLanguagecode();
        }
        $this->setLocale($locale);
        $pad_string="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $pad = str_pad("",  $this->getLevel()*strlen($pad_string) , $pad_string, STR_PAD_LEFT);
        return $pad . $this->getTitle();
    }


}
