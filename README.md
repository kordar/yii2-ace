# yii2-ace
Ace Admin Template For Yii2 Extension

### 邮件（组件）
````
'mailer' => [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '...',    // 'viewPath' => '@kordar/ace/mail',
    // send all mails to a file by default. You have to set
    // useFileTransport to false and configure a transport
    // for the mailer to send real emails.
    'useFileTransport' => false,
			
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.qq.com',
        'port' => 587,
        'encryption' => 'tls',
        'username' => '*******',
        'password' => '*******',  
    ],
    
    // 发送的邮件信息配置
    'messageConfig' => [
        'charset' => 'utf-8',
        'from' => ['******@qq.com' => '***']
    ],		
],


// params 配置
'supportEmail' => '*****@qq.com',   // 设置发件人邮箱
````

### 密码重置
````
// params 配置
'user.passwordResetTokenExpire' => 3600,    // 配置密码重置token过期时间
````


### 语言包（组件）
````
'i18n' => [
  'translations' => [
      'ace*' => [
          'class' => 'yii\i18n\PhpMessageSource',
          'basePath' => '@kordar/ace/web/messages',
          // 'sourceLanguage' => 'en-US',
          'fileMap' => [
              'ace' => 'ace.php',
              'ace.sidebar' => 'ace.sidebar.php',
              'app/error' => 'error.php',
          ],
      ],
      // 上传组件语言包
      'upload' => [
          'class' => 'yii\i18n\PhpMessageSource',
          'basePath' => '@kordar/upload/messages',
      ],
  ],
],
`````

### ErrorAction（组件）
````
'errorHandler' => [
    'errorAction' => 'ace/default/error',
],
````

### AssetManager（组件）
````
'assetManager' => [
    'class' => 'yii\web\AssetManager',
    'appendTimestamp' => true,
    'forceCopy' => false,
    'bundles' => [
        'yii\web\JqueryAsset' => [
            'sourcePath' => '@kordar/ace/assets/ace/assets',
            'js' => [
                ['js/jquery-2.1.4.min.js', 'condition'=>'!IE'],
                ['js/jquery-1.11.3.min.js', 'condition'=>'IE'],
            ]
        ],
        'yii\bootstrap\BootstrapAsset' => [
            'sourcePath' => '@kordar/ace/assets/ace/assets',
            'css' => [
                'css/bootstrap.min.css'
            ]
        ],
        'yii\bootstrap\BootstrapPluginAsset' => [
            'sourcePath' => '@kordar/ace/assets/ace/assets',
            'js' => [
                'js/bootstrap.min.js'
            ]
        ],
    ],
],
````

### AuthManager（组件）
````
'authManager' => [
    'class' => 'yii\rbac\DbManager',
    'itemTable' => '{{%auth_item}}',
    'itemChildTable' => '{{%auth_item_child}}',
    'assignmentTable' => '{{%auth_assignment}}',
    'ruleTable' => '{{%auth_rule}}',
    'defaultRoles' => ['guest'],
],
````

### Redis（组件）
````
'redis' => [
    'class' => 'yii\redis\Connection',
    'hostname' => '127.0.0.1',
    'port' => 6379,
    'database' => 0,
],
````

### Session（组件）
````$xslt
'session' => [
    // this is the name of the session cookie used for login on the backend
    'class'=>'yii\redis\Session',
    //'timeout'=>3600,
    /*
    'keyPrefix'=>'qian',
    'cookieParams' => [
        'path' => '/',
        'domain' => ".qian.com",
    ],
    */
    'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => '127.0.0.1',
        'port' => 6379,
        'database' => 1,
    ],
],
````

### Modules
````$xslt
'modules' => [
    'ace' => [
        'class' => 'kordar\ace\Module',
    ],
    'rbac' => [
        'class' => 'kordar\ace\modules\rbac\Module',
    ],
],
````

### Formatter（组件）
````$xslt
'formatter' => [
    'dateFormat' => 'yyyy-MM-dd',
    'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
    /*
    'decimalSeparator' => ',',
    'thousandSeparator' => ' ',
    'currencyCode' => 'CNY',
    */
],
````

### 用户认证（组件）
````$xslt
'user' => [
    'identityClass' => 'kordar\ace\models\admin\Admin',
    'enableAutoLogin' => true,
    'identityCookie' => ['name' => '__ace_identity', 'httpOnly' => true],
    'idParam' => '__ace_admin',
    'loginUrl' => ['/ace/auth/login'],
],
````