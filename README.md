Melon Yii 2 Advanced Application Template
===================================

превоначальная настройка
------------------------

репозиторий `https://bitbucket.org/vintageua/melon.ng/branch/testing`
находится в ветке `testing`

склонить, удалить origin, добавить origin нового репозитория, залить ветку в мастер нового ориджина, сменить ветку на мастер

```
git clone git@bitbucket.org:vintageua/melon.ng.git project-name
cd project-name
git merge --no-ff --no-edit origin/testing
git remote remove origin
git remote add origin git@bitbucket.org:vintageua/NEW_PROJECT.git
git push origin master
```

первой миграцией выполнить:

```
./yii migrate --migrationPath=vendor/yiisoft/yii2/rbac/migrations
```

фронт
-----

фронт используется как есть, все нужно делать вручную

бекенд
------

на беке есть готовый круд, который генерируется в специльно созданых gii темплейтах
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANZ2h2d054LXZ0SUU/view?usp=drivesdk

миграции
--------

для начала нужно создать миграцию

```
./yii migrate/create
or
./yii migrate/create table_name # prefer
or
./yii migrate/create table_name --lang # for language models
```

лучше создавать миграции сразу указывая имя таблицы

миграции создаются с преустановленым кодом, который нужно немного модифицировать

все миграции собираются в `console/migrations`

внести все необходимые поля в миграции и выполнить ее

```
./yii migrate
```

генерация модели
----------------

https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANSU8zNDctclFCbFU/view?usp=drivesdk
выбираем имя таблицы, выбираем имя модели. модели создадутся в common/models и common/models/base
(не забываем про мультиязыковую таблицу, если она есть - ее нужно отдельно создать)
модель в common/models/base можно менять как угодно, и она дальше не будет перегенериваться в gii
модель в common/models будет перегенериваться - там хранится общая информация, которая не зависит от бизнес логики, ее трогать не нужно

код для мультиязыка будет добавлен автоматически (на основании названий таблиц, поэтому название таблицы переводов не нужно менять)

так же будут автоматически добавлены мультиязычные поля

модуль
------

дальше мы создаем модуль
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANLXl4YnpnZFo4THc/view?usp=drivesdk
тут ничего необычного, просто структура генерируемых файлов немного изменена

добавляем модуль в конфигурацию бекенда и делаем круд в gii

круд
----

https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANTjlMcHZUMDZ0cVE/view?usp=drivesdk
вписываем путь к моделе, которая лежив в common/models
вписываем название модели, которая должна создаться на бекенде (модель для поиска создастся автоматически)
списываем название контроллера в бекенде

теперь круд для таблицы готов
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANX1otTVhKSzJldnM/view?usp=drivesdk
можно создать запись и посмотреть ее
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANNDIwU1ZOVnF2aWs/view?usp=drivesdk
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANVmRacm1Vb3BtSU0/view?usp=drivesdk

конфигурация отображения index, view и формы хранится в моделе в бекенде, в соответствующих методах


загрузка файлов
---------------

поле в табице

```
'file_id' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL COMMENT "File"'
```

поле в форме:

```
'file_id' => [
    'type' => ActiveFormBuilder::INPUT_FILE,
],
```

бехевиор в моделе в common/models/base

```
'file' => [
    'class' => \metalguardian\fileProcessor\behaviors\UploadBehavior::className(),
    'attribute' => 'file_id',
    //'required' => false,
],
```

поле file_id необходимо убрать из рулов модели (для полей с именем image_id, file_id - gii делает это автоматически)

ручная загрузка
---------------

если необходимо какие то сложные операции с файлами, или необходима мультизагрузка (имя поля должно быть 'file[]'), можно загружать так:

для примера мультизагрузка:

```
$this->images = UploadedFile::getInstances($this, 'images');

foreach ($this->images as $image) {
    $model = new ImageModel();
    $model->image_id = FPM::transfer()->saveUploadedFile($image);
    $model->save();
}
```

