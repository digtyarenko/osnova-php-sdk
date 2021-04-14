<?php declare(strict_types=1);

namespace Osnova\Api\Service\Uploader;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Component\Model\Custom\UploaderResultObject;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Upload
 * @package Osnova\Api\Service\Upload
 */
class UploaderService extends BaseService
{
    public const SERVICE = 'Uploader';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUploaderExtract
     *
     * @param string $url
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUploaderExtract(string $url): IResponse
    {
        return $this
            ->prepareWithName('extract', ['url' => $url])
            ->setMethod(Method::POST)
            ->buildEntity(UploaderResultObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postUploaderUpload
     *
     * @param string $file
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postUploaderUpload(string $file): IResponse
    {
        return $this
            ->prepareWithName('extract', ['file' => $file])
            ->setMethod(Method::POST)
            ->buildEntity(UploaderResultObject::class)
            ->call();
    }
}
