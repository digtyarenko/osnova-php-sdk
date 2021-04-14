<?php declare(strict_types=1);

namespace Osnova\Api\Service\Tweets;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Params\CountOffsetParams;
use Osnova\Api\Component\Model\Tweet;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Tweets\Enum\ModeEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Tweets
 * @package Osnova\Api\Service\Tweets
 */
class TweetsService extends BaseService
{
    public const SERVICE = 'Tweets';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getTweets
     *
     * @param ModeEnum $mode
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getTweets(ModeEnum $mode, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName($mode, new CountOffsetParams($count, $offset))
            ->buildEntity(Tweet::class)
            ->call();
    }
}
