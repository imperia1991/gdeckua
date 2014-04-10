<?php
$this->pageTitle = CHtml::encode('main', 'Добавить объект');
$title = 'title_' . Yii::app()->getLanguage();
$district = 'district_' . Yii::app()->getLanguage();
$address = 'address_' . Yii::app()->getLanguage();
$description = 'description_' . Yii::app()->getLanguage();
?>
<div class="search-block">
    <?php
    $this->renderPartial('/partials/_search', array(
            'currentPage' => 1,
            'model' => $model,
        ));
    ?>
</div>
<div class="container">
    <div class="content" style="padding-left: 0;width: 100%;">
        <div>
            <?php $form = $this->beginWidget('CActiveForm',
                array(
                    'id' => 'place-model-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                )); ?>

                <div>
                    <?php echo $form->labelEx($model, $title, array()); ?>
                    <?php echo $form->textField($model, $title, array()); ?>
                    <?php echo $form->error($model, $title, array('class' => 'error')); ?>
                </div>
                <div>
                    <?php echo $form->labelEx($model, 'district_id', array()); ?>
                    <?php echo $form->dropDownList($model, 'district_id', $districts); ?>
                    <?php echo $form->error($model, 'district_id', array('class' => 'error')); ?>
                </div>
                <div>
                    <?php echo $form->labelEx($model, $address, array()); ?>
                    <?php echo $form->textField($model, $address, array()); ?>
                    <?php echo $form->error($model, $address, array('class' => 'error')); ?>
                </div>
                <div>
                    <?php echo $form->labelEx($model, $description, array()); ?>
                    <?php echo $form->textField($model, $description, array()); ?>
                    <?php echo $form->error($model, $description, array('class' => 'error')); ?>
                </div>
                <div>
                    <?php echo CHtml::submitButton(Yii::t('main', 'Добавить')); ?>
                </div>

            <?php $this->endWidget(); ?>
        </div>
        <div class="content-ad">
            <img src="/images/rek492x70.png" alt="">
        </div>

        <div style="margin-bottom: 20px;">
            <?php $this->renderPartial('/partials/_find_' . Yii::app()->language); ?>
        </div>
    </div>
</div><!-- .container-->
