<?php

/**
 * This is the model class for table "contacts".
 *
 * The followings are the available columns in table 'contacts':
 * @property integer $id
 * @property integer $place_id
 * @property string $phone_city
 * @property string $phone_mobile1
 * @property string $phone_mobile2
 * @property string $phax
 * @property string $email
 * @property string $skype
 * @property string $operation_time
 *
 * The followings are the available model relations:
 * @property Places $place
 */
class Contacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['place_id', 'numerical', 'integerOnly'=>true],
			['phone_city, phone_mobile1, phone_mobile2, phax', 'length', 'max'=>20],
			['phone_city, phone_mobile1, phone_mobile2, phax', 'match', 'pattern'=>'/^[0-9]+$/', 'message' => Yii::t('main', 'Должны быть только цифры')],
			['email, skype', 'length', 'max'=>50],
			['email', 'email'],
			['operation_time', 'length', 'max'=>255],
			// The following rule is used by search().
			['id, place_id, phone_city, phone_mobile1, phone_mobile2, phax, email, skype, operation_time', 'safe', 'on'=>'search'],
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
			'id' => 'ID',
			'place_id' => Yii::t('main', 'Название места'),
			'phone_city' => Yii::t('main', 'Телефон городской'),
			'phone_mobile1' => Yii::t('main', 'Телефон мобильный'),
			'phone_mobile2' => Yii::t('main', 'Телефон мобильный (дополнительный)'),
			'phax' => Yii::t('main', 'Факс'),
			'email' => Yii::t('main', 'Электронный адрес (email)'),
			'skype' => Yii::t('main', 'Скайп (skype)'),
			'operation_time' => Yii::t('main', 'Время работы'),
		];
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

		$criteria->compare('id',$this->id);
		$criteria->compare('place_id',$this->place_id);
		$criteria->compare('phone_city',$this->phone_city,true);
		$criteria->compare('phone_mobile1',$this->phone_mobile1,true);
		$criteria->compare('phone_mobile2',$this->phone_mobile2,true);
		$criteria->compare('phax',$this->phax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('operation_time',$this->operation_time,true);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
