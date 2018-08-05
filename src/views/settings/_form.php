<?php

use Bridge\Core\Models\SettingsGroup;
use yii\bootstrap\Html;
use Bridge\Core\Widgets\ActiveForm;
use Bridge\Core\Models\Settings;

/* @var $this yii\web\View */
/* @var $model Settings */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-lg-5">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'group_id')->relationalDropDown(SettingsGroup::class) ?>

        <?php if ($model->type == Settings::TYPE_TEXT) : ?>
            <?= $form->field($model, 'value')->richTextArea(['options' => ['rows' => 6]]) ?>
        <?php elseif ($model->type == Settings::TYPE_IMAGE) : ?>
            <?= $form->field($model, 'value')->imageUpload() ?>
        <?php elseif ($model->type == Settings::TYPE_SWITCH): ?>
            <?= $form->field($model, 'value')->switchInput() ?>
        <?php elseif ($model->type == Settings::TYPE_MAP): ?>
            <?= $form->field($model, 'value')->map() ?>
        <?php else: ?>
            <?= $form->field($model, 'value')->textInput() ?>
        <?php endif; ?>
    </div>
    <div class="col-md-4">

        <button type="button" class="btn btn-default"
                data-toggle="collapse" data-target="#advancedSettings" aria-expanded="false"
                aria-controls="advancedSettings">
            <?= Yii::t('bridge', 'Advanced settings') ?>
        </button>

        <div id="advancedSettings" class="collapse">
            <br/>

            <div class="alert alert-danger">
                <b><?= Yii::t('bridge', 'Warning') ?>!</b> <?= Yii::t('bridge', 'Don\'t edit, if you are not familiar what those do!') ?>
            </div>

            <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->select2(Settings::getTypes()) ?>

            <?= $form->field($model, 'type_settings')->textarea(['rows' => 6]) ?>
        </div>
    </div>
</div>
<div class="form-group clearfix">
    <?= Html::submitButton(\Yii::t('bridge', $model->isNewRecord ?  'Create' : 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
