Related Form Widget
===================================

Позволяет редактировать основную и связанные таблицы в одном месте. Для этого, на все таблицы, как обычно, создаются
CRUD и реляции. В связанных моделях можно использовать любые виджеты, включая загрузку картинок и файлов.
В getFormConfig() основой модели добавляется код

```php
[
    'class' => tolik505\relatedForm\RelatedFormWidget::className(),
    'relation' => 'tests', //имя реляции (всегда с маленькой буквы, от названия метода реляции убрать get)
    'uploadBehavior' => [ //если в связанных модлях требуется загружать файлы
        [
            'attribute' => 'file_id',
            'extensions' => ['png', 'gif', 'jpg', 'jpeg', 'ico', 'svg'],
            'required' => true
        ]
    ],
]
```
еще пример [здесь](docs/AddTabs.md).
