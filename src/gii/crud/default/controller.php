<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \Bridge\Core\Gii\CRUD\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$contexts = $generator->getContexts();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use <?= ltrim($generator->baseControllerClass, '\\') ?>;
<?php if (!empty($contexts) || $generator->generatePositionColumn || $generator->generateToggleColumn) : ?>
use yii\helpers\ArrayHelper;
<?php endif; ?>
<?php if (!empty($contexts)): ?>
use yii2tech\admin\behaviors\ContextModelControlBehavior;
<?php endif ?><?php if ($generator->generatePositionColumn) : ?>
use yii2tech\admin\actions\Position;
<?php endif; ?><?php if ($generator->shouldSoftDelete()) : ?>
use yii2tech\admin\actions\SoftDelete;
use yii2tech\admin\actions\Restore;
<?php endif; ?><?php if ($generator->generateToggleColumn) : ?>
use dosamigos\grid\actions\ToggleAction;
<?php endif; ?>

/**
 * <?= $controllerClass ?> implements the CRUD actions for [[<?= $generator->modelClass ?>]] model.
 * @see <?= $generator->modelClass . "\n" ?>
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    /**
     * @inheritdoc
     */
    public $modelClass = '<?= $generator->modelClass ?>';
<?php if (!empty($generator->searchModelClass)): ?>
    /**
     * @inheritdoc
     */
    public $searchModelClass = '<?= $generator->searchModelClass ?>';
<?php endif ?>

<?php if ($generator->hasScenario($generator->createScenario)) : ?>
    /**
    * @inheritdoc
    */
    public $createScenario = '<?= $generator->createScenario ?>';
<?php endif; ?>

<?php if ($generator->hasScenario($generator->updateScenario)) : ?>
    /**
    * @inheritdoc
    */
    public $updateScenario = '<?= $generator->updateScenario ?>';
<?php endif; ?>

<?php if (!empty($contexts)): ?>
    /**
     * Contexts configuration
     * @see ContextModelControlBehavior::contexts
     */
    public $contexts = [
    <?php foreach ($contexts as $name => $class) : ?>
        // Specify actual contexts :
        '<?= $name ?>' => [
        'class' => '<?= $class ?>',
        'attribute' => '<?= lcfirst(StringHelper::basename($class)) ?>Id',
        'controller' => '<?= $name ?>',
        'required' => false,
        ],
        ];
    <?php endforeach ?>


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'model' => [
                    'class' => ContextModelControlBehavior::class,
                    'contexts' => $this->contexts
                ]
            ]
        );
    }
<?php endif ?>

<?php if ($generator->generateToggleColumn || $generator->generatePositionColumn) : ?>
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
<?php if ($generator->generateToggleColumn) : ?>
                'toggle' => [
                    'class' => ToggleAction::class,
                    'modelClass' => '<?= $generator->modelClass ?>',
                    'onValue' => 1,
                    'offValue' => 0
                ],
<?php endif; ?><?php if ($generator->generatePositionColumn) : ?>
                'position' => [
                    'class' => Position::class,
                ],
<?php endif; ?><?php if ($generator->shouldSoftDelete()) : ?>
                'delete' => [
                    'class' => SoftDelete::class,
                ],
                'restore' => [
                    'class' => Restore::class,
                ],
<?php endif; ?>
            ]
        );
    }
<?php endif; ?>
}
