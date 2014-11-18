<?php

/**
 * This is the model class for table "rss_content".
 *
 * The followings are the available columns in table 'rss_content':
 * @property integer $id
 * @property string $title_news
 * @property string $url
 * @property string $add_at
 * @property string $created_at
 * @property integer $is_deleted
 * @property integer $rss_site_id
 *
 * The followings are the available model relations:
 * @property RssSites $rssSite
 */
class RssContent extends ActiveRecord
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
            ['title_news, url, add_at, created_at, rss_site_id', 'required'],
            ['is_deleted, rss_site_id', 'numerical', 'integerOnly' => true],
            ['title_news, url', 'length', 'max' => 255],
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
            'title_news'       => Yii::t('main', 'Заголовок новости'),
            'url'         => Yii::t('main', 'Адрес сайта'),
            'add_at'      => Yii::t('main', 'Дата создания новости'),
            'created_at'  => Yii::t('main', 'Дата добавления новости на сайт'),
            'is_deleted'  => Yii::t('main', 'Не показывать'),
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

        if ($this->id) {
            $criteria->compare('id', $this->id);
        }
        if ($this->title_news) {
            $criteria->compare('title_news', $this->title_news, true);
        }
        if ($this->url) {
            $criteria->compare('url', $this->url, true);
        }
        if ($this->created_at) {
            $criteria->compare('created_at', $this->created_at);
        }
        if ($this->is_deleted == 0 || $this->is_deleted == 1) {
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

    /**
     * @return CActiveDataProvider
     */
    public function getAll()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('is_deleted', 0);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'add_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizeNews'] + 8,
                'pageVar' => 'page',
            ],
        ]);
    }

    /**
     * @return mixed
     */
    public function getAddAt()
    {
        return $this->add_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * @return mixed
     */
    public function getRssSite()
    {
        return $this->rssSite;
    }

    /**
     * @return mixed
     */
    public function getRssSiteId()
    {
        return $this->rss_site_id;
    }

    /**
     * @return mixed
     */
    public function getTitleNews()
    {
        return $this->title_news;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


}
