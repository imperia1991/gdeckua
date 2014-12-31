<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $category_news_id
 * @property string $title
 * @property string $text
 * @property string $short_text
 * @property string $created_at
 * @property integer $is_deleted
 * @property string $photo
 * @property string $alias
 * @property integer $is_opinion
 *
 * The followings are the available model relations:
 * @property CategoryNews $categoryNews
 */
class News extends ActiveRecord
{
    /**
     *
     */
    const OPINION = 'opinion';
    /**
     *
     */
    const SCENARIO_ADMIN = 'admin';
    /**
     *
     */
    const SCENARIO_USER = 'user';
    /**
     * Новость
     */
    const IS_OPINION = 1;
    /**
     * Мнение
     */
    const IS_NOT_OPINION = 0;

    /**
     * Добавлять на фото водяной знак или нет
     * @var bool
     */
    public $isWatemark = false;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
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
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['title, created_at, category_news_id, short_text, alias', 'required'],
            ['photo', 'required', 'message' => 'Фото для анонса новости обязательно'],
            ['text', 'required', 'message' => 'Введите текст новости'],
            ['category_news_id, is_deleted', 'numerical', 'integerOnly' => true],
            ['title', 'length', 'max' => 255],
            ['photo, is_opinion, isWatemark', 'safe'],
            // The following rule is used by search().
            ['id, category_news_id, title, text, created_at, is_deleted, is_opinion', 'safe', 'on' => 'search'],
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
            'categoryNews' => [self::BELONGS_TO, 'CategoryNews', 'category_news_id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'category_news_id' => Yii::t('main', 'Категория'),
            'title' => Yii::t('main', 'Заголовок'),
            'text' => Yii::t('main', 'Текст новости'),
            'created_at' => Yii::t('main', 'Добавлено'),
            'is_deleted' => Yii::t('main', 'Статус'),
            'photo' => Yii::t('main', 'Фото для анонса новости'),
            'short_text' => Yii::t('main', 'Текст для анонса новости'),
            'is_opinion' => Yii::t('main', 'Мнение'),
            'isWatemark' => Yii::t('main', 'Водяной знак'),
        ];
    }

    /**
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        if ($this->id) {
            $criteria->compare('id', $this->id);
        }

        if ($this->category_news_id) {
            $criteria->compare('category_news_id', $this->category_news_id);
        }
        if ($this->title) {
            $criteria->compare('title', $this->title);
        }
        if ($this->created_at) {
            $criteria->compare('created_at', $this->created_at);
        }
        if ($this->is_deleted) {
            $criteria->compare('is_deleted', $this->is_deleted);
        }
        if ($this->is_opinion == 0 || $this->is_opinion == 1) {
            $criteria->compare('is_opinion', $this->is_opinion);
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
     * Возвращает превью новостей или мнений
     * @param int $is_opinion (0 - новость, 1 - мнение)
     * @param int $limit количество на страницу
     * @return CActiveRecord[]
     */
    public function getPreview($is_opinion = 0, $limit = 4)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('is_deleted', 0);
        $criteria->compare('is_opinion', $is_opinion);
        $criteria->order = 'created_at DESC';
        $criteria->limit = $limit;

        return $this->findAll($criteria);
    }

    /**
     * Возвращает тип(ы) новостей (0 - новость, 1 - мнение)
     * @param bool $all true - все типы, false - конкретный тип
     * @param int $opinion число обозначающее тип новости (0 - новость, 1 - мнение)
     * @return array|string
     */
    public function getOpinions($all = true, $opinion = 0)
    {
        if ($all) {
            return [
                '0' => Yii::t('main', 'Новость'),
                '1' => Yii::t('main', 'Мнение'),
            ];
        }

        return $opinion ? Yii::t('main', 'Мнение') : Yii::t('main', 'Новость');
    }


    /**
     * Возвращает массив состоящий из предыдущей, текущей и следующей новостей
     * @param $id int текущая новость
     * @return News[]
     */
    public function getViewNews($id)
    {
        $query = 'SELECT * FROM news WHERE (
                    id = (SELECT MAX(id) FROM news WHERE id < ' . $id . ' AND is_deleted = 0)
                    OR id = (SELECT MIN(id) FROM news WHERE id > ' . $id . ' AND is_deleted = 0)
                    OR id = ' . $id . ' AND is_deleted = 0)
                  ORDER BY created_at DESC';

        $dataReader = Yii::app()->db->createCommand($query)->query();
        $items = [];
        while ($item = $dataReader->readObject('News', News::model()->getAttributes())) {
            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param int $isOpinion
     * @param string $category
     * @return CActiveDataProvider
     */
    public function getAll($isOpinion = 0, $category = '')
    {
        $criteria = new CDbCriteria();
        $criteria->compare('is_deleted', 0);
        $criteria->compare('is_opinion', $isOpinion);

        if ($category && $category != self::OPINION) {
            $criteria->join = 'join category_news cn ON t.category_news_id = cn.id AND cn.aliases = "' . $category . '"';
        }

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizeNews'],
                'pageVar' => 'page',
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getShortTitle()
    {
        $result = mb_substr($this->title, 0, 20, 'UTF-8');
        if (strlen($this->title) > 20) {
            $result .= '...';
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getShortText()
    {
        $result = mb_substr($this->short_text, 0, 100, 'UTF-8');
        if (strlen($this->short_text) > 100) {
            $result .= '...';
        }

        return $result;
    }
}
