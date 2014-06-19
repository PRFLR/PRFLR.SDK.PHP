PRFLR.SDK.PHP
=============

PHP
=============

Пример использования:
```php
<?php

include('./prflr.php');

// configure profiler
//  выставляем источник таймеров (имя сервера к примеру)  и прописываем API ключ 
PRFLR::init('11msHost', 'YourApiKey');

PRFLR::Begin('checkUDP');  //стартуем таймер чтобы понять продолжительность цикла целиком
for ($i = 0; $i < 100; $i++) {
//start timer
    $r = rand(1,9);
    PRFLR::Begin('test.timer'.$r); // стартуем таймер в цикле
    sleep(1);
    PRFLR::End('test.timer'.$r, "step {$i}");
}
PRFLR::End('checkUDP', $i);  //завершаем таймер и щаодно информируем сколько было шакгов в цикле 
?>
```




Yii Framework
=============

Качаем файлы:
https://github.com/PRFLR/PRFLR.SDK.PHP.git


Добавляем в config.php : 
```php
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
```
И в начале конфига вот такие 2 строчки, так профайлер работает лучше:
```php
<?php
Yii::getLogger()->autoDump = 1;
Yii::getLogger()->autoFlush = 1;
```

Если вы используете в проекте  Yii::app()>profile(), то все данные пойдут в PRFLR, где их будет удобно анализировать по различным срезам статистики. ﻿

А если не используете, то самое время начать.

Good luck! =)
