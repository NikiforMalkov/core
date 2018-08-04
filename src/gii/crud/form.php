<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator \Bridge\Core\Gii\CRUD\Generator */

echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'searchModelClass');
echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'generateCustomFields')->checkbox();
echo $form->field($generator, 'generatePositionColumn')->checkbox();
echo $form->field($generator, 'generateToggleColumn')->checkbox();
echo $form->field($generator, 'generateSoftDelete')->checkbox();
echo $form->field($generator, 'contextClass');
echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'createScenario');
echo $form->field($generator, 'updateScenario');
echo $form->field($generator, 'indexWidgetType')->dropDownList([
    'grid' => 'GridView',
    'list' => 'ListView',
]);
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
