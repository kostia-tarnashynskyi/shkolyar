<?php

/**
 * This is the model class for table "description".
 *
 * The followings are the available columns in table 'description':
 * @property string $id
 * @property string $owner
 * @property string $action
 * @property string $clas_id
 * @property string $subject_id
 * @property integer $description
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Subject $subject
 * @property Clas $slas
 */
class Description extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner, description, action, clas_id, subject_id, ', 'required'),
			array('owner, action', 'length', 'max'=>255),
			array('clas_id, subject_id, create_time, update_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner, action, clas_id, subject_id, description, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
			'clas' => array(self::BELONGS_TO, 'Clas', 'clas_id'),
		);
	}

	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'create_time',
				'updateAttribute' => 'update_time',
				'setUpdateOnCreate'=>true,
			),
			// 'DescriptionBehavior'=>array(
			// 	'clas'=>'DescriptionBehavior'
			// )
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner' => 'Owner',
			'action' => 'Action',
			'clas_id' => 'Slas',
			'subject_id' => 'Subject',
			'description' => 'Description',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('clas_id',$this->clas_id,true);
		$criteria->compare('subject_id',$this->subject_id,true);
		$criteria->compare('description',$this->description);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Description the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
