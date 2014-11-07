<?php

/**
 * This is the model class for table "rss_content".
 *
 * The followings are the available columns in table 'rss_content':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $add_at
 * @property string $created_at
 * @property integer $is_deleted
 * @property integer $rss_site_id
 *
 * The followings are the available model relations:
 * @property RssSites $rssSite
 */
class RssContent extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return RssContent the static model class
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
        return 'rss_content';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['id, title, url, add_at, created_at, is_deleted, rss_site_id', 'required'],
            ['id, is_deleted, rss_site_id', 'numerical', 'integerOnly' => true],
            ['title, url', 'length', 'max' => 255],
            // The following rule is used by search().
            ['id, title, url, add_at, created_at, is_deleted, rss_site_id', 'safe', 'on' => 'search'],
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
            'rssSite' => [self::BELONGS_TO, 'RssSites', 'rss_site_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id'          => '№',
            'title'       => Yii::t('main', 'Заголовок новости'),
            'url'         => Yii::t('main', 'Адрес сайта'),
            'add_at'      => Yii::t('main', 'Дата создания новости'),
            'created_at'  => Yii::t('main', 'Дата добавления новости'),
            'is_deleted'  => Yii::t('main', 'Активно'),
            'rss_site_id' => Yii::t('main', 'Сайт'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('add_at', $this->add_at, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('is_deleted', $this->is_deleted);
        $criteria->compare('rss_site_id', $this->rss_site_id);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
}