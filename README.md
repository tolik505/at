Melon.ng Yii 2 Advanced Application Template
===================================

1. [Установка](#markdown-header-install)
2. [Кастомный CRUD](#markdown-header-crud)
3. [Полезности](#markdown-header-useful)
4. [SEO](#markdown-header-seo)

### Install

1.Клонируем, устанавливаем новую ветку на репозиторий вашего проекта

```
git clone git@bitbucket.org:vintageua/melon.ng.git project-name
cd project-name
git remote remove origin
git remote add origin git@bitbucket.org:vintageua/NEW_PROJECT.git
git push origin master
//для получения обновлений движка
git remote add upstream git@bitbucket.org:vintageua/melon.ng.git
```

2.Инициализация приложения и установка всех зависимостей

```
./init
composer install
```

3.Поднимаем миграции

```
./yii migrate
```

Для добавления новых директорий миграций нужно в `console/config/params.php`

```php
"yii.migrations"=> [
	// Добавить сюда новую директорию
]
```

### CRUD

1. [Backend](docs/Backend_crud.md)

2. Frontend
Особых наработок нету, все нужно делать вручную.
Все фронтенд-контроллеры наследуeм от `frontend/components/FrontendController`, пока в нем генерация 
canonical url для страниц, но в будущем будут еще общие штуки добавляться.



### Useful

1.[Загрузка и отображение файлов/изображений](docs/File_upload.md)


2.[Работа с данными при ajax-запросах](docs/Ajax_features.md)

3.Работа с переводами:

Для добавления нового языка, вам нужно добавить его в админке Translations->Language и в common/main.php добавить его:
```php
'i18n' => [
            'class' => 'Zelenin\yii\modules\I18n\components\I18N',
            'languages' => [
                //тут добавляем code нужного языка
                'ru',
                'en'
            ]
        ],
```
для того что бы перевод для данного языка появился в Translations.

При использовании `Yii::t('app', 'your_key')`, ключ перевода будет автоматически добавлен в БД в таблицу для переводов.
Заполнить нужные переводы для ключа можна в админке, раздел Translations.

4.Хранение полей в Configuration.

В админке, раздел Configuration можна хранить данные вида key => value. Это часто удобно для таких вещей, как

* номер телефона на сайте

* email для рассылок

* изобрежение-подложка на главной и т.д.

value может быть следующих типов:

* String

* Integer

* Text

* Html text

* Boolean

* Double

* File

Для получения значения, сохраненного в конфигурации, во frontend запрашиваем следующим образом:

```php
echo \Yii::$app->config->get('key');
```

Для работы вышеприведенного кода, в frontend/main.php добавлен компонент, проверьте что он присутствует:

```php
'config' => [
            'class' => '\common\components\ConfigurationComponent',
        ],
```


5.[Configuration form builder](docs/Configuration.md)



### SEO

[SEO](docs/SEO.md)
