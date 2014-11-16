<?php

/**
 * This is the model class for table "category_boards".
 *
 * The followings are the available columns in table 'category_boards':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $alias
 * @property integer $parent_id
 * @property string $photo
 *
 * The followings are the available model relations:
 * @property CategoryBoards $parent
 * @property CategoryBoards[] $categoryBoards
 */
class CategoryBoards extends CActiveRecord
{
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_boards';
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
			['parent_id', 'numerical', 'integerOnly'=>true],
			['title_ru, title_uk, alias, photo', 'length', 'max'=>255],
            ['photo', 'safe'],
			// The following rule is used by search().
			['id, title_ru, title_uk, alias, parent_id', 'safe', 'on'=>'search'],
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
			'parent' => [self::BELONGS_TO, 'CategoryBoards', 'parent_id'],
			'categoryBoards' => [self::HAS_MANY, 'CategoryBoards', 'parent_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => '№',
			'title_ru' => Yii::t('main', 'Название (русский)'),
			'title_uk' => Yii::t('main', 'Название (украинский)'),
			'alias' => 'Alias',
			'parent_id' => Yii::t('main', 'Родительская категория'),
			'photo' => Yii::t('main', 'Иконка'),
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
		$criteria=new CDbCriteria;

//		$criteria->compare('id',$this->id);
//		$criteria->compare('title_ru',$this->title_ru,true);
//		$criteria->compare('title_uk',$this->title_uk,true);
//		$criteria->compare('alias',$this->alias,true);
//		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
            'pagination' => false
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryBoards the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return array
     */
    public function getTree()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('parent_id IS NULL');
        $criteria->order = 'title_ru';

        return $this->prepareTree($this->findAll($criteria));
    }


    /**
     * Возвращет html тег иконки или пустую строку в случае ее отсутствия
     * @return string
     */
    public function getPhotoWidget()
    {
        if (empty($this->photo)) {
            return '';
        }

        return CHtml::image($this->getPhoto(), $this->getTitle());
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return '/' . Yii::app()->params['admin']['files']['boardIcons'] . '/';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $title = 'title_' . Yii::app()->getLanguage();

        return $this->{$title};
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->getDirectory() . $this->photo;
    }

    /**
     * @param CActiveRecord[] $categories
     * @return array
     */
    private function prepareTree($categories)
    {
        $result = [];

        if (empty($categories)) {
            return $result;
        }

        /** @var CategoryBoards $category */
        foreach ($categories as $category) {
            if ($this->id == $category->id) {
                continue;
            }

            $result[] = [
                'id' => $category->id,
                'title' => $category->getPhotoWidget() . ' ' . $category->title_ru,
                'children' => $this->prepareTree($category->categoryBoards),
            ];
        }

        return $result;
    }
}
