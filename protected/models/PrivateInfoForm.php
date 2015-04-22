<?php

class PrivateInfoForm extends CFormModel
{
	public $full_name;
	public $phone;
	public $phone_add;
	public $site;
	public $photo;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
			['full_name, phone', 'required', 'message' => Yii::t('error', 'Необходимо заполнить поле «{attribute}».')],
			['site', 'url', 'defaultScheme' => 'http', 'allowEmpty' => true, 'validateIDN' => true],
			['full_name, photo', 'length', 'max' => 255],
			['phone, phone_add', 'length', 'max' => 15],
		];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'site'      => Yii::t('main', 'Сайт'),
			'full_name' => Yii::t('main', 'ФИО'),
			'phone'     => Yii::t('main', 'Мобильный телефон'),
			'phone_add' => Yii::t('main', 'Дополнительный телефон'),
		];
	}

	/**
	 * @return bool
	 */
	public function save()
	{
		if ($this->validate()) {
			$modelUser = Users::model()->findByPk(Yii::app()->user->id);
			$modelUser->setAttributes($this->getAttributes());
			$modelUser->save(false);

			return true;
		}

		return false;
	}
}