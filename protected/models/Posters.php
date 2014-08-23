<?php

/**
 * This is the model class for table "posters".
 *
 * The followings are the available columns in table 'posters':
 * @property integer $id
 * @property integer $category_poster_id
 * @property string $title
 * @property string $description
 * @property string $date_from
 * @property string $date_to
 * @property string $photo
 * @property string $created_at
 * @property string $alias
 *
 * The followings are the available model relations:
 * @property CategoryPosters $categoryPoster
 */
class Posters extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'posters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['created_at, photo, category_poster_id', 'required'],
			['category_poster_id', 'numerical', 'integerOnly'=>true],
			['title, photo, alias', 'length', 'max'=>255],
			['description, date_from, date_to', 'safe'],
			// The following rule is used by search().
			['id, category_poster_id, title, description, date_from, date_to, photo, created_at, alias', 'safe', 'on'=>'search'],
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
			'categoryPoster' => [self::BELONGS_TO, 'CategoryPosters', 'category_poster_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'category_poster_id' => Yii::t('main', 'Категория'),
			'title' => Yii::t('main', 'Заголовок'),
			'description' => Yii::t('main', 'Описание'),
			'date_from' => Yii::t('main', 'с'),
			'date_to' => Yii::t('main', 'по'),
			'photo' => Yii::t('main', 'Фото'),
			'created_at' => Yii::t('main', 'Добавлено'),
			'alias' => 'Alias',
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

        if ($this->id) {
            $criteria->compare('id', $this->id);
        }

        if ($this->category_poster_id) {
            $criteria->compare('category_poster_id', $this->category_poster_id);
        }
        if ($this->title) {
            $criteria->compare('title', $this->title);
        }
        if ($this->created_at) {
            $criteria->compare('created_at', $this->created_at);
        }

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
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
	 * @return Posters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    /**
     * @param int $currentCategoryId
     * @return CActiveDataProvider
     */
    public function getPosters($currentCategoryId = 0)
    {
        $criteria = new CDbCriteria();

        if ($currentCategoryId) {
            $criteria->compare('category_poster_id', $currentCategoryId);
        }

        $criteria->order = 'created_at DESC';

        $dataProvider = new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizePosters'],
                'pageVar' => 'page',
            ],
        ]);

        return $dataProvider;
    }
}
