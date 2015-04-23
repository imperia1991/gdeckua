<?php

class ChangeEmailForm extends AbstractForm
{
	public $email;
	public $newEmail;
	public $newEmailRepeat;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
			[
				'email, newEmail, newEmailRepeat',
				'required',
				'message' => Yii::t('error', 'Необходимо заполнить поле «{attribute}».')
			],
			[
				'email, newEmail, newEmailRepeat',
				'email',
				'message' => Yii::t('main', 'Значение не является правильным E-Mail адресом')
			],
			['newEmail', 'validateInBase'],
			['newEmailRepeat', 'compare', 'compareAttribute' => 'newEmail'],
			['newEmailRepeat', 'validateInBase'],
		];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'email'          => Yii::t('main', 'E-Mail'),
			'newEmail'       => Yii::t('main', 'E-Mail'),
			'newEmailRepeat' => Yii::t('main', 'E-Mail'),
		];
	}

	/**
	 * @param $attribute
	 * @param $params
	 */
	public function validateInBase($attribute, $params)
	{
		$email = Users::model()->findByAttributes([
			'email' => $this->email,
		]);

		$newEmail = Users::model()->findByAttributes([
			'email' => $this->newEmail,
		]);

		if ( !is_object($email)) {
			$this->addError('email', Yii::t('error', 'Данный E-Mail не зарегистрирован на сайте'));
		}

		if (is_object($newEmail)) {
			$this->addError('newEmail', Yii::t('error', 'Данный E-Mail уже зарегистрирован на сайте. Введите другой'));
		}
	}

	/**
	 * @return bool
	 */
	public function save()
	{
		if ($this->validate()) {
			$modelUser = Users::model()->findByPk(Yii::app()->user->id);
			$modelUser->setAttributes($this->getAttributes());
			$modelUser->email = $this->newEmail;

			$modelUser->save(false);

			return true;
		}

		return false;
	}
}