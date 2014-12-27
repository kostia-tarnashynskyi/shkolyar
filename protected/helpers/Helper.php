<?php 


class Helper{

	/**
	 * длина статьи
	 * @param  Article $article
	 * @return int  длина статьи
	 */
	public static function getLength( $article ){

		// content
		$content = strip_tags($article->text);
		$content = str_replace( ' ', '', $content );
		$contentLength = mb_strlen($content, 'utf-8');

		// title
		$title = strip_tags($article->title);
		$title = str_replace( ' ', '', $title );
		$titleLength = mb_strlen($title, 'utf-8');

		return $contentLength + $titleLength;

	}

	public static function getShort($title){

		$title = mb_strtolower($title, 'utf8');

		$short = array(
			'українська мова'=>'укр-мова',
			'українська література'=>'укр-літ',
			'російська мова'=>'рос-мова',
			'зарубіжна література'=>'зар-літ',
		);

		return isset($short[$title]) ? $short[$title] : $title ;
	}

	public static function getOwner(){
		return array(
			'writing'=>'writing',
			'gdz'=>'gdz',
			'textbook'=>'textbook',
			'knowall'=>'knowall'
		);
	}

	public static function getAction(){
		return array(
			'clas'=>'clas',
			'subject'=>'subject',
			'category'=>'category',
		);
	}


}