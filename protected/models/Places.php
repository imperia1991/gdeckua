<?php

/**
 * This is the model class for table "services".
 *
 * The followings are the available columns in table 'services':
 * @property integer $id
 * @property integer $user_id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $description
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property string $address
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

    public $districtId;

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
            array('title_ru, title_uk, description, address, lat, lng, created_at, district_id', 'required'),
            array('is_deleted', 'numerical', 'integerOnly' => true),
            array('title_ru, title_uk', 'length', 'max' => 255),
            array('user_id, updated_at, country_id, region_id, city_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, title_ru, title_uk, description, country_id, region_id, city_id, address, lat, lng, created_at, updated_at, is_deleted, district_id, districtId', 'safe', 'on' => 'search'),
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
            'country' => array(self::BELONGS_TO, 'Countries', 'region_id'),
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
            'title_ru' => Yii::t('main', 'Название (русский)'),
            'title_uk' => Yii::t('main', 'Название (украинский)'),
            'district_id' => Yii::t('main', 'Район'),
            'description' => Yii::t('main', 'Короткое описание'),
            'country_id' => Yii::t('main', 'Страна'),
            'region_id' => Yii::t('main', 'Область'),
            'city_id' => Yii::t('main', 'Населенный пункт'),
            'address' => Yii::t('main', 'Адрес'),
            'lat' => Yii::t('main', 'Широта'),
            'lng' => Yii::t('main', 'Долгота'),
            'created_at' => Yii::t('main', 'Дата добавления'),
            'updated_at' => Yii::t('main', 'Дата обновления'),
            'is_deleted' => Yii::t('main', 'Не показывается'),
            'districtId' => Yii::t('main', 'Район'),
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
        if ($this->address) {
            $criteria->compare('address', $this->address, true);
        }
        if ($this->created_at) {
            $criteria->compare('created_at', $this->created_at);
        }
        if ($this->updated_at) {
            $criteria->compare('updated_at', $this->updated_at);
        }
        if ($this->districtId) {
            $criteria->compare('district_id', $this->districtId);
        }
        if ($this->is_deleted) {
            $criteria->compare('is_deleted', $this->is_deleted);
        }

        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
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

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->description = nl2br($this->description);

            return true;
        }

        return false;
    }
}
