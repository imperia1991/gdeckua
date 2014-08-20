<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $created_at
 * @property integer $is_reading
 * @property integer $is_answer
 */
class Feedback extends ActiveRecord
{
    public $verifyCode;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name, email, message, created_at', 'required', 'message' => Yii::t('main', 'Необхідно заповнити поле «{attribute}»')],
			['email', 'email', 'message' => Yii::t('main', '{attribute} не является правильным E-Mail адресом')],
            ['verifyCode', 'captcha'],
			['is_reading, is_answer', 'numerical', 'integerOnly'=>true],
			['name, email', 'length', 'max'=>255],
			// The following rule is used by search().
			['id, name, email, message, created_at, is_reading, is_answer', 'safe', 'on'=>'search'],
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
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => CHtml::encode(Yii::t('main', '"Введите имя и фамилию"')),
			'email' => CHtml::encode(Yii::t('main', '"Введите Ваш e-mail"')),
			'message' => CHtml::encode(Yii::t('main', '"Введите текст сообщения"')),
			'created_at' => 'Created At',
			'is_reading' => 'Is Reading',
			'is_answer' => 'Is Answer',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('is_reading',$this->is_reading);
		$criteria->compare('is_answer',$this->is_answer);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Feedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
