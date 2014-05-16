PRFLR.SDK.PHP
=============


Yii Framework
=============

Качаем файлы:
https://github.com/PRFLR/PRFLR.SDK.PHP.git


Добавляем в config.php : 

'log' => array(
        'class' => 'CLogRouter',
                 'routes' => array(
                       array(
                              'class' =>'application.ext.PRFLR.PRFLRLogRoute',
                              'enabled' => true,
                              'levels'  => 'profile',
                              'source' => 'myserver1.ru',
                              'apikey' => 'youApiKey'
                         ),
                  ),
 ),

И в начале конфига вот такие 2 строчки, так профайлер работает лучше:
<?php
Yii::getLogger()->autoDump = 1;
Yii::getLogger()->autoFlush = 1;


Если вы используете в проекте  yii::app()>profile()      то все данные пойдут в PRFLR, где их будет удобно анализировать по различным срезам статистики. ﻿
