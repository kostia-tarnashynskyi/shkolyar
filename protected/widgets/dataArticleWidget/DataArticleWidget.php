<?php

class DataArticleWidget extends CWidget{

	public $params = array();
	public $model = null;

	public function init(){
		// $this->params = $this->controller->param;
        parent::init();
    }

	public function run(){

		// $title = 'Knowall articles';
		// if( !empty($this->controller->clasModel) ){
		// 	$title .= ' ' . $this->controller->clasModel->clas->slug . ' клас';
		// }

		// if( !empty($this->controller->subjectModel) ){
		// 	$title = 'Виберiть збiрник ГДЗ';
		// }

		// if( isset($this->params['subject']) ){
		// 	$title .= ' '.$this->params['subject'];
		// }

       // передаем данные в представление виджета
		$view = 'index';
		if(Yii::app()->theme->name == 'm'){
			$view = 'm_'.$view;
		}
       $this->render($view,array('dataProvider' => $this->model));
   }

}