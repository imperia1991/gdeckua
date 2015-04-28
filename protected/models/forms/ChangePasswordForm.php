<?php

class ChangePasswordForm extends AbstractForm
{
	public $password;
	public $newPassword;
	public $newPasswordRepeat;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
			[
				'password, newPassword, newPasswordRepeat',
				'required',
				'message' => Yii::t('error', 'Необходимо заполнить поле «{attribute}».')
			],
			['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
			[
				'newPassword',
				'length',
				'min'     => 6,
				'max'     => 50,
				'message' => Yii::t('main', 'Пароль должен быть минимум 6 символов')
			],
			['password', 'validateInBase']
		];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'password'          => Yii::t('main', 'Ваш текущий пароль'),
			'newPassword'       => Yii::t('main', 'Ваш новый пароль'),
			'newPasswordRepeat' => Yii::t('main', 'Повторите новый пароль'),
		];
	}

	/**
	 * @param $attribute
	 * @param $params
	 */
	public function validateInBase($attribute, $params)
	{
		$password = Users::model()->findByAttributes([
			'password' => md5($this->password),
			'id' => Yii::app()->getUser()->id
		]);

		if ( !is_object($password)) {
			$this->addError('password', Yii::t('error', 'Вы ввели не правильный текущий пароль'));
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
			$modelUser->password = md5($this->newPassword);

			$modelUser->save(false);

			return true;
		}

		return false;
	}
}