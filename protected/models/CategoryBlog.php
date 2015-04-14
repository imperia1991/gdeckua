<?php

/**
 * This is the model class for table "category_blog".
 *
 * The followings are the available columns in table 'category_blog':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $alias
 * @property string $icon
 * @property integer $status
 */
class CategoryBlog extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return CategoryBlog the static model class
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
		return 'category_blog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['title_ru, title_uk, alias', 'required'],
			['status', 'numerical', 'integerOnly' => true],
			['title_ru, title_uk, alias, icon', 'length', 'max' => 255],
			['icon', 'safe'],
			// The following rule is used by search().
			['id, title_ru, title_uk, alias, icon, status', 'safe', 'on' => 'search'],
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
			'id'       => 'ID',
			'title_ru' => Yii::t('main', 'Название (русский)'),
			'title_uk' => Yii::t('main', 'Название (украинский)'),
			'alias'    => 'Alias',
			'icon'     => 'Icon',
			'status'   => Yii::t('main', 'Статус'),
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

		if ($this->title_ru) {
			$criteria->compare('title_ru', $this->title_ru, true);
		}
		if ($this->title_uk) {
			$criteria->compare('title_uk', $this->title_uk, true);
		}

		return new CActiveDataProvider($this, [
			'criteria' => $criteria,
		]);
	}

	/**
	 * @return array
	 */
	public function getCategories()
	{
		$criteria        = new CDbCriteria();
		$criteria->order = 'title_ru';

		return CHtml::listData($this->findAll($criteria), 'id', 'title_ru');
	}
}
