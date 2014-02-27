<?php

/**
 * This is the model class for table "regions".
 *
 * The followings are the available columns in table 'regions':
 * @property integer $id
 * @property integer $country_id
 * @property string $title_ru
 * @property string $title_ua
 * @property string $title_be
 * @property string $title_en
 * @property string $title_es
 * @property string $title_pt
 * @property string $title_de
 * @property string $title_fr
 * @property string $title_it
 * @property string $title_pl
 * @property string $title_ja
 * @property string $title_lt
 * @property string $title_lv
 * @property string $title_cz
 */
class Regions extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'regions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id', 'required'),
			array('id, country_id', 'numerical', 'integerOnly'=>true),
			array('title_ru, title_ua, title_be, title_en, title_es, title_pt, title_de, title_fr, title_it, title_pl, title_ja, title_lt, title_lv, title_cz', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, country_id, title_ru, title_ua, title_be, title_en, title_es, title_pt, title_de, title_fr, title_it, title_pl, title_ja, title_lt, title_lv, title_cz', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'country_id' => 'Country',
			'title_ru' => 'Title Ru',
			'title_ua' => 'Title Ua',
			'title_be' => 'Title Be',
			'title_en' => 'Title En',
			'title_es' => 'Title Es',
			'title_pt' => 'Title Pt',
			'title_de' => 'Title De',
			'title_fr' => 'Title Fr',
			'title_it' => 'Title It',
			'title_pl' => 'Title Pl',
			'title_ja' => 'Title Ja',
			'title_lt' => 'Title Lt',
			'title_lv' => 'Title Lv',
			'title_cz' => 'Title Cz',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('title_be',$this->title_be,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('title_es',$this->title_es,true);
		$criteria->compare('title_pt',$this->title_pt,true);
		$criteria->compare('title_de',$this->title_de,true);
		$criteria->compare('title_fr',$this->title_fr,true);
		$criteria->compare('title_it',$this->title_it,true);
		$criteria->compare('title_pl',$this->title_pl,true);
		$criteria->compare('title_ja',$this->title_ja,true);
		$criteria->compare('title_lt',$this->title_lt,true);
		$criteria->compare('title_lv',$this->title_lv,true);
		$criteria->compare('title_cz',$this->title_cz,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Regions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