отображение на фронте
---------------------

в common конфиге в модуле fileProcessor добавляются размеры изображений для ресайза

```
'modules' => [
    'fileProcessor' => [
        'class' => '\metalguardian\fileProcessor\Module',
        'imageSections' => [

            'profile' => [
                'view' => [
                    'action' => \metalguardian\fileProcessor\helpers\FPM::ACTION_ADAPTIVE_THUMBNAIL,
                    'width' => 120,
                    'height' => 120,
                ],
            ],
        ],
    ],
],
```

во вьюхах вызывать так:

```
<?= \metalguardian\fileProcessor\helpers\FPM::image($model->image_id, 'profile', 'view') ?>
```

Работа с данными при ajax-запросах
---------------------

Часто, при клике по кнопке, ссылке нужно получить с сервера данные(форму, попап, заменить блок на странице) bkb без
перезагрузки страницы. Для этого используем ajax-обработчики, а в success событии ajax-запроса вызываем указанную ниже
функцию.

```
function parseResponse(response) {
	if (response.replaces instanceof Array) {
		for (var i = 0, ilen = response.replaces.length; i < ilen; i++) {
			$(response.replaces[i].what).replaceWith(response.replaces[i].data);
		}
	}
	if (response.append instanceof Array) {
		for (i = 0, ilen = response.append.length; i < ilen; i++) {
			$(response.append[i].what).append(response.append[i].data);
		}
	}
	if (response.content instanceof Array) {
		for (i = 0, ilen = response.content.length; i < ilen; i++) {
			$(response.content[i].what).html(response.content[i].data);
		}
	}
	if (response.js) {
		$("body").append(response.js);
	}
	if (response.refresh) {
		window.location.reload(true);
	}
	if (response.redirect) {
		window.location.href = response.redirect;
	}
}
```

Возможности:

- replaces, заменить 1 и/или более блоков на странице. На сервере формируем в таком виде:

```
$data = [
                'replaces' => [
                    [
                        'data' => $this->renderPartial('_cart_positions'),
                        'what' => '.buscket-w .purchase'
                    ],
                    [
                        'data' => StoreProductCartPosition::getShowCartButton(),
                        'what' => 'a.btn-top-buscket.btn-round.btn-round__yell'
                    ]

                ],
            ];
        return Json::encode($data);
```

- append, добавить к элементу 1 и/или более блоков. На сервере формируем в таком виде:

```
$data = [
                'append' => [
                    [
                        'data' => $this->renderPartial('_cart_positions'),
                        'what' => '.buscket-w'
                    ],
                    [
                        'data' => StoreProductCartPosition::getShowCartButton(),
                        'what' => '.buscket-w'
                    ]

                ],
            ];
        return Json::encode($data);
```

- content, вставить контент в блок с указанным селектором. На сервере формируем в таком виде:

```
$data = [
                'content' => [
                    [
                        'data' => $this->renderPartial('_cart_positions'),
                        'what' => '.buscket-w'
                    ],
                    [
                        'data' => StoreProductCartPosition::getShowCartButton(),
                        'what' => '.buscket-w .button'
                    ]

                ],
            ];
        return Json::encode($data);
```

- js, добавить на страницу, и соответственно выполнить js-код. На сервере:

```
$data = [
                'js' => Html::script('showPopup(); $(".cart-form").remove();')
            ];
        return Json::encode($data);
```

- refresh, перезагрузить страницу. На сервере:

```
$data = [
                'refresh' => true
            ];
        return Json::encode($data);
```

- redirect, перенаправить на указанную страницу. На сервере:

```
$data = [
                'redirect' => News::getViewLink(['alias' => $model->alias])
            ];
        return Json::encode($data);
```

Все вышеуказанные параметры можна комбинировать на сервере в любом разумном кол-ве.

SEO
---------------
[SEO](docs/SEO.md)