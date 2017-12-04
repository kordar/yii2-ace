# yii2-ace
Ace Admin Template For Yii2 Extension

````
$config = array_merge_recursive(
    $config,
    require (dirname(__DIR__) . '/runtime/tmp-extensions/yii2-ace/config/ace.php')
);
````

``````
'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@kordar/ace/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
			
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                //我用的是QQ 的代理，所以这里是 QQ 的配置信息
                'host' => 'smtp.qq.com',
                'port' => 587,
                'encryption' => 'tls',
                //这部分信息不应该公开，所以后期会由数据库中拿取
                'username' => '605205796',
                'password' => 'fjpouagngihgbbbe',
		
				
				// 'verify_peer' => false,
				// 'verify_peer_name' => false,
				// 'allow_self_signed' => true,
				
				
            ],
            //发送的邮件信息配置
            'messageConfig' => [
                'charset' => 'utf-8',

                'from' => ['605205796@qq.com' => '阿毛']
            ],
			
        ],
  ``````
  
  ````
  'language' => 'zh-CN',
  
      'aliases' => [
          '@kordar/ace' => '@app/runtime/tmp-extensions/yii2-ace'
      ],
  
      'defaultRoute' => 'ace/default/index',
  
      'layoutPath' => '@kordar/ace/views/layouts',  # 布局文件
      'layout' => 'main',
  `````
  
  

