<div class="row">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$model->search(),
        'emptyText' => 'Пользователи не найдены',
        'template'=>"{items}",
        'filter' => $model,
        'columns'=>array(
            'id',
            'name',
            'email',
            array(
                'name' => 'rule',
                'value' => function($data, $row) {
                    echo $data->ruleUser->rule->description . ' (' . $data->ruleUser->rule->name . ')';
                }
            ),
            'logins',
            'last_login',
            'created_at',
            'updated_at',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}{delete}',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
    )); ?>
</div>