Создание табов в редактировании модели
===================================

Создаются при добавлении ключа "form-set" и вложенных массивов самих табов с ключами-названиями.

```php
public function getFormConfig()
{
    return [
        'form-set' => [
            'Основные' => [
                'separator' => [
                    'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                    'items' => static::$separator,
                    'options' => [
                        'prompt' => 'Выберите',
                    ],
                ],
                'content' => [
                    'type' => ActiveFormBuilder::INPUT_TEXTAREA,
                ],
            ],
            'Характеристики' => [
                [
                    'class' => RelatedFormWidget::className(),
                    'relation' => 'anotherTests',
                    'uploadBehavior' => [
                        [
                            'attribute' => 'file_id',
                            'extensions' => ['png', 'gif', 'jpg', 'jpeg', 'ico', 'svg'],
                            'required' => false
                        ]
                    ],
                ]
            ],
        ]
    ];
}
```
