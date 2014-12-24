<?php/** * ETranslitFilter class file. */class ETranslitFilter extends CValidator {	/**	 * @var string the name of the attribute to be translit.	 */	public $translitAttribute;	/**	 * @var boolean whether to translit value only when the attribute value is null or empty string.	 * Defaults to true. If false, the attribute will always be translit.	 */	public $setOnEmpty=true;	/**	 * Validates the attribute of the object.	 * @param CModel $object the object being validated	 * @param string $attribute the attribute being validated	 * @throws CException	 */	protected function validateAttribute($object,$attribute) {		if($this->setOnEmpty && !$this->isEmpty($object->$attribute))			return;		if(!$object->hasAttribute($this->translitAttribute))			throw new CException(Yii::t('yiiext','Active record "{class}" is trying to select an invalid column "{column}". Note, the column must exist in the table or be an expression with alias.',				array('{class}'=>get_class($object),'{column}'=>$this->translitAttribute)));		$cyrillicToLatin = self::cyrillicToLatin($object->getAttribute($this->translitAttribute));		$model = $object->findByAttributes(array($attribute => $cyrillicToLatin));        // Если есть статья с таким именем, то выводим ошибку//		if ($model && $model->id != $object->id) {//			$cyrillicToLatin .= time();//		}		$object->$attribute = $cyrillicToLatin;	}	/**	 * Translit text from cyrillic to latin letters.	 * @param string $str the text being translit.	 * @param bool $useMvd	 * @param bool $saveDot	 * @return string	 */	public static function cyrillicToLatin($str) {		$tr = array(			'А'=>'a', 'Б'=>'b', 'В'=>'v', 'Г'=>'g', 'Ґ'=>'g', 			'Д'=>'d', 'Е'=>'e', 'Є'=>'ie', 'Ж'=>'zh', 'З'=>'z', 'И'=>'y', 'І'=>'i',			'Й'=>'y', 'К'=>'k', 'Л'=>'l', 'М'=>'m', 'Н'=>'n',			'О'=>'o', 'П'=>'p', 'Р'=>'r', 'С'=>'s', 'Т'=>'t',			'У'=>'u', 'Ф'=>'f', 'Х'=>'kh', 'Ц'=>'ts', 'Ч'=>'ch',			'Ш'=>'sh','Щ'=>'shch', 'Ь'=>'','Ю'=>'yu', 'Я'=>'ya', 			'а'=>'a', 'б'=>'b',			'в'=>'v', 'г'=>'g', 'ґ'=>'g', 'д'=>'d', 'е'=>'e', 'є'=>'ie', 'ж'=>'zh',			'з'=>'z', 'и'=>'y', 'і'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l',			'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p', 'р'=>'r',			'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'х'=>'kh',			'ц'=>'ts', 'ч'=>'ch', 'ш'=>'sh', 'щ'=>'shch',			'ь'=>'', 'ю'=>'yu', 'я'=>'ya',			' '=> '-', '.'=> '-', "/"=> "-"		);		if (preg_match('/[^A-Za-z0-9\_\-]/', $str)) {			// транслит			$str = strtr($str, $tr);			// зачистка			$str = preg_replace('/[^A-Za-z0-9\_\-\.]/', '', $str);		}		return strtolower($str);	}}