<?php
/**
 * @var $relModels ActiveRecord[]
 */
use common\components\model\ActiveRecord;
use tolik505\relatedForm\RelatedFormWidget;

$formName = $relModels[0]->formName();
?>
<div class="form-group template-builder">
    <h4><?= $formName ?></h4>
    <?php
    RelatedFormWidget::begin([
        'widgetContainer' => 'related_form_wrapper_' . $formName, // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.template-builder', // required: css class selector
        'widgetItem' => '.content-append', // required: css class
        //'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.btn-template-delete', // css class
        'model' => $relModels[0],
        'formId' => 'main-form',
        'formFields' => ['dummy'],
    ]); ?>
    <div class="template-list related-model-panel">
        <div class="template-builder"><!-- widgetContainer -->
            <?= $this->render('_related_form_fields', ['form' => $form, 'relModels' => $relModels]) ?>
        </div>
        <div class="button-add">
            <button type="button" data-className="<?= $relModels[0]->className() ?>" class="btn btn-success btn-template-builder add-item">
                <i class="glyphicon glyphicon-plus"></i> Добавить
            </button>
        </div>
    </div>
    <?php
    RelatedFormWidget::end();
    ?>
</div>
