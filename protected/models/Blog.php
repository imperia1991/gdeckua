<?php

/**
 * This is the model class for table "blog".
 *
 * The followings are the available columns in table 'blog':
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $text
 * @property string $short_text
 * @property string $photo
 * @property string $alias
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property CategoryBlog $category
 * @property Users $user
 */
class Blog extends CActiveRecord
{
	const STATUS_SHOW     = 1;
	const STATUS_NOT_SHOW = 2;
	const STATUS_DELETED  = 3;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Blog the static model class
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
		return 'blog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['title, text, short_text, alias, user_id, category_id', 'required'],
			['user_id, category_id, status', 'numerical', 'integerOnly' => true],
			['title, short_text, photo, alias', 'length', 'max' => 255],
			['created_at, updated_at, photo', 'safe'],
			// The following rule is used by search().
			[
				'id, user_id, category_id, title, text, short_text, photo, alias, status, created_at, updated_at',
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
			'category'          => [self::BELONGS_TO, 'CategoryBlog', 'category_id'],
			'user'              => [self::BELONGS_TO, 'Users', 'user_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id'          => 'ID',
			'user_id'     => Yii::t('main', 'Пользователь'),
			'category_id' => Yii::t('main', 'Категория'),
			'title'       => Yii::t('main', 'Название'),
			'text'        => Yii::t('admin', 'Полный текст'),
			'short_text'  => Yii::t('admin', 'Краткое описание'),
			'photo'       => Yii::t('main', 'Фото для анонса новости'),
			'alias'       => 'Alias',
			'status'      => Yii::t('admin', 'Статус'),
			'created_at'  => Yii::t('admin', 'Дата добавления'),
			'updated_at'  => Yii::t('admin', 'Дата обновления'),
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
		if ($this->category_id) {
			$criteria->compare('category_id', $this->category_id);
		}

		return new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'sort'       => [
				'defaultOrder' => 'created_at DESC',
			],
			'pagination' => [
				'pageSize' => Yii::app()->params['pageSizeNews'],
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
