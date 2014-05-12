<?php

/**
 * This is the model class for table "services".
 *
 * The followings are the available columns in table 'services':
 * @property integer $id
 * @property integer $user_id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $description_ru
 * @property string $description_uk
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property string $address_ru
 * @property string $address_uk
 * @property float $lat
 * @property float $lng
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_deleted
 * @property integer $district_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Cities $city
 * @property Regions $region
 * @property PlaceTags $tags
 */
class Places extends ActiveRecord
{
    const SCENARIO_RU = 'ru';
    const SCENARIO_UK = 'uk';
    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_GUEST = 'guest';

    public $search;
    public $districtId;
    public $verifyCode;
    public $images;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'places';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title_ru, address_ru, created_at, district_id, description_ru', 'required', 'on' => self::SCENARIO_RU),
            array('title_uk, address_uk, created_at, district_id, description_uk', 'required', 'on' => self::SCENARIO_UK),
            array('title_ru, title_uk, address_ru, address_uk, lat, lng, created_at, district_id', 'required', 'on' => self::SCENARIO_ADMIN),
            array('is_deleted', 'numerical', 'integerOnly' => true),
            array('title_ru, title_uk', 'length', 'max' => 255),
            array('user_id, updated_at, country_id, region_id, city_id, description_ru, description_uk, district_id, search', 'safe'),
            array('verifyCode', 'captcha', 'on' => self::SCENARIO_RU . ', ' . self::SCENARIO_UK),
            array('images', 'required', 'on' => self::SCENARIO_RU . ', ' . self::SCENARIO_UK, 'message' => Yii::t('main', 'Добавьте хотя бы одну фотографию')),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, title_ru, title_uk, description_ru, description_uk, country_id, region_id, city_id, address_ru, address_uk, lat, lng, created_at, updated_at, is_deleted, district_id, districtId, search', 'safe', 'on' => 'search'),
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
            'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
            'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'city' => array(self::BELONGS_TO, 'Cities', 'city_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'tags' => array(self::HAS_ONE, 'PlaceTags', 'place_id'),
            'photos' => array(self::HAS_MANY, 'Photos', 'place_id'),
            'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('main', '№'),
            'user_id' => Yii::t('main', 'Пользователь'),
            'title_ru' => Yii::t('main', 'Название'),
            'title_uk' => Yii::t('main', 'Название'),
            'district_id' => Yii::t('main', 'Район'),
            'description_ru' => Yii::t('main', 'Краткое описание'),
            'description_uk' => Yii::t('main', 'Краткое описание'),
            'country_id' => Yii::t('main', 'Страна'),
            'region_id' => Yii::t('main', 'Область'),
            'city_id' => Yii::t('main', 'Населенный пункт'),
            'address_ru' => Yii::t('main', 'Адрес'),
            'address_uk' => Yii::t('main', 'Адрес'),
            'lat' => Yii::t('main', 'Широта'),
            'lng' => Yii::t('main', 'Долгота'),
            'created_at' => Yii::t('main', 'Дата добавления'),
            'updated_at' => Yii::t('main', 'Дата обновления'),
            'is_deleted' => Yii::t('main', 'Активно'),
            'districtId' => Yii::t('main', 'Район'),
            'search' => Yii::t('main', 'Название'),
            'images' => Yii::t('main', 'Загрузка фотографий'),
            'address_ru_admin' => Yii::t('main', 'Название (русский)'),
            'address_uk_admin' => Yii::t('main', 'Название (украинский)'),
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        if ($this->id) {
            $criteria->compare('id', $this->id);
        }
        if ($this->title_ru) {
            $criteria->compare('title_ru', $this->title_ru, true);
        }
        if ($this->title_uk) {
            $criteria->compare('title_uk', $this->title_uk, true);
        }
        if ($this->created_at) {
            $criteria->compare('created_at', $this->created_at);
        }
        if ($this->updated_at) {
            $criteria->compare('updated_at', $this->updated_at);
        }
        if ($this->districtId == -1) {
            $criteria->addCondition('district_id IS NULL');
        }
        if ($this->districtId && $this->districtId != -1) {
            $criteria->compare('district_id', $this->districtId);
        }
        if ($this->is_deleted == 0 || $this->is_deleted == 1) {
            $criteria->compare('is_deleted', $this->is_deleted);
        }
        $criteria->with = array('photos');

        return new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'title_ru ASC',
                    ),
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['admin']['pageSize'],
                    ),
            ));
    }

    public function searchMain()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->condition = 'is_deleted = 0';
        $criteria->with = array('photos');

        return new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'title_' . Yii::app()->getLanguage() . ' ASC',
                    ),
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['pageSize'],
                        'pageVar' => 'page',
                        'route' => '/' . Yii::app()->getLanguage() .'/',
                        'params' => array(),
                    ),
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Services the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->description_ru = nl2br($this->description_ru);
            $this->description_uk = nl2br($this->description_uk);

            return true;
        }

        return false;
    }

    public function getIsDeletes($all = true)
    {
        if ($all) {
            return array(
                0 => 'Активно',
                1 => 'Не активно'
            );
        }
        else {
            switch ($this->is_deleted) {
                case 0:
                    return 'Активно';
                case 1:
                    return 'Не активно';
                default:
                    return 'Активно';
            }
        }
    }

    public function getDistrict()
    {
        return is_object($this->district) ? $this->district->title_ru : Yii::t('main', 'Не указан');
    }

}