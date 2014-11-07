<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property string $name
 * @property string $message
 * @property integer $created_at
 * @property Places $place_id
 */
class Comments extends ActiveRecord
{
    /**
     *
     */
    const SCENARIO_ADMIN = 'admin';
    /**
     *
     */
    const SCENARIO_USER = 'user';

    /**
     * @var
     */
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
		return [
			['name, message, created_at', 'required', 'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')],
			['name', 'length', 'max'=>255],
			['message', 'length', 'max'=>1024],
            ['verifyCode', 'captcha', 'on' => self::SCENARIO_USER],
			// The following rule is used by search().
			['id, name, message, created_at', 'safe', 'on'=>'search'],
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
            'place' => [self::BELONGS_TO, 'Places', 'place_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => '№',
			'name' => Yii::t('main', 'Имя'),
			'message' => Yii::t('main', 'Комментарий'),
			'created_at' => Yii::t('main', 'Добавлено'),
			'place_id' => Yii::t('main', 'Название места'),
		];
	}


    /**
     * @param int $placeId
     * @return CActiveDataProvider
     */
    public function search($placeId = 0)
	{
		$criteria = new CDbCriteria;

        $criteria->compare('place_id', $placeId);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizeComment'],
                'pageVar' =>'page',
//                'currentPage' => Yii::app()->getRequest()->getParam('page', 0)
            ],
		]);
	}

    /**
     * @return CActiveDataProvider
     */
    public function searchAdmin()
    {
        $criteria = new CDbCriteria;

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
        if ($this->place_id) {
            $criteria->compare('place_id', $this->place_id);
        }

        return new CActiveDataProvider($this, [
            'criteria'=>$criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['admin']['pageSize'],
            ],
        ]);
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
