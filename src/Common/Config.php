<?php declare(strict_types=1);

namespace Osnova\Api\Common;

use Osnova\Api\Api;
use Osnova\Api\Component\Enum\DomainEnum;
use Osnova\Api\Component\Enum\ModeEnum;
use Osnova\Api\Exception\InvalidTokenException;

/**
 * Class Config
 * @package Osnova\Api\Common
 */
class Config
{
    private string $token;
    private string $version;
    private DomainEnum $domain;
    private ModeEnum $mode;
    private UserAgent $userAgent;

    /**
     * @param DomainEnum $domain
     * @param string|null $token
     * @param string $version
     * @param ModeEnum|null $mode
     * @param UserAgent|null $userAgent
     */
    public function __construct(
        DomainEnum $domain,
        string $token = null,
        string $version = Api::VERSION,
        ModeEnum $mode = null,
        UserAgent $userAgent = null
    )
    {
        $this->domain = $domain;

        if (null !== $token) {
            $this->token = $token;
        }

        $this->$version = $version;
        $this->mode = $mode ?: new ModeEnum(ModeEnum::MODE_ENTITY);
    }

    public function getDomain(): string
    {
        return (string) $this->domain;
    }

    public function getMode(): string
    {
        return (string) $this->mode;
    }

    /**
     * @return bool
     */
    public function hasToken(): bool
    {
        return !empty($this->token);
    }

    /**
     * @return string
     * @throws InvalidTokenException
     */
    public function getToken(): string
    {
        if (empty($this->token)) {
            throw new InvalidTokenException('Invalid token');
        }

        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): Config
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version ?? Api::VERSION;
    }

    /**
     * @param string $version
     * @return Config
     */
    public function setVersion(string $version): Config
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasUserAgent(): bool
    {
        return !empty($this->userAgent);
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return (string) $this->userAgent;
    }

    /**
     * @param UserAgent $userAgent
     * @return $this
     */
    public function setUserAgent(UserAgent $userAgent): Config
    {
        $this->userAgent = $userAgent;
        return $this;
    }
}
