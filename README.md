Melon Yii 2 Advanced Application Template
===================================

репозиторий `https://bitbucket.org/vintageua/melon.ng/branch/testing`
находится в ветке `testing`

склонить, удалить origin, добавить origin нового репозитория, залить ветку в мастер нового ориджина, сменить ветку на мастер

```
git clone git@bitbucket.org:vintageua/melon.ng.git
git checkout testing
git remote remove origin
git remote add origin git@bitbucket.org:vintageua/NEW_PROJECT.git
git push origin master
git branch -D master
git checkout master
```

фронт используется как есть, все нужно делать вручную

на беке есть готовый круд, который генерируется в специльно созданых gii темплейтах
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANZ2h2d054LXZ0SUU/view?usp=drivesdk

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

генерация модели:
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANSU8zNDctclFCbFU/view?usp=drivesdk
выбираем имя таблицы, выбираем имя модели. модели создадутся в common/models и common/models/base
(не забываем про мультиязыковую таблицу, если она есть - ее нужно отдельно создать)
модель в common/models/base можно менять как угодно, и она дальше не будет перегенериваться в gii
модель в common/models будет перегенериваться - там хранится общая информация, которая не зависит от бизнес логики, ее трогать не нужно

код для мультиязыка будет добавлен автоматически (на основании названий таблиц, поэтому название таблицы переводов не нужно менять)

дальше мы создаем модуль
https://drive.google.com/a/vintage.com.ua/file/d/0B66RPwG-7oANLXl4YnpnZFo4THc/view?usp=drivesdk
тут ничего необычного, просто структура генерируемых файлов немного изменена

добавляем модуль в конфигурацию бекенда и делаем круд в gii
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


загрузка файлов:

поле в табице
'file_id' => Schema::TYPE_INTEGER . ' NULL DEFAULT NULL COMMENT "File"'

поле в форме:

'file_id' => [
    'type' => ActiveFormBuilder::INPUT_FILE,
],

бехевиор в моделе в common/models/base

'file' => [
    'class' => \metalguardian\fileProcessor\behaviors\UploadBehavior::className(),
    'attribute' => 'file_id',
    //'required' => false,
],

поле file_id необходимо убрать из рулов модели (для полей с именем image_id, file_id - gii делает это автоматически)
