<?php

Yii::import('zii.widgets.CPortlet');

class SearchBlock extends CPortlet
{
    public $model;

    protected function renderContent()
    {
        echo CHtml::beginForm(array('/#'), 'get', array('style' => 'inline')) .
        CHtml::textField('q', $this->model->search, array('placeholder' => Yii::t('main', 'Введите название, например "Кафе Крещатик"'))) .
        CHtml::submitButton(Yii::t('main', 'Найти'), array('name' => '')) .
        CHtml::endForm('');
    }

}
