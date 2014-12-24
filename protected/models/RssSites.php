<?php

/**
 * This is the model class for table "rss_sites".
 *
 * The followings are the available columns in table 'rss_sites':
 * @property integer $id
 * @property string $url
 * @property string $site
 * @property string $created_at
 * @property integer $is_deleted
 * @property string $title
 * @property string $alias
 * @property string $message
 * @property integer $is_read
 * The followings are the available model relations:
 * @property RssContent[] $rssContents
 */
class RssSites extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return RssSites the static model class
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
        return 'rss_sites';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['url, site, created_at, title, alias', 'required'],
            ['is_deleted', 'numerical', 'integerOnly' => true],
            ['site, url', 'length', 'max' => 255],
            ['site, url', 'url', 'defaultScheme' => 'http', 'allowEmpty' => false, 'validateIDN' => true, 'message' => Yii::t('main', 'Значение не является правильным URL-адресом сайта')],
            ['message, is_read', 'safe'],
            // The following rule is used by search().
            ['id, url, created_at, is_deleted', 'safe', 'on' => 'search'],
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
            'rssContents' => [self::HAS_MANY, 'RssContent', 'rss_site_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id'         => '№',
            'url'        => Yii::t('main', 'Адрес Rss сайта'),
            'site'        => Yii::t('main', 'URL новостного сайта'),
            'created_at' => Yii::t('main', 'Дата добавления'),
            'is_deleted' => Yii::t('main', 'Отключить'),
            'title' => Yii::t('main', 'Название сайта'),
            'message' => Yii::t('main', 'Сообщение'),
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
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getIsRead()
    {
        return $this->is_read;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param mixed $is_read
     */
    public function setIsRead($is_read)
    {
        $this->is_read = $is_read;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }


}
