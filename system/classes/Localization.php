<?php
/**
 * Localization for translation
 *
 * @version 1.0
 * @author Kemo Oolep <kemo.oolep@khk.ee>
 */
class Localization
{

	public $translations = array();

	public $locale = 2;

	public function getTranslations()
	{
		$translationQuery = get_all("
SELECT terms_value as token,MAX(translation_value) value
    FROM
     (
         SELECT T.value terms_value,R.value translation_value,R.locale_id
         FROM terms T LEFT JOIN translations R
         ON T.terms_id=R.terms_id
         UNION
         SELECT T.value,'',$this->locale FROM terms T
     ) A
     WHERE
         locale_id = $this->locale
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
