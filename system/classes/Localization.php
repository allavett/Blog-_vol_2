<?php

class Localization
{

    public $translations = array();

    function __construct()
    {
        if(!isset($_SESSION['locale'])){
            $_SESSION['locale'] = 1;
        }

        $this->getTranslations();
    }

    function getTranslations()
    {
        $locale = $_SESSION['locale'];
        $translationQuery = get_all("
SELECT terms_value as token,MAX(translation_value) value
    FROM
     (
         SELECT T.value terms_value,R.value translation_value,R.locale_id
         FROM terms T LEFT JOIN translations R
         ON T.terms_id=R.terms_id
         UNION
         SELECT T.value,'',$locale FROM terms T
     ) A
     WHERE
         locale_id = $locale
     GROUP By terms_value
     ");


        foreach ($translationQuery as $translation) {
            $this->translations[$translation["token"]] = $translation["value"];
        }
    }

    public function translate($token){
        if(array_key_exists($token, $this->translations)){
            return $this->translations[$token];
        }else{
            return $token;
        }
    }


}
