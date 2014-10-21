<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_PHONE_INVALID = 3;

    public $name;
    public $email;
    private $id;

    public function __construct($email, $password, $username = '')
    {
        parent::__construct($email, $password, $username);

        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = Users::model()->findByAttributes(['email' => $this->email]);

        if (!is_object($user))
            $this->errorCode = self::ERROR_PHONE_INVALID;
        elseif ($user->password !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->errorCode = self::ERROR_NONE;
            $this->id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;

            $this->setState('email', $this->email);
            $this->setState('roles', $user->ruleUser->rule->name);
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->getState('roles');
    }

}