<?php


/**
 * Class CCaptchaActionExtension
 */
class CCaptchaActionExtension extends CCaptchaAction {
    /**
     * @return string
     */
    protected function getSessionKey()
    {
        return self::SESSION_VAR_PREFIX . Yii::app()->getId() . '.' . $this->getId();
    }


} 