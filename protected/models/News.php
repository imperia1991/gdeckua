<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $category_news_id
 * @property string $title
 * @property string $text
 * @property string $created_at
 * @property integer $is_deleted
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
        return array(
            array('title, text, created_at, category_news_id', 'required'),
            array('category_news_id, is_deleted', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            // The following rule is used by search().
            array('id, category_news_id, title, text, created_at, is_deleted', 'safe', 'on' => 'search'),
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
            'categoryNews' => array(self::BELONGS_TO, 'CategoryNews', 'category_news_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '№',
            'category_news_id' => Yii::t('main', 'Категория'),
            'title' => Yii::t('main', 'Заголовок'),
            'text' => Yii::t('main', 'Текст новости'),
            'created_at' => Yii::t('main', 'Добавлено'),
            'is_deleted' => Yii::t('main', 'Статус'),
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
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('category_news_id', $this->category_news_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('is_deleted', $this->is_deleted);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
