<?php

/**
 * Description of ActiveRecord
 *
 * @author Геннадий
 */
class ActiveRecord extends CActiveRecord
{
    public $title;

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('main', 'Название'),
        ];
    }

    public function behaviors()
    {
        return [
            'EScalarBehavior' => 'ext.scalar.EScalarBehavior',
        ];
    }

    protected function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->scenario == 'insert' && $this->hasAttribute('created_at')) {
                $this->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
            } elseif ($this->hasAttribute('created_at')) {
                $this->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $this->created_at);
            }

            return true;
        }

        return false;
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->scenario == 'update' && $this->hasAttribute('updated_at')) {
                $this->updated_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
            }

            if ($this->scenario == 'update' && $this->hasAttribute('last_login')) {
                $this->last_login = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();

        $title = 'title_' . Yii::app()->getLanguage();

        if ($this->hasAttribute($title)) {
            $this->title = $this->{$title};
        }

        if ($this->hasAttribute('last_login')) {
            $this->last_login = Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', strtotime($this->last_login));
        }

        if ($this->hasAttribute('created_at')) {
            $this->created_at = Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', strtotime($this->created_at));
        }

        if ($this->hasAttribute('updated_at')) {
            $this->updated_at = Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', strtotime($this->updated_at));
        }
    }

}

