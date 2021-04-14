# Вступление

[< Назад](readme.md)

- [Установка](#Установка)
- [Пример использования](gettingstarted.md#Пример-использования)


## Установка

С помощью composer:

``` bash
$ composer require digtyarenko/osnova-php-sdk
```

## Пример использования

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
