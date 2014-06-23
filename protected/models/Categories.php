<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $aliases
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property Promo[] $promos
 */
class Categories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ru, title_uk', 'required'),
			array('title_ru, title_uk, aliases', 'length', 'max'=>255),
            array('parent_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_ru, title_uk, aliases, parent_id', 'safe', 'on'=>'search'),
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
            'places' => array(self::HAS_MANY, 'Places', 'category_id'),
            'parent' => array(self::BELONGS_TO, 'Categories', 'parent_id'),
            'placesCategories' => array(self::HAS_MANY, 'PlacesCategories', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_ru' => Yii::t('main', 'Категории (русский)'),
			'title_uk' => Yii::t('main', 'Категории (украинский)'),
			'aliases' => 'Aliases',
			'parent_id' => Yii::t('main', 'Родительская категория'),
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
		$criteria=new CDbCriteria;

        if ($this->id) {
            $criteria->compare('t.id', $this->id);
        }
        if ($this->title_ru) {
            $criteria->compare('title_ru', $this->title_ru, true);
        }
        if ($this->title_uk) {
            $criteria->compare('title_uk', $this->title_uk, true);
        }
        if ($this->parent_id) {
            $criteria->compare('parent_id', $this->parent_id);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'title_ru ASC',
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['admin']['pageSize'],
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getParentsCategories()
    {
        return CHtml::listData(Categories::model()->findAll('parent_id IS NULL'), 'id', 'title_ru');
    }
}
