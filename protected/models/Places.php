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
 * @property string $how_to_get_ru
 * @property string $how_to_get_uk
 * @property string $short_description_ru
 * @property string $short_description_uk
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Cities $city
 * @property Regions $region
 * @property PlaceTags $tags
 * @property Contacts $contact
 */
class Places extends ActiveRecord
{

    /**
     *
     */
    const SCENARIO_RU = 'ru';
    /**
     *
     */
    const SCENARIO_UK = 'uk';
    /**
     *
     */
    const SCENARIO_ADMIN = 'admin';
    /**
     *
     */
    const SCENARIO_GUEST = 'guest';
    /**
     * @var
     */
    public $search;
    /**
     * @var
     */
    public $districtId;
    /**
     * @var
     */
    public $verifyCode;
    /**
     * @var
     */
    public $images;
    /**
     * @var
     */
    public $photo;
    /**
     * @var
     */
    public $category_id;
    /**
     * @var array
     */
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
            ['title_ru, address_ru, created_at, district_id, description_ru, short_description_ru', 'required', 'on' => self::SCENARIO_RU, 'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')],
            ['title_uk, address_uk, created_at, district_id, description_uk, short_description_uk', 'required', 'on' => self::SCENARIO_UK, 'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')],
            [
                'title_ru, title_uk, address_ru, address_uk, lat, lng, created_at, district_id',
                'required',
                'on' => self::SCENARIO_ADMIN
            ],
            ['is_deleted', 'numerical', 'integerOnly' => true],
            ['title_ru, title_uk, alias', 'length', 'max' => 255],
            [
                'user_id, updated_at, country_id, region_id, city_id, description_ru, description_uk, district_id, search, how_to_get_ru, how_to_get_uk, short_description_ru, short_description_uk',
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
            [
                'id, user_id, title_ru, title_uk, description_ru, description_uk, country_id, region_id, city_id, address_ru, address_uk, lat, lng,
                created_at, updated_at, is_deleted, district_id, districtId, search, category_id, photo, short_description_ru, short_description_uk',
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
            'contact' => [self::HAS_ONE, 'Contacts', 'place_id'],
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
            'description_ru' => Yii::t('main', 'Описание'),
            'description_uk' => Yii::t('main', 'Описание'),
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
            'contact' => Yii::t('main', 'Контакты'),
            'how_to_get_ru' => Yii::t('main', 'Как добраться (р)'),
            'how_to_get_uk' => Yii::t('main', 'Как добраться (у)'),
            'short_description_ru' => Yii::t('main', 'Краткое описание'),
            'short_description_uk' => Yii::t('main', 'Краткое описание'),
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

    /**
     * @param bool $isFirst
     * @return CActiveDataProvider
     */
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

    /**
     * @return string
     */
    public function getTotalItemCount()
    {
        return $this->count('is_deleted = 0');
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        $title = 'title_' . Yii::app()->getLanguage();
        return is_object($this->district) ? $this->district->{$title} : Yii::t('main', '');
    }

    /**
     * @return array
     */
    public function getEmptyAddress()
    {
        return [
            'notempty' => 'Заполнено',
            'empty' => 'Не заполнено'
        ];
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $this->categories = CHtml::listData(Categories::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');

        return $this->categories;
    }

    /**
     * @return null|string
     */
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

    /**
     * @return array
     */
    public function isPhoto()
    {
        return [
            'photo' => 'С фото',
            'notPhoto' => 'Без фото'
        ];
    }

    /**
     * @return array
     */
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

    /**
     * @return bool
     */
    public function isEmptyContact()
    {
        return !is_object($this->contact);
    }

    /**
     * @param array $ids
     * @return CActiveDataProvider
     */
    public function getByIds($ids = [])
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', count($ids) ? array_keys($ids) : 0);

        $pages = new CPagination(count($ids));
        $pages->setPageSize(Yii::app()->params['pageSize']);
        $pages->pageVar = 'page';
        $pages->applyLimit($criteria);

        $dataReader = Yii::app()->db->createCommand()->select('t.*')->from($this->tableName() . ' t')
            ->where('t.id IN (' . (count($ids) ? join(',', array_keys($ids)) : 0) . ')')
            ->query();

        while ($item = $dataReader->readObject('Places', Places::model()->getAttributes())) {
            $ids[$item->id] = $item;
        }

        return [
            'items' => array_slice($ids, $pages->currentPage * $pages->limit, $pages->limit),
            'pages' => $pages
        ];
    }

    /**
     * @return bool
     */
    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->description_ru = nl2br($this->description_ru);
            $this->description_uk = nl2br($this->description_uk);
            $this->how_to_get_ru = nl2br($this->how_to_get_ru);
            $this->how_to_get_uk = nl2br($this->how_to_get_uk);

            return true;
        }

        return false;
    }

}