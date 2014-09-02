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
            ['title, photo, created_at', 'required'],
            ['categoriesStore', 'required', 'message' => 'Выберите хотя бы одну категорию'],
            ['is_showing, is_right_column, counter, orderby', 'numerical', 'integerOnly' => true],
            ['title, photo', 'length', 'max' => 255],
            // The following rule is used by search().
            ['id, title, photo, created_at, is_showing, is_right_column, counter, orderby', 'safe', 'on' => 'search'],
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

//		$criteria->compare('id',$this->id);
//		$criteria->compare('title',$this->title,true);
//		$criteria->compare('photo',$this->photo,true);
//		$criteria->compare('created_at',$this->created_at,true);
//		$criteria->compare('is_showing',$this->is_showing);
//		$criteria->compare('is_right_column',$this->is_right_column);
//		$criteria->compare('counter',$this->counter);
//		$criteria->compare('orderby',$this->orderby);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * @return string
     */
    public function getCategoriesStore()
    {
        $result = [];

        /** @var Categories $category */
        foreach ($this->bannersCategories as $category) {
            $result[] = $category->title_ru;
        }

        return join(', ', $result);
    }

    public function getPosition()
    {
        return $this->is_right_column == self::IS_RIGHT_COLUMN ? 'Вверху' : 'Справа';
    }

    public function getPositions()
    {
        return [
            '-1' => 'Все',
            self::IS_NOT_RIGHT_COLUMN => 'Вверху',
            self::IS_RIGHT_COLUMN => 'Справа',
        ];
    }

    public function getStatus()
    {
        return $this->is_showing == self::STATUS_IS_SHOWING ? 'Показывается' : 'Не показывается';
    }

    public function getStatuses()
    {
        return [
            '-1' => 'Все',
            self::STATUS_IS_SHOWING => 'Показывается',
            self::STATUS_NOT_SHOWING => 'Не показывается',
        ];
    }

    public function getCurrentStatus()
    {
        return $this->is_showing ? $this->is_showing : -1;
    }

    public function getCurrentPosition()
    {
        return $this->is_right_column ? $this->is_right_column : -1;
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
