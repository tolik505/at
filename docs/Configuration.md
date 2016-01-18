Конфигуратор
===================================

Позволяет создавать отдельные формы для конфига, те теперь не надо создавать отдельную таблицу на каждую страницу, 
достаточно сделать модель, и подключить ее к контроллеру.

Создание
--------

Для backend

Берем за пример некую страницу

```php
class Page extends \backend\modules\configuration\components\ConfigurationModel 
{
    public static $title = 'Some page'; // Заголовок страницы

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys() // Набор ключей
    {
        return [
            'label',
            'announce',
            'content',
        ];
    }
    
    /**
     * @return array
     */
     public function getFormTypes()
     {
        return [
            'label' => Configuration::TYPE_STRING,
            'announce' => Configuration::TYPE_HTML,
            'content' => Configuration::TYPE_HTML,
        ];
     }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle() // Заголовок формы
    {
        return self::$title;
    }

    /**
     * @return array
     */
    public static function getUpdateUrl() // Ссылка на обновление, она-же главная
    {
        return ['/configuration/page/update'];
    }
}
```

Контроллер реализуется аналогично стандартному backend, 
но только наследует ```\backend\modules\configuration\components\ConfigurationController```

```php
class PageController extends \backend\modules\configuration\components\ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return Page::className();
    }
}
```

Для frontend

Просто используем Configuration как обычно
