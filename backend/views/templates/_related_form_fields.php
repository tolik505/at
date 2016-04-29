<?php
/**
 * @var $relModels ActiveRecord[]
 */
use backend\components\FormBuilder;
use common\components\model\ActiveRecord;
use common\components\model\Translateable;
use yii\helpers\Html;

$isAjax = false;
if (!isset($form)) {
    $form = FormBuilder::begin([
        'id' => 'dummy-form'
    ]);
    $isAjax = true;
}
foreach ($relModels as $index => $elModel) { ?>
    <div class="form-group content-append filled item-<?= $index ?>" data-index="<?= $index ?>"><!-- widgetBody -->
        <button type="button" class="btn btn-info btn-template-mover ui-sortable-handle"><i class="glyphicon glyphicon-move"></i></button>
        <button type="button" class="btn btn-danger btn-template-delete"><i class="glyphicon glyphicon-trash"></i></button>
        <?php
        // necessary for update action.
        if (!$elModel->isNewRecord) {
            echo Html::activeHiddenInput($elModel, "[{$index}]id");
        }
        foreach ($elModel->getFormConfig($index) as $attr => $el) { ?>
                <?= $form->renderField($elModel,  "[{$index}]$attr", $el);  ?>
                <?php if (isset($elModel->errors["[{$index}]$attr"][0])) { ?>
                    <div class="help-block has-error"><?= $elModel->errors["[{$index}]$attr"][0] ?></div>
                <?php } ?>
                <?= $form->renderUploadedFile($elModel,  "[{$index}]$attr", $el);
                if ($elModel instanceof Translateable && $elModel->isTranslateAttribute($attr)) {
                    foreach ($elModel->getTranslationModels() as $languageModel) {
                        echo $form->renderField($languageModel, "[{$index}][" . $languageModel->language . ']' . $attr, $el);
                        if (isset($languageModel->errors["[{$index}][{$languageModel->language}]$attr"][0])) { ?>
                            <div class="help-block has-error"><?= $languageModel->errors["[{$index}][{$languageModel->language}]$attr"][0] ?></div>
                        <?php }
                        echo $form->renderUploadedFile($languageModel, $attr, $el, $languageModel->language);
                    }
                }
        } ?>
    </div>
<?php }
if ($isAjax) {
    FormBuilder::end();
}
