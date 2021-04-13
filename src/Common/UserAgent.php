<?php declare(strict_types=1);

namespace Osnova\Api\Common;

/**
 * Class UserAgent
 * @package Osnova\Api\Common
 */
class UserAgent
{
    public string $appName;
    public string $appVersion;
    public string $deviceName;
    public string $osName;
    public string $osVersion;
    public string $locale;
    public int $screenHeight;
    public int $screenWidth;

    /**
     * @param string $appName
     * @param string $appVersion
     * @param string $deviceName
     * @param string $osName
     * @param string $osVersion
     * @param string $locale
     * @param int $screenHeight
     * @param int $screenWidth
     */
    public function __construct(
        string $appName,
        string $appVersion,
        string $deviceName = '',
        string $osName = '',
        string $osVersion = '',
        string $locale = '',
        int $screenHeight = 0,
        int $screenWidth = 0
    )
    {
        $this->appName = $appName;
        $this->appVersion = $appVersion;
        $this->deviceName = $deviceName;
        $this->osName = $osName;
        $this->osVersion = $osVersion;
        $this->locale = $locale;
        $this->screenHeight = $screenHeight;
        $this->screenWidth = $screenWidth;
    }

    public function __toString()
    {
        return $this->getComputedUserAgent();
    }

    /**
     * @return string
     */
    private function getComputedUserAgent(): string
    {
        return trim(implode(' ', [
            $this->getAppPart(),
            $this->getDevicePart(),
        ]));
    }

    /**
     * @return string
     */
    private function getAppPart(): string
    {
        return sprintf('%s-app/%s', $this->appName, $this->appVersion);
    }

    /**
     * @return string
     */
    private function getDevicePart(): string
    {
        if (empty($this->deviceName)
            || empty($this->osName)
            || empty($this->osVersion)
            || empty($this->locale)
            || empty($this->screenHeight)
            || empty($this->screenWidth)) {
            return '';
        }

        return sprintf(
            '(%s; %s/%s; %s; %dx%d)',
            $this->deviceName,
            $this->osName,
            $this->osVersion,
            $this->locale,
            $this->screenHeight,
            $this->screenWidth
        );
    }
}
