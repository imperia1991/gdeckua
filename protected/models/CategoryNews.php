<?php

/**
 * This is the model class for table "category_news".
 *
 * The followings are the available columns in table 'category_news':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $aliases
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property CategoryNews $parent
 * @property CategoryNews[] $categoryNews
 * @property News[] $news
 */
class CategoryNews extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ru, title_uk, aliases', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('title_ru, title_uk, aliases', 'length', 'max'=>255),
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
			'parent' => array(self::BELONGS_TO, 'CategoryNews', 'parent_id'),
			'categoryNews' => array(self::HAS_MANY, 'CategoryNews', 'parent_id'),
			'news' => array(self::HAS_MANY, 'News', 'category_news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'title_ru' => Yii::t('main', 'Название (русский)'),
			'title_uk' => Yii::t('main', 'Название (украинский)'),
			'aliases' => 'Aliases',
			'parent_id' => 'Parent',
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

		if ($this->title_ru) {
            $criteria->compare('title_ru',$this->title_ru,true);
        }
        if ($this->title_uk) {
            $criteria->compare('title_uk',$this->title_uk,true);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryNews the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getCategories()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'title_ru';

        return CHtml::listData($this->findAll($criteria), 'id', 'title_ru');
    }
}
