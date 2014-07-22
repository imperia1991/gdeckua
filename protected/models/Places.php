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
 * @property string $alias
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
    public $photo;
    public $category_id;
    private $categories = [];

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
        return [
            ['title_ru, address_ru, created_at, district_id, description_ru', 'required', 'on' => self::SCENARIO_RU],
            ['title_uk, address_uk, created_at, district_id, description_uk', 'required', 'on' => self::SCENARIO_UK],
            [
                'title_ru, title_uk, address_ru, address_uk, lat, lng, created_at, district_id',
                'required',
                'on' => self::SCENARIO_ADMIN
            ],
            ['is_deleted', 'numerical', 'integerOnly' => true],
            ['title_ru, title_uk, alias', 'length', 'max' => 255],
            [
                'user_id, updated_at, country_id, region_id, city_id, description_ru, description_uk, district_id, search',
                'safe'
            ],
            ['verifyCode', 'captcha', 'on' => self::SCENARIO_RU . ', ' . self::SCENARIO_UK],
            [
                'images',
                'required',
                'on' => self::SCENARIO_RU . ', ' . self::SCENARIO_UK,
                'message' => Yii::t('main', 'Добавьте хотя бы одну фотографию')
            ],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            [
                'id, user_id, title_ru, title_uk, description_ru, description_uk, country_id, region_id, city_id, address_ru, address_uk, lat, lng, created_at, updated_at, is_deleted, district_id, districtId, search, category_id, photo',
                'safe',
                'on' => 'search'
            ],
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
            'country' => [self::BELONGS_TO, 'Countries', 'country_id'],
            'region' => [self::BELONGS_TO, 'Regions', 'region_id'],
            'city' => [self::BELONGS_TO, 'Cities', 'city_id'],
            'user' => [self::BELONGS_TO, 'Users', 'user_id'],
            'tags' => [self::HAS_ONE, 'PlaceTags', 'place_id'],
            'photos' => [self::HAS_MANY, 'Photos', 'place_id'],
            'district' => [self::BELONGS_TO, 'Districts', 'district_id'],
            'placesCategories' => [self::HAS_MANY, 'PlacesCategories', 'place_id'],
            'comments' => [self::HAS_MANY, 'Comments', 'place_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
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
            'category_id' => Yii::t('main', 'Категория'),
            'photo' => Yii::t('main', 'Фото'),
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
            $criteria->compare('t.id', $this->id);
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
        if ($this->address_uk == 'empty') {
            $criteria->addCondition('(address_uk = "" OR address_uk IS NULL)');
        }
        if ($this->address_uk == 'notempty') {
            $criteria->addCondition('(address_uk <> "" AND address_uk IS NOT NULL)');
        }
        if ($this->category_id) {
            $criteria->compare('placesCategories.category_id', $this->category_id);
        }
        if ($this->photo == 'notPhoto') {
            $criteria->addCondition('photos.place_id IS NULL');
            $criteria->together = true;
        }
        $criteria->together = true;
        $criteria->with = ['photos', 'placesCategories'];

        return new CActiveDataProvider($this,
            [
                'criteria' => $criteria,
                'sort' => [
                    'defaultOrder' => 'title_ru ASC',
                ],
                'pagination' => [
                    'pageSize' => Yii::app()->params['admin']['pageSize'],
                ],
            ]);
    }

    public function searchMain($isFirst = false)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'is_deleted = 0';
        $criteria->with = ['photos'];

        if ($isFirst) {
            $criteria->order = 'RAND()';
        }

        return new CActiveDataProvider($this,
            [
                'criteria' => $criteria,
                'sort' => [
                    'defaultOrder' => 'title_' . Yii::app()->getLanguage() . ' ASC',
                ],
                'pagination' => [
                    'pageSize' => Yii::app()->params['pageSize'],
                    'pageVar' => 'page',
                    'route' => '/' . Yii::app()->getLanguage() . '/',
                    'params' => [],
                ],
            ]);
    }

    public function getTotalItemCount()
    {
        return $this->count('is_deleted = 0');
    }

    public function getIsDeletes($all = true)
    {
        if ($all) {
            return [
                0 => 'Активно',
                1 => 'Не активно'
            ];
        } else {
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

    public function getEmptyAddress()
    {
        return [
            'notempty' => 'Заполнено',
            'empty' => 'Не заполнено'
        ];
    }

    public function getCategories()
    {
        $this->categories = CHtml::listData(Categories::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');

        return $this->categories;
    }

    public function getCategory()
    {
        if (!count($this->placesCategories)) {
            return null;
        }

        $result = [];
        foreach ($this->placesCategories as $item) {
            $result[] = $item->category->title_ru;
        }

        return join(', ', $result);
    }

    public function isPhoto()
    {
        return [
            'photo' => 'С фото',
            'notPhoto' => 'Без фото'
        ];
    }

    public function getCategoriesSelected()
    {
        if (!count($this->placesCategories)) {
            return [];
        }

        $result = [];
        foreach ($this->placesCategories as $item) {
            $result[$item->category_id] = ['selected' => 'selected'];
        }

        return $result;
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

}