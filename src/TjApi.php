<?php declare(strict_types=1);

namespace Osnova\Api;

use Osnova\Api\Common\Config;
use Osnova\Api\Common\UserAgent;
use Osnova\Api\Component\Enum\DomainEnum;
use Osnova\Api\Component\Enum\ModeEnum;

/**
 * Class TjournalApi
 * @package Osnova\Api
 */
class TjApi
{
    /**
     * @param string|null $token
     * @param string $version
     * @param ModeEnum|null $mode
     * @param UserAgent|null $userAgent
     * @return Api
     */
    public static function init(
        string $token = null,
        string $version = Api::VERSION,
        ModeEnum $mode = null,
        UserAgent $userAgent = null
    ): Api
    {
        return new Api(new Config(new DomainEnum(DomainEnum::TJ), $token, $version, $mode, $userAgent));
    }
}
