<?php

/**
 * Генератор карты сайта
 */
class SitemapController extends Controller{

private $siteUrl = 'http://shkolyar.info';
private $lastModify = array();

const ALWAYS = 'always';
const HOURLY = 'hourly';
const DAILY = 'daily';
const WEEKLY = 'weekly';
const MONTHLY = 'monthly';
const YEARLY = 'yearly';
const NEVER = 'never';

protected $items = array();

public function actionIndex() {

    // echo Helper::lastPublicTime();
    // die;

    $this->addUrl('/', self::DAILY, 0.9, Helper::lastTime() );
	$this->addUrl('/about', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','about') );
	$this->addUrl('/contacts', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','contacts') );
	$this->addUrl('/advertiser', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','advertiser') );
	$this->addUrl('/rules', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','rules') );
	$this->addUrl('/rightholder', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','rightholder') );
	$this->addUrl('/gdz/', self::WEEKLY, 0.5, Helper::lastTime('GdzBook') );
	$this->addUrl('/textbook/', self::WEEKLY, 0.5, Helper::lastTime('TextbookBook') );
	$this->addUrl('/writing/', self::WEEKLY, 0.5, Helper::lastTime('Writing') );
	$this->addUrl('/knowall/', self::WEEKLY, 0.5, Helper::lastTime('Knowall') );
    $this->addModels( GdzClas::model()->findAll(), self::WEEKLY, 0.3);
    $this->addModels( TextbookClas::model()->findAll(), self::WEEKLY, 0.3);
    $criteria = new CDbCriteria;
    $criteria->group = 'subject_id'; 
	$this->addModels( GdzSubject::model()->findAll($criteria), self::WEEKLY, 0.6);
    $this->addModels( TextbookSubject::model()->findAll($criteria), self::WEEKLY, 0.6);
    $this->addModelsWithClas('gdz', GdzClas::model()->findAll(), self::WEEKLY, 0.7);
	$this->addModelsWithClas('textbook', TextbookClas::model()->findAll(), self::WEEKLY, 0.7);
	$this->addModels( GdzBook::model()->public()->findAll(), self::WEEKLY, 0.8);
	$this->addModels( TextbookBook::model()->public()->findAll(), self::WEEKLY, 0.8);
	// $this->addModels( Writing::model()->public()->findAll(), self::WEEKLY, 0.8);
	// $this->addModels( TextbookBook::model()->public()->findAll(), self::WEEKLY, 0.8);
	$xml = $this->create();

	header("Content-type: text/xml");
    echo $xml;
    Yii::app()->end(); 

	// $this->renderPartial('index', array('sitemap'=>$xml));

	// file_put_contents(Yii::app()->basePath . '/../sitemap.xml', $xml);
}

 /**
 * @param $url
 * @param string $changeFreq
 * @param float $priority
 * @param int $lastmod
 */
public function addUrl($url, $changeFreq=self::DAILY, $priority=0.5, $lastMod=0){

    $item = array(
        'loc' => $this->siteUrl . $url,
        'changefreq' => $changeFreq,
        'priority' => $priority
    );
    if ($lastMod){
        $item['lastmod'] = $this->dateToW3C($lastMod);
		}

    $this->items[] = $item;
}

/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addModels($models, $changeFreq=self::DAILY, $priority=0.5){
    $time=time();

    foreach ($models as $model){

        //  добаляем в карту только опубликованные
        if( isset($model->public_time) ){
            if( $time < $model->public_time ){
                continue;
            }
        }

        $item = array(
            'loc' => $this->siteUrl . $model->getUrl(),
            'changefreq' => $changeFreq,
            'priority' => $priority
        );

        if ($model->hasAttribute('update_time')){

        	if(isset($model->public_time)){
        		if($model->public_time > $model->update_time){
        			$item['lastmod'] = $this->dateToW3C($model->public_time);
        		} else {
        			$item['lastmod'] = $this->dateToW3C((int)$model->update_time);
        		}
        	} else {
                
            	$item['lastmod'] = $this->dateToW3C((int)$model->update_time);
        	}


        }

        $this->items[] = $item;
    }
}

/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addModelsWithClas($mode, $models, $changeFreq=self::DAILY, $priority=0.5){
    $time=time();
    $subjects = $mode.'_subject';

    foreach ($models as $model){


        if($model->$subjects){
            foreach($model->$subjects as $subject){

                $item = array(
                    'loc' => $this->siteUrl . $subject->getUrl($model->clas->slug),
                    'changefreq' => $changeFreq,
                    'priority' => $priority
                );



                if ($subject->hasAttribute('update_time')){

                    if(isset($subject->public_time)){
                        if($subject->public_time > $subject->update_time){
                            $item['lastmod'] = $this->dateToW3C($subject->public_time);
                        } else {
                            $item['lastmod'] = $this->dateToW3C((int)$subject->update_time);
                        }
                    } else {
                        
                        $item['lastmod'] = $this->dateToW3C((int)$subject->update_time);
                    }


                }

                $this->items[] = $item;

                
            }
        }


    }


    
}

/**
 * @return string XML code
 */
public function create()
{
    $dom = new DOMDocument('1.0', 'utf-8');
    $urlset = $dom->createElement('urlset');
    $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
    foreach($this->items as $item)
    {
        $url = $dom->createElement('url');

        foreach ($item as $key=>$value)
        {
            $elem = $dom->createElement($key);
            $elem->appendChild($dom->createTextNode($value));
            $url->appendChild($elem);
        }

        $urlset->appendChild($url);
    }
    $dom->appendChild($urlset);

    return $dom->saveXML();
}

protected function dateToW3C($date){

    if (is_int($date)){
        $dateTime = new DateTime(date('Y-m-d\TH:i:sP',$date));
        return $dateTime->format(DateTime::W3C);
    } else {

        $dateTime = new DateTime(date('Y-m-d\TH:i:sP',strtotime($date)));
        return $dateTime->format(DateTime::W3C);
    }
}


} // end class SitemapController