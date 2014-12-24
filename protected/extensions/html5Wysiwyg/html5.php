<?php
/**
 * Html5 wysiwyg widget implements bootstrap-wysihtml5
 */
/**
 *   Html5 wysiwyg widget implements bootstrap-wysihtml5. You can use CActiveForm or CHtml.
 *    Example for CActiveForm.
 *    <code>
 *       <?php
 *        $this->widget('ext.html5Wysiwyg.html5',array(
 *       'model'=>$model,
 *       'model_value'=>'username',
 *       'form'=>$form,
 *       )); ?>
 *    </code>
 */
class html5 extends CWidget
{

    public $model;
    public $model_value;
    public $bootstrap = false;
    public $htmlOptions = array();
    public $errorHtmlOptions = array();
    public $labelHtmlOptions = array();
    public $class = null;
    public $id = null;
    public $name = 'html5';
    public $label = true;
    public $error = false;
    public $locale = null;
    public $form = null;
    public $buttons = array();

    /**
     * Scripts registration
     */
    public function init()
    {
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');

        $assetUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.html5Wysiwyg'));
        Yii::app()->clientScript->registerScriptFile($assetUrl . '/js/wysihtml5-0.3.0.min.js');
        Yii::app()->clientScript->registerCssFile($assetUrl . '/css/wysiwyg-color.css');
        if ($this->bootstrap) {
            Yii::app()->clientScript->registerCssFile($assetUrl . '/css/bootstrap.min.css');
            Yii::app()->clientScript->registerCssFile($assetUrl . '/css/bootstrap-responsive.min.css');
            Yii::app()->clientScript->registerScriptFile($assetUrl . '/js/bootstrap.min.js');
        }
        if ($this->locale != null)
            Yii::app()->clientScript->registerScriptFile($assetUrl . '/js/locales/bootstrap-wysihtml5.' . $this->locale . '.js');
        Yii::app()->clientScript->registerScriptFile($assetUrl . '/js/bootstrap-wysihtml5.js');
        Yii::app()->clientScript->registerCssFile($assetUrl . '/css/bootstrap-wysihtml5.css');
        $this->generateArea();
    }

    /**
     * Generates wyswig textArea
     */
    private function generateArea()
    {
        $this->mergeButtons();
        $this->addClass();
        $this->addId();
        if ($this->form == null) {
            if ($this->label)
                echo CHtml::activeLabel($this->model, $this->model_value, $this->labelHtmlOptions);
            echo CHtml::activeTextArea($this->model, $this->model_value, $this->htmlOptions);
        } else {
            if ($this->label)
                echo $this->form->label($this->model, $this->model_value, $this->labelHtmlOptions);
            echo $this->form->textArea($this->model, $this->model_value, $this->htmlOptions);
            if ($this->error)
                echo $this->form->error($this->model, $this->model_value, $this->errorHtmlOptions);
        }
        $this->implementWysiwyg();
    }

    private function addClass()
    {
        if (empty($this->htmlOptions)) {
            $this->htmlOptions = array(
                'class' => ($this->class == null ? 'html5Wyswig' : $this->class),
            );
        } else {
            if (array_key_exists('class', $this->htmlOptions)) {
                $this->htmlOptions['class'] = $this->htmlOptions['class'] . ($this->class == null ? 'html5Wyswig' : $this->class);
            } else {
                $this->htmlOptions['class'] = ($this->class == null ? 'html5Wyswig' : $this->class);
            }
        }
    }

    private function addId()
    {
        if (empty($this->htmlOptions) && $this->id != null) {
            $this->htmlOptions = array(
                'id' => $this->id,
            );
        } else {
            if (key_exists('id', $this->htmlOptions) && $this->id != null) {
                $this->htmlOptions['id'] = $this->id;
            } elseif ($this->id != null) {
                $this->htmlOptions['id'] = $this->id;
            }
        }
    }

    private function implementWysiwyg()
    {
        $this->render('html5', array(
            'name' => $this->name,
            'identifier' => ($this->id == null ? '.' . ($this->class == null ? 'html5Wyswig' : $this->class) : '#' . $this->id),
            'buttons' => $this->buttons,
            'locale' => $this->locale,
        ));
    }

    private function mergeButtons()
    {
        $this->buttons = CMap::mergeArray(
            array(
                "font-styles" => true,
                "emphasis" => true,
                "lists" => true,
                "html" => false,
                "link" => true,
                "image" => true,
                "color" => false,
                "stylesheets" => false,
            ),
            $this->buttons
        );
    }

    public function boolToString($in)
    {
        if (is_bool($in)) {
            if ($in)
                return "true";
            else
                return "false";
        } else
            return $in;
    }

    public function run()
    {

    }
}
