<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property integer $logins
 * @property string $last_login
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Promo[] $promos
 * @property ServiceReviews[] $serviceReviews
 * @property Services[] $services
 */
class Users extends ActiveRecord
{
	const SCENARIO_LOGIN    = 'login';
	const SCENARIO_REGISTER = 'register';
	const SCENARIO_FORGOT   = 'forgot';
	const SCENARIO_ADMIN    = 'admin';

	const ROLE_USER    = 'user';
	const ROLE_ADMIN   = 'admin';
	const ROLE_MUSER   = 'muser';
	const ROLE_CHASHKA = 'chashka';

	public $errorMessage;
	// для капчи
	public $verifyCode;
	// для поля "повтор пароля"
	public $passwordRepeat;
	// для поля "Пользовательское соглашение"
	public $agree;
	public $rule;
	public $ruleId;

	private $_identity;
	private $newPassword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
//			array('name, email, password, created_at', 'required'),
			['email, password', 'authenticate', 'on' => self::SCENARIO_LOGIN],
			[
				'email, password',
				'required',
				'on'      => [self::SCENARIO_LOGIN, self::SCENARIO_REGISTER],
				'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')
			],
			['email', 'email', 'message' => Yii::t('main', 'Значение не является правильным E-Mail адресом')],
			['email', 'unique', 'on' => self::SCENARIO_REGISTER],
			[
				'email',
				'required',
				'on'      => [self::SCENARIO_FORGOT, self::SCENARIO_REGISTER],
				'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')
			],
			['email', 'forgot', 'on' => self::SCENARIO_FORGOT],
			[
				'password',
				'length',
				'min'     => 6,
				'max'     => 50,
				'on'      => self::SCENARIO_REGISTER,
				'message' => Yii::t('main', 'Пароль должен быть минимум 6 символов')
			],
			['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'on' => self::SCENARIO_REGISTER],
			['verifyCode', 'captcha', 'on' => self::SCENARIO_REGISTER],
			['name, passwordRepeat', 'required', 'on' => self::SCENARIO_REGISTER],
//            ['agree', 'mustCheck', 'on' => self::SCENARIO_REGISTER],
			['logins', 'numerical', 'integerOnly' => true],
			['name', 'length', 'max' => 12],
			[
				'name',
				'match',
				'pattern' => '/^[A-Za-zА-Яа-яёЁєЄїЇіІ]+$/u',
				'message' => Yii::t('main', 'Должны быть только буквы')
			],
			['phone, password', 'length', 'max' => 50],
			['email', 'length', 'max' => 30],
			[
				'name, email',
				'required',
				'on'      => self::SCENARIO_ADMIN,
				'message' => Yii::t('main', 'Необходимо заполнить поле «{attribute}»')
			],
			['last_login, updated_at', 'safe'],
			// The following rule is used by search().
			['id, name, phone, email, password, logins, last_login, created_at, updated_at', 'safe', 'on' => 'search'],
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
			'ruleUser'       => [self::HAS_ONE, 'RulesUsers', 'user_id'],
			'promos'         => [self::HAS_MANY, 'Promo', 'user_id'],
			'serviceReviews' => [self::HAS_MANY, 'ServiceReviews', 'user_id'],
			'services'       => [self::HAS_MANY, 'Services', 'user_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id'             => Yii::t('main', '№'),
			'name'           => Yii::t('main', 'Имя'),
			'phone'          => Yii::t('main', 'Мобильный телефон'),
			'email'          => Yii::t('main', 'E-mail'),
			'password'       => Yii::t('main', 'Пароль'),
			'logins'         => Yii::t('main', 'Количество заходов'),
			'last_login'     => Yii::t('main', 'Последняя авторизация'),
			'created_at'     => Yii::t('main', 'Дата регистрации'),
			'updated_at'     => Yii::t('main', 'Дата последнего обновления данных'),
			'passwordRepeat' => Yii::t('main', 'Повторите пароль'),
			'rule'           => Yii::t('main', 'Роль'),
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
		if ($this->name) {
			$criteria->compare('name', $this->name, true);
		}
		if ($this->phone) {
			$criteria->compare('phone', $this->phone, true);
		}
		if ($this->email) {
			$criteria->compare('email', $this->email, true);
		}
		if ($this->logins) {
			$criteria->compare('logins', $this->logins);
		}
		if ($this->last_login) {
			$criteria->compare('last_login', $this->last_login);
		}
		if ($this->created_at) {
			$criteria->compare('created_at', $this->created_at);
		}
		if ($this->updated_at) {
			$criteria->compare('updated_at', $this->updated_at);
		}
		if ($this->rule) {
			$criteria->compare('userRule.name', $this->rule, true);
		}

		$criteria->addCondition('userRule.name != "admin"');

		$criteria->with = [
			'ruleUser.rule' => [
				'alias'    => 'userRule',
				'joinType' => 'JOIN',
			],
		];

		$sort             = new CSort();
		$sort->attributes = [
			'id',
			'name',
			'phone',
			'email',
			'logins',
			'last_login',
			'created_at',
			'updated_at',
			'rule' => [
				'asc'  => 'userRule.name',
				'desc' => 'userRule.name DESC',
			],
		];

		$sort->defaultOrder = [
			'created_at' => CSort::SORT_DESC,
		];

		return new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'pagination' => ['pageSize' => 20],
			'sort'       => $sort,
		]);
	}

	/**
	 * @param $attribute
	 * @param $params
	 */
	public function authenticate($attribute, $params)
	{
		if ( !$this->hasErrors()) {
			if ( !$this->email || !$this->password) {
				$this->addError('errorMessage', Yii::t('main', 'Вы ввели неверный логин или пароль'));
			} else {
				$this->_identity = new UserIdentity($this->email, $this->password);

				if ( !$this->_identity->authenticate()) {
					$this->addError('errorMessage', Yii::t('main', 'Вы ввели неверный логин или пароль'));
				}
			}
		}
	}

	/**
	 * @return bool
	 */
	public function login()
	{
		if ($this->_identity === null) {
			$this->_identity = new UserIdentity($this->email, $this->password);
			$this->_identity->authenticate();
		}

		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
			$duration = 3600 * 24 * 30; // 30 days
			Yii::app()->user->login($this->_identity, $duration);

			$user             = Users::model()->findByAttributes(['email' => $this->email]);
			$user->logins     = $user->logins + 1;
			$user->last_login = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
			$user->update();

			return true;
		} else {
			return false;
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return Users the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @param $attribute
	 * @param $params
	 */
	public function forgot($attribute, $params)
	{
		$model = $this->findByAttributes([
			'email' => $this->email
		]);

		if ( !$this->hasErrors()) {
			if ( !is_object($model)) {
				$this->addError('email', Yii::t('main', 'Пользователь с таким E-Mail не зарегистрирован на сайте'));
			}
		}
	}

	/**
	 * @param Users $model
	 */
	public function setPassword(Users $model)
	{
		$this->newPassword = StringHelper::getPassword();

		$model->password = md5($this->newPassword);
		$model->save();
	}

	/**
	 * @param $attribute
	 * @param $params
	 */
	public function mustCheck($attribute, $params)
	{
		if ( !$this->agree) {
			$this->addError('agree', Yii::t('main', 'Вы должны согласиться с условиями пользовательского соглашения'));
		}
	}

	/**
	 * @return bool
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->hasAttribute('password') && $this->isNewRecord) {
				$this->password = md5($this->password);
			}

			return true;
		};

		return false;
	}


	/**
	 *
	 */
	protected function afterSave()
	{
		parent::afterSave();

		if ($this->scenario == self::SCENARIO_REGISTER) {
			$role                    = Rules::model()->findByAttributes([
				'name' => self::ROLE_MUSER
			]);
			$this->ruleUser          = new RulesUsers();
			$this->ruleUser->user_id = $this->id;
			$this->ruleUser->rule_id = $role->id;

			$this->ruleUser->save();
		}

		if ($this->scenario == self::SCENARIO_ADMIN) {
			$this->ruleUser->rule_id = $this->ruleId;
			$this->ruleUser->save();
		}
	}
}
