# PHP SDK для API Основы (TJ, vc.ru, DTF)

[![Latest Version on Packagist][ico-version]][link-packagist]

## Требования
Требуется PHP 7.4 или выше.

## Установка

Вы можете установить пакет с помощью composer:

``` bash
$ composer require digtyarenko/osnova-php-sdk
```
## Документация

Полная документация доступна [здесь](./docs/getstarted.md).

## Примеры

### Лента статей

```php
<?php

use Osnova\Api\DtfApi;
use Osnova\Api\Service\Timeline\Enum\CategoryEnum;
use Osnova\Api\Service\Timeline\Enum\SortingEnum;
use Osnova\Api\Service\Timeline\TimelineService;

$api = DtfApi::init();
$timelineService = $api->getService(TimelineService::class);

$result = $timelineService->getTimeline(
    new CategoryEnum(CategoryEnum::INDEX),
    new SortingEnum(SortingEnum::RECENT)
)->getResult();
```

### Список подсайтов

```php
<?php

use Osnova\Api\DtfApi;
use Osnova\Api\Service\Subsite\Enum\TypeEnum;
use Osnova\Api\Service\Subsite\SubsiteService;

$api = DtfApi::init();
$subsiteService = $api->getService(SubsiteService::class);

$result = $subsiteService->getSubsitesList(new TypeEnum(TypeEnum::SECTIONS))->getResult();
```

### Лента статей подсайта

```php
<?php

use Osnova\Api\DtfApi;
use Osnova\Api\Service\Subsite\Enum\SortingEnum;
use Osnova\Api\Service\Subsite\SubsiteService;

$api = DtfApi::init();
$subsiteService = $api->getService(SubsiteService::class);

$result = $subsiteService->getSubsiteTimeline(
    64953,
    new SortingEnum(SortingEnum::TOP_WEEK)
)->getResult();
```

## Лицензия

The MIT License (MIT). Пожалуйста, просмотрите [файл лицензии](LICENSE.md) для получения более детальной информации.

[ico-version]: https://poser.pugx.org/digtyarenko/osnova-php-sdk/version?format=flat
[link-packagist]: https://packagist.org/packages/digtyarenko/osnova-php-sdk
