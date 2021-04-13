<?php declare(strict_types=1);

namespace Osnova\Api\Service\Widgets;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Component\Model\Rates;
use Osnova\Api\Exception\InvalidEntityClassException;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Exception\InvalidTokenException;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\UnexpectedResultTypeException;
use Osnova\Api\Service\BaseService;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Widgets
 * @package Osnova\Api\Service\Widgets
 */
class WidgetsService extends BaseService
{
    public const SERVICE = 'Widgets';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getRates
     *
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function getRates(): IResponse
    {
        return $this
            ->prepare('rates')
            ->buildEntity(Rates::class)
            ->call();
    }
}
