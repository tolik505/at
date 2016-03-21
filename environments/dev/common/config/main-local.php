<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=melon',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'schemaMap' => [
                'pgsql' => 'yii\db\pgsql\Schema', // PostgreSQL
                'mysqli' => '\common\components\Schema', // MySQL
                'mysql' => '\common\components\Schema', // MySQL
                'sqlite' => 'yii\db\sqlite\Schema', // sqlite 3
                'sqlite2' => 'yii\db\sqlite\Schema', // sqlite 2
                'sqlsrv' => 'yii\db\mssql\Schema', // newer MSSQL driver on MS Windows hosts
                'oci' => 'yii\db\oci\Schema', // Oracle driver
                'mssql' => 'yii\db\mssql\Schema', // older MSSQL driver on MS Windows hosts
                'dblib' => 'yii\db\mssql\Schema', // dblib drivers on GNU/Linux (and maybe other OSes) hosts
                'cubrid' => 'yii\db\cubrid\Schema', // CUBRID
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => '\yii\caching\DummyCache',
        ],
    ],
];
