<?php

/**
 * This is the model class for table "banners_categories".
 *
 * The followings are the available columns in table 'banners_categories':
 * @property integer $id
 * @property integer $place_category_id
 * @property integer $banner_id
 *
 * The followings are the available model relations:
 * @property Categories $placeCategory
 * @property Banners $banner
 */
class BannersCategories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banners_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['place_category_id, banner_id', 'numerical', 'integerOnly'=>true],
			// The following rule is used by search().
			['id, place_category_id, banner_id', 'safe', 'on'=>'search'],
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
			'placeCategory' => [self::BELONGS_TO, 'Categories', 'place_category_id'],
			'banner' => [self::BELONGS_TO, 'Banners', 'banner_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'place_category_id' => 'Place Category',
			'banner_id' => 'Banner',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('place_category_id',$this->place_category_id);
		$criteria->compare('banner_id',$this->banner_id);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BannersCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
