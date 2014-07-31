<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $category_news_id
 * @property string $title
 * @property string $text
 * @property string $short_text
 * @property string $created_at
 * @property integer $is_deleted
 * @property string $photo
 *
 * The followings are the available model relations:
 * @property CategoryNews $categoryNews
 */
class News extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
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
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['title, created_at, category_news_id, short_text', 'required'],
            ['photo', 'required', 'message' => 'Фото для анонса новсти обязательно'],
            ['text', 'required', 'message' => 'Введите текст новости'],
            ['category_news_id, is_deleted', 'numerical', 'integerOnly' => true],
            ['title', 'length', 'max' => 255],
            ['photo', 'safe'],
            // The following rule is used by search().
            ['id, category_news_id, title, text, created_at, is_deleted', 'safe', 'on' => 'search'],
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
            'categoryNews' => [self::BELONGS_TO, 'CategoryNews', 'category_news_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'category_news_id' => Yii::t('main', 'Категория'),
            'title' => Yii::t('main', 'Заголовок'),
            'text' => Yii::t('main', 'Текст новости'),
            'created_at' => Yii::t('main', 'Добавлено'),
            'is_deleted' => Yii::t('main', 'Статус'),
            'photo' => Yii::t('main', 'Фото для анонса новости'),
            'short_text' => Yii::t('main', 'Текст для анонса новости'),
        ];
    }

    /**
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        if ($this->id) {
            $criteria->compare('id', $this->id);
        }

        if ($this->category_news_id) {
            $criteria->compare('category_news_id', $this->category_news_id);
        }
        if ($this->title) {
            $criteria->compare('title', $this->title);
        }
        if ($this->created_at) {
            $criteria->compare('created_at', $this->created_at);
        }
        if ($this->is_deleted) {
            $criteria->compare('is_deleted', $this->is_deleted);
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

    public function getPreviewNews()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('is_deleted', 0);
        $criteria->order = 'created_at DESC';
        $criteria->limit = 4;

        return $this->findAll($criteria);
    }
}
