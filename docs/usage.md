# Использование

[< Назад](readme.md)

- [Инициализация](#Инициализация)
- [Сервисы](#Сервисы)
- [Ответ сервера](#Ответ-сервера)
- [Сущности](#Сущности)
- [ArrayOf](#ArrayOf)  
- [Enum](#Enum)

## Инициализация

Есть несколько способов инициализировать API.

##### 1. С помощью объекта обертки для конкретного сайта:

```php
<?php

use Osnova\Api\DtfApi;
use Osnova\Api\TjApi;
use Osnova\Api\VcApi;

$api = DtfApi::init();
// или
$api = TjApi::init();
// или
$api = VcApi::init();
```

В метод `init` можно передать конфигурацию: токен, версию API (по умолчанию будет использовано значение из `Api::VERSION`) и определить режим работы библиотеки. 

При необходимости можно передать данные о клиенте с помощью объекта `UserAgent`. Из этих данных для запроса будет сформирован заголовок `User-agent`.
Подробнее об этом можно прочитать в [официальной спецификации](https://cmtt-ru.github.io/osnova-api/redoc.html#section/Zagolovki-(headers)).

```php
<?php

use Osnova\Api\Common\UserAgent;
use Osnova\Api\Component\Enum\ModeEnum;
use Osnova\Api\DtfApi;

$api = DtfApi::init(
    YOUR_TOKEN_HERE, 
    '1.9', 
    new ModeEnum(ModeEnum::MODE_RAW), 
    new UserAgent('app-name', 'app-version')
);
```

По умолчанию библиотека работает в режиме `ModeEnum::MODE_ENTITY`. Это означает, что данные из ответа сервера будут преобразованы в соответстующие объекты-сущности (или в массив таких объектов). `ModeEnum::MODE_RAW` означает, что библиотека вернет ответ в виде распарсенной JSON строки.

##### 2. Альтернативный способ, инициализация напрямую:

```php
<?php

use Osnova\Api\Api;
use Osnova\Api\Common\Config;
use Osnova\Api\Common\UserAgent;
use Osnova\Api\Component\Enum\DomainEnum;

$userAgent = new UserAgent('app-name', 'app-version');

$config = (new Config(new DomainEnum(DomainEnum::DTF)))
    ->setToken(YOUR_TOKEN_HERE)
    ->setVersion('1.9')
    ->setUserAgent($userAgent);

$api = new Api($config);
```

Нужно обязательно указать сайт, с которым предстоить работать с помощью `DomainEnum`.

## Сервисы

Запросы осуществляются с помощью сервисов. В библиотеки реализована поддержка большинства сервисов, описанных в [спецификации](https://cmtt-ru.github.io/osnova-api/redoc.html).

Вызвать сервис можно с помощью метода `getService`. Пример:

```php
<?php

use Osnova\Api\DtfApi;
use Osnova\Api\Service\Entry\EntryService;

$api = DtfApi::init();
$service = $api->getService(EntryService::class);
```

Сервис предоставляет доступ к методам, которые также описаны в официальной спецификации. Например, для сервиса `EntryService` методы описаны [здесь](https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Entry).

Ниже пример запроса для создания записи. Создадим пост с несколькими изображениями, предварительно загрузив их. Также получим `id` подсайта зная только его url.

```php
<?php

use Osnova\Api\Common\Support\Storage\ArrayOf;
use Osnova\Api\DtfApi;
use Osnova\Api\Service\Entry\EntryService;
use Osnova\Api\Service\Uploader\UploaderService;

$api = DtfApi::init(YOUR_TOKEN_HERE);
$entryService = $api->getService(EntryService::class);
$uploaderService = $api->getService(UploaderService::class);

$images = [
    'https://example.com/image_1.jpg',
    'https://example.com/image_2.jpg'
];

$arrayOf = new ArrayOf();

foreach ($images as $image) {
    $response = $uploaderService->postUploaderExtract($image);
    $arrayOf->append(array_shift($response->getResult()));
}

$subsiteId = $entryService->getEntryLocate('https://dtf.ru/apitest')->getResult()->getData()['id'];
$response = $entryService->postEntryCreateSimple($subsiteId, 'Api test', 'Hello world', (string) $arrayOf);
```

Подробнее об использованных методах в спецификации: [UploaderService::postUploaderExtract](https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUploaderExtract), [EntryService::getEntryLocate](https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEntryLocate), [EntryService::postEntryCreateSimple](https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postEntryCreate).

`ArrayOf` - вспомогательный класс, который наследуется от `\ArrayObject` и может хранить любые сущности. При преобразовании в строку - возвращает JSON, что в данном случае полезно, так как в качестве параметра `attachments` метода `postEntryCreateSimple` ожидается именно строка.

## Ответ сервера

Результатом любого запроса является объект `Response`. Он хранит в себе строку `message` и `result`, который в зависимости от ответа сервера может быть сущностью, массивом сущностей булевым значением или `null` (`Model|Model[]|bool|null`). Возвращаются методами `getMessage` и `getResult` соответственно. Узнать, что именно будет возвращено методом можно из официальной спецификации.

### Ошибки

Если ответ сервера содержит данные об ошибке - будет возвращен объект `ErrorResponse`, в котором кроме сообщения `message` также доступен метод `getError` с кодом и дополнительной информацией об ошибке.

### Отсутствие токена

Использовать токен не обязательно. Однако некоторые методы требуют авторизации. Если такой метод будет вызван без токена будет выброшено исключение `TokenRequiredException`.

## Сущности

Сущность - объектное представление данных, описанная в [официальной спецификации](https://cmtt-ru.github.io/osnova-api/redoc.html). Имена свойств совпадают с описанными в спецификации (свойства которые присутствуют в модели, но незадокументированы подписаны соответствующим комментарием).

Получить доступ к свойствам можно напрямую (они публичные) или с помощью геттеров. Например, в сущности `Entry` есть свойства `$isRepost` и `$is_promoted` (с разным стилем написания). Свойства можно получить геттерами `getIsRepost` и `getIsPromoted` соответственно.

## ArrayOf

Если типом свойства указан подкласс `ArrayOf` - например `ArrayOfComment` для свойства `$commentsPreview` сущности `Entry` - будет возвращен специальный объект с набором сущностей (в данном случае `Comment`) - с которым можно работать как с массивом.

## Enum

Тип объектов `Enum` однозначно указывает диапазон значений, которые может хранить свойство или параметр в запросе.

Если типом свойства указан подкласс `Enum` - например `EntryTypeEnum` для свойства `$type` сущности `Entry` - при использовании геттера (в данном случае `getType()`) будет возвращено строковое значение.

Если такой тип указан в качестве аргумента метода, то необходимо инициализировать такой объект и передать в его конструктор конкретное значение из его набора. Пример запроса `EntryService::postLikeEntry` (поставим лайк некой записи):

```php
$entryService->postLikeEntry($entryId, new TypeStringEnum(TypeStringEnum::CONTENT), new SignEnum(SignEnum::UP));
```
