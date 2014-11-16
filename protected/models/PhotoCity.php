<?php

/**
 * This is the model class for table "photo_city".
 *
 * The followings are the available columns in table 'photo_city':
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $site
 * @property string $alias
 * @property string $created_at
 * @property string $photo
 *
 * The followings are the available model relations:
 * @property CommentsPhotoCity[] $commentsPhotoCities
 */
class PhotoCity extends ActiveRecord
{
    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_USER = 'user';
    /**
     * @var
     */
    public $verifyCode;

    /**
     * @var array
     */
    public $types = [];

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PhotoCity the static model class
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
        return 'photo_city';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['title, author, created_at, alias', 'required', 'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')],
            ['photo', 'required', 'message' => Yii::t('main', 'Добавьте фотографию')],
            ['verifyCode', 'captcha', 'on' => self::SCENARIO_USER],
            ['title, author, site, alias', 'length', 'max' => 255],
            ['site', 'url'],
            // The following rule is used by search().
            ['id, title, author, site', 'safe', 'on' => 'search'],
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
            'commentsPhotoCities' => [self::HAS_MANY, 'CommentsPhotoCity', 'photo_city_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('main', 'Название'),
            'author' => Yii::t('main', 'Автор'),
            'site' => Yii::t('main', 'Сайт'),
            'alias' => Yii::t('main', 'Алиас'),
            'created_at' => Yii::t('main', 'Добавлено'),
            'verifyCode' => Yii::t('main', 'Введите код с картинки'),
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
        if ($this->title) {
            $criteria->compare('title', $this->title, true);
        }
        if ($this->author) {
            $criteria->compare('author', $this->author, true);
        }
        if ($this->site) {
            $criteria->compare('site', $this->site, true);
        }

        return new CActiveDataProvider($this,
            [
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
     * @return string
     */
    public function getType()
    {
        return $this->type == self::PHOTO_CITY ? Yii::t('main', 'Фотография города') : Yii::t(
            'main',
            'Фотография мероприятия'
        );
    }

    public function getPhotoCities()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'created_at DESC';

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizePhotos'],
                'pageVar' => 'page',
            ],
        ]);
    }
}
