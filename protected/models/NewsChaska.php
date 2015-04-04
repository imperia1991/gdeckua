<?php

/**
 * This is the model class for table "news_chaska".
 *
 * The followings are the available columns in table 'news_chaska':
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property string $title
 * @property string $short_text
 * @property string $text
 * @property string $photo
 * @property string $created_at
 * @property string $updated_at
 * @property string $alias
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class NewsChaska extends ActiveRecord
{
	const STATUS_SHOW     = 1;
	const STATUS_NOT_SHOW = 2;
	const STATUS_DELETED  = 3;

	const TYPE_MEETING = 1;
	const TYPE_CLUB    = 2;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return NewsChaska the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news_chaska';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['type, title, short_text, text, created_at, alias', 'required'],
			['user_id, type, status', 'numerical', 'integerOnly' => true],
			['title, alias', 'length', 'max' => 255],
			['photo', 'length', 'max' => 64],
			['update_at', 'safe'],
			// The following rule is used by search().
			[
				'id, user_id, type, title, short_text, text, created_at, updated_at, alias, status',
				'safe',
				'on' => 'search'
			],
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
			'user' => [self::BELONGS_TO, 'Users', 'user_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id'         => 'ID',
			'user_id'    => 'User',
			'type'       => 'Type',
			'alias'      => 'Alias',
			'status'     => Yii::t('admin', 'Статус'),
			'title'      => Yii::t('admin', 'Заголовок'),
			'text'       => Yii::t('admin', 'Полный текст'),
			'short_text' => Yii::t('admin', 'Краткое описание'),
			'created_at' => Yii::t('admin', 'Дата добавления'),
			'updated_at' => Yii::t('admin', 'Дата обновления'),
		];
	}

	protected function beforeValidate()
	{
		if (parent::beforeValidate()) {
			$this->user_id = Yii::app()->user->id;

			$random = substr( md5(rand()), 0, 7);
			$this->alias = $random . '-' . LocoTranslitFilter::cyrillicToLatin($this->title);

			return true;
		};

		return false;
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
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', Yii::app()->user->id);
		$criteria->addCondition('status != ' . static::STATUS_DELETED);

		if ($this->title) {
			$criteria->compare('title', $this->title, true);
		}
		if ($this->created_at) {
			$criteria->compare('created_at', $this->created_at);
		}
		if ($this->status) {
			$criteria->compare('status', $this->status);
		}
		if ($this->type) {
			$criteria->compare('type', $this->type);
		}

		return new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'sort'       => [
				'defaultOrder' => 'created_at DESC',
			],
			'pagination' => [
				'pageSize' => Yii::app()->params['admin']['pageSize'],
			],
		]);
	}

	/**
	 * @return array
	 */
	public function getStatuses()
	{
		$statuses = [
			static::STATUS_SHOW     => Yii::t('admin', 'Показывается'),
			static::STATUS_NOT_SHOW => Yii::t('admin', 'Не показывается'),
		];

		return $statuses;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		$statuses = [
			static::STATUS_SHOW     => CHtml::tag('span', [
				'class' => 'show',
			], Yii::t('admin', 'Показывается')),
			static::STATUS_NOT_SHOW => CHtml::tag('span', [
				'class' => 'not-show',
			], Yii::t('admin', 'Не показывается')),
		];

		return $statuses[$this->status];
	}
}
