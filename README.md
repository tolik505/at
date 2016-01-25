Melon.ng Yii 2 Advanced Application Template
===================================

1. [Установка](#markdown-header-install)
2. [Кастомный CRUD](#markdown-header-crud)
3. [Полезности](#markdown-header-useful)
4. [SEO](#markdown-header-seo)

### Install

1. Клонируем, устанавливаем новую ветку на репозиторий вашего проекта

```
git clone git@bitbucket.org:vintageua/melon.ng.git project-name
cd project-name
git remote remove origin
git remote add origin git@bitbucket.org:vintageua/NEW_PROJECT.git
git push origin master
//для получения обновлений движка
git remote add upstream git@bitbucket.org:vintageua/melon.ng.git
```

2. Инициализация приложения и установка всех зависимостей

```
./init
composer install
```

3. Поднимаем миграции

```
./yii migrate --migrationPath=vendor/notgosu/yii2-meta-tag-module/src/migrations
./yii migrate --migrationPath=vendor/metalguardian/yii2-file-processor-module/src/migrations
./yii migrate --migrationPath=vendor/yiisoft/yii2/rbac/migrations

./yii migrate
```


### CRUD

1. [Backend](docs/Backend_crud.md)

2. Frontend
Особых наработок нету, все нужно делать вручную.
Все фронтенд-контроллеры наследуeм от `frontend/components/FrontendController`, пока в нем генерация 
canonical url для страниц, но в будущем будут еще общие штуки добавляться.



### Useful

1. [Загрузка и отображение файлов/изображений](docs/File_upload.md)


2. [Работа с данными при ajax-запросах](docs/Ajax_features.md)


3. [Configuration form builder](docs/Configuration.md)



### SEO

[SEO](docs/SEO.md)
