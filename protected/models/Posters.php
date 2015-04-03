<?php

/**
 * This is the model class for table "posters".
 *
 * The followings are the available columns in table 'posters':
 * @property integer $id
 * @property integer $category_poster_id
 * @property string $title
 * @property string $description
 * @property string $date_from
 * @property string $date_to
 * @property string $photo
 * @property string $created_at
 * @property string $alias
 * @property string $cropID
 * @property integer $place_id
 *
 * The followings are the available model relations:
 * @property CategoryPosters $categoryPoster
 * @property Places $place
 */
class Posters extends ActiveRecord
{
	/**
	 * @var
	 */
	public $placeTitle;
	public $cropID;
	public $cropX;
	public $cropY;
	public $cropW;
	public $cropH;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Posters the static model class
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
		return 'posters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['created_at, photo, category_poster_id', 'required'],
			['category_poster_id', 'numerical', 'integerOnly' => true],
			['title, photo, alias', 'length', 'max' => 255],
			['description, date_from, date_to, place_id, cropID', 'safe'],
			// The following rule is used by search().
			[
				'id, category_poster_id, title, description, date_from, date_to, photo, created_at, alias, place_id',
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
			'categoryPoster' => [self::BELONGS_TO, 'CategoryPosters', 'category_poster_id'],
			'place'          => [self::BELONGS_TO, 'Places', 'place_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id'                 => 'ID',
			'category_poster_id' => Yii::t('main', 'Категория'),
			'title'              => Yii::t('main', 'Заголовок'),
			'description'        => Yii::t('main', 'Описание'),
			'date_from'          => Yii::t('main', 'с'),
			'date_to'            => Yii::t('main', 'по'),
			'photo'              => Yii::t('main', 'Фото'),
			'created_at'         => Yii::t('main', 'Добавлено'),
			'place_id'           => 'Место',
			'placeTitle'         => 'Место',
			'alias'              => 'Alias',
			'cropID'              => 'Превью',
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

		if ($this->category_poster_id) {
			$criteria->compare('category_poster_id', $this->category_poster_id);
		}
		if ($this->title) {
			$criteria->compare('title', $this->title);
		}
		if ($this->created_at) {
			$criteria->compare('created_at', $this->created_at);
		}
		if ($this->place_id) {
			$criteria->compare('place_id', $this->place_id);
		}

		return new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'sort'       => [
				'defaultOrder' => 'created_at DESC',
			],
			'pagination' => [
				'pageSize' => Yii::app()->params['admin']['pageSize'],
			],
		]);
	}

	/**
	 * @param int $currentCategoryId
	 *
	 * @return CActiveDataProvider
	 */
	public function getPosters($currentCategoryId = 0)
	{
		$criteria = new CDbCriteria();

		if ($currentCategoryId) {
			$criteria->compare('category_poster_id', $currentCategoryId);
		}

		$criteria->order = 'created_at DESC';

		$dataProvider = new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'sort'       => [
				'defaultOrder' => 'created_at DESC',
			],
			'pagination' => [
				'pageSize' => Yii::app()->params['pageSizePosters'],
				'pageVar'  => 'page',
			],
		]);

		return $dataProvider;
	}

	/**
	 * @return string
	 */
	public function getPlaceTitle()
	{
		if (is_object($this->place)) {
			return $this->place->title_ru . ' (' . $this->place->getDistrict() . ', ' . $this->place->address_ru . ')';
		}

		return '';
	}

	/**
	 * @return array
	 */
	public function getForMainPage()
	{
		$criteria = new CDbCriteria();

		$criteria->join = 'join category_posters cp ON t.category_poster_id = cp.id AND cp.is_affisha = 0';
		$criteria->addCondition('t.place_id IS NOT NULL');
		$criteria->order = 't.created_at DESC';
		$criteria->limit = 6;

		$dataProvider = new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'sort'       => [
				'defaultOrder' => 'created_at DESC',
			],
			'pagination' => false,
		]);

		return $dataProvider->getData();
	}


	/**
	 * @return string
	 */
	public function getFullTitle()
	{
		$title = 'title_' . Yii::app()->getLanguage();
		$fullTitle = Yii::t('main', 'с') . ' ' . Yii::app()->dateFormatter->format('dd.MM', strtotime($this->date_from))
		              . ' ' . Yii::t('main', 'по') . ' ' . Yii::app()->dateFormatter->format('dd.MM',	strtotime($this->date_to));
		$fullTitle .= '<br/>' . $this->categoryPoster->{$title} . ': ' . $this->title;

		return $fullTitle;
	}

	public function getAddress()
	{
		return is_object($this->place) ? $this->place->getTitleWithAddress() : '';
	}

	public function getPlaceUrl()
	{
		return is_object($this->place) ? $this->place->getUrl() : '/';
	}

	public function fromTo()
	{
		if ($this->date_from && $this->date_to && $this->date_from != $this->date_to) {
			return Yii::t('main', 'с') . ' ' . Yii::app()->dateFormatter->format(
				'dd.MM',
				strtotime($this->date_from)
			) . ' ' . Yii::t('main', 'по') . ' ' . Yii::app()->dateFormatter->format(
				'dd.MM',
				strtotime($this->date_to)
			);
		} else {
			return Yii::app()->dateFormatter->format(
				'd MMMM',
				strtotime($this->date_from)
			);
		}
	}

}
