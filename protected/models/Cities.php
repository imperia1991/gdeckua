<?php

/**
 * This is the model class for table "cities".
 *
 * The followings are the available columns in table 'cities':
 * @property integer $id
 * @property integer $country_id
 * @property integer $important
 * @property integer $region_id
 * @property string $title_ru
 * @property string $area_ru
 * @property string $region_ru
 * @property string $title_ua
 * @property string $area_ua
 * @property string $region_ua
 * @property string $title_be
 * @property string $area_be
 * @property string $region_be
 * @property string $title_en
 * @property string $area_en
 * @property string $region_en
 * @property string $title_es
 * @property string $area_es
 * @property string $region_es
 * @property string $title_pt
 * @property string $area_pt
 * @property string $region_pt
 * @property string $title_de
 * @property string $area_de
 * @property string $region_de
 * @property string $title_fr
 * @property string $area_fr
 * @property string $region_fr
 * @property string $title_it
 * @property string $area_it
 * @property string $region_it
 * @property string $title_pl
 * @property string $area_pl
 * @property string $region_pl
 * @property string $title_ja
 * @property string $area_ja
 * @property string $region_ja
 * @property string $title_lt
 * @property string $area_lt
 * @property string $region_lt
 * @property string $title_lv
 * @property string $area_lv
 * @property string $region_lv
 * @property string $title_cz
 * @property string $area_cz
 * @property string $region_cz
 */
class Cities extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id, important', 'required'),
			array('id, country_id, important, region_id', 'numerical', 'integerOnly'=>true),
			array('title_ru, area_ru, region_ru, title_ua, area_ua, region_ua, title_be, area_be, region_be, title_en, area_en, region_en, title_es, area_es, region_es, title_pt, area_pt, region_pt, title_de, area_de, region_de, title_fr, area_fr, region_fr, title_it, area_it, region_it, title_pl, area_pl, region_pl, title_ja, area_ja, region_ja, title_lt, area_lt, region_lt, title_lv, area_lv, region_lv, title_cz, area_cz, region_cz', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, country_id, important, region_id, title_ru, area_ru, region_ru, title_ua, area_ua, region_ua, title_be, area_be, region_be, title_en, area_en, region_en, title_es, area_es, region_es, title_pt, area_pt, region_pt, title_de, area_de, region_de, title_fr, area_fr, region_fr, title_it, area_it, region_it, title_pl, area_pl, region_pl, title_ja, area_ja, region_ja, title_lt, area_lt, region_lt, title_lv, area_lv, region_lv, title_cz, area_cz, region_cz', 'safe', 'on'=>'search'),
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
			'important' => 'Important',
			'region_id' => 'Region',
			'title_ru' => 'Title Ru',
			'area_ru' => 'Area Ru',
			'region_ru' => 'Region Ru',
			'title_ua' => 'Title Ua',
			'area_ua' => 'Area Ua',
			'region_ua' => 'Region Ua',
			'title_be' => 'Title Be',
			'area_be' => 'Area Be',
			'region_be' => 'Region Be',
			'title_en' => 'Title En',
			'area_en' => 'Area En',
			'region_en' => 'Region En',
			'title_es' => 'Title Es',
			'area_es' => 'Area Es',
			'region_es' => 'Region Es',
			'title_pt' => 'Title Pt',
			'area_pt' => 'Area Pt',
			'region_pt' => 'Region Pt',
			'title_de' => 'Title De',
			'area_de' => 'Area De',
			'region_de' => 'Region De',
			'title_fr' => 'Title Fr',
			'area_fr' => 'Area Fr',
			'region_fr' => 'Region Fr',
			'title_it' => 'Title It',
			'area_it' => 'Area It',
			'region_it' => 'Region It',
			'title_pl' => 'Title Pl',
			'area_pl' => 'Area Pl',
			'region_pl' => 'Region Pl',
			'title_ja' => 'Title Ja',
			'area_ja' => 'Area Ja',
			'region_ja' => 'Region Ja',
			'title_lt' => 'Title Lt',
			'area_lt' => 'Area Lt',
			'region_lt' => 'Region Lt',
			'title_lv' => 'Title Lv',
			'area_lv' => 'Area Lv',
			'region_lv' => 'Region Lv',
			'title_cz' => 'Title Cz',
			'area_cz' => 'Area Cz',
			'region_cz' => 'Region Cz',
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
		$criteria->compare('important',$this->important);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('area_ru',$this->area_ru,true);
		$criteria->compare('region_ru',$this->region_ru,true);
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('area_ua',$this->area_ua,true);
		$criteria->compare('region_ua',$this->region_ua,true);
		$criteria->compare('title_be',$this->title_be,true);
		$criteria->compare('area_be',$this->area_be,true);
		$criteria->compare('region_be',$this->region_be,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('area_en',$this->area_en,true);
		$criteria->compare('region_en',$this->region_en,true);
		$criteria->compare('title_es',$this->title_es,true);
		$criteria->compare('area_es',$this->area_es,true);
		$criteria->compare('region_es',$this->region_es,true);
		$criteria->compare('title_pt',$this->title_pt,true);
		$criteria->compare('area_pt',$this->area_pt,true);
		$criteria->compare('region_pt',$this->region_pt,true);
		$criteria->compare('title_de',$this->title_de,true);
		$criteria->compare('area_de',$this->area_de,true);
		$criteria->compare('region_de',$this->region_de,true);
		$criteria->compare('title_fr',$this->title_fr,true);
		$criteria->compare('area_fr',$this->area_fr,true);
		$criteria->compare('region_fr',$this->region_fr,true);
		$criteria->compare('title_it',$this->title_it,true);
		$criteria->compare('area_it',$this->area_it,true);
		$criteria->compare('region_it',$this->region_it,true);
		$criteria->compare('title_pl',$this->title_pl,true);
		$criteria->compare('area_pl',$this->area_pl,true);
		$criteria->compare('region_pl',$this->region_pl,true);
		$criteria->compare('title_ja',$this->title_ja,true);
		$criteria->compare('area_ja',$this->area_ja,true);
		$criteria->compare('region_ja',$this->region_ja,true);
		$criteria->compare('title_lt',$this->title_lt,true);
		$criteria->compare('area_lt',$this->area_lt,true);
		$criteria->compare('region_lt',$this->region_lt,true);
		$criteria->compare('title_lv',$this->title_lv,true);
		$criteria->compare('area_lv',$this->area_lv,true);
		$criteria->compare('region_lv',$this->region_lv,true);
		$criteria->compare('title_cz',$this->title_cz,true);
		$criteria->compare('area_cz',$this->area_cz,true);
		$criteria->compare('region_cz',$this->region_cz,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
