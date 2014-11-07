<?php

/**
 * This is the model class for table "comments_photo_city".
 *
 * The followings are the available columns in table 'comments_photo_city':
 * @property integer $id
 * @property string $name
 * @property string $message
 * @property string $created_at
 * @property string $photo_city_id
 *
 * The followings are the available model relations:
 * @property PhotoCity $photoCity
 */
class CommentsPhotoCity extends CActiveRecord
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
		return 'comments_photo_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name, message, created_at, photo_city_id, verifyCode', 'required'],
			['name', 'length', 'max'=>255],
			['photo_city_id', 'length', 'max'=>20],
			// The following rule is used by search().
			['id, name, message, created_at, photo_city_id', 'safe', 'on'=>'search'],
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
			'photoCity' => [self::BELONGS_TO, 'PhotoCity', 'photo_city_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => Yii::t('main', 'Имя'),
            'message' => Yii::t('main', 'Комментарий'),
            'created_at' => Yii::t('main', 'Добавлено'),
			'photo_city_id' => Yii::t('main', 'Фотография города'),
		];
	}


    /**
     * @param $photoCityId
     * @return CActiveDataProvider
     */
    public function search($photoCityId)
	{
        $criteria = new CDbCriteria;

        $criteria->compare('photo_city_id', $photoCityId);

        return new CActiveDataProvider($this, [
            'criteria'=>$criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizeComment'],
                'pageVar' =>'page',
            ],
        ]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CommentsPhotoCity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
