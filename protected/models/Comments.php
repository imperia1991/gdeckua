<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property string $name
 * @property string $message
 * @property string $created_at
 * @property Places $place_id
 */
class Comments extends ActiveRecord
{
    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_USER = 'user';

    public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, message, created_at', 'required'),
			array('name', 'length', 'max'=>255),
			array('message', 'length', 'max'=>1024),
            array('verifyCode', 'captcha', 'on' => self::SCENARIO_USER),
			// The following rule is used by search().
			array('id, name, message, created_at', 'safe', 'on'=>'search'),
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
            'place' => array(self::BELONGS_TO, 'Places', 'place_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => Yii::t('main', 'Имя'),
			'message' => Yii::t('main', 'Комментарий'),
			'created_at' => Yii::t('main', 'Добавлено'),
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

		if ($this->id) {
            $criteria->compare('id',$this->id);
        }
        if ($this->name) {
		    $criteria->compare('name',$this->name,true);
        }
        if ($this->message) {
		    $criteria->compare('message',$this->message,true);
        }
        if ($this->created_at) {
		    $criteria->compare('created_at',$this->created_at,true);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'created_at DESC',
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
