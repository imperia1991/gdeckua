<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property string $title
 * @property string $photo
 * @property string $created_at
 * @property integer $is_showing
 * @property integer $is_right_column
 * @property integer $counter
 * @property integer $orderby
 *
 * The followings are the available model relations:
 * @property BannersCategories[] $bannersCategories
 */
class Banners extends ActiveRecord
{
    /**
     *
     */
    const STATUS_IS_SHOWING = 1;
    /**
     *
     */
    const STATUS_NOT_SHOWING = 0;
    /**
     *
     */
    const IS_RIGHT_COLUMN = 1;
    /**
     *
     */
    const IS_NOT_RIGHT_COLUMN = 0;

    /**
     * @var array
     */
    public $categoriesStore = [];
    /**
     * @var integer
     */
    public $counterFrom;
    /**
     * @var integer
     */
    public $counterTo;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Banners the static model class
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
        return 'banners';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['title, created_at', 'required'],
            ['photo', 'required', 'message' => 'Изображение банера обязательно'],
            ['categoriesStore', 'required', 'message' => 'Выберите хотя бы одну категорию'],
            ['is_showing, is_right_column, counter, orderby', 'numerical', 'integerOnly' => true],
            ['title, photo', 'length', 'max' => 255],
            // The following rule is used by search().
            ['id, title, photo, created_at, is_showing, is_right_column, counter, orderby, counterFrom, counterTo', 'safe', 'on' => 'search'],
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
            'bannersCategories' => [self::HAS_MANY, 'BannersCategories', 'banner_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('main', 'Короткое описание'),
            'photo' => Yii::t('main', 'Изображение'),
            'created_at' => Yii::t('main', 'Добавлено'),
            'is_showing' => Yii::t('main', 'Статус'),
            'is_right_column' => Yii::t('main', 'Позиция'),
            'counter' => Yii::t('main', 'Количество показов'),
            'orderby' => Yii::t('main', 'Порядок расположения'),
            'categoriesStore' => Yii::t('main', 'Категории'),
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
        if ($this->is_showing == self::STATUS_IS_SHOWING || $this->is_showing == self::STATUS_NOT_SHOWING) {
            $criteria->compare('is_showing',$this->is_showing);
        }
        if ($this->is_right_column == self::IS_RIGHT_COLUMN || $this->is_right_column == self::IS_NOT_RIGHT_COLUMN) {
            $criteria->compare('is_right_column',$this->is_right_column);
        }
        if ($this->orderby) {
            $criteria->compare('orderby',$this->orderby);
        }
        if ($this->counterFrom) {
            $criteria->compare('counter', '>=' . $this->counterFrom);
        }
        if ($this->counterTo) {
            $criteria->compare('counter', '<=' . $this->counterTo);
        }
        if (!empty($this->categoriesStore)) {
            $criteria->compare('bannersCategories.place_category_id', $this->categoriesStore[0], true );
            $criteria->together = true;
//            $criteria->join = 'join banners_categories bc ON (bc.banner_id = ' . $this->id . ' AND bc.place_category_id = ' . $this->categoriesStore[0] . ')';
        }

        $criteria->with = ['bannersCategories'];

//		$criteria->compare('created_at',$this->created_at,true);
//		$criteria->compare('counter',$this->counter);
//		$criteria->compare('orderby',$this->orderby);

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
     * @return string
     */
    public function getCategoriesStore()
    {
        $result = [];

        /** @var BannersCategories $category */
        foreach ($this->bannersCategories as $category) {
            $result[] = $category->placeCategory->title_ru;
        }

        return join(', ', $result);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->is_right_column == self::IS_RIGHT_COLUMN ? 'Справа' : 'Вверху';
    }

    /**
     * @return array
     */
    public function getPositions()
    {
        return [
            2 => 'Все',
            self::IS_NOT_RIGHT_COLUMN => 'Вверху',
            self::IS_RIGHT_COLUMN => 'Справа',
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->is_showing == self::STATUS_IS_SHOWING ? 'Показывается' : 'Не показывается';
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return [
            2 => 'Все',
            self::STATUS_IS_SHOWING => 'Показывается',
            self::STATUS_NOT_SHOWING => 'Не показывается',
        ];
    }

    /**
     * @return int|string
     */
    public function getCurrentStatus()
    {
        return $this->is_showing >= 0 ? $this->is_showing : 2;
    }

    /**
     * @return int|string
     */
    public function getCurrentPosition()
    {
        return $this->is_right_column >= 0 ? $this->is_right_column : 2;
    }

    /**
     * @return array
     */
    public function getCategoriesSelected()
    {
        if (!count($this->bannersCategories)) {
            return [];
        }

        $result = [];
        foreach ($this->bannersCategories as $item) {
            $result[$item->place_category_id] = ['selected' => 'selected'];
        }

        return $result;
    }

    /**
     * Сохраняем выбранные категории
     */
    protected function afterSave()
    {
        parent::afterSave();

        BannersCategories::model()->deleteAllByAttributes(
            [
                'banner_id' => $this->id
            ]
        );

        foreach ($this->categoriesStore as $category) {
            $bannerCategory = new BannersCategories();
            $bannerCategory->banner_id = $this->id;
            $bannerCategory->place_category_id = $category;
            $bannerCategory->save(false);

            unset($bannerCategory);
        }
    }


    /**
     * После удаления удаляется изображение
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->photo && file_exists(Yii::app()->params['admin']['files']['banners'] . $this->photo)) {
            unlink(Yii::app()->params['admin']['files']['banners'] . $this->photo);
        }
    }

}
